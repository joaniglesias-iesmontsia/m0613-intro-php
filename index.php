<?php
// ==========================================
// Basic PHP Example: Variables & Operations
// Approach: "HTML inside PHP"
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

// Current date and time
$currentDateTime = date("d/m/Y H:i:s");

// ------------------------------------------
// Generate HTML completely from within PHP
// ------------------------------------------
echo "<!DOCTYPE html>\n";
echo "<html lang=\"en\">\n";
echo "<head>\n";
echo "    <meta charset=\"UTF-8\">\n";
echo "    <title>Basic PHP Example</title>\n";
echo "</head>\n";
echo "<body>\n";
echo "    <h1>PHP Basics: Variables &amp; Operations</h1>\n";
echo "    \n";
echo "    <h2>Integer Operations</h2>\n";
echo "    <p>Sum: $num1 + $num2 = $sum</p>\n";
echo "    <p>Multiplication: $num1 * $num2 = $product</p>\n";
echo "    <p>Division: $num1 / $num2 = $division</p>\n";
echo "    \n";
echo "    <h2>String Operations</h2>\n";
echo "    <p>Concatenation: $fullMessage</p>\n";
echo "    \n";
echo "    <h2>Current date and time:</h2>\n";
echo "    <p>The current date and time is: $currentDateTime</p>\n";
echo "</body>\n";
echo "</html>\n";
