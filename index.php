<?php
// ==========================================
// Basic PHP Example: Variables & Operations
// ==========================================

// 1. Define two integer variables
$num1 = 10;
$num2 = 5;

// 2. Define two string variables
$greeting = "Hello";
$target = "world!";

// ------------------------------------------
// Integer Operations: Sum, Multiply, Divide
// ------------------------------------------
$sum = $num1 + $num2;
$product = $num1 * $num2;
$division = $num1 / $num2;

// ------------------------------------------
// String Operations: Concatenation
// ------------------------------------------
$fullMessage = $greeting . " " . $target;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basic PHP Example</title>
</head>
<body>
    <h1>PHP Basics: Variables &amp; Operations</h1>
    
    <h2>Integer Operations</h2>
    <p>Sum: <?php echo "$num1 + $num2 = $sum"; ?></p>
    <p>Multiplication: <?php echo "$num1 * $num2 = $product"; ?></p>
    <p>Division: <?php echo "$num1 / $num2 = $division"; ?></p>

    <h2>String Operations</h2>
    <p>Concatenation: <?php echo $fullMessage; ?></p>

    <h2>Current date and time:</h2>
    <p>The current date and time is: <?php echo date("d/m/Y H:i:s"); ?></p>
</body>
</html>
