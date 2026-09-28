<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/Teacher.php';

$teacherModel = new Teacher($db);

// ------------------------------------------
// 1. CREATE or UPDATE
// ------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id      = $_POST['id'] ?? '';
    $name    = $_POST['name'] ?? '';
    $subject = $_POST['subject'] ?? '';

    if ($id !== "") {
        $teacherModel->update($id, $name, $subject);
    } else {
        $teacherModel->create($name, $subject);
    }
    header("Location: teachers.php");
    exit;
}

// ------------------------------------------
// 2. DELETE
// ------------------------------------------
if (isset($_GET['delete'])) {
    $teacherModel->delete($_GET['delete']);
    header("Location: teachers.php");
    exit;
}

// ------------------------------------------
// 3. EDIT (Load teacher data into form)
// ------------------------------------------
$edit_id      = "";
$edit_name    = "";
$edit_subject = "";

if (isset($_GET['edit'])) {
    $teacherToEdit = $teacherModel->find($_GET['edit']);
    if ($teacherToEdit) {
        $edit_id      = $teacherToEdit['id'];
        $edit_name    = $teacherToEdit['name'];
        $edit_subject = $teacherToEdit['subject'];
    }
}

// ------------------------------------------
// 4. READ (Fetch all teachers)
// ------------------------------------------
$teachers = $teacherModel->all();

$pageTitle = "Teachers Management";
require_once __DIR__ . '/header.php';
?>

<h2>Teachers Management</h2>

<!-- Form to Add or Update a Teacher -->
<h3><?php echo $edit_id !== "" ? "Update Teacher" : "Add New Teacher"; ?></h3>
<form method="POST" action="teachers.php">
    <input type="hidden" name="id" value="<?php echo $edit_id; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $edit_name; ?>">
    <br><br>

    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject" value="<?php echo $edit_subject; ?>">
    <br><br>

    <button type="submit"><?php echo $edit_id !== "" ? "Update Teacher" : "Add Teacher"; ?></button>
    <?php if ($edit_id !== ""): ?>
        <a href="teachers.php">Cancel</a>
    <?php endif; ?>
</form>

<hr>

<!-- Display List of Teachers -->
<h3>Registered Teachers</h3>
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($teachers as $teacher): ?>
            <tr>
                <td><?php echo $teacher['id']; ?></td>
                <td><?php echo $teacher['name']; ?></td>
                <td><?php echo $teacher['subject']; ?></td>
                <td>
                    <a href="teachers.php?edit=<?php echo $teacher['id']; ?>">Edit</a> | 
                    <a href="teachers.php?delete=<?php echo $teacher['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/footer.php'; ?>
