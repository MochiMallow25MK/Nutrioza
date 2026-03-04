<?php
require_once 'config/database.php';
require_once 'interfaces/CrudInterface.php';

class FoodItem implements CrudInterface {
    private $conn;
    private $table = 'food_items';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (name, category_id, supplier_id, quantity, expiry_date) 
                  VALUES (:name, :category_id, :supplier_id, :quantity, :expiry_date)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':supplier_id', $data['supplier_id']);
        $stmt->bindParam(':quantity', $data['quantity']);
        $stmt->bindParam(':expiry_date', $data['expiry_date']);
        
        return $stmt->execute();
    }

    public function read($id = null) {
        if ($id) {
            $query = "SELECT f.*, c.category_name, s.name as supplier_name 
                      FROM " . $this->table . " f 
                      JOIN categories c ON f.category_id = c.category_id 
                      JOIN suppliers s ON f.supplier_id = s.supplier_id 
                      WHERE f.item_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
        } else {
            $query = "SELECT f.*, c.category_name, s.name as supplier_name 
                      FROM " . $this->table . " f 
                      JOIN categories c ON f.category_id = c.category_id 
                      JOIN suppliers s ON f.supplier_id = s.supplier_id 
                      ORDER BY f.expiry_date ASC";
            $stmt = $this->conn->prepare($query);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET name = :name, category_id = :category_id, 
                      supplier_id = :supplier_id, quantity = :quantity, 
                      expiry_date = :expiry_date 
                  WHERE item_id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':supplier_id', $data['supplier_id']);
        $stmt->bindParam(':quantity', $data['quantity']);
        $stmt->bindParam(':expiry_date', $data['expiry_date']);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE item_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getLowStock() {
        $query = "SELECT f.*, c.category_name, s.name as supplier_name 
                  FROM " . $this->table . " f 
                  JOIN categories c ON f.category_id = c.category_id 
                  JOIN suppliers s ON f.supplier_id = s.supplier_id 
                  WHERE f.quantity < 10 
                  ORDER BY f.quantity ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNearExpiry() {
        $query = "SELECT f.*, c.category_name, s.name as supplier_name 
                  FROM " . $this->table . " f 
                  JOIN categories c ON f.category_id = c.category_id 
                  JOIN suppliers s ON f.supplier_id = s.supplier_id 
                  WHERE f.expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) 
                  ORDER BY f.expiry_date ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>