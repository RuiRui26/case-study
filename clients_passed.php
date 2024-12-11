<?php
include 'db_connection.php';

// Check if form inputs are set
$selected_date = isset($_POST['date']) ? $_POST['date'] : null;

if ($selected_date) {
    // SQL query to get clients who passed the driving test on the selected date
    $clients_passed_sql = "
        SELECT 
            c.First_Name, 
            c.Last_Name, 
            c.Registration_Date, 
            o.Name AS Office_Name, 
            dt.Notes AS Test_Notes
        FROM client c
        JOIN office o ON c.Office_ID = o.Office_ID
        JOIN drivingtest dt ON c.Client_ID = dt.Client_ID
        WHERE dt.Client_Passed = 1 AND DATE(c.Registration_Date) = ?
    ";

    $stmt = $conn->prepare($clients_passed_sql);
    $stmt->bind_param("s", $selected_date);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h3>Clients Who Passed the Driving Test on " . htmlspecialchars($selected_date) . "</h3>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>Client Name</th>
            <th>Registration Date</th>
            <th>Office</th>
            <th>Test Notes</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['First_Name']) . " " . htmlspecialchars($row['Last_Name']) . "</td>
                <td>" . htmlspecialchars($row['Registration_Date']) . "</td>
                <td>" . htmlspecialchars($row['Office_Name']) . "</td>
                <td>" . htmlspecialchars($row['Test_Notes'] ?? 'N/A') . "</td>
              </tr>";
    }

    if ($result->num_rows == 0) {
        echo "<tr><td colspan='4'>No clients passed the driving test on this date.</td></tr>";
    }

    echo "</table>";
    $stmt->close();
}
?>

<form method="POST" action="">
    <label for="date">Select Date:</label>
    <input type="date" name="date" id="date" required>
    <input type="submit" value="View Clients">
</form>
