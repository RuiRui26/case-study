<?php
    include '../../db_connection.php';
        
    $address = $_GET['address'];
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

        li:hover{
        background-color: #daf0ff;
        transition: 0.4s;
        }

        a button{
            margin-bottom: 30px;
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
                    <a class="nav-link active" aria-current="page" href="#">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_m_c.php?address=<?php echo $address ?>">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_m_o.php?address=<?php echo $address ?>">Others</a>
                </li>
            </ul>
            <br>
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
            
            <ul class="list-group">
                <?php
                    $staff_info = "SELECT 
                                    s.Staff_ID AS ID, 
                                    s.First_Name, 
                                    s.Last_Name, 
                                    s.Age,
                                    s.Gender,
                                    'Staff' AS Role, 
                                    s.Position, 
                                    o.Name AS Office
                                    FROM staff s
                                    JOIN office o ON s.Office_ID = o.Office_ID WHERE o.Address = '$address'
                                    ";

                    $r = $conn->query($staff_info);

                    while($staff = $r -> fetch_assoc()){
                    ?>
                        <a class="link-dark link-underline link-underline-opacity-0" href="dashboard_m_s.php?staffif=<?php echo $staff['ID'] ?>">
                            <li class="list-group-item"><h2><?php echo $staff['First_Name'] . " " . $staff['Last_Name'] ?></h2>
                            <p><?php echo $staff['Position'] ?></p></li>
                        </a>
                    <?php
                    }
                ?>
            </ul>
            <br>
        </div>
    <a href="staff_form.php"><button type="button" class="btn btn-primary">Add New Staff</button></a>    
    </div>
    <?php include '../../footer.php' ?>
</body>
</html>