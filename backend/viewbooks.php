<?php
// 1. Database Connection (using your port 3307)
$conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Fetch all books from your table
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Inventory</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .header { background-color: #1a2a3a; color: white; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
        .container { background: white; padding: 20px; border-radius: 0 0 8px 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #2e7d32; color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #ddd; }
        tr:hover { background-color: #f1f1f1; }
        .status-available { color: green; font-weight: bold; }
        .status-borrowed { color: red; font-weight: bold; }
    </style>
</head>
<body>

<div class="header">
    <h2>Library Management System - Book List</h2>
</div>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $statusClass = (strtolower($row['status']) == 'available') ? 'status-available' : 'status-borrowed';
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['book_name']}</td>
                            <td>{$row['author']}</td>
                            <td class='$statusClass'>{$row['status']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center;'>No books found in the database.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="index.html" style="text-decoration:none; color:#0055ff; font-weight:bold;">← Back to Dashboard</a>
</div>

</body>
</html>