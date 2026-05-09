<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

$message = "";
$messageClass = "";

if (isset($_POST['issue_book'])) {
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $roll_no = mysqli_real_escape_string($conn, $_POST['roll_no']);

    // 1. Check if the book exists
    $book_check = mysqli_query($conn, "SELECT * FROM books WHERE book_name = '$book_name' LIMIT 1");
    
    // 2. Check if the student exists
    $student_check = mysqli_query($conn, "SELECT * FROM student WHERE roll_no = '$roll_no' LIMIT 1");

    if (mysqli_num_rows($book_check) > 0 && mysqli_num_rows($student_check) > 0) {
        // Book and Student found!
        $book = mysqli_fetch_assoc($book_check);
        $book_id = $book['id'];

        // 3. Delete the book from the books table
        $delete_sql = "DELETE FROM books WHERE id = $book_id";
        
        if (mysqli_query($conn, $delete_sql)) {
            $message = "Success: '$book_name' has been issued to Roll No: $roll_no and removed from inventory.";
            $messageClass = "success";
        } else {
            $message = "Error: Could not process the transaction.";
            $messageClass = "error";
        }
    } else {
        // Not found logic
        if (mysqli_num_rows($book_check) == 0) {
            $message = "Error: Book '$book_name' is Not Available.";
        } else {
            $message = "Error: Student with Roll No '$roll_no' not found.";
        }
        $messageClass = "error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Issue Book</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 50px; text-align: center; }
        .card { background: white; padding: 30px; border-radius: 10px; display: inline-block; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 350px; }
        input { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        button { width: 97%; padding: 10px; background: #0044cc; color: white; border: none; cursor: pointer; border-radius: 5px; font-weight: bold; }
        .message { margin-top: 20px; padding: 10px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        a { display: block; margin-top: 20px; color: #666; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <h2>Issue Book</h2>
    <form method="POST">
        <input type="text" name="book_name" placeholder="Enter Book Name" required>
        <input type="text" name="roll_no" placeholder="Enter Student Roll No" required>
        <button type="submit" name="issue_book">Issue Book</button>
    </form>

    <?php if ($message != ""): ?>
        <div class="message <?php echo $messageClass; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <a href="../index.html">← Back to Dashboard</a>
</div>

</body>
</html>