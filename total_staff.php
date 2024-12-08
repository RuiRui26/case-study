<?php
include 'db_connection.php';
//sql query para sa staff
$sql = "SELECT o.Name AS Office_Name, COUNT(s.Staff_ID) AS Total_Staff
        FROM office o
        LEFT JOIN staff s ON o.Office_ID = s.Office_ID
        GROUP BY o.Name";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Office Name</th>
                <th>Total Staff</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['Office_Name'] . "</td>
                <td>" . $row['Total_Staff'] . "</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "No data found.";
}

$conn->close();
?>
