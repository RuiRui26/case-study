<?php
include 'db_connection.php';

$offices_query = "SELECT Name FROM office WHERE City = 'Glasgow'";
$offices_result = $conn->query($offices_query);

$selected_office = isset($_GET['office_name']) ? $_GET['office_name'] : '';

$sql = "
    SELECT c.Registration_No, s.First_Name, s.Last_Name
    FROM car c
    JOIN staff s ON c.Instructor_ID = s.Staff_ID
    JOIN office o ON s.Office_ID = o.Office_ID
    WHERE o.City = 'Glasgow' AND o.Name = ? AND s.Position IN ('Instructor', 'Senior Instructor')
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $selected_office);

if (!empty($selected_office)) {
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = null;
}

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Car Registration Numbers</title>
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
        form {
            text-align: center;
            margin: 20px;
        }
        select {
            padding: 5px;
            font-size: 16px;
        }
        button {
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1 style='text-align: center;'>Car Registration Numbers and Instructors</h1>
    <form method='get'>
        <label for='office_name'>Select Office:</label>
        <select id='office_name' name='office_name'>
            <option value=''>--Select Office--</option>";

if ($offices_result->num_rows > 0) {
    while ($office = $offices_result->fetch_assoc()) {
        $selected = ($office['Name'] === $selected_office) ? "selected" : "";
        echo "<option value='" . htmlspecialchars($office['Name']) . "' $selected>" . htmlspecialchars($office['Name']) . "</option>";
    }
}

echo "      </select>
        <button type='submit'>Submit</button>
    </form>";

if (!empty($selected_office)) {
    echo "<h2 style='text-align: center;'>Office: $selected_office, Glasgow</h2>";

    if ($result && $result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Registration Number</th>
                    <th>Instructor First Name</th>
                    <th>Instructor Last Name</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['Registration_No']) . "</td>
                    <td>" . htmlspecialchars($row['First_Name']) . "</td>
                    <td>" . htmlspecialchars($row['Last_Name']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>No cars or instructors found for the selected office.</p>";
    }
}

echo "</body>
</html>";

$conn->close();
?>
