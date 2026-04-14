<?php
// Decorator Pattern interface — wraps CRUD operations with extra behavior
interface IDecorator {
    public function execute(callable $operation, array $params = []): mixed;
}
?>