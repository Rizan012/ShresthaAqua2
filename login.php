<?php
session_start();
require_once 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Both fields are required.";
    } else {
        $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No account found with that username.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Uniqca&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #212529;
            font-family: 'Poppins', sans-serif;
        }
        .login-container {
            display: flex;
            width: 90%;
            max-width: 1000px;
            height: 700px;
        }
        .login-left,
        .login-right {
            height: 100%;
            width: 50%;
        }
        .login-left {
            background-image: url('bg2.jpeg');
            background-size: cover;
            background-position: center;
        }
        .login-right {
            background-color: #343a40;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
            position: relative;
        }
        .login-right img {
            max-width: 80px;
            margin-bottom: 1rem;
            display: block;
        }
        .login-right h2 {
            margin-bottom: 1.5rem;
            font-family: 'Uniqca', sans-serif;
            font-weight: 600;
            color: #fff;
            font-size: 2rem;
        }
        .form-label {
            font-weight: 600;
            color: #adb5bd;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #495057;
            background-color: #495057;
            color: #fff;
        }
        .form-control:focus {
            border-color: #ffc107;
            background-color: #6c757d;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 600;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .col-yel {
            background-color: #ddec01;
            border-color: #ddec01;
        }
        .text-yel {
            color: #ddec01;
        }
        .alert {
            margin-top: 1rem;
            text-align: right;
        }
        a {
            color: #ffc107;
            font-weight: 500;
            text-decoration: none;
        }
        a:hover {
            color: #e0a800;
        }
        .left-align {
            text-align: left;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left"></div>
        <div class="login-right">
            <img src="logo.png" alt="Company Logo">
            <form method="POST" action="login.php" class="w-100">
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-dark col-yel rounded-pill fs-6 fw-bold px-5 py-3 mt-3 text-dark custom-shadow w-100">Login</button>
            </form>
            <div class="mt-4 w-100 left-align">
                <a href="register.php" class="fs-6 text-white">Don't have an account? Register here</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
