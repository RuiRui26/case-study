<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driving Test Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        h1, h3 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 90%;
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
        .form-container {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Driving Test Information</h1>

    <!-- Section for clients who failed more than 3 times -->
    <h3>Clients Who Failed Driving Test More Than Three Times</h3>
    <?php
    $failed_sql = "
        SELECT c.First_Name, c.Last_Name
        FROM client c
        JOIN drivingtest dt ON c.Client_ID = dt.Client_ID
        GROUP BY c.Client_ID
        HAVING COUNT(dt.DrivingTest_ID) > 3 AND SUM(dt.is_Passed) = 0
    ";
    $failed_result = $conn->query($failed_sql);

    if ($failed_result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Client Name</th>
                </tr>";
        while ($row = $failed_result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['First_Name']) . " " . htmlspecialchars($row['Last_Name']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>No clients found who failed the driving test more than three times.</p>";
    }
    ?>

    <!-- Section for clients who passed on a specific date -->
    <h3>Clients Who Passed the Driving Test on a Selected Date</h3>
    <div class="form-container">
        <form method="POST" action="">
            <label for="date">Select Date:</label>
            <input type="date" name="date" id="date" required>
            <input type="submit" value="View Clients">
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date'])) {
        $selected_date = $_POST['date'];

    $passed_sql = "
        SELECT 
        c.First_Name, 
        c.Last_Name, 
        c.Registration_Date, 
        o.Name AS Office_Name, 
        dt.Notes AS Test_Notes
    FROM client c
    JOIN office o ON c.Office_ID = o.Office_ID
    JOIN drivingtest dt ON c.Client_ID = dt.Client_ID
    WHERE dt.is_Passed = 1 AND dt.Date = ?
    ";

        $stmt = $conn->prepare($passed_sql);
        $stmt->bind_param("s", $selected_date);
        $stmt->execute();
        $passed_result = $stmt->get_result();

        echo "<h3>Clients Who Passed the Driving Test on " . htmlspecialchars($selected_date) . "</h3>";
        echo "<table>
                <tr>
                    <th>Client Name</th>
                    <th>Registration Date</th>
                    <th>Office</th>
                    <th>Test Notes</th>
                </tr>";

        if ($passed_result->num_rows > 0) {
            while ($row = $passed_result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['First_Name']) . " " . htmlspecialchars($row['Last_Name']) . "</td>
                        <td>" . htmlspecialchars($row['Registration_Date']) . "</td>
                        <td>" . htmlspecialchars($row['Office_Name']) . "</td>
                        <td>" . htmlspecialchars($row['Test_Notes'] ?? 'N/A') . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No clients passed the driving test on this date.</td></tr>";
        }

        echo "</table>";
        $stmt->close();
    }
    ?>

</body>
</html>

<?php
$conn->close();
?>
