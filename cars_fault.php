<?php
include 'db_connection.php';

$sql_no_faults = "SELECT Registration_No FROM car WHERE wFaults = 0";
$result_no_faults = $conn->query($sql_no_faults);

$sql_faults = "SELECT Registration_No FROM car WHERE wFaults = 1";
$result_faults = $conn->query($sql_faults);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Car Faults Report</title>
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
    <h1 style='text-align: center;'>Car Faults Report</h1>";


if ($result_no_faults->num_rows > 0) {
    echo "<h2 style='text-align: center;'>Cars with No Faults</h2>";
    echo "<table>
            <tr>
                <th>Registration Number</th>
            </tr>";

    while ($row = $result_no_faults->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['Registration_No'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No cars with no faults found.</p>";
}

if ($result_faults->num_rows > 0) {
    echo "<h2 style='text-align: center;'>Cars with Faults</h2>";
    echo "<table>
            <tr>
                <th>Registration Number</th>
            </tr>";

    while ($row = $result_faults->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['Registration_No'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No cars with faults found.</p>";
}

echo "</body>
</html>";

$conn->close();
?>
