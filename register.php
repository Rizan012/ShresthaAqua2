<?php
session_start();
include('db.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if (empty($username)) {
        $errors[] = "Username is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $errors[] = "Username must contain only letters and numbers.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
        $errors[] = "Password must be at least 8 characters long, contain at least one uppercase letter, and one number.";
    } elseif ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$passwordHash')";
        if (mysqli_query($conn, $sql)) {
            header('Location: login.php');
            exit();
        } else {
            $errors[] = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            background-image: url('bg1.jpg');
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
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left"></div>
        <div class="login-right">
            <img src="logo.png" alt="Company Logo">
            <form method="POST" action="register.php" class="w-100">
                <?php if (!empty($errors)) : ?>
                    <div class="error">
                        <?php foreach ($errors as $error) : ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? $username : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                </div>
                <button type="submit" class="btn btn-dark col-yel rounded-pill fs-6 fw-bold px-5 py-3 mt-3 text-dark custom-shadow w-100">Register</button>
            </form>
            <div class="mt-4 w-100 left-align">
                <a href="login.php" class="fs-6 text-white">Already have an account? Login here</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
