<?php
include 'db_connection.php';

$sql = "
    SELECT c.First_Name, c.Last_Name
    FROM client c
    JOIN drivingtest dt ON c.Client_ID = dt.Client_ID
    GROUP BY c.Client_ID
    HAVING COUNT(dt.DrivingTest_ID) > 3 AND SUM(dt.Client_Passed) = 0
";

$result = $conn->query($sql);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Clients Who Failed Driving Test More Than Three Times</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1 style='text-align: center;'>Clients Who Failed Driving Test More Than Three Times</h1>";

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Client Name</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['First_Name'] . " " . $row['Last_Name'] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No clients found who failed the driving test more than three times.</p>";
}

echo "</body>
</html>";

$conn->close();
?>
