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

<section class="hero-section py-8 bg-dark text-white mt-5">
    <div class="container">
        <div class="row align-items-center justify-content-between flex-row g-5">
            <div class="col-12 col-lg-6">
                <h1 class="mb-3 fw-bold">
                    Explore our wide range of premium fishes, decor, and essential supplies to create the perfect aquatic environment.
                </h1>
                <p class="fst-italic text-yel">Bringing the beauty of the ocean to your home.....</p>
                <a class="btn btn-dark col-yel rounded-pill fs-6 fw-bold px-5 py-3 mt-3 text-dark custom-shadow" href="#">Buy Now</a>
            </div>
            <div class="col-12 col-lg-6">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="nemu1.jpg" class="d-block w-100 custom-shadow" alt="Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="tank.png" class="d-block w-100 custom-shadow" alt="Image 2">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-8 bg-light text-dark">
    <div class="container">
        <h2 class="text-center mb-5">Our Featured Fishes</h2>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card">                  
                    <img src="fish1.jpg" class="card-img-top" alt="Fish 1" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Goldfish</h5>
                        <p class="card-text fs-9 mb-4">Goldfish are one of the most popular aquarium fish, known for their bright orange color and easy care requirements. They are perfect for beginners.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card">                   
                    <img src="fish2.jpg" class="card-img-top" alt="Fish 2" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-4"">Betta Fish</h5>
                        <p class="card-text fs-9 mb-4">Betta fish are known for their vibrant colors and long flowing fins. They are relatively easy to care for, but should be kept alone in tanks due to their aggressive nature.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <img src="fish3.jpg" class="card-img-top" alt="Fish 3" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-4"">Angelfish</h5>
                        <p class="card-text fs-9 mb-4">Angelfish are known for their unique shape and graceful swimming. They come in various colors and thrive in well-maintained aquariums.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-8 bg-light text-dark">
    <div class="container">
        <h2 class="text-center mb-5">Our Featured Fishes</h2>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card">                  
                    <img src="fish1.jpg" class="card-img-top" alt="Fish 1" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Goldfish</h5>
                        <p class="card-text fs-9 mb-4">Goldfish are one of the most popular aquarium fish, known for their bright orange color and easy care requirements. They are perfect for beginners.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card">                   
                    <img src="fish2.jpg" class="card-img-top" alt="Fish 2" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-4"">Betta Fish</h5>
                        <p class="card-text fs-9 mb-4">Betta fish are known for their vibrant colors and long flowing fins. They are relatively easy to care for, but should be kept alone in tanks due to their aggressive nature.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <img src="fish3.jpg" class="card-img-top" alt="Fish 3" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title mb-4"">Angelfish</h5>
                        <p class="card-text fs-9 mb-4">Angelfish are known for their unique shape and graceful swimming. They come in various colors and thrive in well-maintained aquariums.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-8 bg-light text-dark">
    <div class="container">
        <h2 class="text-center mb-5">Our Store Location</h2>
        <p class="text-center mb-4">Our store is located at SHRESTHA AQUARIUM-2, Nepal. Visit us for a variety of aquatic life and supplies.</p>
        <div class="d-flex justify-content-center">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15046.644166347314!2d85.31804406324873!3d27.719146538540848!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1917efba680d%3A0x80a0e10024b009c1!2sSHRESTHA%20AQUARIUM-2!5e0!3m2!1sen!2snp!4v1737909043297!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>



<footer class="bg-dark text-white py-4">
  <div class="container text-center">
      <p class="comp-name">&copy; 2024 Shrestha Aquarium. All rights reserved.</p>
      <div>
          <a href="https://www.facebook.com/Shresthaaquarium2" target="_blank" class="text-white me-3">
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
