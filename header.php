<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?? 'School Management'; ?></title>
</head>
<body>
    <h1>School Management System</h1>

    <!-- Navigation Menu (DRY) -->
    <nav>
        <a href="students.php"><strong>[ Students ]</strong></a>
        &nbsp;|&nbsp;
        <a href="teachers.php"><strong>[ Teachers ]</strong></a>
    </nav>

    <hr>
