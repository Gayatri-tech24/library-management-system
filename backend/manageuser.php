<?php
// Connection using your port 3307
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

// Search Logic - Searching by roll_no as the unique identifier
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    // Table is 'student'
    $sql = "SELECT * FROM student WHERE roll_no LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM student";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f4f4f4; }
        .search-container { margin-bottom: 20px; text-align: center; }
        input[type="text"] { padding: 10px; width: 250px; border-radius: 5px; border: 1px solid #ccc; }
        .btn-search { padding: 10px 15px; background: #0044cc; color: white; border: none; border-radius: 5px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #2e7d32; color: white; }
        .bin-icon { color: #d9534f; cursor: pointer; font-size: 1.1rem; }
        .bin-icon:hover { color: #c9302c; }
    </style>
</head>
<body>

    <h2 style="text-align:center;">Library Student Directory</h2>

    <div class="search-container">
        <form method="GET">
            <input type="text" name="search" placeholder="Search by Roll No..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn-search">Search</button>
            <a href="manageuser.php" style="margin-left:10px; color: #666;">Reset</a>
        </form>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Roll No</th>
            <th style="text-align:center;">Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['student_name']; ?></td>
            <td><?php echo $row['roll_no']; ?></td>
            <td style="text-align:center;">
                <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Delete student <?php echo $row['student_name']; ?>?');">
                    <i class="fa-solid fa-trash-can bin-icon"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <a href="../index.html">← Back to Dashboard</a>

</body>
</html>