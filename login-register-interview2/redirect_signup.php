<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_type = $_POST['user_type'];

    switch ($user_type) {
        case 'client':
            header("Location: client_signup.php");
            break;
        case 'manager':
            header("Location: manager_signup.php");
            break;
        case 'staff':
            header("Location: staff_signup.php");
            break;
        default:
            echo "Invalid user type.";
            exit();
    }
    exit();
}
?>
