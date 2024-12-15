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
            <a class="navbar-brand" href="dashboard.php">EasyDrive</a>
        </div>
        <a class="nav-link" href="../../login-register-interview2/logout.php" style="padding: 0 20px;">Logout</a>
    </nav>
