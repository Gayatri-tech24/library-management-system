<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connection Settings
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
    
    // FIXED: Changed real_escape_with_string to real_escape_string
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "INSERT INTO books (book_name, author, status) VALUES ('$book_name', '$author', '$status')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('✅ Book Added Successfully!');
                window.location.href='../addbook.html';
              </script>";
    } else {
        echo "<h3>❌ Database Error:</h3> " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>