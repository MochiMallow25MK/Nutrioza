<?php
require_once __DIR__ . '/interfaces/ICrudOperations.php';
require_once __DIR__ . '/interfaces/IReportable.php';

class Donation implements ICrudOperations, IReportable {
    public int    $donation_id;
    public string $donor_name;
    public string $donor_email;
    public string $donor_phone_number;
    public string $donation_amount;

    public function __construct(int $donation_id, string $donor_name, string $donor_email, string $donor_phone_number, string $donation_amount) {
        $this->donation_id        = $donation_id;
        $this->donor_name         = $donor_name;
        $this->donor_email        = $donor_email;
        $this->donor_phone_number = $donor_phone_number;
        $this->donation_amount    = $donation_amount;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO donations (donor_name, donor_email, donor_phone_number, donation_amount) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $this->donor_name, $this->donor_email, $this->donor_phone_number, $this->donation_amount);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE donations SET donor_name=?, donor_email=?, donor_phone_number=?, donation_amount=? WHERE donation_id=?");
        $stmt->bind_param('ssssi', $this->donor_name, $this->donor_email, $this->donor_phone_number, $this->donation_amount, $this->donation_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM donations WHERE donation_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT * FROM donations ORDER BY submitted_at ASC");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM donations WHERE donation_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public static function generateReport(Database $db): array {
        $result = $db->getConnection()->query("SELECT * FROM donations ORDER BY submitted_at ASC");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }
}
?>