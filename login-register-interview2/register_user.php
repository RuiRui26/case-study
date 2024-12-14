<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert into 'user' table
    $sql_user = "INSERT INTO user (user_type, username, password) 
                 VALUES ('$user_type', '$username', '$hashed_password')";

    if ($conn->query($sql_user) === TRUE) {
        $user_id = $conn->insert_id;

        if ($user_type == 'client') {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $Office_ID = $_POST['Office_ID'];

            $sql_client = "INSERT INTO client (First_Name, Last_Name, Gender, Age, Office_ID, User_ID) 
                           VALUES ('$first_name', '$last_name', '$gender', $age, $Office_ID, $user_id)";
            $conn->query($sql_client);

        } elseif ($user_type == 'manager') {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $telephone = $_POST['telephone'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];

            $sql_manager = "INSERT INTO manager (First_Name, Last_Name, Telephone, Age, Gender, User_ID) 
                            VALUES ('$first_name', '$last_name', '$telephone', $age, '$gender', $user_id)";
            $conn->query($sql_manager);

        } elseif ($user_type == 'staff') {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone_num = $_POST['phone_num'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $position = $_POST['position'];
            $Office_ID = $_POST['Office_ID'];

            $sql_staff = "INSERT INTO staff (First_Name, Last_Name, Phone_Num, Age, Gender, Position, Office_ID, User_ID)
                          VALUES ('$first_name', '$last_name', '$phone_num', $age, '$gender', '$position', $Office_ID, $user_id)";
            $conn->query($sql_staff);
        }

        echo "Registration successful!";
        // header("Refresh: 2; url=login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

