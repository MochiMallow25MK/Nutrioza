<?php
require_once 'Model.php';

class Supplier extends Model {
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    
    public function create($data) {
        $name = $this->escape($data['name']);
        $contact_info = $this->escape($data['contact_info']);
        $address = $this->escape($data['address']);
        
        $sql = "INSERT INTO suppliers (name, contact_info, address) VALUES ('$name', '$contact_info', '$address')";
        return $this->query($sql);
    }
    
    public function update($id, $data) {
        $name = $this->escape($data['name']);
        $contact_info = $this->escape($data['contact_info']);
        $address = $this->escape($data['address']);
        
        $sql = "UPDATE suppliers SET name='$name', contact_info='$contact_info', address='$address' WHERE supplier_id=$id";
        return $this->query($sql);
    }
    
    public function hasFoodItems($id) {
        $id = (int)$id;
        $result = $this->query("SELECT COUNT(*) as count FROM food_items WHERE supplier_id=$id");
        $row = mysqli_fetch_assoc($result);
        return $row['count'] > 0;
    }
    
    public function getSupplierPerformance($start_date = null, $end_date = null) {
        $sql = "SELECT s.*, 
                COUNT(DISTINCT f.item_id) as total_items,
                SUM(f.quantity) as total_quantity,
                MAX(f.expiry_date) as latest_expiry,
                MIN(f.expiry_date) as earliest_expiry
                FROM suppliers s 
                LEFT JOIN food_items f ON s.supplier_id = f.supplier_id";
        
        if ($start_date && $end_date) {
            $start_date = $this->escape($start_date);
            $end_date = $this->escape($end_date);
            $sql .= " WHERE f.created_at BETWEEN '$start_date' AND '$end_date' OR f.created_at IS NULL";
        }
        
        $sql .= " GROUP BY s.supplier_id";
        
        $result = $this->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function getItemsForReorder($supplier_id, $threshold = 50) {
        $supplier_id = (int)$supplier_id;
        $result = $this->query("SELECT f.*, c.category_name 
                                FROM food_items f 
                                JOIN categories c ON f.category_id = c.category_id 
                                WHERE f.supplier_id=$supplier_id AND f.quantity < $threshold");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
?>