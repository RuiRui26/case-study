<?php
    include '../../db_connection.php';
    include 'manager_session.php';

    $user = $_SESSION['user_id'];
    $usertype = $_SESSION['user_type'];

    $profile = "SELECT
                *,
                m.*
                from user u
                join manager m on m.user_id = u.user_id
                where u.user_id = $user";

    $r = $conn->query($profile);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profile_manager.css">
</head>
<body>
    <?php  include 'header_manager.php'  ?>

    <?php while($manager = $r -> fetch_assoc()){ ?>
    <div class="profile">
        <h1>Welcome, <?php echo $manager['First_Name'] . " " . $manager['Last_Name']; ?></h1>
        <div class="personalinfo">
            <p>Personal Information</p>
            <div class="infos">
                <div>
                    <h3 class="title">Username</h3>
                    <p class="data"><?php echo $manager['username'] ?></p>
                </div>
                <div>
                    <h3 class="title">Gender</h3>
                    <p class="data"><?php echo $manager['Gender'] ?></p>
                </div>
                <div>
                    <h3 class="title">Age</h3>
                    <p class="data"><?php echo $manager['Age'] ?></p>
                </div>
                <div>
                    <h3 class="title">Telephone</h3>
                    <p class="data"><?php echo $manager['Telephone'] ?></p>
                </div>
                
                
            </div>
        </div>
    </div>
    

    <?php } ?>
    <?php  include '../../footer.php'  ?>
</body>
</html>