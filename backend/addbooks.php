<?php
include "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $status = $_POST['status']; 

    // No 'id' here, let the database handle it
    $sql = "INSERT INTO books (book_name, author, status) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $book_name, $author, $status);

    if (mysqli_stmt_execute($stmt)) {
        echo "<h3>✅ Success: Book added to the library!</h3>";
    } else {
        echo "❌ Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}
?>