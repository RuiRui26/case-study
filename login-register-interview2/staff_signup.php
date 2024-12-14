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
    <link rel="stylesheet" href="register.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="left">
        <h1>Staff Sign Up</h1>
        <form action="register_user.php" method="POST">
            <input type="hidden" name="user_type" value="staff">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="text" name="first_name" placeholder="First Name" required><br>
            <input type="text" name="last_name" placeholder="Last Name" required><br>
            <input type="text" name="phone_num" placeholder="Phone Number" required><br>
            <input type="number" name="age" placeholder="Age" required><br>
            <select class="form-select" name="gender" id="gender" required>
                <option hidden>Gender</option>
                <option value="Female">Female</option>
                <option value="Male">Male</option>
                <option value="Others">Others</option>
            </select><br>
            <select class="form-select" name="position" id="position" required>
                <option hidden>Position</option>
                <option value="Senior Instructor">Senior Instructor</option>
                <option value="Instructor">Instructor</option>
                <option value="Admin">Administrative Staff</option>
            </select><br>
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
    </div>
    
</body>
</html>
