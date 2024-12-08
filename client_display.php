<?php
include 'db_connection.php';

$sql = "SELECT c.First_Name, c.Last_Name, o.Name AS Office_Name, c.registration_date 
        FROM client c
        JOIN office o ON c.Office_ID = o.Office_ID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<table>";
    echo "<tr><th>Name</th><th>Office</th><th>Registration Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['First_Name'] . " " . $row['Last_Name'] . "</td>
                <td>" . $row['Office_Name'] . "</td>
                <td>" . $row['registration_date'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No clients found.";
}

$conn->close();
?>
