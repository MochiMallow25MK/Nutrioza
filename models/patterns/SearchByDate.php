<?php
require_once __DIR__ . '/../interfaces/ISearchStrategy.php';

// Strategy: search rows by date range on any date/timestamp column
class SearchByDate implements ISearchStrategy {
    private string $dateFrom;
    private string $dateTo;

    public function __construct(string $dateFrom, string $dateTo) {
        $this->dateFrom = $dateFrom;
        $this->dateTo   = $dateTo;
    }

    public function search(Database $db, string $table, string $value): array {
        $conn = $db->getConnection();
        // Find first date/timestamp column
        $dateCol = null;
        $res = $conn->query("SHOW COLUMNS FROM `$table`");
        while ($row = $res->fetch_assoc()) {
            $type = strtolower($row['Type']);
            if (str_contains($type, 'date') || str_contains($type, 'timestamp')) {
                $dateCol = $row['Field'];
                break;
            }
        }
        if (!$dateCol) return [];

        $sql = "SELECT * FROM `$table` WHERE `$dateCol` BETWEEN ? AND ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $this->dateFrom, $this->dateTo);
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