<?php
    include '../../db_connection.php';
    include 'manager_session.php';

    $c = $_GET['city'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offices</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="dashboard_m.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <style>
        .list-group span{
            font-size: 0.6em;
            font-weight: normal;
        }

        .fulladdress{
            font-size: 1.2em;

        }

        .list-group-item:hover{
            background-color: #cbd9e3;
            transition: 0.4s;
        }
    </style>
</head>
<body style="font-family:'Poppins';">

    <?php  include 'header_manager.php'  ?>
    <?php  include 'dashboard.php'  ?>
        <div>
            <div class="main">
                <div class="sidenav">
                <nav id="nav" class="nav">
                    <div>
                        <a id="first" class="nav-link link-dark link-underline-opacity-0" style="font-size: 2em ;font-weight: 700;">
                            <svg style="padding-bottom:5px" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                                <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                            </svg>
                            CITIES
                        </a>
                        <?php
                            $cities = "SELECT City,
                            COUNT(*) as totaloffices
                            from office
                            group by City";
                
                            $r = $conn->query($cities);
                            while($city = $r -> fetch_assoc()){
                            ?>
                                <a class="nav-link link-dark link-underline-opacity-0" href="dashboard_m.php?city=<?php echo $city['City'] ?>">
                                    <?php if($city['City'] === $c): ?>
                                        <h4 style="font-weight: 700;"><?php echo $city['City'] ?> <span>(<?php echo $city['totaloffices'] ?>)</span></h4> 
                                    <?php else: ?>
                                        <h4><?php echo $city['City'] ?> <span>(<?php echo $city['totaloffices'] ?>)</span></h4>
                                    <?php endif ?>
                                </a>
                            <?php
                            }
                        ?>
                    </div>
                </nav>
                    <div class="dashboard">
                        <ul class="list-group">
                        <?php
                            $offices = "SELECT * from office as O
                            join manager as M
                            on O.Manager_ID = M.Manager_ID
                            where O.city = '$c';";

                            $r2 = $conn->query($offices);
                            while($office = $r2 -> fetch_assoc()){
                            ?>
                                <a class="link-dark link-underline link-underline-opacity-0" href="dashboard_m_s.php?address=<?php echo $office['Address']?>&c=<?php echo $office['City']?>">
                                    <li class="list-group-item"><h2><?php echo $office['Name'] ?> <span>managed by <?php echo $office['First_Name'] . " " . $office['Last_Name'] ?></span></h2>
                                    <p class="fulladdress"><span style="font-weight: 700; font-size: 1em;">Address:</span> <?php echo $c . ", " . $office['Address'] ?></p></li>
                                </a>
                                
                            <?php
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    
    <?php  include '../../footer.php'  ?>
    
</body>
</html>