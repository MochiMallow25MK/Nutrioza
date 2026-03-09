<?php
require_once 'Model.php';

class Donation extends Model {
    protected $table = 'donations';
    protected $primaryKey = 'donation_id';
    
    public function create($data) {
        $donor_name = $this->escape($data['donor_name']);
        $donor_email = $this->escape($data['donor_email']);
        $donor_phone = $this->escape($data['donor_phone']);
        $donation_type = $this->escape($data['donation_type']);
        $description = $this->escape($data['description']);
        $quantity = isset($data['quantity']) && $data['quantity'] ? (int)$data['quantity'] : 'NULL';
        $amount = isset($data['amount']) && $data['amount'] ? (float)$data['amount'] : 'NULL';
        
        $sql = "INSERT INTO donations (donor_name, donor_email, donor_phone, donation_type, description, quantity, amount) 
                VALUES ('$donor_name', '$donor_email', '$donor_phone', '$donation_type', '$description', $quantity, $amount)";
        
        return $this->query($sql);
    }
    
    public function update($id, $data) {
        $donor_name = $this->escape($data['donor_name']);
        $donor_email = $this->escape($data['donor_email']);
        $donor_phone = $this->escape($data['donor_phone']);
        $donation_type = $this->escape($data['donation_type']);
        $description = $this->escape($data['description']);
        $status = $this->escape($data['status']);
        $quantity = isset($data['quantity']) && $data['quantity'] ? (int)$data['quantity'] : 'NULL';
        $amount = isset($data['amount']) && $data['amount'] ? (float)$data['amount'] : 'NULL';
        
        $sql = "UPDATE donations SET 
                donor_name='$donor_name', 
                donor_email='$donor_email', 
                donor_phone='$donor_phone', 
                donation_type='$donation_type', 
                description='$description', 
                status='$status',
                quantity=$quantity,
                amount=$amount
                WHERE donation_id=$id";
        
        return $this->query($sql);
    }
    
    public function approve($id, $reviewed_by) {
        $id = (int)$id;
        $reviewed_by = (int)$reviewed_by;
        return $this->query("UPDATE donations SET status='Approved', reviewed_by=$reviewed_by WHERE donation_id=$id");
    }
    
    public function reject($id, $reviewed_by) {
        $id = (int)$id;
        $reviewed_by = (int)$reviewed_by;
        return $this->query("UPDATE donations SET status='Rejected', reviewed_by=$reviewed_by WHERE donation_id=$id");
    }
    
    public function getAllWithReviewer() {
        $result = $this->query("SELECT d.*, u.name as reviewer_name FROM donations d LEFT JOIN users u ON d.reviewed_by = u.user_id");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
?>