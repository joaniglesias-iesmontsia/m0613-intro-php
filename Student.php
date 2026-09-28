<?php

class Student {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        // Ensure the table exists
        $this->db->exec("CREATE TABLE IF NOT EXISTS students (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            age INTEGER NOT NULL
        )");
    }

    // Get all students
    public function all() {
        $stmt = $this->db->query("SELECT * FROM students");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Find a student by ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert a new student
    public function create($name, $age) {
        $stmt = $this->db->prepare("INSERT INTO students (name, age) VALUES (:name, :age)");
        return $stmt->execute([
            ':name' => $name,
            ':age'  => $age
        ]);
    }

    // Update an existing student
    public function update($id, $name, $age) {
        $stmt = $this->db->prepare("UPDATE students SET name = :name, age = :age WHERE id = :id");
        return $stmt->execute([
            ':name' => $name,
            ':age'  => $age,
            ':id'   => $id
        ]);
    }

    // Delete a student
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
