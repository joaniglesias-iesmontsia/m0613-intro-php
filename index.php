<?php
// Start or resume session
session_start();

var_dump($_SESSION);
echo "<br>";
var_dump($_POST);
echo "<br>";
var_dump($_GET);
echo "<br>";

// Initialize the students list in session if it doesn't exist
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// Add student directly to session without any validation
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION['students'][] = [
        'name' => $_POST['name'],
        'age'  => $_POST['age']
    ];
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

    <!-- Form to Add a New Student -->
    <h2>Add New Student</h2>
    <form method="POST" action="index.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age">
        <br><br>

        <button type="submit">Add Student</button>
    </form>

    <hr>

    <!-- Display List of Students -->
    <h2>Registered Students</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['students'] as $student): ?>
                <tr>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['age']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
