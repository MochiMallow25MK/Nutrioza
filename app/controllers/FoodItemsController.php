<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/FoodItem.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Supplier.php';

class FoodItemsController extends Controller {
    private $foodItemModel;
    private $categoryModel;
    private $supplierModel;
    
    public function __construct() {
        $this->foodItemModel = new FoodItem();
        $this->categoryModel = new Category();
        $this->supplierModel = new Supplier();
    }
    
    public function index() {
        $items = $this->foodItemModel->getAllWithDetails();
        $this->view('fooditems.index', ['items' => $items]);
    }
    
    public function create() {
        $categories = $this->categoryModel->all();
        $suppliers = $this->supplierModel->all();
        $this->view('fooditems.create', [
            'categories' => $categories,
            'suppliers' => $suppliers
        ]);
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->foodItemModel->create($_POST)) {
                $_SESSION['success'] = "Food item added successfully";
                $this->redirect('/food-items');
            } else {
                $_SESSION['error'] = "Error adding food item";
                $this->redirect('/food-items/create');
            }
        }
    }
    
    public function show($id) {
        $item = $this->foodItemModel->find($id);
        $category = $this->categoryModel->find($item['category_id']);
        $supplier = $this->supplierModel->find($item['supplier_id']);
        $item['category_name'] = $category['category_name'];
        $item['supplier_name'] = $supplier['name'];
        $this->view('fooditems.show', ['item' => $item]);
    }
    
    public function edit($id) {
        $item = $this->foodItemModel->find($id);
        $categories = $this->categoryModel->all();
        $suppliers = $this->supplierModel->all();
        $this->view('fooditems.edit', [
            'item' => $item,
            'categories' => $categories,
            'suppliers' => $suppliers
        ]);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->foodItemModel->update($id, $_POST)) {
                $_SESSION['success'] = "Food item updated successfully";
                $this->redirect('/food-items');
            } else {
                $_SESSION['error'] = "Error updating food item";
                $this->redirect('/food-items/edit/' . $id);
            }
        }
    }
    
    public function destroy($id) {
        if ($this->foodItemModel->hasDistributionRecords($id)) {
            $_SESSION['error'] = "Cannot delete food item with distribution records";
        } else {
            if ($this->foodItemModel->delete($id)) {
                $_SESSION['success'] = "Food item deleted successfully";
            } else {
                $_SESSION['error'] = "Error deleting food item";
            }
        }
        $this->redirect('/food-items');
    }
    
    public function lowStock() {
        $items = $this->foodItemModel->getLowStock();
        $this->view('fooditems.lowstock', ['items' => $items]);
    }
    
    public function nearExpiry() {
        $items = $this->foodItemModel->getNearExpiry();
        $this->view('fooditems.nearexpiry', ['items' => $items]);
    }
}
?>