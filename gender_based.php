<?php
include 'db_connection.php';

//Default Female and Office Glasgow!
$gender = 'Female';
$office = 'Glasgow Bearsden Office';


if (isset($_POST['gender'])) {
    $gender = $_POST['gender'];  
}
if (isset($_POST['office'])) {
    $office = $_POST['office']; 
}

$sql = "SELECT s.First_Name, s.Last_Name, s.Gender, o.Name as Office_Name
        FROM staff s
        JOIN office o ON s.Office_ID = o.Office_ID
        WHERE o.City = 'Glasgow' 
        AND o.Name = ? 
        AND s.Gender = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $office, $gender); 

$stmt->execute();


$result = $stmt->get_result();
?>


<form method="POST" action="">
    <label for="gender">Select Gender: </label>
    <select name="gender" id="gender">
        <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
        <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
    </select>
    
    <label for="office">Select Office: </label>
    <select name="office" id="office">
        <option value="Glasgow Bearsden Office" <?php if ($office == 'Glasgow Bearsden Office') echo 'selected'; ?>>Glasgow Bearsden Office</option>
        <option value="Glasgow Central Office" <?php if ($office == 'Glasgow Central Office') echo 'selected'; ?>>Glasgow Central Office</option>
    </select>

    <input type="submit" value="Filter">
</form>

<?php
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Office</th>
            </tr>";

        
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['First_Name'] . "</td>
                <td>" . $row['Last_Name'] . "</td>
                <td>" . $row['Gender'] . "</td>
                <td>" . $row['Office_Name'] . "</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "No instructors found.";
}


$stmt->close();
$conn->close();
?>
