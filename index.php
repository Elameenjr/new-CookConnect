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
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
      <i class="fas fa-utensils fa-lg me-2"></i>CookConnect
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#categoriesSection">Recipes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#communitySection">Community</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tutorialSection">Learn</a>
        </li>
      </ul>
      <div class="d-flex align-items-center gap-2">
        <?php if (isset($_SESSION['user'])) { ?>
          <a href="recipe-add.php" class="btn btn-danger"><i class="fas fa-plus me-1"></i> Add Recipe</a>
          <a href="signout.php" class="btn btn-outline-secondary">Sign Out</a>
        <?php } else { ?>
          <a href="signin.php" class="btn btn-danger">Sign In</a>
        <?php } ?>
      </div>
    </div>
  </div>
</nav>
 <style>
        .hero-section  {
            background: linear-gradient(to right, red, yellow);
            color: white; /* Text color for contrast */
            padding: 100px 0; /* Vertical padding for height */
            text-align: center;
        }
    </style>
<!-- Hero Section -->
<div class="hero-section py-5">
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
<section class="py-5 bg-light" id="categoriesSection">
  <div class="container">
    <div class="text-center mb-5">
      <h6 class="text-uppercase text-danger fw-bold">Community Favorites</h6>
      <h2 class="fw-bold">Top-rated recipes this week</h2>
    </div>
    <div class="row g-4">

      <!-- Card 1 -->
      <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100 border-0">
          <div class="position-relative">
            <img src="assets/IMG/miyan-zogale.jpg"
                 class="card-img-top" alt="Creamy Garlic Pasta">
            <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm">
              <i class="far fa-heart text-danger"></i>
            </button>
          </div>
          <div class="card-body d-flex flex-column justify-content-between">
            <div class="mb-2">
              <h5 class="card-title">Moringa Soup (Miyar Zogale)</h5>
              <p class="card-text text-muted small mb-2">By Chef Mariam</p>
              <div class="d-flex align-items-center small text-warning mb-2">
                <i class="fas fa-star me-1"></i>
                <i class="fas fa-star me-1"></i>
                <i class="fas fa-star me-1"></i>
                <i class="fas fa-star me-1"></i>
                <i class="fas fa-star-half-alt me-1"></i>
                <span class="text-muted ms-2">(243)</span>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> 25 min</span>
              <span class="badge bg-danger-subtle text-danger fw-semibold">Beginner</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100 border-0">
          <div class="position-relative">
            <img src="assets/IMG/suya.jpg"
                 class="card-img-top" alt="BBQ Ribs">
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
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> 3 hrs</span>
              <span class="badge bg-danger-subtle text-danger fw-semibold">Advanced</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100 border-0">
          <div class="position-relative">
            <img src="assets/IMG/Africa-salad.jpg"
                 class="card-img-top" alt="Rainbow Salad Bowl">
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
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> 15 min</span>
              <span class="badge bg-danger-subtle text-danger fw-semibold">Easy</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- Add Recipe Section -->
<section class="py-5 bg-white" id="submitRecipeSection">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-lg-8 text-center">
        <h6 class="text-uppercase text-danger fw-bold">Share a Recipe</h6>
        <h2 class="fw-bold">Submit your favorite dish</h2>
        <p class="text-muted">Upload your recipe and inspire other food lovers in the CookConnect community.</p>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <form action="submit-recipe.php" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
          <div class="mb-3">
            <label for="title" class="form-label fw-semibold">Recipe Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="e.g. Spicy Chicken Curry" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label fw-semibold">Short Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Brief summary..." required></textarea>
          </div>

          <div class="mb-3">
            <label for="ingredients" class="form-label fw-semibold">Ingredients</label>
            <textarea class="form-control" name="ingredients" id="ingredients" rows="4" placeholder="List ingredients separated by commas" required></textarea>
          </div>

          <div class="mb-3">
            <label for="steps" class="form-label fw-semibold">Steps</label>
            <textarea class="form-control" name="steps" id="steps" rows="5" placeholder="Step-by-step instructions..." required></textarea>
          </div>

          <div class="mb-3">
            <label for="difficulty" class="form-label fw-semibold">Difficulty</label>
            <select class="form-select" name="difficulty" id="difficulty" required>
              <option value="">Choose...</option>
              <option value="Easy">Easy</option>
              <option value="Beginner">Beginner</option>
              <option value="Intermediate">Intermediate</option>
              <option value="Advanced">Advanced</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label fw-semibold">Upload Image</label>
            <input class="form-control" type="file" name="image" id="image" accept="image/*" required>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-paper-plane me-2"></i>Submit Recipe
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
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
<footer class="bg-dark text-white pt-5 pb-4 mt-5">
  <div class="container text-center text-md-start">
    <div class="row">

      <!-- Brand & About -->
      <div class="col-md-4 mb-4">
        <h5 class="fw-bold text-uppercase">
          <i class="fas fa-utensils text-danger me-2"></i>CookConnect
        </h5>
        <p class="text-muted small">
          Your go-to recipe platform to explore, share, and connect with food lovers around the world.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 mb-4">
        <h6 class="text-uppercase fw-semibold mb-3">Quick Links</h6>
        <ul class="list-unstyled">
          <li><a href="#categoriesSection" class="text-white-50 text-decoration-none">Recipes</a></li>
          <li><a href="#communitySection" class="text-white-50 text-decoration-none">Community</a></li>
          <li><a href="#tutorialSection" class="text-white-50 text-decoration-none">Learn</a></li>
          <li><a href="recipe-add.php" class="text-white-50 text-decoration-none">Submit Recipe</a></li>
        </ul>
      </div>

      <!-- Contact Info / Socials -->
      <div class="col-md-4 mb-4">
        <h6 class="text-uppercase fw-semibold mb-3">Stay Connected</h6>
        <p class="text-white-50 small mb-2"><i class="fas fa-envelope me-2"></i> support@cookconnect.com</p>
        <div class="d-flex gap-3">
          <a href="#" class="text-white-50 fs-5"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-white-50 fs-5"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-white-50 fs-5"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-white-50 fs-5"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

    </div>

    <hr class="border-light-subtle" />

    <div class="text-center text-white-50 small">
      &copy; <?php echo date("Y"); ?> CookConnect. All rights reserved.
    </div>
  </div>
</footer>

        <
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></scrip>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
