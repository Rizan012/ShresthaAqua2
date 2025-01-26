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
    </style>
</head>
<body>

<header class="bg-colr">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fs-2 comp-name " href="#">
                <img src="logo.png" alt="Bootstrap" width="36" height="36">
                SHRESTHA AQUARIUM <span class="text-yel comp-name">2</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fs-5">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Purchase
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="fish.php">Fishes</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Supplies</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Decorations</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="d-flex ms-auto align-items-center">
                    <a href="#" class="btn btn-dark me-3 position-relative col-yel rounded-pill custom-shadow">
                        <img src="icons/cart.svg" alt="Cart" width="28" height="28">
                    </a>
                    <a class="btn btn-dark col-yel rounded-pill fs-6 fw-bold text-dark px-4 py-2 custom-shadow" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>
</header>



<footer class="bg-dark text-white py-4">
  <div class="container text-center">
      <p class="comp-name">&copy; 2024 Shrestha Aquarium. All rights reserved.</p>
      <div>
          <a href=https://www.facebook.com/Shresthaaquarium2" target="_blank" class="text-white me-3">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook"
                   width="30">
          </a>
          <a href="https://instagram.com" target="_blank" class="text-white me-3">
              <img src="https://upload.wikimedia.org/wikipedia/commons/9/95/Instagram_logo_2022.svg" alt="Instagram"
                   width="30">
          </a>
      </div>
  </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
