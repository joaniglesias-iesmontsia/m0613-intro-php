<h2>Students Management</h2>

<!-- Form to Add or Update a Student -->
<h3><?php echo $edit_id !== "" ? "Update Student" : "Add New Student"; ?></h3>
<form method="POST" action="index.php?controller=students&action=save">
    <input type="hidden" name="id" value="<?php echo $edit_id; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $edit_name; ?>" required>
    <br><br>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" value="<?php echo $edit_age; ?>" required>
    <br><br>

    <button type="submit"><?php echo $edit_id !== "" ? "Update Student" : "Add Student"; ?></button>
    <?php if ($edit_id !== ""): ?>
        <a href="index.php?controller=students&action=index">Cancel</a>
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
                    <a href="index.php?controller=students&action=edit&id=<?php echo $student['id']; ?>">Edit</a> | 
                    <a href="index.php?controller=students&action=delete&id=<?php echo $student['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
