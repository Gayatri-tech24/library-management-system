<?php
include "../config/db.php";

// Fetch all books from the database
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Books - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; text-align: center; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #2c3e50; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .status-available { color: green; font-weight: bold; }
        .status-borrowed { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h2>📚 Current Library Inventory</h2>
    <a href="../index.html">⬅ Back to Dashboard</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Status</th>
        </tr>