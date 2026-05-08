<?php
// Correct path to your config file
include("../config/db.php");

// Identify action
$action = isset($_GET['action']) ? $_GET['action'] : "";

/* =========================
   ➤ ADD USER (STUDENT)
========================= */
if ($action == "add") {

    $name = $_POST['name'];

    // Changed 'students' to 'student' to match your sidebar
    $sql = "INSERT INTO student (student_name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        echo "<h3>✅ Student added successfully</h3>";
    } else {
        echo "Error: " . $conn->error;
    }
}


/* =========================
   ➤ VIEW USERS (STUDENTS)
========================= */
else if ($action == "view") {

    // Changed 'students' to 'student'
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    echo "<h2>📋 Student List</h2>";

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['student_name']."</td>
                    <td>
                        <a href='manageuser.php?action=delete&id=".$row['id']."'>Delete</a>
                    </td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No students found";
    }
}


/* =========================
   ➤ DELETE USER (STUDENT)
========================= */
else if ($action == "delete") {

    $id = $_GET['id'];

    // Changed 'students' to 'student'
    $sql = "DELETE FROM student WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<h3>🗑️ Student deleted successfully</h3>";
    } else {
        echo "Error: " . $conn->error;
    }
}


/* =========================
   ➤ DEFAULT MESSAGE
========================= */
else {
    echo "<h3>⚠️ No action specified</h3>";
}

$conn->close();
?>