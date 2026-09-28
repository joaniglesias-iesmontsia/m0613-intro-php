<?php
// ==============================================================================
// Simple OOP (POO) CRUD with SQLite & PDO
// ==============================================================================

// 1. Connect to SQLite database
$db = new PDO('sqlite:' . __DIR__ . '/students.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 2. Import the Student class
require_once __DIR__ . '/Student.php';


// 3. Instantiate the Student object
$studentModel = new Student($db);

// ------------------------------------------
// CREATE or UPDATE
// ------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';

    if ($id !== "") {
        $studentModel->update($id, $name, $age);
    } else {
        $studentModel->create($name, $age);
    }
}

// ------------------------------------------
// DELETE
// ------------------------------------------
if (isset($_GET['delete'])) {
    $studentModel->delete($_GET['delete']);
}

// ------------------------------------------
// EDIT (Load student data into form)
// ------------------------------------------
$edit_id = "";
$edit_name = "";
$edit_age = "";

if (isset($_GET['edit'])) {
    $studentToEdit = $studentModel->find($_GET['edit']);
    if ($studentToEdit) {
        $edit_id = $studentToEdit['id'];
        $edit_name = $studentToEdit['name'];
        $edit_age = $studentToEdit['age'];
    }
}

// ------------------------------------------
// READ (Fetch all students)
// ------------------------------------------
$students = $studentModel->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management (OOP + SQLite)</title>
</head>
<body>
    <h1>Student Management System (OOP + SQLite)</h1>

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
