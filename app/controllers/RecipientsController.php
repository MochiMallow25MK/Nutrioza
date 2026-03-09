<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/Recipient.php';

class RecipientsController extends Controller {
    private $recipientModel;
    
    public function __construct() {
        $this->recipientModel = new Recipient();
    }
    
    public function index() {
        $recipients = $this->recipientModel->all();
        $this->view('recipients.index', ['recipients' => $recipients]);
    }
    
    public function create() {
        $this->view('recipients.create');
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->recipientModel->create($_POST)) {
                $_SESSION['success'] = "Recipient created successfully";
                $this->redirect('/recipients');
            } else {
                $_SESSION['error'] = "Error creating recipient";
                $this->redirect('/recipients/create');
            }
        }
    }
    
    public function show($id) {
        $recipient = $this->recipientModel->find($id);
        $distributions = $this->recipientModel->getDistributionHistory($id);
        $this->view('recipients.show', [
            'recipient' => $recipient,
            'distributions' => $distributions
        ]);
    }
    
    public function edit($id) {
        $recipient = $this->recipientModel->find($id);
        $this->view('recipients.edit', ['recipient' => $recipient]);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->recipientModel->update($id, $_POST)) {
                $_SESSION['success'] = "Recipient updated successfully";
                $this->redirect('/recipients');
            } else {
                $_SESSION['error'] = "Error updating recipient";
                $this->redirect('/recipients/edit/' . $id);
            }
        }
    }
    
    public function destroy($id) {
        if ($this->recipientModel->hasDistributions($id)) {
            $_SESSION['error'] = "Cannot delete recipient with distribution records";
        } else {
            if ($this->recipientModel->delete($id)) {
                $_SESSION['success'] = "Recipient deleted successfully";
            } else {
                $_SESSION['error'] = "Error deleting recipient";
            }
        }
        $this->redirect('/recipients');
    }
    
    public function byType($type) {
        $recipients = $this->recipientModel->getByType($type);
        $this->view('recipients.by_type', [
            'recipients' => $recipients,
            'type' => $type
        ]);
    }
}
?>