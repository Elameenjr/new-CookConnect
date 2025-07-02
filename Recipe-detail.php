<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recipe Detail - CookConnect</title>
  <link rel="icon" href="assets/favicon.ico" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<header class="bg-danger text-white py-4 mb-4">
  <div class="container text-center">
    <h1 class="fw-bold mb-0">Recipe Details</h1>
    <p class="lead text-white-50">Discover how to cook this amazing dish step-by-step</p>
  </div>
</header>

<!-- Main Content -->
<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">

      <!-- Recipe Card -->
      <div class="card border-0 shadow-sm">
        <img src="https://images.unsplash.com/photo-1555243896-c709bfa0b564?auto=format&fit=crop&w=1200&q=60"
             class="card-img-top" alt="Dish Image">

        <div class="card-body">
          <!-- Recipe Title & Meta -->
          <h2 class="card-title fw-bold">Spicy Chicken Curry</h2>
          <p class="text-muted mb-2">By <strong>Chef Ameen</strong> | <i class="fas fa-clock me-1"></i> 45 min | <span class="badge bg-danger-subtle text-danger">Intermediate</span></p>

          <!-- Short Description -->
          <p class="card-text text-muted">
            A bold and flavorful chicken curry recipe packed with spices and rich aroma. Perfect for family dinners and special occasions.
          </p>

          <hr>

          <!-- Ingredients -->
          <h5 class="fw-semibold mt-4 mb-3"><i class="fas fa-list-ul me-2 text-danger"></i>Ingredients</h5>
          <ul class="list-group list-group-flush mb-4">
            <li class="list-group-item">500g chicken thighs</li>
            <li class="list-group-item">2 onions (chopped)</li>
            <li class="list-group-item">3 cloves garlic</li>
            <li class="list-group-item">1 tbsp curry powder</li>
            <li class="list-group-item">1 tsp paprika</li>
            <li class="list-group-item">Salt & pepper to taste</li>
          </ul>

          <!-- Steps -->
          <h5 class="fw-semibold mt-4 mb-3"><i class="fas fa-utensils me-2 text-danger"></i>Cooking Steps</h5>
          <ol class="ps-3">
            <li class="mb-2">Heat oil and sauté onions until soft.</li>
            <li class="mb-2">Add garlic, curry powder, and paprika. Stir until fragrant.</li>
            <li class="mb-2">Add chicken and cook until browned on all sides.</li>
            <li class="mb-2">Pour in water or stock and simmer for 30 minutes.</li>
            <li class="mb-2">Season with salt and pepper. Serve hot with rice.</li>
          </ol>

          <!-- Call to Action -->
          <div class="mt-4 text-end">
            <a href="index.php" class="btn btn-outline-secondary me-2"><i class="fas fa-arrow-left me-1"></i>Back</a>
            <a href="#" class="btn btn-danger"><i class="fas fa-heart me-1"></i> Save Recipe</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
