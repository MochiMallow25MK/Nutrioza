<?php
require_once __DIR__ . '/../interfaces/ICrudOperations.php';
require_once __DIR__ . '/../interfaces/IReportable.php';

class Receipt implements ICrudOperations, IReportable {
    public int    $receipt_id;
    public int    $location_id;
    public string $supplier_name;
    public string $product_name;
    public int    $quantity;
    public string $unit;
    public string $received_date;
    public string $notes;

    public function __construct(int $receipt_id, int $location_id, string $supplier_name, string $product_name, int $quantity, string $unit, string $received_date, string $notes) {
        $this->receipt_id    = $receipt_id;
        $this->location_id   = $location_id;
        $this->supplier_name = $supplier_name;
        $this->product_name  = $product_name;
        $this->quantity      = $quantity;
        $this->unit          = $unit;
        $this->received_date = $received_date;
        $this->notes         = $notes;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO receipts (location_id, supplier_name, product_name, quantity, unit, received_date, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('isssisss', $this->location_id, $this->supplier_name, $this->product_name, $this->quantity, $this->unit, $this->received_date, $this->notes);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE receipts SET location_id=?, supplier_name=?, product_name=?, quantity=?, unit=?, received_date=?, notes=? WHERE receipt_id=?");
        $stmt->bind_param('ississsi', $this->location_id, $this->supplier_name, $this->product_name, $this->quantity, $this->unit, $this->received_date, $this->notes, $this->receipt_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM receipts WHERE receipt_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT r.*, l.location_name FROM receipts r LEFT JOIN locations l ON r.location_id=l.location_id ORDER BY r.received_date DESC");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT r.*, l.location_name FROM receipts r LEFT JOIN locations l ON r.location_id=l.location_id WHERE r.receipt_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public static function generateReport(Database $db): array {
        return self::getAll($db);
    }
}
?>