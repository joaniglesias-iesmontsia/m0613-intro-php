<?php
// ==============================================================================
// Teacher Model
// ==============================================================================

require_once __DIR__ . '/Model.php';

class Teacher extends Model {
    protected string $table = 'teachers';

    // Create a new teacher
    public function create(string $name, string $subject): bool {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, subject) VALUES (:name, :subject)");
        return $stmt->execute([
            ':name'    => $name,
            ':subject' => $subject
        ]);
    }

    // Update an existing teacher
    public function update(int $id, string $name, string $subject): bool {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET name = :name, subject = :subject WHERE id = :id");
        return $stmt->execute([
            ':name'    => $name,
            ':subject' => $subject,
            ':id'      => $id
        ]);
    }
}
