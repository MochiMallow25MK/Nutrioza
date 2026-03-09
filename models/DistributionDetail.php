<?php
require_once 'Model.php';

class DistributionDetail extends Model {
    protected $table = 'distribution_details';
    protected $primaryKey = 'detail_id';
    
    public function create($data) {
        $distribution_id = (int)$data['distribution_id'];
        $item_id = (int)$data['item_id'];
        $quantity = (int)$data['quantity'];
        
        $sql = "INSERT INTO distribution_details (distribution_id, item_id, quantity) 
                VALUES ($distribution_id, $item_id, $quantity)";
        
        if ($this->query($sql)) {
            $this->query("UPDATE food_items SET quantity = quantity - $quantity WHERE item_id=$item_id");
            return true;
        }
        return false;
    }
    
    public function update($id, $data) {
        $item_id = (int)$data['item_id'];
        $quantity = (int)$data['quantity'];
        
        $old = $this->find($id);
        
        $this->query("UPDATE food_items SET quantity = quantity + {$old['quantity']} WHERE item_id={$old['item_id']}");
        
        $sql = "UPDATE distribution_details SET item_id=$item_id, quantity=$quantity WHERE detail_id=$id";
        
        if ($this->query($sql)) {
            $this->query("UPDATE food_items SET quantity = quantity - $quantity WHERE item_id=$item_id");
            return true;
        }
        return false;
    }
    
    public function delete($id) {
        $detail = $this->find($id);
        $this->query("UPDATE food_items SET quantity = quantity + {$detail['quantity']} WHERE item_id={$detail['item_id']}");
        return parent::delete($id);
    }
    
    public function getAllWithDetails() {
        $result = $this->query("SELECT dd.*, d.distribution_id as dist_id, f.name as item_name 
                                FROM distribution_details dd 
                                JOIN distributions d ON dd.distribution_id = d.distribution_id 
                                JOIN food_items f ON dd.item_id = f.item_id");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function getByDistribution($distribution_id) {
        $distribution_id = (int)$distribution_id;
        $result = $this->query("SELECT dd.*, f.name as item_name 
                                FROM distribution_details dd 
                                JOIN food_items f ON dd.item_id = f.item_id 
                                WHERE dd.distribution_id = $distribution_id");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function checkStock($item_id, $quantity) {
        $item_id = (int)$item_id;
        $result = $this->query("SELECT quantity FROM food_items WHERE item_id=$item_id");
        $item = mysqli_fetch_assoc($result);
        return $item && $item['quantity'] >= $quantity;
    }
}
?>