<?php
require_once 'Model.php';

class Recipient extends Model {
    protected $table = 'recipients';
    protected $primaryKey = 'recipient_id';
    
    public function create($data) {
        $name = $this->escape($data['name']);
        $type = $this->escape($data['type']);
        $contact_info = $this->escape($data['contact_info']);
        $address = $this->escape($data['address']);
        
        $sql = "INSERT INTO recipients (name, type, contact_info, address) 
                VALUES ('$name', '$type', '$contact_info', '$address')";
        
        return $this->query($sql);
    }
    
    public function update($id, $data) {
        $name = $this->escape($data['name']);
        $type = $this->escape($data['type']);
        $contact_info = $this->escape($data['contact_info']);
        $address = $this->escape($data['address']);
        
        $sql = "UPDATE recipients SET 
                name='$name', 
                type='$type', 
                contact_info='$contact_info', 
                address='$address' 
                WHERE recipient_id=$id";
        
        return $this->query($sql);
    }
    
    public function hasDistributions($id) {
        $id = (int)$id;
        $result = $this->query("SELECT COUNT(*) as count FROM distributions WHERE recipient_id=$id");
        $row = mysqli_fetch_assoc($result);
        return $row['count'] > 0;
    }
    
    public function getByType($type) {
        $type = $this->escape($type);
        $result = $this->query("SELECT * FROM recipients WHERE type='$type'");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function getDistributionHistory($recipient_id) {
        $recipient_id = (int)$recipient_id;
        $result = $this->query("SELECT d.*, u.name as approver_name 
                                FROM distributions d 
                                LEFT JOIN users u ON d.approved_by = u.user_id 
                                WHERE d.recipient_id = $recipient_id 
                                ORDER BY d.distribution_date DESC");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
?>