<?php
    include '../../db_connection.php';
    include 'manager_session.php';

    $user = $_SESSION['user_id'];
    $usertype = $_SESSION['user_type'];

    
    
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

    <?php 
    $profile = "SELECT
                *,
                m.*
                from user u
                join manager m on m.user_id = u.user_id
                where u.user_id = $user";

    $r = $conn->query($profile);
    while($man = $r -> fetch_assoc()){ ?>
    
        

    <div class="profile">
        <div class="top">
            <div class="profile-picture"></div>
            <div class="text">
                <h1>Welcome,</h1>
                <p><?php echo $man['First_Name'] . " " . $man['Last_Name']; ?>!</p>
            </div>
        </div>
        <div class="info">
            <div class="personalinfo">
                <p>Personal Information</p>
                <div class="infos">
                    <div>
                        <h3 class="title">Username</h3>
                        <p class="data"><?php echo $man['username'] ?></p>
                    </div>
                    <div>
                        <h3 class="title">Age</h3>
                        <p class="data"><?php echo $man['Age'] ?></p>
                    </div>
                    <div>
                        <h3 class="title">Gender</h3>
                        <p class="data"><?php echo $man['Gender'] ?></p>
                    </div>
                    
                    <div>
                        <h3 class="title">Telephone</h3>
                        <p class="data"><?php echo $man['Telephone'] ?></p>
                    </div>
                    
                </div>
            </div>
            <?php } ?>
            <div class="additionalinfo">
                <h2>Other Manager Info</h2>
                <?php 
                        $managers = "SELECT * from manager m join user u on m.user_id = u.user_id where m.user_id != $user";
                        $r2 = $conn->query($managers);
                        while ($manager = $r2 -> fetch_assoc()){
                    ?>
                <div class="manager">
                    
                    <h4><span><?php echo $manager['Telephone'] ?></span> <?php echo $manager['First_Name'] . " " . $manager['Last_Name'] ?></h4>
                    
                </div>
                <?php }?>
            </div>
            
            
        </div>
        

    </div>
    

    
    <?php  include '../../footer.php'  ?>
</body>
</html>