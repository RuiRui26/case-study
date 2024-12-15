<?php
    include '../../db_connection.php';
    include 'manager_session.php';
    
    $address = $_GET['address'];

    $sql = "SELECT city from office where address = '$address'";

    $data = $conn->query($sql);
    $city = $data -> fetch_assoc();

    $c = $city['city'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Others</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="dashboard_m.css">

    <style>
        h3{
            margin: 0;
            padding: 10px 0;
        }
        .title{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0 0 0px;
        }

        table{
            margin-bottom: 30px;
        }

        .details{
            margin: 10px 20px;
        }

        .details h4{
            font-size: 1em;
        }

        .details h4 .normal{
            font-weight: normal;
        }

        .top{
            
        }

        button{
            padding: 10px 20px;
            height: 70%;
        }
    </style>
</head>
<body style="font-family:'Poppins'; max-height: 100vh;">
    <?php  include 'header_manager.php'  ?>
    <?php  include 'dashboard.php'  ?>
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
            <h1><?php echo $address ?> Office</h1>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard_m_s.php?address=<?php echo $address ?>">Staff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard_m_c.php?address=<?php echo $address ?>">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">Others</a>
                    </li>
                </ul>
                <br>
                <ul class="list-group">
                    <div class="title">
                        <h3>Current Manager/s:</h3>
                        <a href="../../login-register-interview2/manager_signup.php"><button class="btn btn-dark">Add Manager?</button></a>
                    </div>
                    
                    <?php
                        $manager_info = "SELECT
                                        m.*,
                                        o.Name AS Office
                                        FROM manager m
                                        JOIN office o ON m.manager_id = o.office_id
                                        WHERE o.Address = '$address'
                                        ";

                        $r = $conn->query($manager_info);

                        while($manager = $r -> fetch_assoc()){
                        ?>
                            <li class="list-group-item">
                                <h2 style="border-bottom: 1px solid black; padding: 10px;"><?php echo $manager['First_Name'] . " " . $manager['Last_Name'] ?></h2>
                                <div class="details">
                                    <h4>Telephone: <span class="normal"><?php echo $manager['Telephone'] ?></span></h4>
                                    <h4>Gender: <span class="normal"><?php echo $manager['Gender'] ?></span></h4>
                                    <h4>Age: <span class="normal"><?php echo $manager['Age'] ?></span></h4>
                                </div>
                                
                            </li>
                        <?php
                        }
                    ?>

                    <br><h2 class="title">Vehicle Management</h2>
                    <?php
                        $car_info = "SELECT
                                        c.*,
                                        o.Name AS Office,
                                        i.*
                                        FROM car c
                                        join staff i on i.staff_id = c.instructor_id
                                        JOIN office o ON i.office_id = o.office_id
                                        WHERE o.Address = '$address'
                                        ";

                        $r = $conn->query($car_info);
                        ?>
                        
                        <table class="table table-hover">
                        <thead>
                            <tr class="table-dark">
                            <th scope="col">ID</th>
                            <th scope="col">Car Registration Number</th>
                            <th scope="col">Allocated to</th>
                            <th scope="col">Faults</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($car = $r -> fetch_assoc()){
                            ?>
                                <tr>   
                                <th scope="row"><?php echo $car['Car_ID']?></th>
                                <td><?php echo $car['Registration_No']?></td>
                                <td><?php echo $car['First_Name'] . " " . $car['Last_Name'] ?></td>
                                <td><?php echo $car['wFaults'] > 0 ? 'There are Faults' : 'No Faults'; ?></td>
                                </tr>
                            <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </ul>
            </div>
        </div>
    </div>
    <?php include '../../footer.php' ?>
</body>
</html>