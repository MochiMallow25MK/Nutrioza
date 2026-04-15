<?php
require_once __DIR__ . '/interfaces/ICrudOperations.php';

// EAV: Entity-Attribute-Value model
// Stores flexible extra attributes for any entity in any table

class EavAttribute implements ICrudOperations {
    public int    $eav_id;
    public string $entity_type;
    public int    $entity_id;
    public string $attribute;
    public string $value;

    public function __construct(int $eav_id, string $entity_type, int $entity_id, string $attribute, string $value) {
        $this->eav_id      = $eav_id;
        $this->entity_type = $entity_type;
        $this->entity_id   = $entity_id;
        $this->attribute   = $attribute;
        $this->value       = $value;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO eav_attributes (entity_type, entity_id, attribute, value) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('siss', $this->entity_type, $this->entity_id, $this->attribute, $this->value);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE eav_attributes SET attribute=?, value=? WHERE eav_id=?");
        $stmt->bind_param('ssi', $this->attribute, $this->value, $this->eav_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM eav_attributes WHERE eav_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT * FROM eav_attributes ORDER BY entity_type, entity_id");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM eav_attributes WHERE eav_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }

    // Get all EAV attributes for a specific entity
    public static function getByEntity(Database $db, string $entity_type, int $entity_id): array {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM eav_attributes WHERE entity_type=? AND entity_id=?");
        $stmt->bind_param('si', $entity_type, $entity_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        $stmt->close();
        return $rows;
    }
}
?>