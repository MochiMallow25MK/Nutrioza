<?php
// views/report_view.php
// Renders the printable report table for the Auditor role
// Called by workspace.php
class ReportView {

    // $table      — table name being reported on
    // $reportData — array of rows returned by ReportController
    public function render(string $table, array $reportData): void {
        $label = ucwords(str_replace('_', ' ', $table));
        ?>

        <div class="report-header no-print">
            <h2>Report: <?= htmlspecialchars($label) ?></h2>
            <button class="btn btn-gold" onclick="window.print()">🖨 Print Report</button>
        </div>

        <!-- Print-only header -->
        <div style="display:none;" class="print-only">
            <h2 style="text-align:center; margin-bottom:4px;">NUTRIOZA 🌾</h2>
            <p style="text-align:center; font-size:13px; margin-bottom:16px;">
                Report: <?= htmlspecialchars($label) ?> &nbsp;|&nbsp;
                Generated: <?= date('Y-m-d H:i') ?>
            </p>
        </div>

        <?php if (empty($reportData)): ?>
            <p style="color:var(--green-mid); margin-top:20px;">No data available for this report.</p>
        <?php else:
            $cols = array_keys($reportData[0]);
        ?>
        <table>
            <thead>
                <tr>
                    <?php foreach ($cols as $col): ?>
                        <th><?= htmlspecialchars(ucwords(str_replace('_', ' ', $col))) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reportData as $row): ?>
                <tr>
                    <?php foreach ($row as $val): ?>
                        <td><?= htmlspecialchars((string)$val) ?></td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p style="font-size:12px; color:var(--green-mid); margin-top:12px;" class="no-print">
            <?= count($reportData) ?> record(s) found.
        </p>
        <?php endif; ?>

        <style>
        @media print {
            .no-print  { display: none !important; }
            .print-only { display: block !important; }
        }
        </style>
        <?php
    }
}
?>