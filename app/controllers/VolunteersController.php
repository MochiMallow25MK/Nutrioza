<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/Volunteer.php';
require_once __DIR__ . '/../models/User.php';

class VolunteersController extends Controller {
    private $volunteerModel;
    private $userModel;
    
    public function __construct() {
        $this->volunteerModel = new Volunteer();
        $this->userModel = new User();
    }
    
    public function index() {
        $volunteers = $this->volunteerModel->getAllWithReviewer();
        $this->view('volunteers.index', ['volunteers' => $volunteers]);
    }
    
    public function create() {
        $this->view('volunteers.create');
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->volunteerModel->create($_POST)) {
                $_SESSION['success'] = "Volunteer application submitted successfully";
                $this->redirect('/volunteers');
            } else {
                $_SESSION['error'] = "Error submitting application";
                $this->redirect('/volunteers/create');
            }
        }
    }
    
    public function show($id) {
        $volunteer = $this->volunteerModel->find($id);
        if ($volunteer['reviewed_by']) {
            $reviewer = $this->userModel->find($volunteer['reviewed_by']);
            $volunteer['reviewer_name'] = $reviewer['name'];
        }
        $this->view('volunteers.show', ['volunteer' => $volunteer]);
    }
    
    public function edit($id) {
        $volunteer = $this->volunteerModel->find($id);
        $this->view('volunteers.edit', ['volunteer' => $volunteer]);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->volunteerModel->update($id, $_POST)) {
                $_SESSION['success'] = "Volunteer updated successfully";
                $this->redirect('/volunteers');
            } else {
                $_SESSION['error'] = "Error updating volunteer";
                $this->redirect('/volunteers/edit/' . $id);
            }
        }
    }
    
    public function destroy($id) {
        if ($this->volunteerModel->delete($id)) {
            $_SESSION['success'] = "Volunteer deleted successfully";
        } else {
            $_SESSION['error'] = "Error deleting volunteer";
        }
        $this->redirect('/volunteers');
    }
    
    public function approve($id) {
        if (isset($_SESSION['user_id'])) {
            if ($this->volunteerModel->approve($id, $_SESSION['user_id'])) {
                $_SESSION['success'] = "Volunteer approved successfully";
            } else {
                $_SESSION['error'] = "Error approving volunteer";
            }
        }
        $this->redirect('/volunteers');
    }
    
    public function reject($id) {
        if (isset($_SESSION['user_id'])) {
            if ($this->volunteerModel->reject($id, $_SESSION['user_id'])) {
                $_SESSION['success'] = "Volunteer rejected successfully";
            } else {
                $_SESSION['error'] = "Error rejecting volunteer";
            }
        }
        $this->redirect('/volunteers');
    }
}
?>