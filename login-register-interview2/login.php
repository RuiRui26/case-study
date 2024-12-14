<?php
session_start();
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to fetch user data
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_type'] = $row['user_type'];
            $_SESSION['username'] = $row['username'];

            // Redirect based on user type
            switch ($row['user_type']) {
                case 'client':
                    header("Location: client_dashboard.php");
                    break;
                case 'manager':
                    header("Location: ../views/managerView/profile_manager.php");
                    break;
                case 'staff':
                    header("Location: staff_dashboard.php");
                    break;
                default:
                    echo "Invalid user type!";
                    exit();
            }
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="title">
                <p class="welcome">WELCOME TO</p>
                <h1>EASYDRIVE </h1>
                <p class="school">SCHOOL OF MOTORING</p>
                
            </div>
            
        </div>
        <div class="right">
            <div class="main">
                <div class="top">
                    <h1>LOGIN</h1>
                    <p>don't have an account yet? <a href="client_signup.php">Register</a>.</p>
                </div>
                
                <form action="" method="POST">
                    <input type="text" name="username" required><br>
                    <input type="password" name="password" required><br>
                    <button class="btn" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

