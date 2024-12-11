<?php
include '../../db_connection.php';

$sql = "SELECT Office_ID, Name from office";

$r = $conn->query($sql);
$office = $r -> fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname= $_POST['First_Name'];
    $lastname= $_POST['Last_Name'];
    $password = $_POST['Password'];
    $phonenum = $_POST['Phone_Num'];
    $gender= $_POST['Gender'];
    $age= $_POST['Age']; 
    $position= $_POST['Position'];
    $officeid= $_POST['Office_Name']; 

    $hash_pass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO staff(First_Name, Last_Name, Password, Phone_Num, Age, Gender, Position, Office_ID)  VALUES('$firstname', '$lastname', '$hash_pass', '$phonenum', $age, '$gender', '$position', '$officeid')";
    
    mysqli_query($conn, $sql);
    header("Location: staffRegistration.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body >

<?php include 'header_manager.php'; ?>

    <div class="container-md p-4">
        <h2>Staff Registration</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="First_Name" class="form-label">First Name</label>
                <input class="form-control" type="text" name="First_Name" id="First_Name" placeholder="First Name">
            </div>

            <div class="mb-3">
                <label for="Last_Name" class="form-label">Last Name</label>
                <input class="form-control" type="text" name="Last_Name" id="Last_Name" placeholder="Last Name">
            </div>
            
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
            </div>

            <div class="mb-3">
                <label for="Phone_Num" class="form-label">Phone Number</label>
                <input class="form-control" type="number" name="Phone_Num" id="Phone_Num" placeholder="Phone Number">
            </div>

            <div class="mb-3">
                <label for="Age" class="form-label">Age</label>
                <input class="form-control" type="number" name="Age" id="Age" placeholder="Age">
            </div>

            <div class="mb-3">
                <label for="Gender" class="form-label">Gender</label>
                <select class="form-select" name="Gender" id="Gender">
                    <option hidden>Gender</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="Gender" class="form-label">Position</label>
                <select class="form-select" name="Position" id="Position">
                    <option hidden>Position</option>
                    <option value="Senior Instructor">Senior Instructor</option>
                    <option value="Instructor">Instructor</option>
                    <option value="Admin">Administrative Staff</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="Office_Name" class="form-label">Office</label>
                <select class="form-select" name="Office_Name" id="Office_Name">
                    <option hidden>Office</option>
                    <?php
                        while($office = $r -> fetch_assoc()){
                        ?>
                            <option value="<?php echo $office["Office_ID"];?>"><?php echo $office["Name"];?></option>
                        <?php
                        }
                    ?>
                </select>
            </div>

            <div class="d-grid gap-2">
                    <button name="submit" type="submit" class="btn btn-dark btn-lg">Submit</button>
            </div>

        </form>
    </div>

    <?php include '../../footer.php'; ?>
    
</body>
</html>