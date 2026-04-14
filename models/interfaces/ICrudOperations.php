<?php
// Interface for all CRUD operations — NFR-11: modular design
interface ICrudOperations {
    public function create(Database $db): bool;
    public function update(Database $db): bool;
    public function delete(Database $db, int $id): bool;
    public static function getAll(Database $db): array;
    public static function getById(Database $db, int $id);
}
?>