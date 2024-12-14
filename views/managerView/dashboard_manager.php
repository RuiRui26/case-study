<?php
    include '../../db_connection.php';
    include 'manager_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        a li:hover{
            background-color: #daf0ff;
            transition: 0.4s;
        }
    </style>
</head>
<body style="font-family:'Poppins';">
    <?php  include 'header_manager.php'  ?>
    <?php  include 'dashboard.php'  ?>

    <div class="main">
        <div class="sidenav">
            <nav id="nav" class="nav">
                <a id="first" class="nav-link link-dark link-underline-opacity-0" style="font-size: 2em ;font-weight: 700;">
                <svg style="padding-bottom:5px" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                    <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                </svg>
                CITIES
                </a>
                <?php
                    $sql = "SELECT City,
                    COUNT(*) as totaloffices
                    from office
                    group by City";
        
                    $r = $conn->query($sql);
                    while($office = $r -> fetch_assoc()){
                    ?>
                        <a class="nav-link link-dark link-underline-opacity-0" href="dashboard_m.php?city=<?php echo $office['City'] ?>">
                            <h4><?php echo $office['City'] ?> <span>(<?php echo $office['totaloffices'] ?>)</span></h4> 
                        </a>
                    <?php
                    }
                ?>
            </nav>
        </div>
    </div>

   

    <?php  include '../../footer.php'  ?>
    
</body>
</html> 

<!-- <ul class="list-group">
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
    </ul> -->