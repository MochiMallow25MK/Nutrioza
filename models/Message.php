<?php
require_once __DIR__ . '/interfaces/ICrudOperations.php';

class Message implements ICrudOperations {
    public int    $message_id;
    public string $name;
    public string $email;

    public function __construct(int $message_id, string $name, string $email) {
        $this->message_id = $message_id;
        $this->name       = $name;
        $this->email      = $email;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO messages (name, email) VALUES (?, ?)");
        $stmt->bind_param('ss', $this->name, $this->email);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE messages SET name=?, email=? WHERE message_id=?");
        $stmt->bind_param('ssi', $this->name, $this->email, $this->message_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM messages WHERE message_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT * FROM messages ORDER BY submitted_at ASC");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM messages WHERE message_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }
}
?>