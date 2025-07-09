<?php
session_start();
require 'connection.php';
if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    exit;
}
$user_id = $_SESSION['user']['id'];

// Pagination
$page = max(1, intval($_GET['page'] ?? 1));
$perPage = 9;
$offset = ($page - 1) * $perPage;

// Count total
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM recipes WHERE user_id = ?");
$countStmt->execute([$user_id]);
$totalRecipes = $countStmt->fetchColumn();
$totalPages = ceil($totalRecipes / $perPage);

// Fetch recipes
$sql = "SELECT * FROM recipes WHERE user_id = ? ORDER BY created_at DESC LIMIT $perPage OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$recipes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Recipes - CookConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    .recipe-card img { height: 200px; object-fit: cover; }
    .card.shadow-sm { transition: transform 0.18s cubic-bezier(.4,2,.6,1), box-shadow 0.18s; }
    .card.shadow-sm:hover { transform: translateY(-8px) scale(1.025); box-shadow: 0 8px 32px rgba(221,36,118,0.12), 0 1.5px 8px rgba(0,0,0,0.08); z-index: 2; }
    .card .card-img-top { transition: filter 0.2s, transform 0.2s; }
    .card.shadow-sm:hover .card-img-top { filter: brightness(0.97) saturate(1.1); transform: scale(1.03); }
    .text-gradient { background: linear-gradient(90deg, #ff512f 0%, #dd2476 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .pagination .page-link { border-radius: 50px !important; color: #dd2476; border: none; margin: 0 2px; }
    .pagination .page-link.active, .pagination .page-link:hover { background: linear-gradient(90deg, #ff512f 0%, #dd2476 100%); color: #fff !important; }
    footer.bg-dark {
      background: linear-gradient(120deg, #232526 0%, #414345 100%);
      color: #fff;
      border-top: 4px solid #dd2476;
      box-shadow: 0 -2px 16px rgba(221,36,118,0.08);
    }
    .footer-link:hover, .footer-link:focus {
      color: #fff !important;
      text-decoration: underline;
      transition: color 0.2s;
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
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php"><i class="fas fa-utensils text-danger me-2"></i>CookConnect</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#footerSection">About</a></li>
            </ul>
            <?php if (isset($_SESSION['user'])) { ?>
                <a href="recipe-add.php" class="btn btn-danger"><i class="fas fa-plus me-1"></i> Add Recipe</a>
                <a href="user_dashboard.php" class="btn btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fas fa-user"></i></a>
                <a href="signout.php" class="btn btn-outline-secondary">Sign Out</a>
            <?php } else { ?>
                <a href="signin.php" class="btn btn-danger">Sign In</a>
            <?php } ?>
        </div>
    </div>
</nav>
<header class="bg-danger text-white text-center py-5 mb-5">
  <div class="container">
    <h1 class="fw-bold">My Recipes</h1>
    <p class="text-white-50">All recipes you have shared</p>
  </div>
</header>
<div class="container">
  <div class="row g-4">
    <?php if (count($recipes)): foreach ($recipes as $recipe): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100 border-0 recipe-card">
          <div class="position-relative">
            <img src="<?= htmlspecialchars($recipe['picture'] ?? 'assets/IMG/placeholder.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($recipe['title']) ?>">
            <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm">
              <i class="far fa-heart text-danger"></i>
            </button>
          </div>
          <div class="card-body d-flex flex-column justify-content-between">
            <div class="mb-2">
              <h5 class="card-title"><?= htmlspecialchars($recipe['title']) ?></h5>
              <div class="d-flex align-items-center small text-warning mb-2">
                <i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i class="fas fa-star-half-alt me-1"></i><i class="far fa-star me-1"></i>
                <span class="text-muted ms-2">(<?= rand(10, 200) ?>)</span>
              </div>
            </div>
            <a href="recipe-detail.php?id=<?= $recipe['id'] ?>" class="btn btn-danger btn-sm mb-2 w-100">View Recipe</a>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> <?= $recipe['cook_time'] ?> mins</span>
              <span class="badge bg-danger-subtle text-danger fw-semibold"><?= $recipe['difficulty_level'] ?></span>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; else: ?>
      <div class="col-12 text-center text-muted py-5">
        <i class="fas fa-utensils fa-2x mb-2"></i>
        <div>You haven't added any recipes yet.</div>
      </div>
    <?php endif; ?>
  </div>
  <?php if ($totalPages > 1): ?>
    <nav class="mt-5">
      <ul class="pagination justify-content-center">
        <?php for ($i=1; $i<=$totalPages; $i++): ?>
          <li class="page-item<?= $i==$page?' active':'' ?>">
            <a class="page-link<?= $i==$page?' active':'' ?>" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
      </ul>
    </nav>
  <?php endif; ?>
</div>
<!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-4 mt-5" id="footerSection">
  <div class="container text-center text-md-start">
    <div class="row align-items-start">
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
      <div class="col-md-4 mb-4">
        <h6 class="text-uppercase fw-semibold mb-3 text-danger">Quick Links</h6>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="recipes_catalog.php" class="text-white-50 text-decoration-none fw-semibold footer-link">Recipes</a></li>
          <li class="mb-2"><a href="#communitySection" class="text-white-50 text-decoration-none fw-semibold footer-link">Community</a></li>
          <li class="mb-2"><a href="#tutorialSection" class="text-white-50 text-decoration-none fw-semibold footer-link">Learn</a></li>
          <li class="mb-2"><a href="recipe-add.php" class="text-white-50 text-decoration-none fw-semibold footer-link">Submit Recipe</a></li>
        </ul>
      </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
