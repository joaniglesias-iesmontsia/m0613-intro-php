<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?? 'School Management'; ?></title>
</head>
<body>
    <h1>School Management System</h1>

    <!-- Navigation Menu (MVC links) -->
    <nav>
        <a href="index.php?controller=students&action=index"><strong>[ Students ]</strong></a>
        &nbsp;|&nbsp;
        <a href="index.php?controller=teachers&action=index"><strong>[ Teachers ]</strong></a>
    </nav>

    <hr>
