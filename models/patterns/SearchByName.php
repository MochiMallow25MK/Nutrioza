<?php
require_once __DIR__ . '/../interfaces/ISearchStrategy.php';

// Strategy: search rows where any text column contains the value
class SearchByName implements ISearchStrategy {
    public function search(Database $db, string $table, string $value): array {
        $conn = $db->getConnection();
        // Get column names for the table
        $cols = [];
        $res = $conn->query("SHOW COLUMNS FROM `$table`");
        while ($row = $res->fetch_assoc()) {
            $type = strtolower($row['Type']);
            if (str_contains($type, 'varchar') || str_contains($type, 'text')) {
                $cols[] = "`" . $row['Field'] . "`";
            }
        }
        if (empty($cols)) return [];

        $where = implode(" LIKE ? OR ", $cols) . " LIKE ?";
        $sql = "SELECT * FROM `$table` WHERE $where";
        $stmt = $conn->prepare($sql);
        $binds = array_fill(0, count($cols), "%$value%");
        $types = str_repeat('s', count($cols));
        $stmt->bind_param($types, ...$binds);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
}
?>