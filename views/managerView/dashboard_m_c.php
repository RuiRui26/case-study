<?php
    include '../../db_connection.php';
        
    $address = $_GET['address'];

    $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'c.Client_ID';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

    $valid_columns = ['c.First_Name', 'c.Last_Name', 'c.Age', 'c.Gender', 'Total', 'Passed', 'c.Client_ID'];
    $valid_order = ['ASC', 'DESC'];

    if (!in_array($sort_column, $valid_columns)) {
        $sort_column = 'c.Client_ID';
    }
    if (!in_array($order, $valid_order)) {
        $order = 'ASC';
    }

    $client_info = "SELECT 
                    c.Client_ID AS ID, 
                    c.*,
                    o.Name AS Office,
                    s.*,
                    i.*,
                    (SELECT COUNT(*) 
                        FROM drivingtest t
                        WHERE t.client_ID = c.Client_ID AND t.is_Passed = '1') AS Passed,
                    (SELECT COUNT(*) 
                        FROM drivingtest t
                        WHERE t.client_ID = c.Client_ID) AS Total
                    FROM client c
                    JOIN office o ON c.Office_ID = o.Office_ID
                    JOIN lesson l on l.client_id = c.client_ID
                    join staff s on l.instructor_ID = s.staff_ID
                    JOIN interview i on i.client_ID = c.client_id
                    WHERE o.Address = '$address'
                    ORDER BY $sort_column $order
                    ";

    $desc = "DESC";

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

        .sort{
            display: flex;
            flex-direction: row;
            
        }

        .sort .form{
            width: 50%;
            display: flex;
            gap: 10px;
            right: 0;
        }

    </style>
</head>
<body>

    <?php  include 'header_manager.php'  ?>
    <?php  include 'dashboard.php'  ?>
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
            <div class="sort">
                <?php 
                    $total_client = "SELECT o.Name AS Office_Name, COUNT(c.Client_ID) AS Total_Client
                                    FROM office o
                                    JOIN client c ON o.Office_ID = c.Office_ID
                                    WHERE o.Address = '$address' GROUP BY o.Name";
                                    
                    $r2 = $conn->query($total_client);
                ?>
                <div class="container-fluid">
                    <?php while($t_c = $r2 -> fetch_assoc()){ ?>
                    Total number of clients: <?php echo $t_c['Total_Client'] ?>
                    <?php
                        }
                    ?>
                </div>

                <form class="form" method="GET" action="">
                    <input type="hidden" name="address" value="<?php echo $address; ?>">
                    <label for="sort">Sort By:</label>
                        <select name="sort" id="sort">
                            <option value="First_Name">First Name</option>
                            <option value="Last_Name">Last Name</option>
                            <option value="Age">Age</option>
                            <option value="Gender">Gender</option>
                            <option value="Total">Total Driving Tests</option>
                            <option value="Passed">Passed Tests</option>
                        </select>
                        <select name="order">
                            <option value="ASC">Ascending</option>
                            <option value="DESC">Descending</option>
                        </select>
                        <button type="submit">Sort</button>
                    
                    
                </form>
            </div>
            
                
            <table class="table table-hover">
            <thead>
                <tr class="table-primary">
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Times Sat Through Driving Test</th>
                <th scope="col">Passed Driving Test?</th>
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
                    <td><?php echo $client['Total']?></td>
                    <td><?php echo $client['Passed']?></td>
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