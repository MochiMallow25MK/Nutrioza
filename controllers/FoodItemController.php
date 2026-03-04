<?php
require_once 'models/FoodItem.php';
require_once 'models/Category.php';
require_once 'models/Supplier.php';

class FoodItemController {
    private $foodItemModel;
    private $categoryModel;
    private $supplierModel;

    public function __construct() {
        $this->foodItemModel = new FoodItem();
        $this->categoryModel = new Category();
        $this->supplierModel = new Supplier();
    }

    public function index() {
        $items = $this->foodItemModel->read();
        include 'views/inventory/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'category_id' => $_POST['category_id'],
                'supplier_id' => $_POST['supplier_id'],
                'quantity' => $_POST['quantity'],
                'expiry_date' => $_POST['expiry_date']
            ];
            
            if ($this->foodItemModel->create($data)) {
                $_SESSION['success'] = 'Food item added successfully';
                header('Location: /nutrioza/inventory.php');
            } else {
                $_SESSION['error'] = 'Failed to add food item';
                header('Location: /nutrioza/inventory/create.php');
            }
        } else {
            $categories = $this->categoryModel->read();
            $suppliers = $this->supplierModel->read();
            include 'views/inventory/create.php';
        }
    }

    public function lowStock() {
        $items = $this->foodItemModel->getLowStock();
        include 'views/inventory/low-stock.php';
    }

    public function nearExpiry() {
        $items = $this->foodItemModel->getNearExpiry();
        include 'views/inventory/expiring.php';
    }
}
?>