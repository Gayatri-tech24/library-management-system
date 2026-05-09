<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if (isset($_POST['return_book'])) {
    $b_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $r_no = mysqli_real_escape_string($conn, $_POST['roll_no']);

    // 1. Verify the student exists
    $student_check = mysqli_query($conn, "SELECT * FROM student WHERE roll_no = '$r_no'");

    if (mysqli_num_rows($student_check) > 0) {
        // 2. UPDATE existing book status instead of INSERTing a new row
        $update_sql = "UPDATE books SET status = 'Available' WHERE book_name = '$b_name' LIMIT 1";

        if (mysqli_query($conn, $update_sql)) {
            echo "<script>
                    alert('Success: $b_name is now Available');
                    window.location.href='viewbooks.php';
                  </script>";
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Error: Roll No $r_no not found.');</script>";
    }
}
?>