<?php
// ==============================================================================
// Base Model (M in MVC)
// ==============================================================================

abstract class Model {
    protected PDO $db;
    protected string $table;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // Retrieve all records from the table
    public function all(): array {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Find a single record by primary key (ID)
    public function find(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    // Delete a record by ID
    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
