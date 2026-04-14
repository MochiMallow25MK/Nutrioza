<?php
session_start();
require_once 'config.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/CrudController.php';
require_once 'controllers/ReportController.php';

AuthController::requireLogin();

$role   = $_SESSION['role']         ?? 'Viewer';
$menus  = $_SESSION['menus']        ?? [];

// ── Role → table map ──────────────────────────────────────────────────────────
$roleTables = [
    'Administrator'      => ['user','user_type','usertype_menu'],
    'Manager'            => ['donations','volunteers','messages'],
    'Warehouse Staff'    => ['receipts','recipients','locations'],
    'Supplier Staff'     => ['product','supplier'],
    'Distribution Staff' => ['distribution_order','distribution_details'],
    'Viewer'             => ['user','user_type','donations','volunteers','messages',
                             'receipts','recipients','locations','product','supplier',
                             'distribution_order','distribution_details'],
    'Auditor'            => ['donations','volunteers','receipts','recipients',
                             'distribution_order','distribution_details'],
];

$allowedTables = $roleTables[$role] ?? [];
$isViewer      = ($role === 'Viewer');
$isAuditor     = ($role === 'Auditor');

// ── Active table from GET ─────────────────────────────────────────────────────
$activeTable = $_GET['table'] ?? ($allowedTables[0] ?? '');
if (!in_array($activeTable, $allowedTables)) $activeTable = $allowedTables[0] ?? '';

// ── Handle POST actions (Create / Update / Delete) ───────────────────────────
$message = '';
$msgType = 'success';

if (!$isViewer && !$isAuditor && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $crud   = new CrudController();
    $action = $_POST['action'] ?? '';
    $table  = $_POST['table']  ?? '';

    if (!in_array($table, $allowedTables)) {
        $message = 'Access denied to that table.';
        $msgType = 'error';
    } else {
        try {
            if ($action === 'create') {
                $data = $_POST;
                unset($data['action'], $data['table']);
                $ok = $crud->create($table, $data);
                $message = $ok ? 'Record created successfully.' : 'Failed to create record.';
                if (!$ok) $msgType = 'error';
            } elseif ($action === 'update') {
                $data = $_POST;
                unset($data['action'], $data['table']);
                $ok = $crud->update($table, $data);
                $message = $ok ? 'Record updated successfully.' : 'Failed to update record.';
                if (!$ok) $msgType = 'error';
            } elseif ($action === 'delete') {
                $id = (int)($_POST['record_id'] ?? 0);
                $ok = $crud->delete($table, $id);
                $message = $ok ? 'Record deleted successfully.' : 'Failed to delete record.';
                if (!$ok) $msgType = 'error';
            }
        } catch (Exception $ex) {
            $message = 'Error: ' . $ex->getMessage();
            $msgType = 'error';
        }
    }
}

// ── Load data ─────────────────────────────────────────────────────────────────
$crud        = new CrudController();
$rows        = [];
$editRow     = null;
$searchMode  = $_GET['search_mode'] ?? '';
$searchVal   = $_GET['search_val']  ?? '';
$dateFrom    = $_GET['date_from']   ?? '';
$dateTo      = $_GET['date_to']     ?? '';

if ($activeTable) {
    if ($searchVal || ($dateFrom && $dateTo)) {
        $rows = $crud->search($activeTable, $searchMode, $searchVal, $dateFrom, $dateTo);
    } else {
        $rows = $crud->getAll($activeTable);
    }
}

if (!empty($_GET['edit_id']) && !$isViewer && !$isAuditor) {
    $editRow = $crud->getById($activeTable, (int)$_GET['edit_id']);
}

// ── Report ────────────────────────────────────────────────────────────────────
$reportData  = [];
$reportTable = '';
if ($isAuditor && !empty($_GET['report'])) {
    $reportTable = $_GET['report'];
    if (in_array($reportTable, $allowedTables)) {
        $rc = new ReportController();
        $reportData = $rc->generate($reportTable);
    }
}

// ── Helper: get column names from a result set ────────────────────────────────
function getColumns(array $rows): array {
    return !empty($rows) ? array_keys($rows[0]) : [];
}

// Pretty label for table names
function tableLabel(string $t): string {
    return ucwords(str_replace('_', ' ', $t));
}

// Primary key column name (first column)
function pkCol(array $rows): string {
    return !empty($rows) ? array_keys($rows[0])[0] : 'id';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Workspace</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/workspace.css">
</head>
<body>
<script>alert('Welcome, <?= htmlspecialchars($role) ?>!');</script>

<!-- Top nav -->
<nav class="navbar" style="justify-content:space-between;">
    <span style="color:var(--cream); font-size:1.1rem; letter-spacing:2px;">NUTRIOZA 🌾</span>
    <div style="display:flex; gap:8px;">
        <a href="homepage.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="workspace-wrapper">

    <!-- ── SIDEBAR (20%) ─────────────────────────────────────────────────── -->
    <aside class="sidebar">
        <div class="sidebar-title">Menu</div>

        <?php if ($isAuditor): ?>
            <?php foreach ($allowedTables as $t): ?>
                <a href="?table=<?= $t ?>&report=<?= $t ?>"
                   class="<?= ($reportTable === $t) ? 'active' : '' ?>">
                    📄 <?= tableLabel($t) ?> Report
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <?php foreach ($allowedTables as $t): ?>
                <a href="?table=<?= $t ?>"
                   class="<?= ($activeTable === $t) ? 'active' : '' ?>">
                    <?= $isViewer ? '👁 ' : '⚙ ' ?><?= tableLabel($t) ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="sidebar-role">
            👤 <?= htmlspecialchars($_SESSION['username']) ?><br>
            🏷 <?= htmlspecialchars($role) ?>
        </div>
    </aside>

    <!-- ── MAIN CONTENT (80%) ─────────────────────────────────────────────── -->
    <main class="main-content">

        <?php if ($message): ?>
            <div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <!-- ════ AUDITOR: Report view ════ -->
        <?php if ($isAuditor && $reportTable && !empty($reportData)): ?>
            <div class="report-header">
                <h2>Report: <?= tableLabel($reportTable) ?></h2>
                <button class="btn btn-gold no-print" onclick="window.print()">🖨 Print Report</button>
            </div>
            <table>
                <thead>
                    <tr><?php foreach (getColumns($reportData) as $col): ?>
                        <th><?= htmlspecialchars(ucwords(str_replace('_',' ',$col))) ?></th>
                    <?php endforeach; ?></tr>
                </thead>
                <tbody>
                    <?php foreach ($reportData as $row): ?>
                    <tr><?php foreach ($row as $val): ?>
                        <td><?= htmlspecialchars((string)$val) ?></td>
                    <?php endforeach; ?></tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <!-- ════ VIEWER / CRUD: Table view ════ -->
        <?php elseif ($activeTable): ?>
            <h2 style="color:var(--green-dark); margin-bottom:18px;">
                <?= tableLabel($activeTable) ?>
                <?= $isViewer ? '<span style="font-size:12px; color:var(--green-mid);"> (read only)</span>' : '' ?>
            </h2>

            <!-- Search toolbar -->
            <form method="GET" class="toolbar no-print">
                <input type="hidden" name="table" value="<?= $activeTable ?>">
                <input type="text" name="search_val" placeholder="Search by name..."
                       value="<?= htmlspecialchars($searchVal) ?>">
                <input type="hidden" name="search_mode" value="name">
                <input type="date" name="date_from" value="<?= htmlspecialchars($dateFrom) ?>">
                <input type="date" name="date_to"   value="<?= htmlspecialchars($dateTo) ?>">
                <button type="submit" name="search_mode" value="name"  class="btn btn-secondary">Search Name</button>
                <button type="submit" name="search_mode" value="date"  class="btn btn-secondary">Search Date</button>
                <a href="?table=<?= $activeTable ?>" class="btn btn-secondary">Clear</a>
                <?php if (!$isViewer && !$isAuditor): ?>
                    <button type="button" class="btn btn-primary no-print"
                            onclick="openModal('createModal')">+ Add New</button>
                <?php endif; ?>
            </form>

            <!-- Data table -->
            <?php if (empty($rows)): ?>
                <p style="color:var(--green-mid); margin-top:20px;">No records found.</p>
            <?php else:
                $cols  = getColumns($rows);
                $pkKey = pkCol($rows);
            ?>
            <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <?php foreach ($cols as $col): ?>
                            <th><?= htmlspecialchars(ucwords(str_replace('_',' ',$col))) ?></th>
                        <?php endforeach; ?>
                        <?php if (!$isViewer && !$isAuditor): ?><th class="no-print">Actions</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($row as $val): ?>
                            <td><?= htmlspecialchars((string)$val) ?></td>
                        <?php endforeach; ?>
                        <?php if (!$isViewer && !$isAuditor): ?>
                        <td class="no-print">
                            <a href="?table=<?= $activeTable ?>&edit_id=<?= $row[$pkKey] ?>"
                               class="action-link action-edit">Edit</a>
                            <form method="POST" style="display:inline;"
                                  onsubmit="return confirm('Delete this record?');">
                                <input type="hidden" name="action"    value="delete">
                                <input type="hidden" name="table"     value="<?= $activeTable ?>">
                                <input type="hidden" name="record_id" value="<?= $row[$pkKey] ?>">
                                <button type="submit" class="action-link action-delete">Delete</button>
                            </form>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <?php endif; ?>

            <!-- ── CREATE modal ────────────────────────────────────── -->
            <?php if (!$isViewer && !$isAuditor): ?>
            <div class="modal-overlay" id="createModal"
                 <?= (!empty($_GET['show_create'])) ? 'style="display:flex;"' : '' ?>>
                <div class="modal-box">
                    <button class="modal-close" onclick="closeModal('createModal')">✕</button>
                    <h3>Add New — <?= tableLabel($activeTable) ?></h3>
                    <form method="POST" id="createForm" novalidate>
                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="table"  value="<?= $activeTable ?>">
                        <?php
                        // Render fields based on existing columns from first row
                        $fieldCols = !empty($rows) ? array_keys($rows[0]) : [];
                        // Skip auto-increment PK (first col) and timestamp cols
                        $skipCols  = ['submitted_at','created_at'];
                        foreach ($fieldCols as $i => $col):
                            if ($i === 0) continue; // skip PK
                            if (in_array($col, $skipCols)) continue;
                        ?>
                        <div class="form-group">
                            <label><?= ucwords(str_replace('_',' ',$col)) ?></label>
                            <input type="text" name="<?= htmlspecialchars($col) ?>" required>
                        </div>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-primary" style="width:100%;">Save</button>
                    </form>
                </div>
            </div>

            <!-- ── EDIT inline section ─────────────────────────────── -->
            <?php if ($editRow): ?>
            <div class="card no-print" style="margin-top:24px;">
                <h3 style="color:var(--green-dark); margin-bottom:18px;">
                    Edit Record — <?= tableLabel($activeTable) ?>
                </h3>
                <form method="POST" id="editForm" novalidate>
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="table"  value="<?= $activeTable ?>">
                    <?php foreach ($editRow as $col => $val): ?>
                    <div class="form-group">
                        <label><?= ucwords(str_replace('_',' ',$col)) ?></label>
                        <input type="text" name="<?= htmlspecialchars($col) ?>"
                               value="<?= htmlspecialchars((string)$val) ?>"
                               <?= ($col === array_key_first($editRow)) ? 'readonly style="background:#eee;"' : '' ?>>
                    </div>
                    <?php endforeach; ?>
                    <div style="display:flex; gap:10px;">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="?table=<?= $activeTable ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
            <?php endif; ?>
            <?php endif; ?>

        <?php else: ?>
            <p style="color:var(--green-mid); margin-top:40px; font-size:1.1rem;">
                Select an option from the menu on the left to get started.
            </p>
        <?php endif; ?>

    </main>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.add('open');
}
function closeModal(id) {
    document.getElementById(id).classList.remove('open');
}

// Close modal when clicking outside the box
document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) overlay.classList.remove('open');
    });
});

// Basic client-side validation for create/edit forms
['createForm','editForm'].forEach(function(formId) {
    var form = document.getElementById(formId);
    if (!form) return;
    form.addEventListener('submit', function(e) {
        var empty = false;
        form.querySelectorAll('input[required]').forEach(function(input) {
            if (!input.value.trim()) {
                input.classList.add('error');
                empty = true;
            } else {
                input.classList.remove('error');
            }
        });
        if (empty) {
            e.preventDefault();
            alert('Wrong input! Please fill in all required fields.');
        }
    });
});
</script>
</body>
</html>