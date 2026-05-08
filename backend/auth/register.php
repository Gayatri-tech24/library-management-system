<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Connection (3307 Port)
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "library_db";
$port = 3307; 

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    // Get data from form
    $name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $roll = mysqli_real_escape_string($conn, $_POST['roll_no']);

    // SQL for your 'student' table
    $sql = "INSERT INTO student (student_name, roll_no) VALUES ('$name', '$roll')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('✅ Student Registered Successfully!');
                window.location.href='../../usermanagement.html';
              </script>";
    } else {
        echo "<h3>❌ Error:</h3> " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>