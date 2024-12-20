<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to continue.";
    exit();
}

// Access the user ID from session
$user_id = $_SESSION['user_id'] ?? null;

include '../../db_connection.php';

// Fetch the user's first and last name from the client table based on the user_id
if ($user_id) {
    $stmt = $conn->prepare("SELECT First_Name, Last_Name FROM client WHERE User_ID = ?");
    $stmt->bind_param("i", $user_id);  // Bind the user_id to the query
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name);
    $stmt->fetch();
    $stmt->close();
}

// Query instructors and cars from the database
$instructors = $conn->query("SELECT Staff_ID, CONCAT(First_Name, ' ', Last_Name) AS Name FROM staff WHERE Position in ('Instructor', 'Senior Instructor')");
$cars = $conn->query("SELECT Car_ID, Registration_No FROM car");

// Handle form submission for booking a lesson
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['logout'])) {
    $instructor_id = $_POST['instructor_id'] ?? null;
    $car_id = $_POST['car_id'] ?? null;
    $date = $_POST['date'] ?? null;
    $start_time = $_POST['start_time'] ?? null;
    $end_time = $_POST['end_time'] ?? null;
    $lesson_type = $_POST['lesson_type'] ?? 'individual';  // Default to 'individual'
    $block_size = $_POST['block_size'] ?? 5;  // Default to 5 lessons for block booking
    $fee = 0;

    // Calculate fee based on lesson type
    if ($lesson_type == 'individual') {
        $fee = 50;  // Standard fee for individual lesson
    } elseif ($lesson_type == 'block') {
        $fee = $block_size * 45;  // Reduced fee for block of lessons (e.g., $45 per lesson)
    }

    // Validate the inputs
    if ($instructor_id && $car_id && $date && $start_time && $end_time && $fee > 0) {
        // Use prepared statements for secure SQL execution
        $stmt = $conn->prepare("INSERT INTO lesson (Client_ID, Instructor_ID, Car_ID, Date, Time_Start, Time_End, Fee, Lesson_Type) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiissdss", $user_id, $instructor_id, $car_id, $date, $start_time, $end_time, $fee, $lesson_type);

        if ($stmt->execute()) {
            $success_message = "Lesson booked successfully!";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error_message = "Please fill in all required fields and ensure the fee is valid.";
    }
}

// Handle logout functionality
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../../login-register-interview2/login.php");
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
        h3{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'dashboard.php'; ?>
    <br>
    <h3>Welcome, <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?>!</h3>
    <div class="container mt-4">
        <h2>Book a Driving Lesson</h2>

        <!-- Success/Error Messages -->
        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php } ?>

        <!-- Booking Form -->
        <form method="POST">
            <div class="mb-3">
                <label for="instructor_id" class="form-label">Instructor</label>
                <select name="instructor_id" id="instructor_id" class="form-select" required>
                    <option value="" hidden>Select an Instructor</option>
                    <?php while ($row = $instructors->fetch_assoc()) { ?>
                        <option value="<?= $row['Staff_ID'] ?>"><?= $row['Name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="car_id" class="form-label">Car</label>
                <select name="car_id" id="car_id" class="form-select" required>
                    <option value="" hidden>Select a Car</option>
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
                <label for="lesson_type" class="form-label">Lesson Type</label>
                <select name="lesson_type" id="lesson_type" class="form-select" required>
                    <option value="individual">Individual Lesson</option>
                    <option value="block">Block of Lessons</option>
                </select>
            </div>
            <div class="mb-3" id="block_size_container" style="display: none;">
                <label for="block_size" class="form-label">Number of Lessons in Block</label>
                <input type="number" name="block_size" id="block_size" class="form-control" min="1" max="10" value="5">
            </div>
            <div class="mb-3">
                <label for="fee" class="form-label">Fee</label>
                <input type="number" step="0.01" name="fee" id="fee" class="form-control" required readonly>
            </div>
            <button type="submit" class="btn btn-primary">Book Lesson</button>
        </form>
    </div>

    <br>
    <?php include '../../footer.php'; ?>

    <script>
      document.getElementById('lesson_type').addEventListener('change', function () {
    const blockSizeContainer = document.getElementById('block_size_container');
    const feeInput = document.getElementById('fee');
    const blockSizeInput = document.getElementById('block_size');

    if (this.value === 'block') {
        blockSizeContainer.style.display = 'block';

        blockSizeInput.addEventListener('input', function () {
            const blockSize = parseInt(blockSizeInput.value) || 0;
            feeInput.value = blockSize * 45;
        });
        
        const initialBlockSize = parseInt(blockSizeInput.value) || 0;
        feeInput.value = initialBlockSize * 45;
    } else {
        blockSizeContainer.style.display = 'none';
        feeInput.value = 50; 
    }
});
    </script>
</body>
</html>
