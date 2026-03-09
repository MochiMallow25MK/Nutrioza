<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/DistributionDetail.php';
require_once __DIR__ . '/../models/Distribution.php';
require_once __DIR__ . '/../models/FoodItem.php';

class DistributionDetailsController extends Controller {
    private $detailModel;
    private $distributionModel;
    private $foodItemModel;
    
    public function __construct() {
        $this->detailModel = new DistributionDetail();
        $this->distributionModel = new Distribution();
        $this->foodItemModel = new FoodItem();
    }
    
    public function index() {
        $details = $this->detailModel->getAllWithDetails();
        $this->view('distributiondetails.index', ['details' => $details]);
    }
    
    public function create() {
        $distributions = $this->distributionModel->all();
        $items = $this->foodItemModel->all();
        $this->view('distributiondetails.create', [
            'distributions' => $distributions,
            'items' => $items
        ]);
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_id = $_POST['item_id'];
            $quantity = $_POST['quantity'];
            
            if (!$this->detailModel->checkStock($item_id, $quantity)) {
                $_SESSION['error'] = "Not enough stock available";
                $this->redirect('/distribution-details/create');
                return;
            }
            
            if ($this->detailModel->create($_POST)) {
                $_SESSION['success'] = "Item added to distribution successfully";
                $this->redirect('/distribution-details');
            } else {
                $_SESSION['error'] = "Error adding item";
                $this->redirect('/distribution-details/create');
            }
        }
    }
    
    public function show($id) {
        $detail = $this->detailModel->find($id);
        $distribution = $this->distributionModel->find($detail['distribution_id']);
        $item = $this->foodItemModel->find($detail['item_id']);
        
        $detail['distribution_status'] = $distribution['status'];
        $detail['item_name'] = $item['name'];
        $detail['current_stock'] = $item['quantity'];
        
        $this->view('distributiondetails.show', ['detail' => $detail]);
    }
    
    public function edit($id) {
        $detail = $this->detailModel->find($id);
        $items = $this->foodItemModel->all();
        $this->view('distributiondetails.edit', [
            'detail' => $detail,
            'items' => $items
        ]);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $item_id = $_POST['item_id'];
            $quantity = $_POST['quantity'];
            
            if (!$this->detailModel->checkStock($item_id, $quantity)) {
                $_SESSION['error'] = "Not enough stock available";
                $this->redirect('/distribution-details/edit/' . $id);
                return;
            }
            
            if ($this->detailModel->update($id, $_POST)) {
                $_SESSION['success'] = "Distribution detail updated successfully";
                $this->redirect('/distribution-details');
            } else {
                $_SESSION['error'] = "Error updating detail";
                $this->redirect('/distribution-details/edit/' . $id);
            }
        }
    }
    
    public function destroy($id) {
        if ($this->detailModel->delete($id)) {
            $_SESSION['success'] = "Distribution detail deleted successfully";
        } else {
            $_SESSION['error'] = "Error deleting detail";
        }
        $this->redirect('/distribution-details');
    }
    
    public function byDistribution($distribution_id) {
        $details = $this->detailModel->getByDistribution($distribution_id);
        $distribution = $this->distributionModel->find($distribution_id);
        
        $this->view('distributiondetails.by_distribution', [
            'details' => $details,
            'distribution' => $distribution
        ]);
    }
}
?>