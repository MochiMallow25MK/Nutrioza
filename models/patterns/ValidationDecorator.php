<?php
require_once __DIR__ . '/../interfaces/IDecorator.php';

// Decorator: validates that required fields are non-empty before executing (NFR-08)
class ValidationDecorator implements IDecorator {
    private array $requiredFields;
    private array $data;

    public function __construct(array $data, array $requiredFields) {
        $this->data           = $data;
        $this->requiredFields = $requiredFields;
    }

    public function execute(callable $operation, array $params = []): mixed {
        foreach ($this->requiredFields as $field) {
            if (empty(trim((string)($this->data[$field] ?? '')))) {
                throw new InvalidArgumentException("Validation failed: '$field' is required.");
            }
        }
        return $operation(...$params);
    }
}
?>