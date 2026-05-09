<?php
// Connect via Port 3307
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if (isset($_POST['return_book'])) {
    $b_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $r_no = mysqli_real_escape_string($conn, $_POST['roll_no']);

    // Checking if student exists using 'roll_no'
    $student_check = mysqli_query($conn, "SELECT * FROM student WHERE roll_no = '$r_no'");

    if (mysqli_num_rows($student_check) > 0) {
        // Corrected columns: book_name, author, status
        $sql = "INSERT INTO books (book_name, author, status) VALUES ('$b_name', 'Returned', 'Available')";

        if (mysqli_query($conn, $sql)) {
            $message = "<p style='color:green; font-weight:bold;'>Success: '$b_name' is back in inventory!</p>";
        } else {
            $message = "<p style='color:red;'>SQL Error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        $message = "<p style='color:red;'>Error: Roll No '$r_no' not found.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Return Book</title>
    <style>
        body { font-family: Arial; text-align: center; background: #f4f4f4; padding-top: 50px; }
        .box { background: white; padding: 30px; display: inline-block; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        input { display: block; width: 280px; padding: 10px; margin: 15px auto; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 10px; background: #2e7d32; color: white; border: none; cursor: pointer; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Return Book</h2>
        <form method="POST">
            <input type="text" name="roll_no" placeholder="Student Roll No" required>
            <input type="text" name="book_name" placeholder="Book Name" required>
            <button type="submit" name="return_book">Confirm Return</button>
        </form>
        <?php echo $message; ?>
        <br><a href="../index.html" style="text-decoration:none; color:#666;">← Dashboard</a>
    </div>
</body>
</html>