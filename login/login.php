<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLIENT LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            background-color: aliceblue;
            padding: 10%;
            margin: 0;
        }

        .container-md{
            background-color: white;
            box-shadow: 0 0 20px -15px black;
            border-radius: 10px;
            padding: 5%;
        }
    </style>

</head>
<body>
    <div class="container-md">
        <form action="" method="post">
            <h1 class="text-center">Welcome to EasyDrive School</h1>
            <p class="text-center">Are you Staff? <a class="link-primary link-opacity-50-hover link-underline link-underline-opacity-0" href="">Go here</a>.</p>
            <div class="mb-3">
                <label for="user_id" class="form-label">First Name</label>
                <input class="form-control form-control-lg" type="text" name="first_name" id="first_name" placeholder="First Name">
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Last Name</label>
                <input class="form-control form-control-lg" type="text" name="last_name" id="last_name" placeholder="Last Name">
            </div>
            
            <div class="mb-3">
                <label for="user_id" class="form-label">Password</label>
                <input input class="form-control form-control-lg" type="text" name="password" id="password" placeholder="Password">
            </div>

            <div class="d-grid gap-2">
                <button name="submit" type="button" class="btn btn-dark btn-lg">Submit</button>
            </div>
            
            <div class="form-text">
                <span style="font-size: 18px;">Not registered yet? <a class="link-primary link-opacity-50-hover link-underline link-underline-opacity-0" href="/case-study/clientRegistration/clientRegistration.php">Register now!</a></span>
            </div>
            

        </form>
    </div>
    
</body>
</html>