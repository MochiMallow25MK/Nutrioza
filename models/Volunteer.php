<?php
require_once 'Model.php';

class Volunteer extends Model {
    protected $table = 'volunteers';
    protected $primaryKey = 'volunteer_id';
    
    public function create($data) {
        $full_name = $this->escape($data['full_name']);
        $email = $this->escape($data['email']);
        $phone = $this->escape($data['phone']);
        $availability = $this->escape($data['availability']);
        $skills = $this->escape($data['skills']);
        
        $sql = "INSERT INTO volunteers (full_name, email, phone, availability, skills) 
                VALUES ('$full_name', '$email', '$phone', '$availability', '$skills')";
        
        return $this->query($sql);
    }
    
    public function update($id, $data) {
        $full_name = $this->escape($data['full_name']);
        $email = $this->escape($data['email']);
        $phone = $this->escape($data['phone']);
        $availability = $this->escape($data['availability']);
        $skills = $this->escape($data['skills']);
        $status = $this->escape($data['status']);
        
        $sql = "UPDATE volunteers SET 
                full_name='$full_name', 
                email='$email', 
                phone='$phone', 
                availability='$availability', 
                skills='$skills', 
                status='$status' 
                WHERE volunteer_id=$id";
        
        return $this->query($sql);
    }
    
    public function approve($id, $reviewed_by) {
        $id = (int)$id;
        $reviewed_by = (int)$reviewed_by;
        return $this->query("UPDATE volunteers SET status='Approved', reviewed_by=$reviewed_by WHERE volunteer_id=$id");
    }
    
    public function reject($id, $reviewed_by) {
        $id = (int)$id;
        $reviewed_by = (int)$reviewed_by;
        return $this->query("UPDATE volunteers SET status='Rejected', reviewed_by=$reviewed_by WHERE volunteer_id=$id");
    }
    
    public function getAllWithReviewer() {
        $result = $this->query("SELECT v.*, u.name as reviewer_name FROM volunteers v LEFT JOIN users u ON v.reviewed_by = u.user_id");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
?>