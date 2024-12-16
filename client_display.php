<?php
include 'db_connection.php';

$selected_office_id = isset($_POST['office_id']) ? $_POST['office_id'] : null;

$office_sql = "SELECT Office_ID, Name FROM office";
$office_result = $conn->query($office_sql);

if ($selected_office_id) {
    $client_gender_sql = "
        SELECT 
            SUM(CASE WHEN c.Gender = 'Male' THEN 1 ELSE 0 END) AS Male_Count, 
            SUM(CASE WHEN c.Gender = 'Female' THEN 1 ELSE 0 END) AS Female_Count
        FROM client c
        JOIN office o ON c.Office_ID = o.Office_ID
        WHERE c.Office_ID = ?
    ";

    $stmt = $conn->prepare($client_gender_sql);
    $stmt->bind_param("i", $selected_office_id); 
    $stmt->execute();
    $stmt->bind_result($male_count, $female_count);
    $stmt->fetch();
    $stmt->close();

    echo "<h3>Total Clients in Selected Office (Gender Breakdown)</h3>";
    echo "<p>Male Clients: " . $male_count . "</p>";
    echo "<p>Female Clients: " . $female_count . "</p>";
    $client_list_sql = "
        SELECT 
            c.First_Name, 
            c.Last_Name, 
            c.Gender, 
            c.registration_date, 
            o.Name AS Office_Name,
            dt.is_Passed AS Test_Passed,
            COUNT(dt.DrivingTest_ID) AS Test_Attempts
        FROM client c
        JOIN office o ON c.Office_ID = o.Office_ID
        LEFT JOIN drivingtest dt ON c.Client_ID = dt.Client_ID
        WHERE c.Office_ID = ?
        GROUP BY c.Client_ID, dt.is_Passed
    ";

    $stmt = $conn->prepare($client_list_sql);
    $stmt->bind_param("i", $selected_office_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h3>Clients in Selected Office with Test Information</h3>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Client Name</th><th>Gender</th><th>Registration Date</th><th>Office</th><th>Test Passed</th><th>Test Attempts</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['First_Name'] . " " . $row['Last_Name'] . "</td>
                <td>" . $row['Gender'] . "</td>
                <td>" . $row['registration_date'] . "</td>
                <td>" . $row['Office_Name'] . "</td>
                <td>" . ($row['Test_Passed'] == 1 ? 'Yes' : 'No') . "</td>
                <td>" . $row['Test_Attempts'] . "</td>
              </tr>";
    }
    echo "</table>";
    $stmt->close();
}

$city_client_sql = "
    SELECT o.City, COUNT(c.Client_ID) AS Total_Clients
    FROM client c
    JOIN office o ON c.Office_ID = o.Office_ID
    GROUP BY o.City
";
$city_result = $conn->query($city_client_sql);

echo "<h3>Total Clients in Each City</h3>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>City</th><th>Total Clients</th></tr>";
while ($row = $city_result->fetch_assoc()) {
    echo "<tr><td>" . $row['City'] . "</td><td>" . $row['Total_Clients'] . "</td></tr>";
}
echo "</table>";
?>

<form method="POST" action="">
    <label for="office_id">Select Office:</label>
    <select name="office_id" id="office_id">
        <option value="">--Select Office--</option>
        <?php
        if ($office_result->num_rows > 0) {
            while ($office = $office_result->fetch_assoc()) {
                echo "<option value='" . $office['Office_ID'] . "'>" . $office['Name'] . "</option>";
            }
        }
        ?>
    </select>
    <input type="submit" value="View Client Count">
</form>
