<?php
// ==============================================================================
// Student Model
// ==============================================================================

require_once __DIR__ . '/Model.php';

class Student extends Model {
    protected string $table = 'students';

    // Create a new student
    public function create(string $name, int $age): bool {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, age) VALUES (:name, :age)");
        return $stmt->execute([
            ':name' => $name,
            ':age'  => $age
        ]);
    }

    // Update an existing student
    public function update(int $id, string $name, int $age): bool {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET name = :name, age = :age WHERE id = :id");
        return $stmt->execute([
            ':name' => $name,
            ':age'  => $age,
            ':id'   => $id
        ]);
    }
}
