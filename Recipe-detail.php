<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recipe_app");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Make sure recipe ID is provided
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-warning text-center'>No recipe ID provided.</div>";
    exit;
}

$recipe_id = intval($_GET['id']);

// Fetch the recipe
$sql = "SELECT * FROM recipes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $recipe = $result->fetch_assoc();
} else {
    echo "<div class='alert alert-danger text-center'>Recipe not found.</div>";
    exit;
}

// Handle Save Recipe
if (isset($_POST['save_recipe']) && isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    $check = $conn->prepare("SELECT * FROM favorites WHERE user_id = ? AND recipe_id = ?");
    $check->bind_param("ii", $userId, $recipe_id);
    $check->execute();
    $exists = $check->get_result()->fetch_assoc();

    if (!$exists) {
        $stmt = $conn->prepare("INSERT INTO favorites (user_id, recipe_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $recipe_id);
        $stmt->execute();
        $savedMessage = "Recipe saved!";
    } else {
        $savedMessage = "You already saved this recipe.";
    }
}

// Handle Comment Submission
if (isset($_POST['submit_comment']) && isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $comment = trim($_POST['comment']);

    if (!empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO comments (user_id, recipe_id, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $userId, $recipe_id, $comment);
        $stmt->execute();
    }
}

// Fetch Comments
$commentQuery = $conn->prepare("
    SELECT c.comment, c.created_at, u.username
    FROM comments c
    JOIN users u ON c.user_id = u.id
    WHERE c.recipe_id = ?
    ORDER BY c.created_at DESC
");
$commentQuery->bind_param("i", $recipe_id);
$commentQuery->execute();
$comments = $commentQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($recipe['title']) ?> - CookConnect</title>
  <link rel="icon" href="assets/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container px-4 px-lg-5">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
      <i class="fas fa-utensils text-danger me-2"></i>CookConnect
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#footerSection">About</a></li>
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
<header class="bg-danger text-white py-4 mb-4">
  <div class="container text-center">
    <h1 class="fw-bold mb-0"><i class="fas fa-utensils me-2"></i><?= htmlspecialchars($recipe['title']) ?></h1>
    <p class="lead text-white-50">Step-by-step instructions to cook this dish</p>
  </div>
</header>
<!-- Main Content -->
<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-11 col-lg-10">

      <div class="card flex-md-row border-0 shadow-sm overflow-hidden">

        <!-- Left: Image -->
        <div class="w-100 w-md-50" style="flex: 1 1 45%;">
          <img src="<?= htmlspecialchars($recipe['picture']) ?>" alt="<?= htmlspecialchars($recipe['title']) ?>"
               class="img-fluid h-100 w-100" style="object-fit: cover;">
        </div>

        <!-- Right: Content -->
        <div class="card-body d-flex flex-column justify-content-between p-4" style="flex: 1 1 55%;">
          <div>
            <h2 class="card-title fw-bold mb-3"><?= htmlspecialchars($recipe['title']) ?></h2>

            <!-- Author and badges -->
            <div class="d-flex align-items-center justify-content-between flex-wrap mb-3">
              <div class="d-flex align-items-center gap-2">
                <img src="assets/IMG/avatar-placeholder.png" width="40" height="40" class="rounded-circle" alt="avatar">
                <span class="fw-medium text-muted small">By <?= htmlspecialchars($_SESSION['user']['username'] ?? 'Guest') ?></span>
              </div>
              <div class="d-flex gap-2 flex-wrap mt-2 mt-md-0">
                <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> <?= htmlspecialchars($recipe['cook_time']) ?> mins</span>
                <span class="badge bg-secondary"><i class="fas fa-utensils me-1"></i> <?= htmlspecialchars($recipe['servings']) ?> servings</span>
                <span class="badge bg-danger-subtle text-danger"><?= htmlspecialchars($recipe['difficulty_level']) ?></span>
              </div>
            </div>

            <!-- Description -->
            <p class="text-muted small"><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>

            <!-- Video -->
            <?php if (!empty($recipe['video'])): ?>
              <div class="ratio ratio-16x9 my-3">
                <iframe src="<?= htmlspecialchars($recipe['video']) ?>" title="Recipe video"
                        allowfullscreen></iframe>
              </div>
            <?php endif; ?>
          </div>

          <!-- Accordions -->
          <div class="accordion mt-3" id="recipeAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingIngredients">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseIngredients" aria-expanded="false" aria-controls="collapseIngredients">
                  <i class="fas fa-list-ul me-2 text-danger"></i> Ingredients
                </button>
              </h2>
              <div id="collapseIngredients" class="accordion-collapse collapse" aria-labelledby="headingIngredients"
                   data-bs-parent="#recipeAccordion">
                <div class="accordion-body">
                  <ul class="list-group list-group-flush small">
                    <?php
                    $ingredients = explode("\n", $recipe['ingredients']);
                    foreach ($ingredients as $item) {
                      echo "<li class='list-group-item'>" . htmlspecialchars(trim($item)) . "</li>";
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>

            <div class="accordion-item mt-2">
              <h2 class="accordion-header" id="headingInstructions">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseInstructions" aria-expanded="false" aria-controls="collapseInstructions">
                  <i class="fas fa-utensils me-2 text-danger"></i> Cooking Steps
                </button>
              </h2>
              <div id="collapseInstructions" class="accordion-collapse collapse" aria-labelledby="headingInstructions"
                   data-bs-parent="#recipeAccordion">
                <div class="accordion-body">
                  <ol class="small ps-3">
                    <?php
                    $steps = explode("\n", $recipe['instructions']);
                    foreach ($steps as $step) {
                      echo "<li class='mb-2'>" . htmlspecialchars(trim($step)) . "</li>";
                    }
                    ?>
                  </ol>
                </div>
              </div>
            </div>
          </div>

          <!-- CTA Buttons -->
          <div class="mt-4 d-flex justify-content-end gap-2">
            <a href="index.php" class="btn btn-outline-secondary btn-sm">
              <i class="fas fa-arrow-left me-1"></i> Back
            </a>
           <form method="POST" class="d-inline">
  <button name="save_recipe" class="btn btn-danger btn-sm">
    <i class="fas fa-heart me-1"></i> Save Recipe
  </button>
</form>
            <a href="recipes_catalog.php" class="btn btn-outline-danger btn-sm">
              <i class="fas fa-list me-1"></i> View All Recipes
            </a>
            <?php if (!empty($savedMessage)) echo "<p class='text-success small mt-2'>$savedMessage</p>"; ?>

          </div>
        </div>
      </div>

      <!-- Comments (Simple UI Only) -->
      <!-- Comments Section -->
<div class="card mt-5 shadow-sm">
  <div class="card-body">
    <h5 class="mb-4">Comments</h5>

    <?php if (isset($_SESSION['user'])): ?>
      <form method="POST">
        <div class="mb-3">
          <textarea name="comment" class="form-control" rows="3" required placeholder="Leave a comment..."></textarea>
        </div>
        <button name="submit_comment" type="submit" class="btn btn-sm btn-danger">Post Comment</button>
      </form>
      <hr>
    <?php else: ?>
      <p class="text-muted small">You must <a href="signin.php">sign in</a> to comment.</p>
    <?php endif; ?>

    <?php if ($comments->num_rows > 0): ?>
      <?php while ($row = $comments->fetch_assoc()): ?>
        <div class="mb-3">
          <strong><?= htmlspecialchars($row['username']) ?></strong>
          <p class="mb-1 text-muted small"><?= htmlspecialchars($row['comment']) ?></p>
          <span class="text-muted small"><?= date("M j, Y g:i A", strtotime($row['created_at'])) ?></span>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-muted">No comments yet. Be the first!</p>
    <?php endif; ?>
  </div>
</div>
      <!-- End Comments Section --> 

    </div>
  </div>
</div>




<!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-4 mt-5" id="footerSection" style="background: linear-gradient(120deg, #232526 0%, #414345 100%); border-top: 4px solid #dd2476;">
  <div class="container text-center text-md-start">
    <div class="row align-items-start">

      <!-- Brand & About -->
      <div class="col-md-4 mb-4">
        <h5 class="fw-bold text-uppercase mb-3 d-flex align-items-center">
          <i class="fas fa-utensils text-danger me-2"></i>
          <span class="text-gradient" style="font-size: 1.5rem;">CookConnect</span>
        </h5>
        <p class="text-white-50 small mb-3" style="line-height:1.7;">
          Your go-to recipe platform to explore, share, and connect with food lovers.
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
          <li class="mb-2"><a href="recipes_catalog.php" class="text-white-50 text-decoration-none fw-semibold footer-link">Recipes</a></li>
          <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none fw-semibold footer-link">Community</a></li>
          <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none fw-semibold footer-link">Learn</a></li>
          <li class="mb-2"><a href="add-recipe.php" class="text-white-50 text-decoration-none fw-semibold footer-link">Submit Recipe</a></li>
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
      &copy; <?= date("Y") ?> <span class="text-gradient fw-bold">CookConnect</span>. All rights reserved.
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
  /* Footer styling */
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
