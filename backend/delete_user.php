<?php
// Connect to your database on port 3307
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if 'id' is passed in the URL from the bin icon
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Use your singular table name 'student'
    $sql = "DELETE FROM student WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        // This line sends you back to the list so you don't see a blank page
        header("Location: manageuser.php");
        exit(); 
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "No ID provided for deletion.";
}
?>