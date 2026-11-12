<?php
// ==============================================================================
// Project Model
// ==============================================================================

require_once __DIR__ . '/Model.php';

class Project extends Model {
    protected string $table = 'projects';

    // Create a new project
    public function create(string $name, string $description): bool {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, description) VALUES (:name, :description)");
        return $stmt->execute([
            ':name' => $name,
            ':description' => $description
        ]);
    }

    // Update an existing project
    public function update(int $id, string $name, string $description): bool {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET name = :name, description = :description WHERE id = :id");
        return $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':id'   => $id
        ]);
    }
}
