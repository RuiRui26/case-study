<?php
include 'db_connection.php';

$sql = "
    SELECT 
        s.Staff_ID AS ID, 
        s.First_Name, 
        s.Last_Name, 
        s.Age, 
        'Staff' AS Role, 
        s.Position, 
        o.Name AS Office
    FROM staff s
    LEFT JOIN office o ON s.Office_ID = o.Office_ID
    UNION
    SELECT 
        m.Manager_ID AS ID, 
        m.First_Name, 
        m.Last_Name, 
        m.Age, 
        'Manager' AS Role, 
        NULL AS Position, 
        GROUP_CONCAT(o.Name SEPARATOR ', ') AS Office
    FROM manager m
    LEFT JOIN office o ON m.Manager_ID = o.Manager_ID
    GROUP BY m.Manager_ID
";

if (!$result = $conn->query($sql)) {
    die('Error executing query: ' . $conn->error);
}

$sql_instructors = "SELECT First_Name, Last_Name, Age, Position, o.Name AS Office
                    FROM staff s 
                    LEFT JOIN office o ON s.Office_ID = o.Office_ID 
                    WHERE Position = 'Instructor' AND Age > 55";

if (!$result_instructors = $conn->query($sql_instructors)) {
    die('Error executing instructors query: ' . $conn->error);
}

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Staff and Manager List</title>
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
    <h1 style='text-align: center;'>Staff and Manager List</h1>";

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Role</th>
                <th>Position</th>
                <th>Office</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['ID'] . "</td>
                <td>" . $row['First_Name'] . "</td>
                <td>" . $row['Last_Name'] . "</td>
                <td>" . $row['Age'] . "</td>
                <td>" . $row['Role'] . "</td>
                <td>" . $row['Position'] . "</td>
                <td>" . ($row['Office'] ? $row['Office'] : 'Not Assigned') . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No staff or managers found.</p>";
}

if ($result_instructors->num_rows > 0) {
    echo "<h2 style='text-align: center;'>Instructors Over 55 Years Old</h2>";
    echo "<table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
                <th>Position</th>
                <th>Office</th>
            </tr>";

    while ($row = $result_instructors->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['First_Name'] . "</td>
                <td>" . $row['Last_Name'] . "</td>
                <td>" . $row['Age'] . "</td>
                <td>" . $row['Position'] . "</td>
                <td>" . ($row['Office'] ? $row['Office'] : 'Not Assigned') . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No instructors over 55 years old found.</p>";
}

echo "</body>
</html>";

$conn->close();
?>
