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

// Sum (+)
$sum = $num1 + $num2;
echo "Sum: $num1 + $num2 = " . $sum . PHP_EOL;

// Multiply (*)
$product = $num1 * $num2;
echo "Multiplication: $num1 * $num2 = " . $product . PHP_EOL;

// Divide (/)
$division = $num1 / $num2;
echo "Division: $num1 / $num2 = " . $division . PHP_EOL;

// ------------------------------------------
// String Operations: Concatenation
// ------------------------------------------

// In PHP, the dot operator (.) is used to concatenate strings
$fullMessage = $greeting . " " . $target;
echo "Concatenation: " . $fullMessage . PHP_EOL;
