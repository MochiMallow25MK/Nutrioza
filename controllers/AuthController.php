<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/UsertypeMenu.php';

// NFR-04: password_verify, NFR-06: role-based session
class AuthController {

    public static function login(string $username, string $password): bool {
        $db   = new Database();
        $conn = $db->getConnection();

        // Fetch hashed password and role from uns_pws
        $stmt = $conn->prepare("SELECT u.usnpw_id, u.username, u.password_hash, u.user_type_id, ut.type_name FROM uns_pws u LEFT JOIN user_type ut ON u.user_type_id=ut.user_type_id WHERE u.username=? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$row) return false;

        // NFR-04: verify hashed password
        if (!password_verify($password, $row['password_hash'])) return false;

        // Store session variables — NFR-06
        $_SESSION['logged_in']    = true;
        $_SESSION['username']     = $row['username'];
        $_SESSION['user_type_id'] = $row['user_type_id'];
        $_SESSION['role']         = $row['type_name'];

        // Load allowed menus for this role
        $_SESSION['menus'] = UsertypeMenu::getMenusByUserType($db, (int)$row['user_type_id']);

        return true;
    }

    public static function logout(): void {
        session_destroy();
        header("Location: ../management.php");
        exit();
    }

    // Guard — redirect to login if not authenticated
    public static function requireLogin(): void {
        if (empty($_SESSION['logged_in'])) {
            header("Location: ../management.php");
            exit();
        }
    }

    // Guard — check role has access to a menu item
    public static function hasAccess(string $menu): bool {
        if (empty($_SESSION['menus'])) return false;
        return in_array($menu, $_SESSION['menus']);
    }
}
?>