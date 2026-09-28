<?php
// ==============================================================================
// CRUD Example with SQLite & PDO (Single-page / Spaghetti style)
// ==============================================================================

// 1. Connect to SQLite database (creates 'students.db' file automatically)
$db = new PDO('sqlite:' . __DIR__ . '/students.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 2. Create the table if it does not already exist
$db->exec("CREATE TABLE IF NOT EXISTS students (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    age INTEGER NOT NULL
)");

// ------------------------------------------
// CREATE or UPDATE
// ------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';

    if ($id !== "") {
        // UPDATE existing student
        $stmt = $db->prepare("UPDATE students SET name = :name, age = :age WHERE id = :id");
        $stmt->execute([
            ':name' => $name,
            ':age'  => $age,
            ':id'   => $id
        ]);
    } else {
        // CREATE new student
        $stmt = $db->prepare("INSERT INTO students (name, age) VALUES (:name, :age)");
        $stmt->execute([
            ':name' => $name,
            ':age'  => $age
        ]);
    }
}

// ------------------------------------------
// DELETE
// ------------------------------------------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $db->prepare("DELETE FROM students WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

// ------------------------------------------
// EDIT (Load student data into form)
// ------------------------------------------
$edit_id = "";
$edit_name = "";
$edit_age = "";

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $stmt = $db->prepare("SELECT * FROM students WHERE id = :id");
    $stmt->execute([':id' => $edit_id]);
    $studentToEdit = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($studentToEdit) {
        $edit_name = $studentToEdit['name'];
        $edit_age = $studentToEdit['age'];
    }
}

// ------------------------------------------
// READ (Fetch all students from SQLite)
// ------------------------------------------
$stmt = $db->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management (SQLite)</title>
</head>
<body>
    <h1>Student Management System (SQLite)</h1>

    <!-- Form to Add or Update a Student -->
    <h2><?php echo $edit_id !== "" ? "Update Student" : "Add New Student"; ?></h2>
    <form method="POST" action="index.php">
        <!-- Hidden input to store student ID when editing -->
        <input type="hidden" name="id" value="<?php echo $edit_id; ?>">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $edit_name; ?>">
        <br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo $edit_age; ?>">
        <br><br>

        <button type="submit"><?php echo $edit_id !== "" ? "Update Student" : "Add Student"; ?></button>
        <?php if ($edit_id !== ""): ?>
            <a href="index.php">Cancel</a>
        <?php endif; ?>
    </form>

    <hr>

    <!-- Display List of Students -->
    <h2>Registered Students</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['age']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $student['id']; ?>">Edit</a> | 
                        <a href="index.php?delete=<?php echo $student['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
