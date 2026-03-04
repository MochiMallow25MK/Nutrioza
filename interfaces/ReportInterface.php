<?php
interface ReportInterface {
    public function generate($type, $filters);
    public function export($format, $data);
}
?>