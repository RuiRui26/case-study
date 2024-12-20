<?php
include '../../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $client_id = $_POST['client_id'];
    $test_date = $_POST['test_date'];
    $is_passed = isset($_POST['is_passed']) ? 1 : 0;
    $notes = $_POST['notes'];

    // Insert query for adding driving test information
    $sql = "INSERT INTO drivingtest (Client_ID, Test_Date, is_Passed, Notes) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isis", $client_id, $test_date, $is_passed, $notes);

    if ($stmt->execute()) {
        $message = "Driving test information added successfully.";
    } else {
        $message = "Error: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Driving Test Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include 'header_staff.php' ?>
    <br>
    <h1 style="text-align: center;">Add Driving Test Information</h1>

    <?php if (isset($message)) { echo "<p class='message'>" . htmlspecialchars($message) . "</p>"; } ?>

    <form method="POST" action="">
        <label for="client_id">Client ID:</label>
        <select name="client_id" id="client_id" required>
            <option value="">-- Select Client --</option>
            <?php
            // Fetch clients from the database
            $client_sql = "SELECT Client_ID, First_Name, Last_Name FROM client";
            $client_result = $conn->query($client_sql);

            if ($client_result->num_rows > 0) {
                while ($client = $client_result->fetch_assoc()) {
                    echo "<option value='" . $client['Client_ID'] . "'>" 
                         . htmlspecialchars($client['First_Name']) . " " 
                         . htmlspecialchars($client['Last_Name']) . "</option>";
                }
            } else {
                echo "<option value=''>No clients found</option>";
            }
            ?>
        </select>

        <label for="test_date">Test Date:</label>
        <input type="date" name="test_date" id="test_date" required>

        <label for="is_passed">Test Passed:</label>
        <input type="checkbox" name="is_passed" id="is_passed">

        <label for="notes">Notes:</label>
        <textarea name="notes" id="notes" rows="5" placeholder="Enter additional details (optional)"></textarea>

        <input type="submit" value="Add Test Info">
    </form>
</body>
</html>

<?php
$conn->close();
?>
