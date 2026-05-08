<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    
    // Dates
    $borrow_date = date("Y-m-d");
    $return_date = date("Y-m-d", strtotime("+7 days")); // Adds 14 days automatically

    // Updated SQL with return_date
    $sql = "INSERT INTO borrow (book_id, student_id, borrow_date, return_date) 
            VALUES ('$book_id', '$student_id', '$borrow_date', '$return_date')";
    
    if (mysqli_query($conn, $sql)) {
        // Mark book as borrowed
        mysqli_query($conn, "UPDATE books SET status='Borrowed' WHERE id='$book_id'");
        
        echo "<script>
                alert('✅ Success! Return date is: $return_date');
                window.location.href='../issue.html';
              </script>";
    } else {
        echo "<h3>❌ Error:</h3> " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>