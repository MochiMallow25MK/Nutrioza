<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/Category.php';

class CategoriesController extends Controller {
    private $categoryModel;
    
    public function __construct() {
        $this->categoryModel = new Category();
    }
    
    public function index() {
        $categories = $this->categoryModel->all();
        $this->view('categories.index', ['categories' => $categories]);
    }
    
    public function create() {
        $this->view('categories.create');
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->categoryModel->create($_POST)) {
                $_SESSION['success'] = "Category created successfully";
                $this->redirect('/categories');
            } else {
                $_SESSION['error'] = "Error creating category";
                $this->redirect('/categories/create');
            }
        }
    }
    
    public function show($id) {
        $category = $this->categoryModel->find($id);
        $this->view('categories.show', ['category' => $category]);
    }
    
    public function edit($id) {
        $category = $this->categoryModel->find($id);
        $this->view('categories.edit', ['category' => $category]);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->categoryModel->update($id, $_POST)) {
                $_SESSION['success'] = "Category updated successfully";
                $this->redirect('/categories');
            } else {
                $_SESSION['error'] = "Error updating category";
                $this->redirect('/categories/edit/' . $id);
            }
        }
    }
    
    public function destroy($id) {
        if ($this->categoryModel->hasFoodItems($id)) {
            $_SESSION['error'] = "Cannot delete category with food items";
        } else {
            if ($this->categoryModel->delete($id)) {
                $_SESSION['success'] = "Category deleted successfully";
            } else {
                $_SESSION['error'] = "Error deleting category";
            }
        }
        $this->redirect('/categories');
    }
    
    public function stats() {
        $stats = $this->categoryModel->getCategoryStats();
        $this->view('categories.stats', ['stats' => $stats]);
    }
}
?>