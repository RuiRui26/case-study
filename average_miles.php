<?php
include 'db_connection.php';

$sql = "
    SELECT AVG(Mileage_Used / (TIMESTAMPDIFF(MINUTE, Time_Start, Time_End) / 60)) AS Avg_Miles_Per_Hour
    FROM lesson
    WHERE TIMESTAMPDIFF(MINUTE, Time_Start, Time_End) > 0
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p>Average Miles Driven Per Hour: " . round($row['Avg_Miles_Per_Hour'], 2) . " miles</p>";
} else {
    echo "<p>No lessons found to calculate the average.</p>";
}

$conn->close();
?>
