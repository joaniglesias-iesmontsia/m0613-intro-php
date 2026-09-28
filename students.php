<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/Student.php';

$studentModel = new Student($db);

// ------------------------------------------
// 1. CREATE or UPDATE
// ------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id   = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $age  = $_POST['age'] ?? '';

    if ($id !== "") {
        $studentModel->update($id, $name, $age);
    } else {
        $studentModel->create($name, $age);
    }
    // Refresh to clear form submission
    header("Location: students.php");
    exit;
}

// ------------------------------------------
// 2. DELETE
// ------------------------------------------
if (isset($_GET['delete'])) {
    $studentModel->delete($_GET['delete']);
    header("Location: students.php");
    exit;
}

// ------------------------------------------
// 3. EDIT (Load student data into form)
// ------------------------------------------
$edit_id   = "";
$edit_name = "";
$edit_age  = "";

if (isset($_GET['edit'])) {
    $studentToEdit = $studentModel->find($_GET['edit']);
    if ($studentToEdit) {
        $edit_id   = $studentToEdit['id'];
        $edit_name = $studentToEdit['name'];
        $edit_age  = $studentToEdit['age'];
    }
}

// ------------------------------------------
// 4. READ (Fetch all students)
// ------------------------------------------
$students = $studentModel->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students Management</title>
</head>
<body>
    <h1>School Management System</h1>

    <!-- Navigation Menu -->
    <nav>
        <a href="students.php"><strong>[ Students ]</strong></a>
        &nbsp;|&nbsp;
        <a href="teachers.php"><strong>[ Teachers ]</strong></a>
    </nav>

    <hr>

    <h2>Students Management</h2>

    <!-- Form to Add or Update a Student -->
    <h3><?php echo $edit_id !== "" ? "Update Student" : "Add New Student"; ?></h3>
    <form method="POST" action="students.php">
        <input type="hidden" name="id" value="<?php echo $edit_id; ?>">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $edit_name; ?>">
        <br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo $edit_age; ?>">
        <br><br>

        <button type="submit"><?php echo $edit_id !== "" ? "Update Student" : "Add Student"; ?></button>
        <?php if ($edit_id !== ""): ?>
            <a href="students.php">Cancel</a>
        <?php endif; ?>
    </form>

    <hr>

    <!-- Display List of Students -->
    <h3>Registered Students</h3>
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
                        <a href="students.php?edit=<?php echo $student['id']; ?>">Edit</a> | 
                        <a href="students.php?delete=<?php echo $student['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
