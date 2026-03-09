<?php
require_once 'Model.php';

class Role extends Model {
    protected $table = 'roles';
    protected $primaryKey = 'role_id';
    
    public function create($data) {
        $role_name = $this->escape($data['role_name']);
        $sql = "INSERT INTO roles (role_name) VALUES ('$role_name')";
        return $this->query($sql);
    }
    
    public function update($id, $data) {
        $role_name = $this->escape($data['role_name']);
        $sql = "UPDATE roles SET role_name='$role_name' WHERE role_id=$id";
        return $this->query($sql);
    }
    
    public function getRoleByName($name) {
        $name = $this->escape($name);
        $result = $this->query("SELECT * FROM roles WHERE role_name='$name'");
        return mysqli_fetch_assoc($result);
    }
    
    public function hasUsers($id) {
        $id = (int)$id;
        $result = $this->query("SELECT COUNT(*) as count FROM users WHERE role_id=$id");
        $row = mysqli_fetch_assoc($result);
        return $row['count'] > 0;
    }
}
?>