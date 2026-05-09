<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Students - Library System</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; margin: 0; padding: 40px; }
        .container { max-width: 900px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        h2 { color: #4a148c; text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th { background: #6a1b9a; color: white; padding: 15px; text-align: left; text-transform: uppercase; font-size: 13px; }
        td { padding: 15px; border-bottom: 1px solid #eee; color: #333; }
        tr:hover { background: #f9f0ff; }
        .back-btn { display: inline-block; margin-bottom: 20px; text-decoration: none; color: #6a1b9a; font-weight: bold; }
        .empty { text-align: center; color: #888; padding: 20px; }
    </style>
</head>
<body>

<div class="container">
    <a href="index.html" class="back-btn">← Back to Dashboard</a>
    <h2>👥 Current Student Records</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Roll Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Port 3307 as per your XAMPP setup
            $conn = mysqli_connect("127.0.0.1", "root", "", "library_db", 3307);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM student ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>" . htmlspecialchars($row['student_name']) . "</td>
                            <td>" . htmlspecialchars($row['roll_no']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='empty'>No students found in the database.</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>

</body>
</html>