<?php
    include '../db_connection.php';

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    if(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['password'])){

        $first_name = validate($_POST['first_name']);
        $last_name = validate($_POST['last_name']);
        $pass = validate($_POST['password']);

        if (empty($first_name) || empty($last_name) || empty($pass)){
            header('location: loginPage.php?error=fill in necessary fields.');
            exit();
        }else{
            $sql = "SELECT * from client where First_Name = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $first_name);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                if(password_verify($pass, $row['Password'])){
                    session_start();
                    $_SESSION['Client_ID']=$row['Client_ID'];
                    header('location: ../views/clientView/clientView.php');
                    exit();
                }else{
                    header('location: case-study/login/loginPage.php?error=Incorrect password!');
                    exit();
                }
            }else{
                header('location: case-study/login/loginPage.php?error=User not found.');
                exit();
            }
        }
    }else{
        header('location: case-study/login/loginPage.php');
    }
?>