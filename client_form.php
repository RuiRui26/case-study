<?php
include 'header.php';
include 'db_connection.php';

$offices = $conn->query("SELECT Office_ID, Name FROM office");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $office_id = $_POST['office_id'];

    $sql = "INSERT INTO client (First_Name, Last_Name, Gender, Office_ID) 
            VALUES ('$first_name', '$last_name', '$gender', '$office_id')";

    if ($conn->query($sql)) {
        echo "<div class='alert alert-success'>Client added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<div class="container mt-4">
    <h2>Add New Client</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-select" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="office_id" class="form-label">Office</label>
            <select name="office_id" id="office_id" class="form-select" required>
                <option value="">Select Office</option>
                <?php while ($row = $offices->fetch_assoc()) { ?>
                    <option value="<?= $row['Office_ID'] ?>"><?= $row['Name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Client</button>
    </form>
</div>

<?php
include 'footer.php';
?>
