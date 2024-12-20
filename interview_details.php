<?php
include 'db_connection.php';

$instructor_id = isset($_GET['instructor_id']) ? $_GET['instructor_id'] : null;

if ($instructor_id === null) {
    $sql_instructors = "SELECT Staff_ID, First_Name, Last_Name FROM staff WHERE Position IN ('Instructor', 'Senior Instructor')";
    $result_instructors = $conn->query($sql_instructors);

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Select Instructor</title>
    </head>
    <body>
        <h1 style='text-align: center;'>Select an Instructor</h1>
        <form method='GET' action=''>
            <label for='instructor_id'>Choose an Instructor:</label>
            <select name='instructor_id' id='instructor_id'>";

    if ($result_instructors->num_rows > 0) {
        while ($row = $result_instructors->fetch_assoc()) {
            echo "<option value='" . $row['Staff_ID'] . "'>" . $row['First_Name'] . " " . $row['Last_Name'] . "</option>";
        }
    } else {
        echo "<option>No instructors available</option>";
    }

    echo "</select><br><br>
            <input type='submit' value='Submit'>
        </form>
    </body>
    </html>";
    exit;
}

$sql = "
    SELECT i.Interview_ID, i.Date AS Interview_Date, i.Client_License_Status, i.Notes, 
           c.First_Name AS Client_First_Name, c.Last_Name AS Client_Last_Name,
           s.First_Name AS Instructor_First_Name, s.Last_Name AS Instructor_Last_Name
    FROM interview i
    JOIN client c ON i.Client_ID = c.Client_ID
    JOIN staff s ON i.Instructor_ID = s.Staff_ID
    WHERE i.Instructor_ID = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $instructor_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Interview Details</title>
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
    <h1 style='text-align: center;'>Interviews Conducted by Instructor</h1>";

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Interview ID</th>
                <th>Interview Date</th>
                <th>Client License Status</th>
                <th>Notes</th>
                <th>Client Name</th>
                <th>Instructor Name</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['Interview_ID'] . "</td>
                <td>" . $row['Interview_Date'] . "</td>
                <td>" . $row['Client_License_Status'] . "</td>
                <td>" . htmlspecialchars($row['Notes']) . "</td>
                <td>" . $row['Client_First_Name'] . " " . $row['Client_Last_Name'] . "</td>
                <td>" . $row['Instructor_First_Name'] . " " . $row['Instructor_Last_Name'] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No interviews found for this instructor.</p>";
}

echo "</body>
</html>";

$stmt->close();
$conn->close();
?>

