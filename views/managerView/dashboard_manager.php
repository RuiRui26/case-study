<?php
    include '../../db_connection.php';
    
    $sql = "SELECT City,
            COUNT(*) as totaloffices
            from office
            group by City";

    $r = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        a li:hover{
            background-color: #daf0ff;
            transition: 0.4s;
        }

        a li span{
            font-size: .7em;
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
            <li class="list-group-item" style="background-color: #003d80; color: white;"><h1>Cities</h1></li>
            <?php
                while($office = $r -> fetch_assoc()){
                ?>
                    <a class="link-dark link-underline link-underline-opacity-0 " href="dashboard_m.php?city=<?php echo $office['City'] ?>">
                        <li class="list-group-item"><h2><?php echo $office['City'] ?> <span>(<?php echo $office['totaloffices'] ?>)</span></h2></li>
                    </a>
                    
                <?php
                }
                 ?>
            </ul>
            <br>
        </div>
    </div>
    
    <br>
    <?php  include '../../footer.php'  ?>
    
</body>
</html>