<?php
// Strategy Pattern interface — NFR-11, NFR-12
interface ISearchStrategy {
    public function search(Database $db, string $table, string $value): array;
}
?>