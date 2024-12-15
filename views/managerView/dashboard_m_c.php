<?php
    include '../../db_connection.php';
    include 'manager_session.php';
        
    $address = $_GET['address'];

    $sql = "SELECT city from office where address = '$address'";

    $data = $conn->query($sql);
    $city = $data -> fetch_assoc();

    $c = $city['city'];




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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client View</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="dashboard_m.css">

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
            margin: 0 0 20px 0;
        }

        .sort .form{
            width: 70%;
            display: flex;
            gap: 10px;
            right: 0;
            justify-content: space-evenly;
            align-items: center;
        }

    </style>
</head>
<body style="font-family:'Poppins'; min-height: 100vh;">

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
                    <a class="nav-link active" aria-current="page" href="">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_m_o.php?address=<?php echo $address ?>">Others</a>
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
                    <?php while($tc = $r2 -> fetch_assoc()){ ?>
                    Total number of clients: <?php echo $tc['Total_Client'] ?>
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
                        <button class="btn btn-dark" type="submit">Sort</button>
                    
                    
                </form>
            </div>
            
                
            <table class="table table-hover">
                <thead>
                    <tr class="table-dark">
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
                    while($client = $r -> fetch_assoc()){
                    ?>
                        <tr>   
                        <th scope="row"><?php echo $client['ID']?></th>
                        <td><?php echo $client['First_Name']?></td>
                        <td><?php echo $client['Last_Name']?></td>
                        <td><?php echo $client['Age']?></td>
                        <td><?php echo $client['Gender']?></td>
                        <td><?php echo $client['Total']?></td>
                        <td><?php echo $client['Passed'] > 0 ? 'Passed' : 'Not Passed Yet'; ?></td>
                        </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>
            </ul>
            
            <br>
        </div>
        
    </div>
    <?php include '../../footer.php' ?>
</body>
</html>