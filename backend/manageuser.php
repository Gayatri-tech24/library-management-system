<?php
// Database Connection
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 1. Handle "Add User" (POST Logic)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $roll = mysqli_real_escape_string($conn, $_POST['roll_no']);
    
    $insert_sql = "INSERT INTO student (student_name, roll_no) VALUES ('$name', '$roll')";
    mysqli_query($conn, $insert_sql);
    header("Location: manageuser.php"); // Refresh to show new user
    exit();
}

// 2. Handle Search Logic
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM student WHERE roll_no LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM student";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library User Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f7; margin: 0; padding: 20px; }
        .navbar { background: #2c3e50; color: white; padding: 15px; text-align: center; font-size: 22px; margin: -20px -20px 20px -20px; }
        .container { width: 450px; margin: 0 auto 30px auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 10px; margin: 8px 0 15px 0; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box; }
        .btn { width: 100%; padding: 12px; background:#3498db; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .search-container { text-align: center; margin-bottom: 20px; }
        table { width: 90%; margin: 0 auto; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
        th { background: #3498db; color: white; }
        .bin-icon { color: #d9534f; font-size: 1.2rem; }
    </style>
</head>
<body>

<div class="navbar">Library Management System</div>

<!-- Add User Form -->
<div class="container">
    <h2>Add New Student</h2>
    <form method="POST">
        <label>Student Name</label>
        <input type="text" name="student_name" required>
        <label>Roll Number</label>
        <input type="text" name="roll_no" required>
        <button type="submit" name="add_user" class="btn">Add User</button>
    </form>
</div>

<!-- Search and List -->
<div class="search-container">
    <form method="GET">
        <input type="text" name="search" placeholder="Search by Roll No..." style="width: 200px;" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" style="padding: 10px;">Search</button>
        <a href="manageuser.php" style="margin-left: 10px;">Reset</a>
    </form>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Roll No</th>
        <th>Action</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['student_name']; ?></td>
        <td><?php echo $row['roll_no']; ?></td>
        <td>
            <a href="delete_user.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Delete student <?php echo $row['student_name']; ?>?');">
                <i class="fa-solid fa-trash-can bin-icon"></i>
            </a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>