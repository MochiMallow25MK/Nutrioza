<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/Donation.php';
require_once __DIR__ . '/../models/Volunteer.php';

class FormController extends Controller {
    private $donationModel;
    private $volunteerModel;
    
    public function __construct() {
        $this->donationModel = new Donation();
        $this->volunteerModel = new Volunteer();
    }
    
    public function submitContact() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = mysqli_real_escape_string($this->db, $_POST['name']);
            $email = mysqli_real_escape_string($this->db, $_POST['email']);
            
            $sql = "INSERT INTO contact_messages (name, email, submitted_at) VALUES ('$name', '$email', NOW())";
            
            if (mysqli_query($this->db, $sql)) {
                $_SESSION['contact_success'] = true;
                $this->redirect('/contact?success=1');
            } else {
                $this->redirect('/contact?error=1');
            }
        } else {
            $this->redirect('/contact');
        }
    }
    
    public function submitDonation() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->donationModel->create($_POST)) {
                $_SESSION['success'] = "Donation submitted successfully!";
                $this->redirect('/workspace');
            } else {
                $_SESSION['error'] = "Error submitting donation";
                $this->redirect('/donation-form');
            }
        } else {
            $this->redirect('/donation-form');
        }
    }
    
    public function submitVolunteer() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->volunteerModel->create($_POST)) {
                $_SESSION['success'] = "Volunteer application submitted successfully!";
                $this->redirect('/workspace');
            } else {
                $_SESSION['error'] = "Error submitting application";
                $this->redirect('/volunteer-form');
            }
        } else {
            $this->redirect('/volunteer-form');
        }
    }
    
    public function showDonationForm() {
        require_once __DIR__ . '/../views/forms/donationform.php';
    }
    
    public function showVolunteerForm() {
        require_once __DIR__ . '/../views/forms/volunteeringform.php';
    }
}
?>