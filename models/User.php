<?php
require_once 'config/database.php';
require_once 'interfaces/CrudInterface.php';

class User implements CrudInterface {
    private $conn;
    private $table = 'users';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (name, email, password, role_id, status) 
                  VALUES (:name, :email, :password, :role_id, :status)";
        
        $stmt = $this->conn->prepare($query);
        
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role_id', $data['role_id']);
        $stmt->bindParam(':status', $data['status']);
        
        return $stmt->execute();
    }

    public function read($id = null) {
        if ($id) {
            $query = "SELECT u.*, r.role_name FROM " . $this->table . " u 
                      JOIN roles r ON u.role_id = r.role_id 
                      WHERE u.user_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
        } else {
            $query = "SELECT u.*, r.role_name FROM " . $this->table . " u 
                      JOIN roles r ON u.role_id = r.role_id 
                      ORDER BY u.created_at DESC";
            $stmt = $this->conn->prepare($query);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET name = :name, email = :email, role_id = :role_id, status = :status 
                  WHERE user_id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':role_id', $data['role_id']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function login($email, $password) {
        $query = "SELECT u.*, r.role_name FROM " . $this->table . " u 
                  JOIN roles r ON u.role_id = r.role_id 
                  WHERE u.email = :email AND u.status = 'active'";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>