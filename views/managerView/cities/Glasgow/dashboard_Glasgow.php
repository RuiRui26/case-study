<?php
    include '../../../../db_connection.php';
        
    $sql = "SELECT * from office as O inner join manager  as M on O.Manager_ID = M.Manager_ID where O.city = 'Glasgow';";

    $r = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birmingham</title>
</head>
<body>

    <?php  include '../../header_manager.php'  ?>
    <?php  include '../../../../dashboard.php'  ?>
    <br>

    <div class="center">
        <div class="dashboard">
            <h3>please pick a city:</h3><br>
            <ul class="list-group">
            <?php
                while($office = $r -> fetch_assoc()){
                ?>
                    <a class="link-dark link-underline link-underline-opacity-0" href="dashboard_m_<?php echo $office['Office_ID'] ?>.php">
                        <li class="list-group-item"><h1><?php echo $office['Name'] ?></h1> <p>managed by <?php echo $office['First_Name'] ?></p></li>
                    </a>
                    <br>
                <?php
                }
            ?>
            </ul>
        </div>
    </div>
    <?php  include '../../../../footer.php'  ?>
    
</body>
</html>