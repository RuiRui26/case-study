<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyDrive School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #head{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #head .nav{
            display: flex;
            flex-direction: row;
        }

        .container-fluid{
            padding: 0 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="">EasyDrive</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="staff_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="add_interview_details.php">Interview</a></li> 
                    <li class="nav-item"><a class="nav-link" href="add_drivingtest.php">Driving Test</a></li> 
                </ul>
                <a class="nav-link" href="../../login-register-interview2/logout.php" style="padding: 0 20px;">Logout</a>
            </div>
        </div>
    </nav>
