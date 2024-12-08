<?php
include 'db_connection.php';

$sql = "SELECT First_Name, Last_Name, Phone_Num 
        FROM staff 
        WHERE Position = 'Manager'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Phone Number</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['First_Name'] . " " . $row['Last_Name'] . "</td><td>" . $row['Phone_Num'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No results found.";
}

$conn->close();
?>
