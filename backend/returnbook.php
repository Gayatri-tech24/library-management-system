<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Connection
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);

    // 1. Delete the record from the borrow table
    $delete_sql = "DELETE FROM borrow WHERE book_id = '$book_id'";
    
    if (mysqli_query($conn, $delete_sql)) {
        
        // 2. Update the books table to make it 'Available' again
        $update_sql = "UPDATE books SET status='Available' WHERE id='$book_id'";
        mysqli_query($conn, $update_sql);

        echo "<script>
                alert('✅ Book Returned Successfully!');
                window.location.href='../return.html';
              </script>";
    } else {
        echo "<h3>❌ Error:</h3> " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>