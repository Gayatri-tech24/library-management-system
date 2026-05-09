<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "DELETE FROM student WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the user management list
        header("Location: backend/manageruser.php"); 
        exit(); 
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>