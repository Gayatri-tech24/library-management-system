<?php
// Link to the connection file
include "../config/db.php";

// Check if data is sent via POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Collect data from the form
    $id = $_POST['id']; // New ID variable
    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $status = $_POST['status']; 

    // 1. Prepare the SQL template including 'id'
    $sql = "INSERT INTO books (id, book_name, author, status) VALUES (?, ?, ?, ?)";
    
    // 2. Initialize the statement
    $stmt = mysqli_prepare($conn, $sql);

    // 3. Bind variables to the placeholders
    // "isss" means: integer (id), string (book_name), string (author), string (status)
    mysqli_stmt_bind_param($stmt, "isss", $id, $book_name, $author, $status);

    // 4. Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Success: Book added securely!";
    } else {
        // If you get an error here, it might be because that ID already exists
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // 5. Close the statement
    mysqli_stmt_close($stmt);
}
?>