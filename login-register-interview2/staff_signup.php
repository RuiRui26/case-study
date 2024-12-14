<?php
include '../db_connection.php';

$sql = "SELECT Office_ID, Name from office";

$r = $conn->query($sql);
$office = $r -> fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Sign Up</title>
</head>
<body>
    <h1>Staff Sign Up</h1>
    <form action="register_user.php" method="POST">
        <input type="hidden" name="user_type" value="staff">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <label>First Name: <input type="text" name="first_name" required></label><br>
        <label>Last Name: <input type="text" name="last_name" required></label><br>
        <label>Phone Number: <input type="text" name="phone_num" required></label><br>
        <label>Age: <input type="number" name="age" required></label><br>
        <label for="gender" class="form-label">Gender: </label>
            <select class="form-select" name="gender" id="gender" required>
                <option hidden>Gender</option>
                <option value="Female">Female</option>
                <option value="Male">Male</option>
                <option value="Others">Others</option>
            </select><br>
        <label for="position" class="form-label">Position</label>
            <select class="form-select" name="position" id="position" required>
                <option hidden>Position</option>
                <option value="Senior Instructor">Senior Instructor</option>
                <option value="Instructor">Instructor</option>
                <option value="Admin">Administrative Staff</option>
            </select><br>
            <label for="Office_ID" class="form-label">Office</label>
                <select class="form-select" name="Office_ID" id="Office_ID" required>
                    <option hidden>Office</option>
                    <?php
                        while($office = $r -> fetch_assoc()){
                        ?>
                            <option value="<?php echo $office["Office_ID"];?>"><?php echo $office["Name"];?></option>
                        <?php
                        }
                    ?>
                </select>   
        <button type="submit">Register</button>
    </form>
</body>
</html>
