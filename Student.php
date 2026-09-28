<?php
require_once __DIR__ . '/Model.php';

class Student extends Model {
    protected $table = 'students';

    // Insert a new student
    public function create($name, $age) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (name, age) VALUES (:name, :age)");
        return $stmt->execute([
            ':name' => $name,
            ':age'  => $age
        ]);
    }

    // Update an existing student
    public function update($id, $name, $age) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET name = :name, age = :age WHERE id = :id");
        return $stmt->execute([
            ':name' => $name,
            ':age'  => $age,
            ':id'   => $id
        ]);
    }
}
