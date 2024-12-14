<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Role</title>
</head>
<body>
    <h1>Sign Up</h1>
    <p>Select your role to sign up:</p>
    <form action="redirect_signup.php" method="POST">
        <input type="radio" name="user_type" value="client" required> Client<br>
        <input type="radio" name="user_type" value="manager" required> Manager<br>
        <input type="radio" name="user_type" value="staff" required> Staff<br>
        <button type="submit">Next</button>
    </form>
</body>
</html>
