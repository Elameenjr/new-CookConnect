<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>CookConnect - Share & Discover Recipes</title>
        <link rel="icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    
 
    </head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top" style="border-bottom: 1px solid #f3f3f3;">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="#" style="font-size: 1.7rem;">
      <i class="fas fa-utensils fa-lg me-2 text-danger"></i><span class="text-gradient">CookConnect</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active px-3 fw-semibold nav-hover" href="#heroSection">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 fw-semibold nav-hover" href="recipes_catalog.php">Recipes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 fw-semibold nav-hover" href="#communitySection">Community</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 fw-semibold nav-hover" href="#tutorialSection">Learn</a>
        </li>
      </ul>
      <div class="d-flex align-items-center gap-2">
        <?php if (isset($_SESSION['user'])) { ?>
          <a href="recipe-add.php" class="btn btn-danger shadow-sm fw-semibold px-3"><i class="fas fa-plus me-1"></i> Add Recipe</a>
          <!-- Profile Icon -->
          <a href="user_dashboard.php" class="btn btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
            <i class="fas fa-user"></i>
          </a>
          <a href="signout.php" class="btn btn-outline-secondary fw-semibold px-3">Sign Out</a>
        <?php } else { ?>
          <a href="signin.php" class="btn btn-danger shadow-sm fw-semibold px-3">Sign In</a>
        <?php } ?>
      </div>
    </div>
  </div>
</nav>
<style>
    /* Navbar hover effect */
    .nav-hover {
        transition: color 0.2s, background 0.2s;
        border-radius: 0.5rem;
    }
    .nav-hover:hover, .nav-link.active {
        color: #fff !important;
        background: linear-gradient(90deg, #ff512f 0%, #dd2476 100%);
        box-shadow: 0 2px 8px rgba(221,36,118,0.08);
    }
    /* Gradient text for brand */
    .text-gradient {
        background: linear-gradient(90deg, #ff512f 0%, #dd2476 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    /* Hero Section */
    .hero-section  {
        background: linear-gradient(120deg, #ff512f 0%, #dd2476 100%);
        color: #fff;
        padding: 110px 0 90px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.18);
        z-index: 1;
    }
    .hero-section .container {
        position: relative;
        z-index: 2;
    }
    .hero-section h1, .hero-section p {
        text-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .hero-section .btn-light {
        background: #fff;
        color: #dd2476;
        border: none;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(221,36,118,0.08);
    }
    .hero-section .btn-light:hover {
        background: #dd2476;
        color: #fff;
    }
    .hero-section .btn-ghost {
        background: rgba(255,255,255,0.08);
        color: #fff;
        border: 1px solid #fff;
        transition: background 0.2s, color 0.2s;
    }
    .hero-section .btn-ghost:hover {
        background: #fff;
        color: #dd2476;
    }
    .hero-section img.rotate {
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
        border-radius: 1.5rem;
        transform: rotate(-2deg);
        transition: transform 0.3s;
    }
    .hero-section img.rotate:hover {
        transform: rotate(2deg) scale(1.03);
    }
    /* Card hover effect */
    .card.shadow-sm {
        transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s;
    }
    .card.shadow-sm:hover {
        transform: translateY(-8px) scale(1.025);
        box-shadow: 0 8px 32px rgba(221,36,118,0.12), 0 1.5px 8px rgba(0,0,0,0.08);
        z-index: 2;
    }
    .card .card-img-top {
        transition: filter 0.2s, transform 0.2s;
    }
    .card.shadow-sm:hover .card-img-top {
        filter: brightness(0.97) saturate(1.1);
        transform: scale(1.03);
    }
    /* Responsive tweaks */
    @media (max-width: 991px) {
        .hero-section {
            padding: 70px 0 60px 0;
        }
        .hero-section h1 {
            font-size: 2.2rem;
        }
    }
    /* Footer styling */
    footer.bg-dark {
        background: linear-gradient(120deg, #232526 0%, #414345 100%);
        color: #fff;
        border-top: 4px solid #dd2476;
        box-shadow: 0 -2px 16px rgba(221,36,118,0.08);
    }
    footer .fw-bold.text-uppercase {
        letter-spacing: 1px;
    }
    footer .text-white-50 {
        transition: color 0.2s;
    }
    footer .text-white-50:hover, footer .text-white-50:focus {
        color: #fff !important;
        text-decoration: underline;
    }
    footer .list-unstyled li {
        margin-bottom: 0.5rem;
    }
    footer .d-flex.gap-3 a {
        transition: color 0.2s, transform 0.2s;
    }
    footer .d-flex.gap-3 a:hover {
        color: #dd2476 !important;
        transform: translateY(-2px) scale(1.1);
    }
    footer hr {
        border-top: 1.5px solid #dd2476;
        opacity: 0.15;
    }
    footer .text-center.text-white-50.small {
        letter-spacing: 0.5px;
        font-size: 0.97rem;
    }
</style>
<!-- Hero Section -->
<div class="hero-section py-5"  id="heroSection">
  <div class="container py-5">
    <div class="row align-items-center">
      <div class="col-lg-6 text-center text-lg-start">
        <h1 class="display-4 fw-bold">Share your culinary<br>creations with the world</h1>
        <p class="lead text-white-50 mt-3">
          Join our community of food lovers, learn new skills, and get inspired by thousands of recipes from home cooks around the globe.
        </p>
        <div class="d-flex flex-column flex-sm-row gap-3 mt-4">
          <a href="#submitRecipeSection" class="btn btn-light text-danger fw-semibold">
            Get Started <i class="fas fa-arrow-right ms-2"></i>
          </a>
          <a href="#videoModal" class="btn btn-ghost">
            <i class="fas fa-play me-2"></i> Watch Demo
          </a>
        </div>
      </div>
      <div class="col-lg-6 d-none d-lg-block text-center">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=500&q=60"
             class="img-fluid rounded shadow-lg rotate" alt="Featured Dish" style="max-height: 400px;">
      </div>
    </div>
  </div>
<!-- Featured Recipes -->
 <!--  -->
<section class="py-5 bg-light" id="categoriesSection">
  <div class="container">
    <div class="text-center mb-5">
      <h6 class="text-uppercase text-danger fw-bold">Community Favorites</h6>
      <h2 class="text-uppercase text-danger fw-bold " >Top-rated recipes this week</h2>
    </div>
    <div class="row g-4">
<!-- card 1 -->
    <div class="col-md-6 col-lg-4">
  <div class="card shadow-sm h-100 border-0">
    <div class="position-relative">
      <img src="https://media.istockphoto.com/id/185274327/photo/picture-of-hot-spicy-buffalo-wings.webp?a=1&b=1&s=612x612&w=0&k=20&c=Bbnp-n0VzhiUPMEbrQ1dtQBOIgc1z3I1GbCJKz9gxKs=" class="card-img-top" alt="Moringa Soup">
      <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm">
        <i class="far fa-heart text-danger"></i>
      </button>
    </div>
    <div class="card-body d-flex flex-column justify-content-between">
      <div class="mb-2">
        <h5 class="card-title">Spicy Chicken Curry</h5>
        <p class="card-text text-muted small mb-2">By Chef Ameen</p>
        <div class="d-flex align-items-center small text-warning mb-2">
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star-half-alt me-1"></i>
          <span class="text-muted ms-2">(243)</span>
        </div>
      </div>
      <a href="recipe-detail.php?id=1" class="btn btn-danger btn-sm mb-2">View Recipe</a>
      <div class="d-flex justify-content-between align-items-center">
        <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> 25 min</span>
        <span class="badge bg-danger-subtle text-danger fw-semibold">Beginner</span>
      </div>
    </div>
  </div>
</div>
<!-- card 2 -->
<div class="col-md-6 col-lg-4">
  <div class="card shadow-sm h-100 border-0">
    <div class="position-relative">
      <img src="assets/IMG/suya.jpg" class="card-img-top" alt="BBQ Suya">
      <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm">
        <i class="fas fa-heart text-danger"></i>
      </button>
    </div>
    <div class="card-body d-flex flex-column justify-content-between">
      <div class="mb-2">
        <h5 class="card-title">BBQ Suya</h5>
        <p class="card-text text-muted small mb-2">By Chef Alhaji</p>
        <div class="d-flex align-items-center small text-warning mb-2">
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <span class="text-muted ms-2">(512)</span>
        </div>
      </div>
      <a href="recipe-detail.php?id=2" class="btn btn-danger btn-sm mb-2">View Recipe</a>
      <div class="d-flex justify-content-between align-items-center">
        <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> 3 hrs</span>
        <span class="badge bg-danger-subtle text-danger fw-semibold">Advanced</span>
      </div>
    </div>
  </div>
</div>
<!-- card 3 -->
 <div class="col-md-6 col-lg-4">
  <div class="card shadow-sm h-100 border-0">
    <div class="position-relative">
      <img src="assets/IMG/Africa-salad.jpg" class="card-img-top" alt="African Salad">
      <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm">
        <i class="far fa-heart text-danger"></i>
      </button>
    </div>
    <div class="card-body d-flex flex-column justify-content-between">
      <div class="mb-2">
        <h5 class="card-title">African salad (ABACHA)</h5>
        <p class="card-text text-muted small mb-2">By Chef Emily</p>
        <div class="d-flex align-items-center small text-warning mb-2">
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <i class="fas fa-star me-1"></i>
          <span class="text-muted ms-2">(194)</span>
        </div>
      </div>
      <a href="recipe-detail.php?id=3" class="btn btn-danger btn-sm mb-2">View Recipe</a>
      <div class="d-flex justify-content-between align-items-center">
        <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> 15 min</span>
        <span class="badge bg-danger-subtle text-danger fw-semibold">Easy</span>
      </div>
    </div>
  </div>
</div>
</div>
</section>
<!-- Add Recipe Section -->

</section>
<!-- Community Chat Section -->
<section class="py-5 bg-white" id="communitySection">
  <div class="container">
    <div class="text-center mb-5">
      <h6 class="text-uppercase text-danger fw-bold">Community</h6>
      <h2 class="fw-bold">Live Recipe Chat</h2>
      <p class="text-muted">Chat with other food lovers. Ask questions, share tips, or just say hi!</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0"><i class="fas fa-comments me-2"></i>CookChat</h6>
            <small>Online: 12</small>
          </div>

          <!-- Chat Messages -->
          <div class="card-body" style="height: 300px; overflow-y: auto;" id="chatBox">
            <!-- Example Messages -->
            <div class="mb-3">
              <div class="d-flex align-items-center">
                <div class="bg-danger text-white rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 35px; height: 35px;">A</div>
                <div>
                  <strong class="text-dark">Ameen</strong>
                  <div class="text-muted small">Try adding cumin to your jollof rice 🔥</div>
                </div>
              </div>
            </div>
            <div class="mb-3 text-end">
              <div>
                <strong class="text-dark">You</strong>
                <div class="text-muted small">Noted! Will try it tonight 😋</div>
              </div>
            </div>
            <!-- End messages -->
          </div>

          <!-- Input Area -->
          <div class="card-footer">
            <form id="chatForm" class="d-flex gap-2">
              <input type="text" class="form-control" placeholder="Type your message..." id="chatInput" required />
              <button class="btn btn-danger" type="submit">
                <i class="fas fa-paper-plane"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-4 mt-5 shadow-lg" style="background: linear-gradient(120deg, #232526 0%, #414345 100%); border-top: 4px solid #dd2476;">
  <div class="container text-center text-md-start">
    <div class="row align-items-start">

      <!-- Brand & About -->
      <div class="col-md-4 mb-4">
        <h5 class="fw-bold text-uppercase mb-3 d-flex align-items-center">
          <i class="fas fa-utensils text-danger me-2"></i>
          <span class="text-gradient" style="font-size: 1.5rem;">CookConnect</span>
        </h5>
        <p class="text-white-50 small mb-3" style="line-height:1.7;">
          Your go-to recipe platform to explore, share, and connect with food lovers around the world.
        </p>
        <div class="d-flex gap-2 mt-3">
          <a href="#" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;"><i class="fab fa-twitter"></i></a>
          <a href="#" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;"><i class="fab fa-instagram"></i></a>
          <a href="#" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 mb-4">
        <h6 class="text-uppercase fw-semibold mb-3 text-danger">Quick Links</h6>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="#categoriesSection" class="text-white-50 text-decoration-none fw-semibold footer-link">Recipes</a></li>
          <li class="mb-2"><a href="#communitySection" class="text-white-50 text-decoration-none fw-semibold footer-link">Community</a></li>
          <li class="mb-2"><a href="#tutorialSection" class="text-white-50 text-decoration-none fw-semibold footer-link">Learn</a></li>
          <li class="mb-2"><a href="recipe-add.php" class="text-white-50 text-decoration-none fw-semibold footer-link">Submit Recipe</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-md-4 mb-4">
        <h6 class="text-uppercase fw-semibold mb-3 text-danger">Contact</h6>
        <p class="text-white-50 small mb-2"><i class="fas fa-envelope me-2"></i> support@cookconnect.com</p>
        <p class="text-white-50 small mb-0"><i class="fas fa-map-marker-alt me-2"></i> 123 Foodie Lane, Lagos, Nigeria</p>
      </div>

    </div>

    <hr class="border-light-subtle" style="opacity:0.15;" />

    <div class="text-center text-white-50 small" style="letter-spacing:0.5px;">
      &copy; <?php echo date("Y"); ?> <span class="text-gradient fw-bold">CookConnect</span>. All rights reserved.
    </div>
  </div>
</footer>
<style>
  .footer-link:hover, .footer-link:focus {
    color: #fff !important;
    text-decoration: underline;
    transition: color 0.2s;
  }
  .text-gradient {
    background: linear-gradient(90deg, #ff512f 0%, #dd2476 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  footer .btn-outline-light:hover, footer .btn-outline-light:focus {
    background: #dd2476;
    border-color: #dd2476;
    color: #fff !important;
    transform: scale(1.1);
    transition: all 0.2s;
  }
  @media (max-width: 767px) {
    footer .row > div {
      text-align: center !important;
    }
    footer .d-flex.gap-2 {
      justify-content: center;
    }
  }
</style>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">         
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></scrip>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
