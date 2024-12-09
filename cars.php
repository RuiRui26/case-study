<?php
include 'db_connection.php';

$sql = "
    SELECT c.Car_ID, c.Registration_No
    FROM car c
    LEFT JOIN lesson l ON c.Car_ID = l.Car_ID
    WHERE c.wFaults = 0
      AND (l.Lesson_ID IS NULL OR l.Date != CURDATE())
    GROUP BY c.Car_ID;
";

$result = $conn->query($sql);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Available Cars</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
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
    <h1 style='text-align: center;'>Available Cars</h1>";

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Car ID</th>
                <th>Registration Number</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['Car_ID'] . "</td>
                <td>" . $row['Registration_No'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No available cars found.</p>";
}

echo "</body>
</html>";

$conn->close();
?>
