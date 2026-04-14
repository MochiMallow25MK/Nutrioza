<?php
// Interface for report generation — used by Auditor role
interface IReportable {
    public static function generateReport(Database $db): array;
}
?>