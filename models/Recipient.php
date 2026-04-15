<?php
require_once __DIR__ . '/interfaces/ICrudOperations.php';
require_once __DIR__ . '/interfaces/IReportable.php';

class Recipient implements ICrudOperations, IReportable {
    public int    $recipient_id;
    public string $recipient_name;
    public string $contact_person;
    public string $phone;
    public string $email;
    public string $address;
    public string $city;

    public function __construct(int $recipient_id, string $recipient_name, string $contact_person, string $phone, string $email, string $address, string $city) {
        $this->recipient_id   = $recipient_id;
        $this->recipient_name = $recipient_name;
        $this->contact_person = $contact_person;
        $this->phone          = $phone;
        $this->email          = $email;
        $this->address        = $address;
        $this->city           = $city;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO recipients (recipient_name, contact_person, phone, email, address, city) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $this->recipient_name, $this->contact_person, $this->phone, $this->email, $this->address, $this->city);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE recipients SET recipient_name=?, contact_person=?, phone=?, email=?, address=?, city=? WHERE recipient_id=?");
        $stmt->bind_param('sssssssi', $this->recipient_name, $this->contact_person, $this->phone, $this->email, $this->address, $this->city, $this->recipient_id);
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