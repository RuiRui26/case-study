<?php
include 'db_connection.php';

$sql = "SELECT Name, Address FROM office WHERE City = 'Glasgow'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    echo "<table border='1'>";
    echo "<tr><th>Office Name</th><th>Address</th></tr>";  

    
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['Name'] . "</td><td>" . $row['Address'] . "</td></tr>";
    }

    echo "</table>";
} else {
    echo "No offices found in Glasgow.";
}

$conn->close();
?>
