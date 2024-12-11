<?php
include 'db_connection.php';

$sql = "SELECT Office_ID, COUNT(*) AS Admin_Count
        FROM staff
        WHERE Position = 'Administrator'
        GROUP BY Office_ID";

$result = $conn->query($sql);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Administrative Staff by Office</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
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
    <h1 style='text-align: center;'>Administrative Staff Count by Office</h1>";

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Office ID</th>
                <th>Number of Administrators</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['Office_ID'] . "</td>
                <td>" . $row['Admin_Count'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No administrative staff found for any office.</p>";
}

echo "</body>
</html>";

$conn->close();
?>
