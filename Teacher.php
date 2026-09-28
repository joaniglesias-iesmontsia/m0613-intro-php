<?php
require_once __DIR__ . '/Model.php';

class Teacher extends Model {
    protected $table = 'teachers';

    // Insert a new teacher
    public function create($name, $subject) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, subject) VALUES (:name, :subject)");
        return $stmt->execute([
            ':name'    => $name,
            ':subject' => $subject
        ]);
    }

    // Update an existing teacher
    public function update($id, $name, $subject) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET name = :name, subject = :subject WHERE id = :id");
        return $stmt->execute([
            ':name'    => $name,
            ':subject' => $subject,
            ':id'      => $id
        ]);
    }
}
