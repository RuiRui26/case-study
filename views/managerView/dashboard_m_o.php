<?php
    include '../../db_connection.php';
    
    $address = $_GET['address'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .title{
            margin: 10px 0 30px 20px;
        }

        table{
            margin-bottom: 30px;
        }

        .details{
            margin: 10px 20px;
        }

        .details h4 .normal{
            font-weight: normal;
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
                    <a class="nav-link" href="dashboard_m_c.php?address=<?php echo $address ?>">Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="">Others</a>
                </li>
            </ul>
            <br>
            <ul class="list-group">
                <h2 class="title">Current Manager/s:</h2>
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
                        <tr class="table-primary">
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
    <?php include '../../footer.php' ?>
</body>
</html>