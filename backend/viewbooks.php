<?php
include "../config/db.php";

$sql = "SELECT id, title, author, isbn, quantity FROM books";
$result = mysqli_query($conn, $sql);

echo "<h2>Library Inventory</h2>";

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Quantity</th>
            </tr>";
    
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["title"] . "</td>
                <td>" . $row["author"] . "</td>
                <td>" . $row["isbn"] . "</td>
                <td>" . $row["quantity"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No books found in the database.";
}
?>