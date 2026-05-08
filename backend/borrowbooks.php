<?php
include "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Collect data from the form
    $student_id = $_POST['student_id'];
    $book_id = $_POST['book_id'];
    $borrow_date = date("Y-m-d"); // Automatically get today's date

    // SQL: We skip the 'issue_id' column because it should be AUTO_INCREMENT
    $sql = "INSERT INTO borrow (student_id, book_id, borrow_date) VALUES (?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);

    // "iis" means: integer, integer, string
    mysqli_stmt_bind_param($stmt, "iis", $student_id, $book_id, $borrow_date);

    if (mysqli_stmt_execute($stmt)) {
        // Optional: Update the book status to 'Borrowed' in the books table
        $updateSql = "UPDATE books SET status = 'Borrowed' WHERE id = ?";
        $updateStmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "i", $book_id);
        mysqli_stmt_execute($updateStmt);

        echo "<h3>✅ Success: Book issued to Student ID: $student_id</h3>";
        echo "<a href='../index.html'>Back to Dashboard</a>";
    } else {
        echo "❌ Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
?>