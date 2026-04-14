<?php
require_once __DIR__ . '/../interfaces/IDecorator.php';

// Decorator: logs every CRUD action (NFR-11, audit trail)
class LoggingDecorator implements IDecorator {
    public function execute(callable $operation, array $params = []): mixed {
        $start = microtime(true);
        $result = $operation(...$params);
        $elapsed = round((microtime(true) - $start) * 1000, 2);
        $logLine = date('Y-m-d H:i:s') . " | elapsed:{$elapsed}ms | result:" . ($result ? 'success' : 'fail') . PHP_EOL;
        @file_put_contents(__DIR__ . '/../../logs/crud.log', $logLine, FILE_APPEND);
        return $result;
    }
}
?>