<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Role.php';

class UsersController extends Controller {
    private $userModel;
    private $roleModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->roleModel = new Role();
    }
    
    public function index() {
        $users = $this->userModel->getAllWithRoles();
        $this->view('users.index', ['users' => $users]);
    }
    
    public function create() {
        $roles = $this->roleModel->all();
        $this->view('users.create', ['roles' => $roles]);
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->userModel->create($_POST)) {
                $_SESSION['success'] = "User created successfully";
                $this->redirect('/users');
            } else {
                $_SESSION['error'] = "Error creating user";
                $this->redirect('/users/create');
            }
        }
    }
    
    public function show($id) {
        $user = $this->userModel->find($id);
        $role = $this->roleModel->find($user['role_id']);
        $user['role_name'] = $role['role_name'];
        $this->view('users.show', ['user' => $user]);
    }
    
    public function edit($id) {
        $user = $this->userModel->find($id);
        $roles = $this->roleModel->all();
        $this->view('users.edit', ['user' => $user, 'roles' => $roles]);
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->userModel->update($id, $_POST)) {
                $_SESSION['success'] = "User updated successfully";
                $this->redirect('/users');
            } else {
                $_SESSION['error'] = "Error updating user";
                $this->redirect('/users/edit/' . $id);
            }
        }
    }
    
    public function destroy($id) {
        $user = $this->userModel->find($id);
        $role = $this->roleModel->find($user['role_id']);
        
        if ($role['role_name'] == 'Admin') {
            $_SESSION['error'] = "Cannot delete Admin users";
        } else {
            if ($this->userModel->delete($id)) {
                $_SESSION['success'] = "User deleted successfully";
            } else {
                $_SESSION['error'] = "Error deleting user";
            }
        }
        $this->redirect('/users');
    }
}
?>