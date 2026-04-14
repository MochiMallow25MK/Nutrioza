<?php
require_once __DIR__ . '/../interfaces/ICrudOperations.php';

class Supplier implements ICrudOperations {
    public int    $supplier_id;
    public string $supplier_name;
    public string $contact_person;
    public string $contact_email;
    public string $contact_phone;
    public string $address;

    public function __construct(int $supplier_id, string $supplier_name, string $contact_person, string $contact_email, string $contact_phone, string $address) {
        $this->supplier_id    = $supplier_id;
        $this->supplier_name  = $supplier_name;
        $this->contact_person = $contact_person;
        $this->contact_email  = $contact_email;
        $this->contact_phone  = $contact_phone;
        $this->address        = $address;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO supplier (supplier_name, contact_person, contact_email, contact_phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $this->supplier_name, $this->contact_person, $this->contact_email, $this->contact_phone, $this->address);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE supplier SET supplier_name=?, contact_person=?, contact_email=?, contact_phone=?, address=? WHERE supplier_id=?");
        $stmt->bind_param('sssssi', $this->supplier_name, $this->contact_person, $this->contact_email, $this->contact_phone, $this->address, $this->supplier_id);
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