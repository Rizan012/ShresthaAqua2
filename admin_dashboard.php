<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include('db.php'); // Make sure to include the database connection

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fishName = $_POST['name'];
    $fishPrice = $_POST['price'];

    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is a valid image
    if (getimagesize($_FILES["image"]["tmp_name"])) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image = basename($_FILES["image"]["name"]);
            $sql = "INSERT INTO fish (name, price, image) VALUES ('$fishName', '$fishPrice', '$image')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Fish added successfully');</script>";
            } else {
                echo "<script>alert('Error adding fish: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    } else {
        echo "<script>alert('File is not an image.');</script>";
    }
}

// Handle fish deletion
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Get the fish details to delete the image only for the selected fish
    $sql = "SELECT * FROM fish WHERE id = '$deleteId'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imagePath = "uploads/" . $row['image'];

        // Before deleting the image, check how many fish use the same image
        $imageCheckSql = "SELECT COUNT(*) AS count FROM fish WHERE image = '" . $row['image'] . "'";
        $imageCheckResult = mysqli_query($conn, $imageCheckSql);
        $imageCheckRow = mysqli_fetch_assoc($imageCheckResult);

        // If the image is used by more than one fish, do not delete the image
        if ($imageCheckRow['count'] == 1) {
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image from the server
            }
        }
    }

    // Delete the fish record from the database
    $deleteSql = "DELETE FROM fish WHERE id = '$deleteId'";
    if (mysqli_query($conn, $deleteSql)) {
        echo "<script>alert('Fish removed successfully'); window.location.href = 'admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error removing fish: " . mysqli_error($conn) . "');</script>";
    }
}

// Query to fetch fish list
$sql = "SELECT * FROM fish";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn)); // Show detailed SQL error
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unica+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            font-family: Poppins;
        }
        .bg-colr {
            background-color: rgb(245, 245, 245);
        }
        .comp-name {
            font-family: "Unica One", serif;
        }
        .rounded-bottom-right {
            border-bottom-right-radius: 100px;
        }
        .py-8 {
            padding-top: 6rem;
            padding-bottom: 6rem;
        }
        .col-yel {
            background-color: #ddec01;
            border-color: #ddec01;
        }
        .text-yel {
            color: #ddec01;
        }
        .custom-shadow {
            box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.8);
        }
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        footer {
          margin-top: auto;
        }

        .hero-section {
            padding-top: 6rem;
            padding-bottom: 6rem;
            background-color: #f0f0f0;
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<header class="bg-colr">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-2 comp-name" href="#">
                <img src="logo.png" alt="Logo" width="36" height="36">
                <span class="comp-name">SHRESTHA AQUARIUM</span> <span class="comp-name text-yel">2</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fs-5">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">User</a>
                    </li>
                </ul>
                <div class="d-flex ms-auto align-items-center">
                    <a href="#" class="btn btn-dark me-3 position-relative col-yel rounded-pill custom-shadow">
                        <img src="icons/cart.svg" alt="Cart" width="28" height="28">
                    </a>
                    <?php if (isset($_SESSION['username'])): ?>
                        <div class="dropdown">
                            <button class="btn btn-dark col-yel rounded-pill fs-6 fw-bold text-dark px-4 py-2 custom-shadow dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['username']; ?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a class="btn btn-dark col-yel rounded-pill fs-6 fw-bold text-dark px-4 py-2 custom-shadow" href="login.php">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<section class="hero-section">
    <div class="container">
        <h2 class="mb-5 text-center">Upload Fish Information</h2>
        <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Fish Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Fish Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-dark col-yel rounded-pill fs-6 fw-bold px-5 py-3 mt-3 text-dark custom-shadow">Upload Fish</button>
        </form>
    </div>
</section>

<section class="mt-5">
    <div class="container">
        <h2 class="mb-5 text-center">Fish List</h2>
        <div class="row">
            <?php
            // Display fish items
            while ($row = mysqli_fetch_assoc($result)):
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow">
                        <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" alt="Fish Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text">Price: $<?php echo number_format($row['price'], 2); ?></p>
                            <a href="admin_dashboard.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger">Remove</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>© 2025 Fish Store. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
