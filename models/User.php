<?php
require_once __DIR__ . '/interfaces/ICrudOperations.php';
require_once __DIR__ . '/interfaces/IReportable.php';

class User implements ICrudOperations {
    public int    $user_id;
    public string $username;
    public string $full_name;
    public string $email;
    public string $password_hash;
    public int    $user_type_id;

    public function __construct(int $user_id, string $username, string $full_name, string $email, string $password, int $user_type_id) {
        $this->user_id       = $user_id;
        $this->username      = $username;
        $this->full_name     = $full_name;
        $this->email         = $email;
        $this->password_hash = password_hash($password, PASSWORD_BCRYPT); // NFR-04
        $this->user_type_id  = $user_type_id;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $sql  = "INSERT INTO user (username, full_name, email, password_hash, user_type_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql); // NFR-05
        $stmt->bind_param('ssssi', $this->username, $this->full_name, $this->email, $this->password_hash, $this->user_type_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $sql  = "UPDATE user SET username=?, full_name=?, email=?, user_type_id=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssii', $this->username, $this->full_name, $this->email, $this->user_type_id, $this->user_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM user WHERE user_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $conn   = $db->getConnection();
        $result = $conn->query("SELECT u.*, ut.type_name FROM user u LEFT JOIN user_type ut ON u.user_type_id=ut.user_type_id");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT u.*, ut.type_name FROM user u LEFT JOIN user_type ut ON u.user_type_id=ut.user_type_id WHERE u.user_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }
}
?>