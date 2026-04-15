<?php
require_once __DIR__ . '/interfaces/ICrudOperations.php';
require_once __DIR__ . '/interfaces/IReportable.php';

class DistributionDetail implements ICrudOperations, IReportable {
    public int    $detail_id;
    public int    $order_id;
    public int    $product_id;
    public int    $quantity_distributed;
    public string $unit_of_measure;
    public string $expiry_date;
    public string $notes;

    public function __construct(int $detail_id, int $order_id, int $product_id, int $quantity_distributed, string $unit_of_measure, string $expiry_date, string $notes) {
        $this->detail_id            = $detail_id;
        $this->order_id             = $order_id;
        $this->product_id           = $product_id;
        $this->quantity_distributed = $quantity_distributed;
        $this->unit_of_measure      = $unit_of_measure;
        $this->expiry_date          = $expiry_date;
        $this->notes                = $notes;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO distribution_details (order_id, product_id, quantity_distributed, unit_of_measure, expiry_date, notes) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iiiiss', $this->order_id, $this->product_id, $this->quantity_distributed, $this->unit_of_measure, $this->expiry_date, $this->notes);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE distribution_details SET order_id=?, product_id=?, quantity_distributed=?, unit_of_measure=?, expiry_date=?, notes=? WHERE detail_id=?");
        $stmt->bind_param('iiiissi', $this->order_id, $this->product_id, $this->quantity_distributed, $this->unit_of_measure, $this->expiry_date, $this->notes, $this->detail_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM distribution_details WHERE detail_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT dd.*, p.product_name, do.order_code FROM distribution_details dd LEFT JOIN product p ON dd.product_id=p.product_id LEFT JOIN distribution_order do ON dd.order_id=do.order_id ORDER BY dd.detail_id ASC");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT dd.*, p.product_name, do.order_code FROM distribution_details dd LEFT JOIN product p ON dd.product_id=p.product_id LEFT JOIN distribution_order do ON dd.order_id=do.order_id WHERE dd.detail_id=?");
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