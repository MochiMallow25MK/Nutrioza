<?php
require_once 'models/User.php';
require_once 'models/Role.php';

class UserController {
    private $userModel;
    private $roleModel;

    public function __construct() {
        $this->userModel = new User();
        $this->roleModel = new Role();
    }

    public function index() {
        $users = $this->userModel->read();
        include 'views/users/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role_id' => $_POST['role_id'],
                'status' => $_POST['status']
            ];
            
            if ($this->userModel->create($data)) {
                $_SESSION['success'] = 'User created successfully';
                header('Location: /nutrioza/users.php');
            } else {
                $_SESSION['error'] = 'Failed to create user';
                header('Location: /nutrioza/users/create.php');
            }
        } else {
            $roles = $this->roleModel->read();
            include 'views/users/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'role_id' => $_POST['role_id'],
                'status' => $_POST['status']
            ];
            
            if ($this->userModel->update($id, $data)) {
                $_SESSION['success'] = 'User updated successfully';
                header('Location: /nutrioza/users.php');
            } else {
                $_SESSION['error'] = 'Failed to update user';
                header('Location: /nutrioza/users/edit.php?id=' . $id);
            }
        } else {
            $user = $this->userModel->read($id)[0];
            $roles = $this->roleModel->read();
            include 'views/users/edit.php';
        }
    }

    public function delete($id) {
        if ($this->userModel->delete($id)) {
            $_SESSION['success'] = 'User deleted successfully';
        } else {
            $_SESSION['error'] = 'Failed to delete user';
        }
        header('Location: /nutrioza/users.php');
    }
}
?>