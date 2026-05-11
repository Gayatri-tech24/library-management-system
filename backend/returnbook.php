<?php
// 1. Database Connection
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Processing the Form Submission
if (isset($_POST['submit_return'])) {
    $usn = mysqli_real_escape_string($conn, $_POST['usn']);
    $b_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $r_date = mysqli_real_escape_string($conn, $_POST['return_date']);

    // Check if book exists and is NOT available
    $check_sql = "SELECT status FROM books WHERE LOWER(book_name) = LOWER('$b_name') LIMIT 1";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if (strtolower($row['status']) !== 'available') {
            // Update status to Available
            $update_sql = "UPDATE books SET status = 'Available' WHERE LOWER(book_name) = LOWER('$b_name')";
            
            if (mysqli_query($conn, $update_sql)) {
                echo "<script>
                        alert('Success: Book returned! Status is now Available.');
                        window.location.href='viewbooks.php';
                      </script>";
            }
        } else {
            echo "<script>alert('Error: This book is already Available in the library.');</script>";
        }
    } else {
        echo "<script>alert('Error: Book name not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Return Book</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 400px; }
        h2 { color: #1a2a3a; text-align: center; margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input { width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #0055ff; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #0044cc; }
        .back-link { display: block; text-align: center; margin-top: 15px; text-decoration: none; color: #666; font-size: 14px; }
    </style>
</head>
<body>

<div class="card">
    <h2>Return a Book</h2>
    <form action="returnbook.php" method="POST">
        <label>Student USN</label>
        <input type="text" name="usn" placeholder="Enter your USN (e.g. 1RV21CS...)" required>

        <label>Book Name</label>
        <input type="text" name="book_name" placeholder="Enter exact Book Title" required>

        <label>Return Date</label>
        <input type="date" name="return_date" value="<?php echo date('Y-m-d'); ?>" required>

        <button type="submit" name="submit_return">Confirm Return</button>
        <a href="student.html" class="back-link">← Cancel and Go Back</a>
    </form>
</div>

</body>
</html>