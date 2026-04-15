<?php
session_start();
require_once 'config.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/CrudController.php';
require_once 'controllers/ReportController.php';
require_once 'views/workspace_view.php';
require_once 'views/crud_view.php';
require_once 'views/report_view.php';

AuthController::requireLogin();

$role   = $_SESSION['role']  ?? 'Viewer';
$menus  = $_SESSION['menus'] ?? [];

// ── Role → allowed tables ────────────────────────────────────────────────────
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

$activeTable = $_GET['table'] ?? ($allowedTables[0] ?? '');
if (!in_array($activeTable, $allowedTables)) $activeTable = $allowedTables[0] ?? '';

// ── Handle POST (Create / Update / Delete) ───────────────────────────────────
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
                $data = $_POST; unset($data['action'], $data['table']);
                $ok   = $crud->create($table, $data);
                $message = $ok ? 'Record created successfully.' : 'Failed to create record.';
                if (!$ok) $msgType = 'error';
            } elseif ($action === 'update') {
                $data = $_POST; unset($data['action'], $data['table']);
                $ok   = $crud->update($table, $data);
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

// ── Load table data ──────────────────────────────────────────────────────────
$crud       = new CrudController();
$rows       = [];
$editRow    = null;
$searchMode = $_GET['search_mode'] ?? '';
$searchVal  = $_GET['search_val']  ?? '';
$dateFrom   = $_GET['date_from']   ?? '';
$dateTo     = $_GET['date_to']     ?? '';

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

// ── Report ───────────────────────────────────────────────────────────────────
$reportData  = [];
$reportTable = '';
if ($isAuditor && !empty($_GET['report'])) {
    $reportTable = $_GET['report'];
    if (in_array($reportTable, $allowedTables)) {
        $rc         = new ReportController();
        $reportData = $rc->generate($reportTable);
    }
}

// ── Build view classes ───────────────────────────────────────────────────────
$workspaceView = new WorkspaceView();
$crudView      = new CrudView();
$reportView    = new ReportView();

// Build sidebar HTML
$sidebar = $workspaceView->renderSidebar($allowedTables, $activeTable, $isViewer, $isAuditor, $reportTable);

// Build main content HTML
ob_start();
if ($isAuditor && $reportTable) {
    $reportView->render($reportTable, $reportData);
} elseif ($activeTable) {
    $crudView->render($activeTable, $rows, $editRow, $isViewer, $message, $msgType, $searchVal, $dateFrom, $dateTo);
} else {
    echo '<p style="color:var(--green-mid); margin-top:40px; font-size:1.1rem;">Select an option from the menu on the left to get started.</p>';
}
$content = ob_get_clean();
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
<?php $workspaceView->render($sidebar, $content, $role, $_SESSION['username'] ?? ''); ?>
</body>
</html>