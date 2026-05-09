<?php
// Connect via Port 3307
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if (isset($_POST['issue_book'])) {
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $roll_no = mysqli_real_escape_string($conn, $_POST['roll_no']);

    // 1. Check if the book exists and is actually available
    $check_query = "SELECT * FROM books WHERE book_name = '$book_name' AND status = 'Available' LIMIT 1";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // 2. Update the status instead of deleting
        $update_sql = "UPDATE books SET status = 'Not Available' WHERE book_name = '$book_name' LIMIT 1";
        
        if (mysqli_query($conn, $update_sql)) {
            echo "<script>
                    alert('Success: Status changed to Not Available for $book_name');
                    window.location.href='viewbooks.php';
                  </script>";
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Error: Book is either Not Found or already Issued');</script>";
    }
}
?>