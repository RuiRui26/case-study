<?php
    include '../db_connection.php';
    $error="";

    if(isset($_POST['Submit'])) {
        $firstname= $_POST['firstname'];
        $lastname= $_POST['lastname'];
        
        $sql = "INSERT INTO client(First_Name, Last_Name, Gender, Birthday, Age, Office_ID) VALUES('$title', '$content')";

        mysqli_query($connect, $sql);
        echo "<script> alert('Entry posted!'); </script>";
        
        
        header("Location: clientRegistration.php"); 
}
?>