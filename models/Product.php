<?php
require_once __DIR__ . '/interfaces/ICrudOperations.php';

class Product implements ICrudOperations {
    public int    $product_id;
    public int    $supplier_id;
    public string $product_name;
    public string $category;
    public string $description;
    public string $unit_of_measure;
    public int    $current_stock;
    public int    $min_stock_level;
    public string $expiry_date;
    public string $storage_location;
    public int    $is_active;

    public function __construct(int $product_id, int $supplier_id, string $product_name, string $category, string $description, string $unit_of_measure, int $current_stock, int $min_stock_level, string $expiry_date, string $storage_location, int $is_active) {
        $this->product_id        = $product_id;
        $this->supplier_id       = $supplier_id;
        $this->product_name      = $product_name;
        $this->category          = $category;
        $this->description       = $description;
        $this->unit_of_measure   = $unit_of_measure;
        $this->current_stock     = $current_stock;
        $this->min_stock_level   = $min_stock_level;
        $this->expiry_date       = $expiry_date;
        $this->storage_location  = $storage_location;
        $this->is_active         = $is_active;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO product (supplier_id, product_name, category, description, unit_of_measure, current_stock, min_stock_level, expiry_date, storage_location, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('isssiiis', $this->supplier_id, $this->product_name, $this->category, $this->description, $this->unit_of_measure, $this->current_stock, $this->min_stock_level, $this->expiry_date, $this->storage_location, $this->is_active);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE product SET supplier_id=?, product_name=?, category=?, description=?, unit_of_measure=?, current_stock=?, min_stock_level=?, expiry_date=?, storage_location=?, is_active=? WHERE product_id=?");
        $stmt->bind_param('isssiiis', $this->supplier_id, $this->product_name, $this->category, $this->description, $this->unit_of_measure, $this->current_stock, $this->min_stock_level, $this->expiry_date, $this->storage_location, $this->is_active, $this->product_id);
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