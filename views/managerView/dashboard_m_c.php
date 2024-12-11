<?php
    include '../../db_connection.php';
        
    $address = $_GET['address'];
    $client_info = "SELECT 
                    c.Client_ID AS ID, 
                    c.First_Name, 
                    c.Last_Name, 
                    c.Age, 
                    c.Gender,
                    o.Name AS Office
                    FROM client c
                    LEFT JOIN office o ON c.Office_ID = o.Office_ID WHERE o.Address = '$address'
                    ";

    $r = $conn->query($client_info);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birmingham</title>

    <style>
        footer{
                width: 100%;
                height: fit-content;
                position: absolute;
                bottom: 0;
                left: 0;
            }
    </style>
</head>
<body>

    <?php  include 'header_manager.php'  ?>
    <?php  include '../../dashboard.php'  ?>
    <br>

    <div class="center">
        <div class="dashboard">
            <h1><?php echo $address ?> Office</h1><br>
            <ul class="nav nav-tabs">
                
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_m_s.php?address=<?php echo $address ?>">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Others</a>
                </li>
            </ul>
            <br>
                <?php 
                $total_client = "SELECT o.Name AS Office_Name, COUNT(c.Client_ID) AS Total_Client
                                FROM office o
                                LEFT JOIN client c ON o.Office_ID = c.Office_ID
                                WHERE o.Address = '$address' GROUP BY o.Name";
                                
                $r2 = $conn->query($total_client);
                ?>
                <div class="container-fluid">
                <?php while($t_c = $r2 -> fetch_assoc()){ ?>
                Total number of clients: <?php echo $t_c['Total_Client'] ?>
                <?php
                    }
                ?>
                <a href="client_form.php">
                    <button class="btn btn-primary offset-md-9" type="submit">Add New Client</button>
                </a>
                
                </div>
            <table class="table table-hover">
            <thead>
                <tr class="table-info">
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($client = $r -> fetch_assoc()){
                ?>
                    <tr>   
                    <th scope="row"><?php echo $client['ID']?></th>
                    <td><?php echo $client['First_Name']?></td>
                    <td><?php echo $client['Last_Name']?></td>
                    <td><?php echo $client['Age']?></td>
                    <td><?php echo $client['Gender']?></td>
                    </tr>
                <?php
                }
            ?>
            </ul>
            <br>
        </div>
        
    </div>
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3">
            &copy; 2024 EasyDrive School of Motoring
        </div>
    </footer>
</body>
</html>