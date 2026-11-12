<h2>Projects Management</h2>

<!-- Form to Add or Update a Project -->
<h3><?php echo $edit_id !== "" ? "Update Project" : "Add New Project"; ?></h3>
<form method="POST" action="index.php?controller=projects&action=save">
    <input type="hidden" name="id" value="<?php echo $edit_id; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $edit_name; ?>" required>
    <br><br>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" value="<?php echo $edit_description; ?>" required>
    <br><br>

    <button type="submit"><?php echo $edit_id !== "" ? "Update Project" : "Add Project"; ?></button>
    <?php if ($edit_id !== ""): ?>
        <a href="index.php?controller=projects&action=index">Cancel</a>
    <?php endif; ?>
</form>

<hr>

<!-- Display List of Projects -->
<h3>Registered Projects</h3>
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project): ?>
            <tr>
                <td><?php echo $project['id']; ?></td>
                <td><?php echo $project['name']; ?></td>
                <td><?php echo $project['description']; ?></td>
                <td>
                    <a href="index.php?controller=projects&action=edit&id=<?php echo $project['id']; ?>">Edit</a> | 
                    <a href="index.php?controller=projects&action=delete&id=<?php echo $project['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
