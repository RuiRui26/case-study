<?php
include '../../db_connection.php';

// Fetch clients from the database
$sql_clients = "SELECT Client_ID, First_Name, Last_Name FROM client";
$result_clients = $conn->query($sql_clients);

// Fetch instructors from the database
$sql_instructors = "SELECT Staff_ID, First_Name, Last_Name FROM staff WHERE Position = 'Instructor'";
$result_instructors = $conn->query($sql_instructors);

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $instructor_id = $_POST['instructor_id'];
    $interview_date = $_POST['date'];
    $notes = $_POST['notes'];
    $license_status = $_POST['license_status'];

    // Insert the new interview into the database
    $sql_insert = "
        INSERT INTO interview (Client_ID, Instructor_ID, Date, Notes, Client_License_Status)
        VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("iisss", $client_id, $instructor_id, $interview_date, $notes, $license_status);

    if ($stmt->execute()) {
        echo "<p style='color: green; text-align: center;'>Interview successfully added!</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    header('location: views/staffView/staff_dashboard.php');
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Interview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            color: #333;
        }
        form {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, select, textarea {
            width: 80%;
            margin: 10px 0;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea {
            resize: none;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include 'header_staff.php'?>
    <br>
    <h1 style="text-align:center;">Add New Interview</h1>
    <form method="POST" action="">
        <label for="client_id">Select Client:</label><br>
        <select name="client_id" id="client_id" required>
            <option value="" hidden>-- Select Client --</option>
            <?php
            if ($result_clients->num_rows > 0) {
                while ($row = $result_clients->fetch_assoc()) {
                    echo "<option value='" . $row['Client_ID'] . "'>" . $row['First_Name'] . " " . $row['Last_Name'] . "</option>";
                }
            } else {
                echo "<option value=''>No clients available</option>";
            }
            ?>
        </select><br>

        <label for="instructor_id">Select Instructor:</label><br>
        <select name="instructor_id" id="instructor_id" required>
            <option value="" hidden>-- Select Instructor --</option>
            <?php
            if ($result_instructors->num_rows > 0) {
                while ($row = $result_instructors->fetch_assoc()) {
                    echo "<option value='" . $row['Staff_ID'] . "'>" . $row['First_Name'] . " " . $row['Last_Name'] . "</option>";
                }
            } else {
                echo "<option value=''>No instructors available</option>";
            }
            ?>
        </select><br>

        <label for="date">Interview Date:</label><br>
        <input type="date" name="date" id="date" required><br>

        <label for="notes">Notes:</label><br>
        <textarea name="notes" id="notes" rows="5" placeholder="Enter any additional notes here..."></textarea><br>

        <label for="license_status">License Status:</label><br>
        <select name="license_status" id="license_status" required>
            <option value="" hidden>-- Select License Status --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select><br><br>

        <button type="submit">Add Interview</button>
    </form>
</body>
</html>
