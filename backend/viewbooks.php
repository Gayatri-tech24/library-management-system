<!DOCTYPE html>
<html>
<head>
    <title>Library Inventory</title>
    <style>
        body { font-family: sans-serif; background: #eef5ff; padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #1565c0; color: white; }
        .available { color: green; font-weight: bold; }
        .borrowed { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>📚 Current Library Books</h2>
    <a href="index.html">Back to Dashboard</a><br><br>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Status</th>
        </tr>
        <?php
        $conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);
        $res = mysqli_query($conn, "SELECT * FROM books");
        while($row = mysqli_fetch_assoc($res)) {
            $class = ($row['status'] == 'Available') ? 'available' : 'borrowed';
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['book_name']}</td>
                    <td>{$row['author']}</td>
                    <td class='$class'>{$row['status']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>