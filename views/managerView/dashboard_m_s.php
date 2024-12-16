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
    <title>Staff View</title>
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

        .list-group-item:hover{
        background-color: #cbd9e3;
        transition: 0.4s;
        }

        a button{
            margin-bottom: 30px;
        }

        .dashboard{
            padding: 15px 30px;
        }

        .dashboard .title{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .add{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            padding: 10px 5px 0 5px;
        }

        .addsort{
            display: flex;
            flex-direction: row;
            align-items: center;
            margin: 10px 0;
            gap: 20px;
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
                    <div class="title">
                        <h1><?php echo $address ?> Office</h1>
                        
                    </div>
                    
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Staff</a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard_m_c.php?address=<?php echo $address ?>">Clients</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard_m_o.php?address=<?php echo $address ?>">Others</a>
                            </li>
                        </ul>
                        <div class="add">
                            <?php 
                                $total_staff = "SELECT o.Name AS Office_Name, COUNT(s.Staff_ID) AS Total_Staff
                                                FROM office o
                                                LEFT JOIN staff s ON o.Office_ID = s.Office_ID
                                                WHERE o.Address = '$address' GROUP BY o.Name";
                                                
                                $r2 = $conn->query($total_staff);
                            ?>
                            <?php while($t_s = $r2 -> fetch_assoc()){ ?>
                                <p>Total number of staff: <?php echo $t_s['Total_Staff'] ?></p> 
                                <?php
                                }
                            ?>

                            <div class="addsort">
                                <form method="GET" action="">
                                    <input type="hidden" name="address" value="<?php echo $address?>">
                                    <select id="filter" name="filter">
                                        <option hidden>Filter...</option>
                                        <option value="All">All</option>
                                        <option disabled>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option disabled>Position</option>
                                        <option value="Administrative Staff">Administrative Staff</option>
                                        <option value="Instructor">Instructor</option>
                                        <option value="Senior Instructor">Senior Instructor</option>
                                    </select>
                                    <button type="submit" style="border-radius: 5px; border:none; padding: 2px 10px;">Filter</button>
                                </form>
                                <a href="../../login-register-interview2/staff_signup.php"><button type="button" class="btn btn-dark" style="margin: 0;">Add New Staff</button></a>
                            </div>
                        </div>

                        <?php
                        if (isset($_GET['filter'])) {
                            $filter = $_GET['filter'];  
                        }
                    
                        $staff_info = "SELECT 
                        s.Staff_ID AS ID, 
                        s.First_Name, 
                        s.Last_Name, 
                        s.Age,
                        s.Gender,
                        s.Phone_Num,
                        s.Position
                        FROM staff s
                        JOIN office o ON s.Office_ID = o.Office_ID
                        WHERE o.Address = ?";
                    
                    if (isset($filter) && $filter !== "All" && $filter !== "Male" && $filter !== "Female") {
                        $staff_info .= " AND s.Position = ?";
                    } else if (isset($filter) && $filter !== "All" && $filter !== "Administrative Staff" && $filter !== "Instructor" && $filter !== "Senior Instructor"){
                        $staff_info .= " AND s.Gender = ?";
                    } else

                    if (isset($filter) && $filter !== "All" && $filter !== "Male" && $filter !== "Female") {
                        $staff_info .= " AND s.Position = ?";
                    }
                    
                    $stmt = $conn->prepare($staff_info);
                    
                    if (isset($filter) && $filter !== "All") {
                        $stmt->bind_param("ss", $address, $filter);
                    } else {
                        $stmt->bind_param("s", $address);
                    }
                    
                    $stmt->execute();
                    $result = $stmt->get_result();
                    ?>
                    
                        <?php if ($result->num_rows > 0) { ?>
                        <table class="table table-hover">
                            <thead>
                                <tr class="table-dark">
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Position</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                    while($staff = $result -> fetch_assoc()){
                                    ?>
                                        <tr>   
                                            <th scope="row"><a href="dashboard_m_s_interviews.php?staffid=<?php echo $staff['ID']?>"><?php echo $staff['ID']?></a></th>
                                            <td><?php echo $staff['First_Name']?></td>
                                            <td><?php echo $staff['Last_Name']?></td>
                                            <td><?php echo $staff['Age']?></td>
                                            <td><?php echo $staff['Gender']?></td>
                                            <td><?php echo $staff['Phone_Num']?></td>
                                            <td><?php echo $staff['Position']?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    echo "<tr><p>There are no staff under this position.</p></tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                        
                        <br>
                    
                </div>
            </div>
            
        </div>
    </div>
    <?php $stmt->close(); ?>
    <?php include '../../footer.php' ?>
</body>
</html>