<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/Distribution.php';
require_once __DIR__ . '/../models/Recipient.php';
require_once __DIR__ . '/../models/User.php';

class DistributionsController extends Controller {
    private $distributionModel;
    private $recipientModel;
    private $userModel;
    
    public function __construct() {
        $this->distributionModel = new Distribution();
        $this->recipientModel = new Recipient();
        $this->userModel = new User();
    }
    
    public function index() {
        $distributions = $this->distributionModel->getAllWithDetails();
        $this->view('distributions.index', ['distributions' => $distributions]);
    }
    
    public function create() {
        $recipients = $this->recipientModel->all();
        $this->view('distributions.create', ['recipients' => $recipients]);
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $distribution_id = $this->distributionModel->create($_POST);
            if ($distribution_id) {
                $_SESSION['success'] = "Distribution created successfully";
                $this->redirect('/distributions/' . $distribution_id . '/add-items');
            } else {
                $_SESSION['error'] = "Error creating distribution";
                $this->redirect('/distributions/create');
            }
        }
    }
    
    public function show($id) {
        $distribution = $this->distributionModel->find($id);
        $recipient = $this->recipientModel->find($distribution['recipient_id']);
        $distribution['recipient_name'] = $recipient['name'];
        $distribution['recipient_type'] = $recipient['type'];
        $distribution['recipient_contact'] = $recipient['contact_info'];
        $distribution['recipient_address'] = $recipient['address'];
        
        if ($distribution['approved_by']) {
            $approver = $this->userModel->find($distribution['approved_by']);
            $distribution['approver_name'] = $approver['name'];
        }
        
        $items = $this->distributionModel->getDistributionItems($id);
        
        $this->view('distributions.show', [
            'distribution' => $distribution,
            'items' => $items
        ]);
    }
    
    public function edit($id) {
        $distribution = $this->distributionModel->find($id);
        $recipients = $this->recipientModel->all();
        $this->view('distributions.edit', [
            'distribution' => $distribution,
            'recipients' => $recipients
        ]);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->distributionModel->update($id, $_POST)) {
                $_SESSION['success'] = "Distribution updated successfully";
                $this->redirect('/distributions');
            } else {
                $_SESSION['error'] = "Error updating distribution";
                $this->redirect('/distributions/edit/' . $id);
            }
        }
    }
    
    public function destroy($id) {
        if ($this->distributionModel->delete($id)) {
            $_SESSION['success'] = "Distribution deleted successfully";
        } else {
            $_SESSION['error'] = "Error deleting distribution";
        }
        $this->redirect('/distributions');
    }
    
    public function approve($id) {
        if (isset($_SESSION['user_id'])) {
            if ($this->distributionModel->approve($id, $_SESSION['user_id'])) {
                $_SESSION['success'] = "Distribution approved successfully";
            } else {
                $_SESSION['error'] = "Error approving distribution";
            }
        }
        $this->redirect('/distributions');
    }
    
    public function deliver($id) {
        if ($this->distributionModel->markDelivered($id)) {
            $_SESSION['success'] = "Distribution marked as delivered";
        } else {
            $_SESSION['error'] = "Error updating distribution";
        }
        $this->redirect('/distributions');
    }
    
    public function addItems($id) {
        require_once __DIR__ . '/../models/FoodItem.php';
        $foodItemModel = new FoodItem();
        
        $distribution = $this->distributionModel->find($id);
        $items = $foodItemModel->all();
        
        $this->view('distributions.add_items', [
            'distribution' => $distribution,
            'items' => $items
        ]);
    }
}
?>