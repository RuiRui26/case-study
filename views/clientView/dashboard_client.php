<?php
    include '../../db_connection.php';
    
    $instructors = $conn->query("SELECT Staff_ID, CONCAT(First_Name, ' ', Last_Name) AS Name FROM staff WHERE Position = 'Instructor'");
    $cars = $conn->query("SELECT Car_ID, Registration_No FROM car");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $client_id = $_SESSION['client_id'];
        $instructor_id = $_POST['instructor_id'];
        $car_id = $_POST['car_id'];
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $fee = $_POST['fee'];

        $sql = "INSERT INTO lesson (Client_ID, Instructor_ID, Car_ID, Date, Time_Start, Time_End, Fee)
                VALUES ('$client_id', '$instructor_id', '$car_id', '$date', '$start_time', '$end_time', '$fee')";

        if ($conn->query($sql)) {
            $success_message = "Lesson booked successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }

    // Logout Logic
    if (isset($_POST['logout'])) {
        session_start();
        session_destroy();
        header("Location: ../../login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyDrive School - Client Dashboard</title>
    <style>
   a li:hover {
    background-color: #daf0ff;
    transition: 0.4s;
}

a li span {
    font-size: .7em;
}

.logout-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 20px;
    display: block;
    width: 200px;
    margin-left: auto; 
    margin-right: auto;
}

.logout-btn:hover {
    background-color: #c82333;
}

    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'dashboard.php'; ?>
    <br>

    <form method="POST">
        <button type="submit" name="logout" class="logout-btn">Logout</button>
    </form>

    <div class="container mt-4">
        <h2>Book a Driving Lesson</h2>

        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3">
                <label for="instructor_id" class="form-label">Instructor</label>
                <select name="instructor_id" id="instructor_id" class="form-select" required>
                    <option value="">Select an Instructor</option>
                    <?php while ($row = $instructors->fetch_assoc()) { ?>
                        <option value="<?= $row['Staff_ID'] ?>"><?= $row['Name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="car_id" class="form-label">Car</label>
                <select name="car_id" id="car_id" class="form-select" required>
                    <option value="">Select a Car</option>
                    <?php while ($row = $cars->fetch_assoc()) { ?>
                        <option value="<?= $row['Car_ID'] ?>"><?= $row['Registration_No'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" name="start_time" id="start_time" class="form-control" min="08:00" max="20:00" required>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" name="end_time" id="end_time" class="form-control" min="08:00" max="20:00" required>
            </div>
            <div class="mb-3">
                <label for="fee" class="form-label">Fee</label>
                <input type="number" step="0.01" name="fee" id="fee" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Book Lesson</button>
        </form>
    </div>

    <br>
    <?php include '../../footer.php'; ?>
</body>
</html>
