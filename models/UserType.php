<?php
require_once __DIR__ . '/interfaces/ICrudOperations.php';

class UserType implements ICrudOperations {
    public int    $user_type_id;
    public string $type_name;

    public function __construct(int $user_type_id, string $type_name) {
        $this->user_type_id = $user_type_id;
        $this->type_name    = $type_name;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO user_type (type_name) VALUES (?)");
        $stmt->bind_param('s', $this->type_name);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE user_type SET type_name=? WHERE user_type_id=?");
        $stmt->bind_param('si', $this->type_name, $this->user_type_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM user_type WHERE user_type_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT * FROM user_type");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM user_type WHERE user_type_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }
}
?>