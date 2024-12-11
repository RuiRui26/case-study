<?php
    include '../../db_connection.php';

    $city = $_GET['city'];
        
    $sql = "SELECT * from office as O
            inner join manager  as M
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
</head>
<body>

    <?php  include 'header_manager.php'  ?>
    <?php  include '../../dashboard.php'  ?>
    <br>

    <div class="center">
        <div class="dashboard">
            <h3>please pick an office:</h3><br>
            <ul class="list-group">
            <?php
                while($office = $r -> fetch_assoc()){
                ?>
                    <a class="link-dark link-underline link-underline-opacity-0" href="dashboard_m_s.php?address=<?php echo $office['Address']?>">
                        <li class="list-group-item"><h2><?php echo $office['Name'] ?></h2> <p>managed by <?php echo $office['First_Name'] ?></p></li>
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