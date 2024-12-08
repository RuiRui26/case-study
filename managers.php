<?php
include 'db_connection.php';

$sql = "SELECT office.Name AS Office_Name, 
               office.City, 
               manager.First_Name, 
               manager.Last_Name, 
               manager.Telephone
        FROM office
        JOIN manager ON office.Manager_ID = manager.Manager_ID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Office Name</th><th>Manager Name</th><th>Phone Number</th></tr>";
    while ($row = $result->fetch_assoc()) {
        // Displaying the office and manager details
        echo "<tr><td>" . $row['Office_Name'] . "</td><td>" . "</td><td>" . 
             $row['First_Name'] . " " . $row['Last_Name'] . "</td><td>" . $row['Telephone'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No offices found.";
}

$conn->close();
?>
