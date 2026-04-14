<?php
require_once __DIR__ . '/../interfaces/ICrudOperations.php';

class Product implements ICrudOperations {
    public int    $product_id;
    public int    $supplier_id;
    public string $product_name;
    public string $category;
    public string $unit;
    public int    $quantity_in_stock;
    public string $expiry_date;
    public string $notes;

    public function __construct(int $product_id, int $supplier_id, string $product_name, string $category, string $unit, int $quantity_in_stock, string $expiry_date, string $notes) {
        $this->product_id        = $product_id;
        $this->supplier_id       = $supplier_id;
        $this->product_name      = $product_name;
        $this->category          = $category;
        $this->unit              = $unit;
        $this->quantity_in_stock = $quantity_in_stock;
        $this->expiry_date       = $expiry_date;
        $this->notes             = $notes;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO product (supplier_id, product_name, category, unit, quantity_in_stock, expiry_date, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('isssisss', $this->supplier_id, $this->product_name, $this->category, $this->unit, $this->quantity_in_stock, $this->expiry_date, $this->notes);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE product SET supplier_id=?, product_name=?, category=?, unit=?, quantity_in_stock=?, expiry_date=?, notes=? WHERE product_id=?");
        $stmt->bind_param('isssissi', $this->supplier_id, $this->product_name, $this->category, $this->unit, $this->quantity_in_stock, $this->expiry_date, $this->notes, $this->product_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM product WHERE product_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT p.*, s.supplier_name FROM product p LEFT JOIN supplier s ON p.supplier_id=s.supplier_id ORDER BY p.product_name");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT p.*, s.supplier_name FROM product p LEFT JOIN supplier s ON p.supplier_id=s.supplier_id WHERE p.product_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }
}
?>