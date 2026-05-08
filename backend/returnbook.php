<?php
// Correct path to your config file
include("../config/db.php");

// Get data from form
$student_id = $_POST['student_id'];
$book_id = $_POST['book_id'];

// 1. Find active borrow record in the 'borrow' table (not 'borrowed_books')
$sql = "SELECT * FROM borrow 
        WHERE student_id='$student_id' 
        AND book_id='$book_id' 
        AND return_date >= CURDATE()";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // 2. Mark as returned in the 'borrow' table
    $updateBorrow = "UPDATE borrow 
                     SET return_date = CURDATE() 
                     WHERE student_id='$student_id' 
                     AND book_id='$book_id' 
                     AND return_date >= CURDATE()";

    if ($conn->query($updateBorrow) === TRUE) {

        // 3. Update book status back to 'Available' in the 'books' table
        // Based on your photo, we use the column 'status'
        $updateBook = "UPDATE books 
                       SET status = 'Available' 
                       WHERE id='$book_id'";

        $conn->query($updateBook);

        echo "<h3>✅ Book Returned and marked as Available!</h3>";

    } else {
        echo "Error updating record: " . $conn->error;
    }

} else {
    echo "<h3>❌ No active borrow record found for this student and book</h3>";
}

$conn->close();
?>