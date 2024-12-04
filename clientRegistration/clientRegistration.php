<?php
    include '../db_connection.php';
    $error="";

    $sql="SELECT Office_ID, Name from office";
    
    $r = $conn->query($sql);
    $office = $r -> fetch_assoc();

    if(isset($_POST['Submit'])) {
        $firstname= $_POST['First_Name'];
        $lastname= $_POST['Last_Name'];
        $gender= $_POST['Gender'];
        $birthday= $_POST['Birthday'];
        $age= $_POST['Age'];
        $officeid= $_POST['Office_Name'];
        
        echo "console.log($officeid)";
        
        $sql = "INSERT INTO client(First_Name, Last_Name, Gender, Birthday, Age, Office_ID) VALUES('$firstname', '$lastname', '$gender', '$birthday', '$age', '$officeid')";

        mysqli_query($conn, $sql);
        echo "<script> alert('Entry posted!'); </script>";
        
        
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
    <h1>Client Registration</h1><br>
    <form method="post">
        <input type="text" name="First_Name" id="First_Name" placeholder="First Name"><br>
        <input type="text" name="Last_Name" id="Last_Name" placeholder="Last Name"><br>
        <input type="text" name="Gender" id="Gender" placeholder="Gender"><br>
        <input type="text" name="Birthday" id="Birthday" placeholder="Birthday" onfocus="(this.type='date')" onblur="(this.type='text')"><br>
        <input type="number" name="Age" id="Age" placeholder="Age"><br>

        <select name="Office_Name" id="Office_Name">
            <option hidden>Select office you are registering in:</option>
            <?php
                while($office = $r -> fetch_assoc()){
                ?>
                    <option value="<?php echo $office["Office_ID"];?>"><?php echo $office["Name"];?></option>
                <?php
                }
            ?>
        </select>

        <button type="submit" name="Submit">Submit</button>
    </form>
    
</body>
</html>