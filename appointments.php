<?php
include 'db_connection.php';

$first_name = isset($_GET['first_name']) ? $_GET['first_name'] : null;
$last_name = isset($_GET['last_name']) ? $_GET['last_name'] : null;

if (!$first_name || !$last_name) {
    echo '<form method="GET" action="">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required>
            <br>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" required>
            <br>
            <button type="submit">Search</button>
          </form>';
    exit;
}

// Query to get lessons for the instructor
$sql = "SELECT 
            l.Date AS Appointment_Date, 
            l.Time_Start AS Start_Time, 
            l.Time_End AS End_Time, 
            c.First_Name AS Client_First_Name, 
            c.Last_Name AS Client_Last_Name
        FROM lesson l
        JOIN staff s ON l.Instructor_ID = s.Staff_ID
        LEFT JOIN client c ON l.Client_ID = c.Client_ID
        WHERE s.First_Name = ? 
        AND s.Last_Name = ?
        ORDER BY l.Date, l.Time_Start";

$stmt = $conn->prepare($sql);

// Bind instructor first and last name parameters
$stmt->bind_param("ss", $first_name, $last_name);

$stmt->execute();

$result = $stmt->get_result();

// Check if there are lessons for the instructor
if ($result->num_rows > 0) {
    echo "<h2>Appointments for {$first_name} {$last_name} (Next Week)</h2>";
    echo "<table border='1'>
            <tr>
                <th>Appointment Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Client Name</th>
            </tr>";
    
    // Loop through the results and display each appointment
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['Appointment_Date'] . "</td>
                <td>" . $row['Start_Time'] . "</td>
                <td>" . $row['End_Time'] . "</td>
                <td>" . $row['Client_First_Name'] . " " . $row['Client_Last_Name'] . "</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "<h2>No appointments found for {$first_name} {$last_name} (Next Week).</h2>";
}

$stmt->close();
$conn->close();
?>

