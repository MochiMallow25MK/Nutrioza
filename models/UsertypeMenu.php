<?php
require_once __DIR__ . '/../interfaces/ICrudOperations.php';

class UsertypeMenu implements ICrudOperations {
    public int    $permission_id;
    public int    $user_type_id;
    public string $menu_name;

    public function __construct(int $permission_id, int $user_type_id, string $menu_name) {
        $this->permission_id = $permission_id;
        $this->user_type_id  = $user_type_id;
        $this->menu_name     = $menu_name;
    }

    public function create(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("INSERT INTO usertype_menu (user_type_id, menu_name) VALUES (?, ?)");
        $stmt->bind_param('is', $this->user_type_id, $this->menu_name);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(Database $db): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("UPDATE usertype_menu SET user_type_id=?, menu_name=? WHERE permission_id=?");
        $stmt->bind_param('isi', $this->user_type_id, $this->menu_name, $this->permission_id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(Database $db, int $id): bool {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("DELETE FROM usertype_menu WHERE permission_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public static function getAll(Database $db): array {
        $result = $db->getConnection()->query("SELECT um.*, ut.type_name FROM usertype_menu um LEFT JOIN user_type ut ON um.user_type_id=ut.user_type_id");
        $rows   = [];
        while ($row = $result->fetch_assoc()) $rows[] = $row;
        return $rows;
    }

    public static function getById(Database $db, int $id) {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM usertype_menu WHERE permission_id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row;
    }

    public static function getMenusByUserType(Database $db, int $user_type_id): array {
        $conn = $db->getConnection();
        $stmt = $conn->prepare("SELECT menu_name FROM usertype_menu WHERE user_type_id=?");
        $stmt->bind_param('i', $user_type_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $menus  = [];
        while ($row = $result->fetch_assoc()) $menus[] = $row['menu_name'];
        $stmt->close();
        return $menus;
    }
}
?>