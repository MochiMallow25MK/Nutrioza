<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/Donation.php';
require_once __DIR__ . '/../models/Volunteer.php';
require_once __DIR__ . '/../models/Receipt.php';
require_once __DIR__ . '/../models/Recipient.php';
require_once __DIR__ . '/../models/DistributionOrder.php';
require_once __DIR__ . '/../models/DistributionDetail.php';

class ReportController {

    private Database $db;

    private static array $reportMap = [
        'donations'            => Donation::class,
        'volunteers'           => Volunteer::class,
        'receipts'             => Receipt::class,
        'recipients'           => Recipient::class,
        'distribution_order'   => DistributionOrder::class,
        'distribution_details' => DistributionDetail::class,
    ];

    public function __construct() {
        $this->db = new Database();
    }

    public function generate(string $table): array {
        $class = self::$reportMap[$table] ?? null;
        if (!$class) return [];
        return $class::generateReport($this->db);
    }

    public static function getReportableTables(): array {
        return array_keys(self::$reportMap);
    }
}
?>