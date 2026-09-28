<?php
// Start or resume session
session_start();

/*
echo "<h3>\$_SESSION</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h3>\$_POST</h3>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<h3>\$_GET</h3>";
echo "<pre>";
print_r($_GET);
echo "</pre>";

echo "<h3>\$_COOKIE</h3>";
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";

echo "<h3>\$_SERVER</h3>";
echo "<pre>";
print_r($_SERVER);
echo "</pre>";
*/

// Initialize the students list in session if it doesn't exist
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// ------------------------------------------
// 1. CREATE or UPDATE
// ------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'] ?? '';

    if ($id !== "") {
        // UPDATE existing student
        $_SESSION['students'][$id] = [
            'name' => $_POST['name'],
            'age'  => $_POST['age']
        ];
    } else {
        // CREATE new student
        $_SESSION['students'][] = [
            'name' => $_POST['name'],
            'age'  => $_POST['age']
        ];
    }
}

// ------------------------------------------
// 2. DELETE
// ------------------------------------------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    unset($_SESSION['students'][$id]);
    // Reset numeric keys so array indexes remain contiguous (0, 1, 2...)
    $_SESSION['students'] = array_values($_SESSION['students']);
}

// ------------------------------------------
// 3. EDIT (Load student data into the form)
// ------------------------------------------
$edit_id = "";
$edit_name = "";
$edit_age = "";

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    if (isset($_SESSION['students'][$edit_id])) {
        $edit_name = $_SESSION['students'][$edit_id]['name'];
        $edit_age = $_SESSION['students'][$edit_id]['age'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management</title>
</head>
<body>
    <h1>Student Management System</h1>

    <!-- Form to Add or Update a Student -->
    <h2><?php echo $edit_id !== "" ? "Update Student" : "Add New Student"; ?></h2>
    <form method="POST" action="index.php">
        <!-- Hidden input to store student index when editing -->
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
                <th>Name</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['students'] as $index => $student): ?>
                <tr>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['age']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $index; ?>">Edit</a> | 
                        <a href="index.php?delete=<?php echo $index; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
