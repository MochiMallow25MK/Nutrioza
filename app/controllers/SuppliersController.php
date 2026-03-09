<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/Supplier.php';
require_once __DIR__ . '/../models/FoodItem.php';

class SuppliersController extends Controller {
    private $supplierModel;
    private $foodItemModel;
    
    public function __construct() {
        $this->supplierModel = new Supplier();
        $this->foodItemModel = new FoodItem();
    }
    
    public function index() {
        $suppliers = $this->supplierModel->all();
        $this->view('suppliers.index', ['suppliers' => $suppliers]);
    }
    
    public function create() {
        $this->view('suppliers.create');
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->supplierModel->create($_POST)) {
                $_SESSION['success'] = "Supplier created successfully";
                $this->redirect('/suppliers');
            } else {
                $_SESSION['error'] = "Error creating supplier";
                $this->redirect('/suppliers/create');
            }
        }
    }
    
    public function show($id) {
        $supplier = $this->supplierModel->find($id);
        $this->view('suppliers.show', ['supplier' => $supplier]);
    }
    
    public function edit($id) {
        $supplier = $this->supplierModel->find($id);
        $this->view('suppliers.edit', ['supplier' => $supplier]);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->supplierModel->update($id, $_POST)) {
                $_SESSION['success'] = "Supplier updated successfully";
                $this->redirect('/suppliers');
            } else {
                $_SESSION['error'] = "Error updating supplier";
                $this->redirect('/suppliers/edit/' . $id);
            }
        }
    }
    
    public function destroy($id) {
        if ($this->supplierModel->hasFoodItems($id)) {
            $_SESSION['error'] = "Cannot delete supplier with food items";
        } else {
            if ($this->supplierModel->delete($id)) {
                $_SESSION['success'] = "Supplier deleted successfully";
            } else {
                $_SESSION['error'] = "Error deleting supplier";
            }
        }
        $this->redirect('/suppliers');
    }
    
    public function purchaseOrders() {
        $suppliers = $this->supplierModel->all();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['supplier_id'])) {
            $supplier_id = $_POST['supplier_id'];
            $supplier = $this->supplierModel->find($supplier_id);
            $items = $this->supplierModel->getItemsForReorder($supplier_id);
            $this->view('suppliers.purchase_orders', [
                'suppliers' => $suppliers,
                'selected_supplier' => $supplier,
                'items' => $items
            ]);
        } else {
            $this->view('suppliers.purchase_orders', ['suppliers' => $suppliers]);
        }
    }
    
    public function performance() {
        $start_date = $_GET['start_date'] ?? date('Y-m-01', strtotime('-3 months'));
        $end_date = $_GET['end_date'] ?? date('Y-m-d');
        
        $performance = $this->supplierModel->getSupplierPerformance($start_date, $end_date);
        $this->view('suppliers.performance', [
            'performance' => $performance,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);
    }
}
?>