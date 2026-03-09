<?php
require_once 'Model.php';

class User extends Model {
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    
    public function create($data) {
        $name = $this->escape($data['name']);
        $email = $this->escape($data['email']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $role_id = (int)$data['role_id'];
        $status = $this->escape($data['status']);
        
        $sql = "INSERT INTO users (name, email, password, role_id, status) 
                VALUES ('$name', '$email', '$password', $role_id, '$status')";
        
        return $this->query($sql);
    }
    
    public function update($id, $data) {
        $name = $this->escape($data['name']);
        $email = $this->escape($data['email']);
        $role_id = (int)$data['role_id'];
        $status = $this->escape($data['status']);
        
        $sql = "UPDATE users SET name='$name', email='$email', role_id=$role_id, status='$status' 
                WHERE user_id=$id";
        
        return $this->query($sql);
    }
    
    public function getAllWithRoles() {
        $result = $this->query("SELECT u.*, r.role_name FROM users u JOIN roles r ON u.role_id = r.role_id");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function findByEmail($email) {
        $email = $this->escape($email);
        $result = $this->query("SELECT * FROM users WHERE email='$email'");
        return mysqli_fetch_assoc($result);
    }
    
    public function updatePassword($id, $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $id = (int)$id;
        return $this->query("UPDATE users SET password='$password' WHERE user_id=$id");
    }
}
?>