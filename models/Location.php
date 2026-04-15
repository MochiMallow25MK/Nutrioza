<?php
require_once __DIR__ . '/interfaces/ICrudOperations.php';

class Location implements ICrudOperations {
    public int    $location_id;
    public string $location_name;
    public string $zone;
    public string $capacity;

    public function __construct(int $location_id, string $location_name, string $zone, string $capacity) {
        $this->location_id     = $location_id;
        $this->location_name   = $location_name;
        $this->zone            = $zone;
        $this->capacity        = $capacity;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO locations (location_name, zone, capacity) VALUES (?, ?, ?)");
        $stmt->bind_param('ssss', $this->location_name, $this->zone, $this->capacity);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE locations SET location_name=?, zone=?, capacity=? WHERE location_id=?");
        $stmt->bind_param('sssssi', $this->location_name, $this->zone, $this->capacity, $this->location_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM locations WHERE location_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT * FROM locations ORDER BY location_name");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM locations WHERE location_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }
}
?>