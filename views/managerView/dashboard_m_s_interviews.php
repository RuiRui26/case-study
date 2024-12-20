<?php
    include '../../db_connection.php';

    $staffid = $_GET['staffid'];

    $sql = "SELECT it.*, 
            CONCAT(ins.First_Name, ' ', ins.Last_Name) as Ins_Fullname,
            ins.Position,
            CONCAT(cl.First_Name, ' ', cl.Last_Name) as Ct_Fullname
            FROM interview it
            join client cl on it.client_id = cl.client_id
            join staff ins on it.instructor_id = ins.staff_id
            where ins.staff_id = $staffid";

    $data = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Interview Log</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        .maincontainer{
            border-top: 2px solid black;
            padding: 20px 30px;
            
        }

        .maincontainer h3 span{
            font-size: .8em;
        }

        .maincontainer .interview{
            background-color: #8cadbb31;
            padding: 20px 30px;
            border-radius:10px;

            display: flex;
            flex-direction: row;
            gap: 10px;
        }

        .maincontainer .interview .one{
            width: 20%;
            border-right: 2px solid black;
        }

        .maincontainer .interview .two{
            max-width: 75%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .maincontainer .interview .two .two-one{
            display: flex;
            flex-direction: row;
            gap: 15px;
        }
    </style>
</head>
<body style="font-family: 'Poppins';">
    <?php 
        include 'header_manager.php' ;
        include 'dashboard.php';
    ?>
    
    

    
    
    <div class="maincontainer">
        <h1>INTERVIEWS</h1>
        <?php  while($interview = $data -> fetch_assoc()){ ?>
        <div class="interview">
            <div class="one">
                <h3><?php echo $interview['Ct_Fullname'] ?></h3>
                interviewed by <strong><?php echo $interview['Ins_Fullname'] ?></strong>
            </div>
            <div class="two">
                <div class="two-one">
                    <div style="width: 15%;"><strong>OVERALL NOTES:</strong></div>
                    <div style="width: 85%;"><?php echo $interview['Notes'] ?></div>
                </div>
                <div class="two-one">
                    <div style="width: 15%;"><strong>do they have a provisional license?:</strong></div>
                    <div style="width: 85%;"><?php echo $interview['Client_License_Status'] ? "Yes, they do have a provisional license." : "No."?></div>
                </div>
                
            </div>
        </div>
        <br>
        <?php } ?>

        
    </div>

    


    <?php include '../../footer.php' ?>
    
</body>
</html>