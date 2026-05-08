<?php
// Link to the connection file
include "../config/db.php";

// Updated SQL to match your attributes: id, book_name, author, status
$sql = "SELECT id, book_name, author, status FROM books";
$result = mysqli_query($conn, $sql);

echo "<h2>Library Inventory</h2>";

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>
            <tr style='background-color: #f2f2f2;'>
                <th>ID</th>
                <th>Book Name</th>
                <th>Author</th>
                <th>Status</th>
            </tr>";
    
    while($row = mysqli_fetch_assoc($result)) {
        // Apply color coding based on status for better visibility
        $statusColor = ($row["status"] == 'available') ? "green" : "red";

        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["book_name"] . "</td>
                <td>" . $row["author"] . "</td>
                <td style='color: $statusColor; font-weight: bold;'>" . ucfirst($row["status"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No books found in the database.";
}
?>