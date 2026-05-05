<?php
// Link to the connection file
include "../config/db.php";

// Check if data is sent via POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $qty = $_POST['quantity'];

    // 1. Prepare the SQL template with placeholders (?)
    $sql = "INSERT INTO books (title, author, isbn, quantity) VALUES (?, ?, ?, ?)";
    
    // 2. Initialize the statement
    $stmt = mysqli_prepare($conn, $sql);

    // 3. Bind variables to the placeholders
    // "sssi" means: string, string, string, integer
    mysqli_stmt_bind_param($stmt, "sssi", $title, $author, $isbn, $qty);

    // 4. Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Success: Book added securely!";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // 5. Close the statement
    mysqli_stmt_close($stmt);
}
?>