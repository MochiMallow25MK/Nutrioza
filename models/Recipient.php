<?php
require_once __DIR__ . '/../interfaces/ICrudOperations.php';
require_once __DIR__ . '/../interfaces/IReportable.php';

class Recipient implements ICrudOperations, IReportable {
    public int    $recipient_id;
    public string $recipient_name;
    public string $recipient_type;
    public string $contact_info;
    public string $address;

    public function __construct(int $recipient_id, string $recipient_name, string $recipient_type, string $contact_info, string $address) {
        $this->recipient_id   = $recipient_id;
        $this->recipient_name = $recipient_name;
        $this->recipient_type = $recipient_type;
        $this->contact_info   = $contact_info;
        $this->address        = $address;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO recipients (recipient_name, recipient_type, contact_info, address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $this->recipient_name, $this->recipient_type, $this->contact_info, $this->address);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE recipients SET recipient_name=?, recipient_type=?, contact_info=?, address=? WHERE recipient_id=?");
        $stmt->bind_param('ssssi', $this->recipient_name, $this->recipient_type, $this->contact_info, $this->address, $this->recipient_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM recipients WHERE recipient_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT * FROM recipients ORDER BY recipient_name");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM recipients WHERE recipient_id=?");
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