<?php
include 'header.php';
include 'db_connection.php';

// Fetch Clients, Instructors, and Cars
$clients = $conn->query("SELECT Client_ID, CONCAT(First_Name, ' ', Last_Name) AS Name FROM client");
$instructors = $conn->query("SELECT Staff_ID, CONCAT(First_Name, ' ', Last_Name) AS Name FROM staff WHERE Position = 'Instructor'");
$cars = $conn->query("SELECT Car_ID, Registration_No FROM car");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $instructor_id = $_POST['instructor_id'];
    $car_id = $_POST['car_id'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $mileage = $_POST['mileage'];
    $fee = $_POST['fee'];

    $sql = "INSERT INTO lesson (Client_ID, Instructor_ID, Car_ID, Date, Time_Start, Time_End, Mileage_Used, Fee)
            VALUES ('$client_id', '$instructor_id', '$car_id', '$date', '$start_time', '$end_time', '$mileage', '$fee')";

    if ($conn->query($sql)) {
        echo "<div class='alert alert-success'>Lesson booked successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<div class="container mt-4">
    <h2>Book a Lesson</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" id="client_id" class="form-select" required>
                <option value="">Select a Client</option>
                <?php while ($row = $clients->fetch_assoc()) { ?>
                    <option value="<?= $row['Client_ID'] ?>"><?= $row['Name'] ?></option>
                <?php } ?>
            </select>
        </div>
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
            <label for="mileage" class="form-label">Mileage Used</label>
            <input type="number" name="mileage" id="mileage" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fee" class="form-label">Fee</label>
            <input type="number" step="0.01" name="fee" id="fee" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Lesson</button>
    </form>
</div>

<?php include 'footer.php'; ?>
