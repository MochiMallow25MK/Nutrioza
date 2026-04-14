<?php
require_once __DIR__ . '/../interfaces/ICrudOperations.php';
require_once __DIR__ . '/../interfaces/IReportable.php';

class DistributionOrder implements ICrudOperations, IReportable {
    public int    $order_id;
    public string $order_code;
    public string $recipient_name;
    public string $recipient_type;
    public string $recipient_contact;
    public string $recipient_address;
    public string $distribution_date;
    public string $status;
    public int    $total_items;
    public string $notes;
    public int    $created_by;

    public function __construct(int $order_id, string $order_code, string $recipient_name, string $recipient_type, string $recipient_contact, string $recipient_address, string $distribution_date, string $status, int $total_items, string $notes, int $created_by) {
        $this->order_id           = $order_id;
        $this->order_code         = $order_code;
        $this->recipient_name     = $recipient_name;
        $this->recipient_type     = $recipient_type;
        $this->recipient_contact  = $recipient_contact;
        $this->recipient_address  = $recipient_address;
        $this->distribution_date  = $distribution_date;
        $this->status             = $status;
        $this->total_items        = $total_items;
        $this->notes              = $notes;
        $this->created_by         = $created_by;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO distribution_order (order_code, recipient_name, recipient_type, recipient_contact, recipient_address, distribution_date, status, total_items, notes, created_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssssisi', $this->order_code, $this->recipient_name, $this->recipient_type, $this->recipient_contact, $this->recipient_address, $this->distribution_date, $this->status, $this->total_items, $this->notes, $this->created_by);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE distribution_order SET order_code=?, recipient_name=?, recipient_type=?, recipient_contact=?, recipient_address=?, distribution_date=?, status=?, total_items=?, notes=? WHERE order_id=?");
        $stmt->bind_param('sssssssisi', $this->order_code, $this->recipient_name, $this->recipient_type, $this->recipient_contact, $this->recipient_address, $this->distribution_date, $this->status, $this->total_items, $this->notes, $this->order_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM distribution_order WHERE order_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT do.*, u.full_name AS created_by_name FROM distribution_order do LEFT JOIN user u ON do.created_by=u.user_id ORDER BY do.distribution_date DESC");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT do.*, u.full_name AS created_by_name FROM distribution_order do LEFT JOIN user u ON do.created_by=u.user_id WHERE do.order_id=?");
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