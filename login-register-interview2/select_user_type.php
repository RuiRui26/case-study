<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Role</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJxj6pT+5+Tm4CkLrFkTAjp0SM2yom9iJ7jyl0hDtYkzJw7p4ZaKh9V4pLzR" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center mb-4">Sign Up</h1>
            <p class="text-center mb-4">Select your role to sign up:</p>
            <form action="redirect_signup.php" method="POST">
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="user_type" value="client" required>
                    <label class="form-check-label">Client</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="user_type" value="manager" required>
                    <label class="form-check-label">Manager</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="user_type" value="staff" required>
                    <label class="form-check-label">Staff</label>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybGvY4z+T4j+P5m7m+9Q+Kd4Hly8R7dL+MZV6I5XoPpA7pK6G" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0l1vKxK2UssOV5y9fhYjzN43JQFjdHf8P5pcknDSo2Ch9g4h" crossorigin="anonymous"></script>
</body>
</html>
