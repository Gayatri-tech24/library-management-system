<?php
include "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $book_id = $_POST['book_id'];
    $student_usn = $_POST['usn'];

    // 1. Check if the book is available (quantity > 0)
    $check_sql = "SELECT quantity FROM books WHERE id = ?";
    $stmt_check = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt_check, "i", $book_id);
    mysqli_stmt_execute($stmt_check);
    $res = mysqli_stmt_get_result($stmt_check);
    $book = mysqli_fetch_assoc($res);

    if ($book && $book['quantity'] > 0) {
        // 2. Start transaction
        mysqli_begin_transaction($conn);

        try {
            // Deduct quantity
            $update_sql = "UPDATE books SET quantity = quantity - 1 WHERE id = ?";
            $stmt_upd = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($stmt_upd, "i", $book_id);
            mysqli_stmt_execute($stmt_upd);

            // Log the record
            $log_sql = "INSERT INTO borrowed_records (book_id, student_usn, borrow_date) VALUES (?, ?, NOW())";
            $stmt_log = mysqli_prepare($conn, $log_sql);
            mysqli_stmt_bind_param($stmt_log, "is", $book_id, $student_usn);
            mysqli_stmt_execute($stmt_log);

            mysqli_commit($conn);
            echo "Success: Book borrowed successfully!";
        } catch (Exception $e) {
            mysqli_rollback($conn);
            echo "Error: Transaction failed.";
        }
    } else {
        echo "Error: Book is out of stock or does not exist.";
    }
}
?>