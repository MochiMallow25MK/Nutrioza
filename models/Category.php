<?php
require_once 'Model.php';

class Category extends Model {
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    
    public function create($data) {
        $category_name = $this->escape($data['category_name']);
        $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
        return $this->query($sql);
    }
    
    public function update($id, $data) {
        $category_name = $this->escape($data['category_name']);
        $sql = "UPDATE categories SET category_name='$category_name' WHERE category_id=$id";
        return $this->query($sql);
    }
    
    public function hasFoodItems($id) {
        $id = (int)$id;
        $result = $this->query("SELECT COUNT(*) as count FROM food_items WHERE category_id=$id");
        $row = mysqli_fetch_assoc($result);
        return $row['count'] > 0;
    }
    
    public function getCategoryStats() {
        $result = $this->query("SELECT c.category_name, COUNT(f.item_id) as item_count, SUM(f.quantity) as total_quantity 
                                FROM categories c 
                                LEFT JOIN food_items f ON c.category_id = f.category_id 
                                GROUP BY c.category_id");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
?>