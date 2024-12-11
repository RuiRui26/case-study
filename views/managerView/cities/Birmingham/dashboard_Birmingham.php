<?php
    include '../../../../db_connection.php';
        
    $sql = "SELECT * from office
    inner join manager on office.Manager_ID = manager.Manager_ID
    where office.city = 'Birmingham' ";

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
                    <a class="link-dark link-underline link-underline-opacity-0" href="dashboard_m_<?php echo $office['office.Office_ID'] ?>.php">
                        <li class="list-group-item"><h1><?php echo $office['office.Name'] ?></h1></li>
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