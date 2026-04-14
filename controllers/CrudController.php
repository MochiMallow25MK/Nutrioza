<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/UserType.php';
require_once __DIR__ . '/../models/UsertypeMenu.php';
require_once __DIR__ . '/../models/Donation.php';
require_once __DIR__ . '/../models/Volunteer.php';
require_once __DIR__ . '/../models/Message.php';
require_once __DIR__ . '/../models/Receipt.php';
require_once __DIR__ . '/../models/Recipient.php';
require_once __DIR__ . '/../models/Location.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Supplier.php';
require_once __DIR__ . '/../models/DistributionOrder.php';
require_once __DIR__ . '/../models/DistributionDetail.php';
require_once __DIR__ . '/../models/EavAttribute.php';
require_once __DIR__ . '/../models/patterns/LoggingDecorator.php';
require_once __DIR__ . '/../models/patterns/ValidationDecorator.php';
require_once __DIR__ . '/../models/patterns/SearchByName.php';
require_once __DIR__ . '/../models/patterns/SearchByDate.php';

class CrudController {

    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    // ── Map table name → model class ─────────────────────────────────────────
    private static array $tableMap = [
        'user'                 => User::class,
        'user_type'            => UserType::class,
        'usertype_menu'        => UsertypeMenu::class,
        'donations'            => Donation::class,
        'volunteers'           => Volunteer::class,
        'messages'             => Message::class,
        'receipts'             => Receipt::class,
        'recipients'           => Recipient::class,
        'locations'            => Location::class,
        'product'              => Product::class,
        'supplier'             => Supplier::class,
        'distribution_order'   => DistributionOrder::class,
        'distribution_details' => DistributionDetail::class,
        'eav_attributes'       => EavAttribute::class,
    ];

    // ── READ ALL ──────────────────────────────────────────────────────────────
    public function getAll(string $table): array {
        $class = self::$tableMap[$table] ?? null;
        if (!$class) return [];
        return $class::getAll($this->db);
    }

    // ── READ ONE ──────────────────────────────────────────────────────────────
    public function getById(string $table, int $id) {
        $class = self::$tableMap[$table] ?? null;
        if (!$class) return null;
        return $class::getById($this->db, $id);
    }

    // ── CREATE ────────────────────────────────────────────────────────────────
    public function create(string $table, array $data): bool {
        $logger = new LoggingDecorator();
        return $logger->execute(function () use ($table, $data) {
            return $this->buildAndRun($table, $data, 'create');
        });
    }

    // ── UPDATE ────────────────────────────────────────────────────────────────
    public function update(string $table, array $data): bool {
        $logger = new LoggingDecorator();
        return $logger->execute(function () use ($table, $data) {
            return $this->buildAndRun($table, $data, 'update');
        });
    }

    // ── DELETE ────────────────────────────────────────────────────────────────
    public function delete(string $table, int $id): bool {
        $logger = new LoggingDecorator();
        return $logger->execute(function () use ($table, $id) {
            $class = self::$tableMap[$table] ?? null;
            if (!$class) return false;
            $obj = new $class(...array_fill(0, (new ReflectionClass($class))->getConstructor()->getNumberOfParameters(), 0));
            return $obj->delete($this->db, $id);
        });
    }

    // ── SEARCH (Strategy Pattern) ─────────────────────────────────────────────
    public function search(string $table, string $mode, string $value, string $dateFrom = '', string $dateTo = ''): array {
        if ($mode === 'date') {
            $strategy = new SearchByDate($dateFrom, $dateTo);
        } else {
            $strategy = new SearchByName();
        }
        return $strategy->search($this->db, $table, $value);
    }

    // ── Helper: build model object and run create/update ─────────────────────
    private function buildAndRun(string $table, array $data, string $action): bool {
        $conn = $this->db->getConnection();
        // Get column names from DB to map POST data safely (NFR-05)
        $cols   = [];
        $result = $conn->query("SHOW COLUMNS FROM `$table`");
        while ($row = $result->fetch_assoc()) $cols[] = $row['Field'];

        // Build safe INSERT/UPDATE with only known columns
        $filtered = array_intersect_key($data, array_flip($cols));

        if ($action === 'create') {
            $fields      = implode(', ', array_map(fn($c) => "`$c`", array_keys($filtered)));
            $placeholders = implode(', ', array_fill(0, count($filtered), '?'));
            $sql         = "INSERT INTO `$table` ($fields) VALUES ($placeholders)";
        } else {
            $pkCol = $cols[0]; // first column = PK by convention
            $sets  = implode(', ', array_map(fn($c) => "`$c`=?", array_keys($filtered)));
            $sql   = "UPDATE `$table` SET $sets WHERE `$pkCol`=?";
        }

        $stmt   = $conn->prepare($sql);
        $values = array_values($filtered);
        if ($action === 'update') $values[] = $data[$cols[0]] ?? 0;
        $types  = str_repeat('s', count($values));
        $stmt->bind_param($types, ...$values);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
?>