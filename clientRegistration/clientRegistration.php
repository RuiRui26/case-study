<?php
    include '../db_connection.php';
    $error="";

    $sql="SELECT Office_ID, Name from office";
    
    $r = $conn->query($sql);
    $office = $r -> fetch_assoc();

    if(isset($_POST['submit'])) {
        $firstname= $_POST['First_Name'];
        $lastname= $_POST['Last_Name'];
        $password = $_POST['Password'];
        $gender= $_POST['Gender'];
        $birthday= $_POST['Birthday'];
        $age= $_POST['Age'];    
        $officeid= $_POST['Office_Name'];  

        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO client(First_Name, Last_Name, Password, Gender, Birthday, Age, Office_ID) VALUES('$firstname', '$lastname', '$hash_pass', '$gender', '$birthday', '$age', '$officeid')";

        mysqli_query($conn, $sql);
        header("Location: clientRegistration.php"); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-md p-5">
        <form action="" method="post">
            <h1 class="text-center p-3">Client Registration</h1>
            <div class="mb-3">
                <label for="First_Name" class="form-label">First Name</label>
                <input class="form-control form-control-lg" type="text" name="First_Name" id="First_Name" placeholder="First Name">
            </div>

            <div class="mb-3">
                <label for="Last_Name" class="form-label">Last Name</label>
                <input class="form-control form-control-lg" type="text" name="Last_Name" id="Last_Name" placeholder="Last Name">
            </div>

            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input class="form-control form-control-lg" type="password" name="Password" id="Password" placeholder="Password">
            </div>

            <div class="mb-3">
                <label for="Gender" class="form-label">Gender</label>
                <select class="form-select form-select-lg" name="Gender" id="Gender">
                    <option hidden>Gender</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="Birthday" class="form-label">Birthday</label>
                <input class="form-control form-control-lg" type="text" name="Birthday" id="Birthday" placeholder="Birthday" onfocus="(this.type='date')" onblur="(this.type='text')">
            </div>

            <div class="mb-3">
                <label for="Birthday" class="form-label">Birthday</label>
                <input class="form-control form-control-lg" type="number" name="Age" id="Age" placeholder="Age">
            </div>

            <div class="mb-3">
                <label for="Office_Name" class="form-label">Select office you are registering in:</label>
                <select class="form-select form-select-lg" name="Office_Name" id="Office_Name">
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
    
</body>
</html>