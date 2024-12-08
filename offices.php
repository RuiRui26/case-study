<?php
include 'db_connection.php';

$sql = "SELECT Address FROM office WHERE City = 'Glasgow'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['Address'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No offices found in Glasgow.";
}

$conn->close();
?>
