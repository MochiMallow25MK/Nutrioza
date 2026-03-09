<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/Role.php';

class RolesController extends Controller {
    private $roleModel;
    
    public function __construct() {
        $this->roleModel = new Role();
    }
    
    public function index() {
        $roles = $this->roleModel->all();
        $this->view('roles.index', ['roles' => $roles]);
    }
    
    public function create() {
        $this->view('roles.create');
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->roleModel->create($_POST)) {
                $_SESSION['success'] = "Role created successfully";
                $this->redirect('/roles');
            } else {
                $_SESSION['error'] = "Error creating role";
                $this->redirect('/roles/create');
            }
        }
    }
    
    public function show($id) {
        $role = $this->roleModel->find($id);
        $this->view('roles.show', ['role' => $role]);
    }
    
    public function edit($id) {
        $role = $this->roleModel->find($id);
        $this->view('roles.edit', ['role' => $role]);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->roleModel->update($id, $_POST)) {
                $_SESSION['success'] = "Role updated successfully";
                $this->redirect('/roles');
            } else {
                $_SESSION['error'] = "Error updating role";
                $this->redirect('/roles/edit/' . $id);
            }
        }
    }
    
    public function destroy($id) {
        if ($this->roleModel->hasUsers($id)) {
            $_SESSION['error'] = "Cannot delete role with assigned users";
        } else {
            if ($this->roleModel->delete($id)) {
                $_SESSION['success'] = "Role deleted successfully";
            } else {
                $_SESSION['error'] = "Error deleting role";
            }
        }
        $this->redirect('/roles');
    }
}
?>