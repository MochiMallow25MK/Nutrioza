<?php
require_once __DIR__ . '/../config/config.php';

class Model {
    protected $db;
    protected $table;
    protected $primaryKey = 'id';
    
    public function __construct() {
        global $link;
        $this->db = $link;
    }
    
    public function all() {
        $result = mysqli_query($this->db, "SELECT * FROM {$this->table}");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
    
    public function find($id) {
        $id = (int)$id;
        $result = mysqli_query($this->db, "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = $id");
        return mysqli_fetch_assoc($result);
    }
    
    public function delete($id) {
        $id = (int)$id;
        return mysqli_query($this->db, "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id");
    }
    
    public function query($sql) {
        return mysqli_query($this->db, $sql);
    }
    
    public function escape($value) {
        return mysqli_real_escape_string($this->db, $value);
    }
    
    public function lastInsertId() {
        return mysqli_insert_id($this->db);
    }
}
?>