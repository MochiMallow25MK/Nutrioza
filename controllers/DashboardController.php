<?php
require_once 'models/FoodItem.php';
require_once 'models/Distribution.php';
require_once 'models/Donation.php';
require_once 'models/Volunteer.php';

class DashboardController {
    private $foodItemModel;
    private $distributionModel;
    private $donationModel;
    private $volunteerModel;

    public function __construct() {
        $this->foodItemModel = new FoodItem();
        $this->distributionModel = new Distribution();
        $this->donationModel = new Donation();
        $this->volunteerModel = new Volunteer();
    }

    public function index() {
        $stats = [
            'total_items' => count($this->foodItemModel->read()),
            'low_stock' => count($this->foodItemModel->getLowStock()),
            'near_expiry' => count($this->foodItemModel->getNearExpiry()),
            'pending_distributions' => count($this->distributionModel->getByStatus('Pending')),
            'pending_donations' => count($this->donationModel->getByStatus('Pending')),
            'pending_volunteers' => count($this->volunteerModel->getByStatus('Pending'))
        ];
        
        $role = $_SESSION['user_role'];
        
        switch($role) {
            case 1:
                include 'views/dashboard/admin.php';
                break;
            case 2:
                include 'views/dashboard/manager.php';
                break;
            case 3:
                include 'views/dashboard/warehouse.php';
                break;
            case 4:
                include 'views/dashboard/supplier.php';
                break;
            default:
                include 'views/dashboard/viewer.php';
        }
    }
}
?>