<?php
require_once __DIR__ . '/interfaces/ICrudOperations.php';

class Supplier implements ICrudOperations {
    public int    $supplier_id;
    public string $supplier_name;
    public string $contact_person;
    public string $phone;
    public string $email;
    public string $address;
    public string $supplier_type;
    public int    $is_active;


    public function __construct(int $supplier_id, string $supplier_name, string $contact_person, string $phone, string $email, string $address, string $supplier_type, int $is_active) {
        $this->supplier_id    = $supplier_id;
        $this->supplier_name  = $supplier_name;
        $this->contact_person = $contact_person;
        $this->email          = $email;
        $this->phone          = $phone;
        $this->address        = $address;
        $this->supplier_type  = $supplier_type;
        $this->is_active      = $is_active;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO supplier (supplier_name, contact_person, phone, email, address, supplier_type, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssii', $this->supplier_name, $this->contact_person, $this->phone, $this->email, $this->address, $this->supplier_type, $this->is_active);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE supplier SET supplier_name=?, contact_person=?, phone=?, email=?, address=?, supplier_type=?, is_active=? WHERE supplier_id=?");
        $stmt->bind_param('sssssi', $this->supplier_name, $this->contact_person, $this->phone, $this->email, $this->address, $this->supplier_type, $this->is_active, $this->supplier_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM supplier WHERE supplier_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT * FROM supplier ORDER BY supplier_name");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM supplier WHERE supplier_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }
}
?>