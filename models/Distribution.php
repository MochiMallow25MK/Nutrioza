<?php
require_once 'Model.php';

class Distribution extends Model {
    protected $table = 'distributions';
    protected $primaryKey = 'distribution_id';
    
    public function create($data) {
        $recipient_id = (int)$data['recipient_id'];
        $distribution_date = $this->escape($data['distribution_date']);
        
        $sql = "INSERT INTO distributions (recipient_id, distribution_date, status) 
                VALUES ($recipient_id, '$distribution_date', 'Pending')";
        
        return $this->query($sql);
    }
    
    public function update($id, $data) {
        $status = $this->escape($data['status']);
        $distribution_date = $this->escape($data['distribution_date']);
        
        $sql = "UPDATE distributions SET status='$status', distribution_date='$distribution_date' WHERE distribution_id=$id";
        return $this->query($sql);
    }
    
    public function approve($id, $approved_by) {
        $id = (int)$id;
        $approved_by = (int)$approved_by;
        return $this->query("UPDATE distributions SET status='Approved', approved_by=$approved_by WHERE distribution_id=$id");
    }
    
    public function markDelivered($id) {
        $id = (int)$id;
        return $this->query("UPDATE distributions SET status='Delivered' WHERE distribution_id=$id");
    }
    
    public function getAllWithDetails() {
        $result = $this->query("SELECT d.*, r.name as recipient_name, r.type, u.name as approver_name 
                                FROM distributions d 
                                JOIN recipients r ON d.recipient_id = r.recipient_id 
                                LEFT JOIN users u ON d.approved_by = u.user_id");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function getDistributionItems($distribution_id) {
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
    
    public function getByDateRange($start_date, $end_date, $status = null) {
        $start_date = $this->escape($start_date);
        $end_date = $this->escape($end_date);
        
        $sql = "SELECT d.*, r.name as recipient_name, r.type, u.name as approver_name 
                FROM distributions d 
                JOIN recipients r ON d.recipient_id = r.recipient_id 
                LEFT JOIN users u ON d.approved_by = u.user_id 
                WHERE d.distribution_date BETWEEN '$start_date' AND '$end_date'";
        
        if ($status) {
            $status = $this->escape($status);
            $sql .= " AND d.status = '$status'";
        }
        
        $sql .= " ORDER BY d.distribution_date DESC";
        
        $result = $this->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
?>