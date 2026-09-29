<h2>Teachers Management</h2>

<!-- Form to Add or Update a Teacher -->
<h3><?php echo $edit_id !== "" ? "Update Teacher" : "Add New Teacher"; ?></h3>
<form method="POST" action="index.php?controller=teachers&action=save">
    <input type="hidden" name="id" value="<?php echo $edit_id; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $edit_name; ?>" required>
    <br><br>

    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject" value="<?php echo $edit_subject; ?>" required>
    <br><br>

    <button type="submit"><?php echo $edit_id !== "" ? "Update Teacher" : "Add Teacher"; ?></button>
    <?php if ($edit_id !== ""): ?>
        <a href="index.php?controller=teachers&action=index">Cancel</a>
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
                    <a href="index.php?controller=teachers&action=edit&id=<?php echo $teacher['id']; ?>">Edit</a> | 
                    <a href="index.php?controller=teachers&action=delete&id=<?php echo $teacher['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
