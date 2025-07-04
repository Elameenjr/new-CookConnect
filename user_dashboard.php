<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Dashboard - CookConnect</title>
  <link rel="icon" href="assets/favicon.ico" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>
<body>
  <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand fw-bold d-flex align-items-center " href="#!"> <i class="fas fa-utensils text-danger me-2"></i> CookConnect</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#footerSection ">About</a></li>
                    </ul>
                       <?php if (isset($_SESSION['user'])) { ?>
          <a href="recipe-add.php" class="btn btn-danger"><i class="fas fa-plus me-1"></i> Add Recipe</a>
          <!-- Profile Icon -->
          <a href="user_dashboard.php" class="btn btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-user"></i>
          </a>
          <a href="signout.php" class="btn btn-outline-secondary">Sign Out</a>
        <?php } else { ?>
          <a href="signin.php" class="btn btn-danger">Sign In</a>
        <?php } ?>
                </div>
            </div>
        </nav>
<!-- Header -->
<header class="bg-danger text-white py-4">
  <div class="container text-center">
    <h1 class="fw-bold">Welcome, <?php echo $_SESSION['user']['name'] ?? 'Guest'; ?></h1>
    <p class="text-white-50">Manage your profile, recipes, and saved dishes</p>
  </div>
</header>

<!-- Main Dashboard -->
<div class="container my-5">
  <div class="row g-4">

    <!-- Profile Info -->
    <div class="col-lg-4">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <img src="https://i.pravatar.cc/100?u=<?php echo $_SESSION['user']['email'] ?? 'default'; ?>"
               class="rounded-circle mb-3" width="100" height="100" alt="User Avatar" />
          <h5 class="fw-bold"><?php echo $_SESSION['user']['name'] ?? 'Username'; ?></h5>
          <p class="text-muted small mb-2"><?php echo $_SESSION['user']['email'] ?? 'user@example.com'; ?></p>
          <a href="edit-profile.php" class="btn btn-outline-danger btn-sm">
            <i class="fas fa-edit me-1"></i> Edit Profile
          </a>
        </div>
      </div>
    </div>

    <!-- Dashboard Actions -->
    <div class="col-lg-8">
      <div class="row g-4">

        <!-- My Recipes -->
        <div class="col-md-6">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column align-items-start">
              <div class="mb-3">
                <i class="fas fa-utensils fa-2x text-danger"></i>
              </div>
              <h5 class="fw-bold">My Recipes</h5>
              <p class="text-muted">View and manage recipes you’ve shared.</p>
              <a href="my-recipes.php" class="btn btn-sm btn-danger mt-auto">Go to Recipes</a>
            </div>
          </div>
        </div>

        <!-- Saved Recipes -->
        <div class="col-md-6">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column align-items-start">
              <div class="mb-3">
                <i class="fas fa-heart fa-2x text-danger"></i>
              </div>
              <h5 class="fw-bold">Saved Recipes</h5>
              <p class="text-muted">See dishes you’ve saved or marked as favorite.</p>
              <a href="saved-recipes.php" class="btn btn-sm btn-danger mt-auto">View Favorites</a>
            </div>
          </div>
        </div>

        <!-- Account Settings -->
        <div class="col-md-6">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column align-items-start">
              <div class="mb-3">
                <i class="fas fa-cog fa-2x text-danger"></i>
              </div>
              <h5 class="fw-bold">Account Settings</h5>
              <p class="text-muted">Change your password, email, or avatar.</p>
              <a href="settings.php" class="btn btn-sm btn-danger mt-auto">Manage Settings</a>
            </div>
          </div>
        </div>

        <!-- Sign Out -->
        <div class="col-md-6">
          <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column align-items-start">
              <div class="mb-3">
                <i class="fas fa-sign-out-alt fa-2x text-danger"></i>
              </div>
              <h5 class="fw-bold">Sign Out</h5>
              <p class="text-muted">Leave the dashboard and return home.</p>
              <a href="signout.php" class="btn btn-sm btn-outline-secondary mt-auto">Sign Out</a>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
<!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-4 mt-5"  id="footerSection" style="background: linear-gradient(120deg, #232526 0%, #414345 100%); border-top: 4px solid #dd2476;">
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
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
