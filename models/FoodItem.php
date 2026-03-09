<?php
require_once 'Model.php';

class FoodItem extends Model {
    protected $table = 'food_items';
    protected $primaryKey = 'item_id';
    
    public function create($data) {
        $name = $this->escape($data['name']);
        $category_id = (int)$data['category_id'];
        $supplier_id = (int)$data['supplier_id'];
        $quantity = (int)$data['quantity'];
        $expiry_date = $this->escape($data['expiry_date']);
        
        $sql = "INSERT INTO food_items (name, category_id, supplier_id, quantity, expiry_date) 
                VALUES ('$name', $category_id, $supplier_id, $quantity, '$expiry_date')";
        
        return $this->query($sql);
    }
    
    public function update($id, $data) {
        $name = $this->escape($data['name']);
        $category_id = (int)$data['category_id'];
        $supplier_id = (int)$data['supplier_id'];
        $quantity = (int)$data['quantity'];
        $expiry_date = $this->escape($data['expiry_date']);
        
        $sql = "UPDATE food_items SET 
                name='$name', 
                category_id=$category_id, 
                supplier_id=$supplier_id, 
                quantity=$quantity, 
                expiry_date='$expiry_date' 
                WHERE item_id=$id";
        
        return $this->query($sql);
    }
    
    public function getAllWithDetails() {
        $result = $this->query("SELECT f.*, c.category_name, s.name as supplier_name 
                                FROM food_items f 
                                JOIN categories c ON f.category_id = c.category_id 
                                JOIN suppliers s ON f.supplier_id = s.supplier_id");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function getLowStock($threshold = 50) {
        $result = $this->query("SELECT f.*, c.category_name, s.name as supplier_name 
                                FROM food_items f 
                                JOIN categories c ON f.category_id = c.category_id 
                                JOIN suppliers s ON f.supplier_id = s.supplier_id 
                                WHERE f.quantity < $threshold 
                                ORDER BY f.quantity ASC");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function getNearExpiry($days = 7) {
        $result = $this->query("SELECT f.*, c.category_name, s.name as supplier_name 
                                FROM food_items f 
                                JOIN categories c ON f.category_id = c.category_id 
                                JOIN suppliers s ON f.supplier_id = s.supplier_id 
                                WHERE f.expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL $days DAY)
                                ORDER BY f.expiry_date ASC");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function updateQuantity($id, $quantity) {
        $id = (int)$id;
        $quantity = (int)$quantity;
        return $this->query("UPDATE food_items SET quantity = quantity + $quantity WHERE item_id=$id");
    }
    
    public function hasDistributionRecords($id) {
        $id = (int)$id;
        $result = $this->query("SELECT COUNT(*) as count FROM distribution_details WHERE item_id=$id");
        $row = mysqli_fetch_assoc($result);
        return $row['count'] > 0;
    }
}
?>