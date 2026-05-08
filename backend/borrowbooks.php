<?php
// Link to the connection file
include "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $book_id = $_POST['book_id'];
    $student_id = $_POST['student_id']; // Using student_id based on image_24a66a.jpg

    // 1. Check if the book is available (status = 'available')
    $check_sql = "SELECT status FROM books WHERE id = ?";
    $stmt_check = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt_check, "i", $book_id);
    mysqli_stmt_execute($stmt_check);
    $res = mysqli_stmt_get_result($stmt_check);
    $book = mysqli_fetch_assoc($res);

    if ($book && $book['status'] == 'available') {
        // 2. Start transaction
        mysqli_begin_transaction($conn);

        try {
            // Update status to 'borrowed'
            $update_sql = "UPDATE books SET status = 'borrowed' WHERE id = ?";
            $stmt_upd = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($stmt_upd, "i", $book_id);
            mysqli_stmt_execute($stmt_upd);

            // Log the record in the 'borrow' table (based on image_24a66a.jpg)
            // Assuming columns are book_id and student_id
            $log_sql = "INSERT INTO borrow (book_id, student_id) VALUES (?, ?)";
            $stmt_log = mysqli_prepare($conn, $log_sql);
            mysqli_stmt_bind_param($stmt_log, "ii", $book_id, $student_id);
            mysqli_stmt_execute($stmt_log);

            mysqli_commit($conn);
            echo "Success: Book borrowed successfully!";
        } catch (Exception $e) {
            mysqli_rollback($conn);
            echo "Error: Transaction failed. " . $e->getMessage();
        }
    } else {
        echo "Error: Book is already borrowed or does not exist.";
    }
}
?>