<?php

class Teacher {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        // Ensure the table exists
        $this->db->exec("CREATE TABLE IF NOT EXISTS teachers (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            subject TEXT NOT NULL
        )");
    }

    // Get all teachers
    public function all() {
        $stmt = $this->db->query("SELECT * FROM teachers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Find a teacher by ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM teachers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert a new teacher
    public function create($name, $subject) {
        $stmt = $this->db->prepare("INSERT INTO teachers (name, subject) VALUES (:name, :subject)");
        return $stmt->execute([
            ':name'    => $name,
            ':subject' => $subject
        ]);
    }

    // Update an existing teacher
    public function update($id, $name, $subject) {
        $stmt = $this->db->prepare("UPDATE teachers SET name = :name, subject = :subject WHERE id = :id");
        return $stmt->execute([
            ':name'    => $name,
            ':subject' => $subject,
            ':id'      => $id
        ]);
    }

    // Delete a teacher
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM teachers WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
