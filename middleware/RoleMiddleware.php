<?php
class RoleMiddleware {
    public static function check($allowed_roles) {
        if(!in_array($_SESSION['user_role'], $allowed_roles)) {
            http_response_code(403);
            echo 'Access Denied - Insufficient Permissions';
            exit();
        }
    }
}
?>