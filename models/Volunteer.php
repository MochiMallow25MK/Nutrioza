<?php
require_once __DIR__ . '/../interfaces/ICrudOperations.php';
require_once __DIR__ . '/../interfaces/IReportable.php';

class Volunteer implements ICrudOperations, IReportable {
    public int    $volunteer_id;
    public string $volunteer_name;
    public string $volunteer_email;
    public string $volunteer_phone;
    public string $availability;
    public string $skills;

    public function __construct(int $volunteer_id, string $volunteer_name, string $volunteer_email, string $volunteer_phone, string $availability, string $skills) {
        $this->volunteer_id    = $volunteer_id;
        $this->volunteer_name  = $volunteer_name;
        $this->volunteer_email = $volunteer_email;
        $this->volunteer_phone = $volunteer_phone;
        $this->availability    = $availability;
        $this->skills          = $skills;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO volunteers (volunteer_name, volunteer_email, volunteer_phone, availability, skills) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $this->volunteer_name, $this->volunteer_email, $this->volunteer_phone, $this->availability, $this->skills);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE volunteers SET volunteer_name=?, volunteer_email=?, volunteer_phone=?, availability=?, skills=? WHERE volunteer_id=?");
        $stmt->bind_param('sssssi', $this->volunteer_name, $this->volunteer_email, $this->volunteer_phone, $this->availability, $this->skills, $this->volunteer_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM volunteers WHERE volunteer_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT * FROM volunteers ORDER BY submitted_at DESC");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM volunteers WHERE volunteer_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public static function generateReport(Database $db): array {
        $result = $db->getConnection()->query("SELECT * FROM volunteers ORDER BY submitted_at DESC");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }
}
?>