<?php
// views/crud_view.php
// Renders the CRUD table, search toolbar, create modal, and edit form
// Called by workspace.php — receives data arrays, renders nothing on its own
class CrudView {

    // ── Main entry point ──────────────────────────────────────────────────────
    // $table       — active table name
    // $rows        — array of data rows
    // $editRow     — single row array when editing, or null
    // $isViewer    — read-only flag
    // $message     — success/error feedback message
    // $msgType     — 'success' or 'error'
    // $searchVal   — current search keyword
    // $dateFrom    — current date filter from
    // $dateTo      — current date filter to
    public function render(
        string $table,
        array  $rows,
        ?array $editRow,
        bool   $isViewer,
        string $message  = '',
        string $msgType  = 'success',
        string $searchVal = '',
        string $dateFrom  = '',
        string $dateTo    = ''
    ): void {
        $label = ucwords(str_replace('_', ' ', $table));
        ?>

        <?php if ($message): ?>
            <div class="alert alert-<?= htmlspecialchars($msgType) ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <h2 style="color:var(--green-dark); margin-bottom:18px;">
            <?= htmlspecialchars($label) ?>
            <?php if ($isViewer): ?>
                <span style="font-size:12px; color:var(--green-mid);"> (read only)</span>
            <?php endif; ?>
        </h2>

        <!-- Search toolbar -->
        <form method="GET" class="toolbar no-print">
            <input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
            <input type="text"  name="search_val" placeholder="Search by name..."
                   value="<?= htmlspecialchars($searchVal) ?>">
            <input type="date"  name="date_from"  value="<?= htmlspecialchars($dateFrom) ?>">
            <input type="date"  name="date_to"    value="<?= htmlspecialchars($dateTo) ?>">
            <button type="submit" name="search_mode" value="name" class="btn btn-secondary">Search Name</button>
            <button type="submit" name="search_mode" value="date" class="btn btn-secondary">Search Date</button>
            <a href="?table=<?= htmlspecialchars($table) ?>" class="btn btn-secondary">Clear</a>
            <?php if (!$isViewer): ?>
                <button type="button" class="btn btn-primary no-print"
                        onclick="openModal('createModal')">+ Add New</button>
            <?php endif; ?>
        </form>

        <!-- Data table -->
        <?php if (empty($rows)): ?>
            <p style="color:var(--green-mid); margin-top:20px;">No records found.</p>
        <?php else:
            $cols  = array_keys($rows[0]);
            $pkKey = $cols[0];
        ?>
        <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <?php foreach ($cols as $col): ?>
                        <th><?= htmlspecialchars(ucwords(str_replace('_', ' ', $col))) ?></th>
                    <?php endforeach; ?>
                    <?php if (!$isViewer): ?><th class="no-print">Actions</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                <tr>
                    <?php foreach ($row as $val): ?>
                        <td><?= htmlspecialchars((string)$val) ?></td>
                    <?php endforeach; ?>
                    <?php if (!$isViewer): ?>
                    <td class="no-print">
                        <a href="?table=<?= htmlspecialchars($table) ?>&edit_id=<?= htmlspecialchars((string)$row[$pkKey]) ?>"
                           class="action-link action-edit">Edit</a>
                        <form method="POST" style="display:inline;"
                              onsubmit="return confirm('Delete this record?');">
                            <input type="hidden" name="action"    value="delete">
                            <input type="hidden" name="table"     value="<?= htmlspecialchars($table) ?>">
                            <input type="hidden" name="record_id" value="<?= htmlspecialchars((string)$row[$pkKey]) ?>">
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

        <?php if (!$isViewer): ?>

        <!-- Create modal -->
        <div class="modal-overlay" id="createModal">
            <div class="modal-box">
                <button class="modal-close" onclick="closeModal('createModal')">✕</button>
                <h3>Add New — <?= htmlspecialchars($label) ?></h3>
                <form method="POST" id="createForm" novalidate>
                    <input type="hidden" name="action" value="create">
                    <input type="hidden" name="table"  value="<?= htmlspecialchars($table) ?>">
                    <?php
                    $skipCols  = ['submitted_at', 'created_at'];
                    $fieldCols = !empty($rows) ? array_keys($rows[0]) : [];
                    foreach ($fieldCols as $i => $col):
                        if ($i === 0) continue;           // skip PK
                        if (in_array($col, $skipCols)) continue;
                    ?>
                    <div class="form-group">
                        <label><?= htmlspecialchars(ucwords(str_replace('_', ' ', $col))) ?></label>
                        <input type="text" name="<?= htmlspecialchars($col) ?>" required>
                    </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary" style="width:100%;">Save</button>
                </form>
            </div>
        </div>

        <!-- Edit form (inline, shown below table when editing) -->
        <?php if ($editRow): ?>
        <div class="card no-print" style="margin-top:24px;">
            <h3 style="color:var(--green-dark); margin-bottom:18px;">
                Edit Record — <?= htmlspecialchars($label) ?>
            </h3>
            <form method="POST" id="editForm" novalidate>
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="table"  value="<?= htmlspecialchars($table) ?>">
                <?php foreach ($editRow as $col => $val): ?>
                <div class="form-group">
                    <label><?= htmlspecialchars(ucwords(str_replace('_', ' ', $col))) ?></label>
                    <input type="text"
                           name="<?= htmlspecialchars($col) ?>"
                           value="<?= htmlspecialchars((string)$val) ?>"
                           <?= ($col === array_key_first($editRow)) ? 'readonly style="background:#eee;"' : '' ?>>
                </div>
                <?php endforeach; ?>
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="?table=<?= htmlspecialchars($table) ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <?php endif; ?>

        <?php endif; // end !isViewer ?>
        <?php
    }
}
?>