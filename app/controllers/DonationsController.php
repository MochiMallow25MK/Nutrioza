<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/Donation.php';
require_once __DIR__ . '/../models/User.php';

class DonationsController extends Controller {
    private $donationModel;
    private $userModel;
    
    public function __construct() {
        $this->donationModel = new Donation();
        $this->userModel = new User();
    }
    
    public function index() {
        $donations = $this->donationModel->getAllWithReviewer();
        $this->view('donations.index', ['donations' => $donations]);
    }
    
    public function create() {
        $this->view('donations.create');
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->donationModel->create($_POST)) {
                $_SESSION['success'] = "Donation created successfully";
                $this->redirect('/donations');
            } else {
                $_SESSION['error'] = "Error creating donation";
                $this->redirect('/donations/create');
            }
        }
    }
    
    public function show($id) {
        $donation = $this->donationModel->find($id);
        if ($donation['reviewed_by']) {
            $reviewer = $this->userModel->find($donation['reviewed_by']);
            $donation['reviewer_name'] = $reviewer['name'];
        }
        $this->view('donations.show', ['donation' => $donation]);
    }
    
    public function edit($id) {
        $donation = $this->donationModel->find($id);
        $this->view('donations.edit', ['donation' => $donation]);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->donationModel->update($id, $_POST)) {
                $_SESSION['success'] = "Donation updated successfully";
                $this->redirect('/donations');
            } else {
                $_SESSION['error'] = "Error updating donation";
                $this->redirect('/donations/edit/' . $id);
            }
        }
    }
    
    public function destroy($id) {
        if ($this->donationModel->delete($id)) {
            $_SESSION['success'] = "Donation deleted successfully";
        } else {
            $_SESSION['error'] = "Error deleting donation";
        }
        $this->redirect('/donations');
    }
    
    public function approve($id) {
        if (isset($_SESSION['user_id'])) {
            if ($this->donationModel->approve($id, $_SESSION['user_id'])) {
                $_SESSION['success'] = "Donation approved successfully";
            } else {
                $_SESSION['error'] = "Error approving donation";
            }
        }
        $this->redirect('/donations');
    }
    
    public function reject($id) {
        if (isset($_SESSION['user_id'])) {
            if ($this->donationModel->reject($id, $_SESSION['user_id'])) {
                $_SESSION['success'] = "Donation rejected successfully";
            } else {
                $_SESSION['error'] = "Error rejecting donation";
            }
        }
        $this->redirect('/donations');
    }
}
?>