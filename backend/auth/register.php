<?php
// 1. Enable error reporting so you don't get a blank screen
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Connect using your specific port
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 3. Check if the button was clicked
if (isset($_POST['register'])) {
    // Collect data from HTML 'name' attributes
    $name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $usn = mysqli_real_escape_string($conn, $_POST['roll_no']);

    // 4. Insert using your table column names
    $sql = "INSERT INTO student (student_name, roll_no) VALUES ('$name', '$usn')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Student Registered!'); window.location.href='../manageuser.php';</script>";
    } else {
        echo "SQL Error: " . mysqli_error($conn);
    }
} else {
    // If the page is accessed directly without clicking the button
    echo "No data received. Please use the registration form.";
}
?>