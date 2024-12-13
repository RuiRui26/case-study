<?php
    include '../../db_connection.php';

    $city = $_GET['city'];
        
    $sql = "SELECT * from office as O
            join manager as M
            on O.Manager_ID = M.Manager_ID
            where O.city = '$city';";

    $r = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glasgow</title>

    <style>
        span{
            font-size: 0.6em;
            font-weight: normal;
        }

        .fulladdress{
            font-size: 1.2em;

        }

        li:hover{
            background-color: #daf0ff;
            transition: 0.4s;
        }
    </style>
</head>
<body>

    <?php  include 'header_manager.php'  ?>
    <?php  include 'dashboard.php'  ?>
    <br>

    <div class="center">
        <div class="dashboard">
            <ul class="list-group">
            <li class="list-group-item" style="background-color: #003d80; color: white;"><h1>Offices</h1></li>
            <?php
                while($office = $r -> fetch_assoc()){
                ?>
                    <a class="link-dark link-underline link-underline-opacity-0" href="dashboard_m_s.php?address=<?php echo $office['Address']?>">
                        <li class="list-group-item"><h2><?php echo $office['Name'] ?> <span>managed by <?php echo $office['First_Name'] . " " . $office['Last_Name'] ?></span></h2>
                        <p class="fulladdress"><?php echo $city . ", " . $office['Address'] ?></p></li>
                    </a>
                    
                <?php
                }
            ?>
            </ul>
            <br>
        </div>
    </div>
    <?php  include '../../footer.php'  ?>
    
</body>
</html>