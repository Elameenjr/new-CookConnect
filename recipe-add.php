<?php 
    include('process.php');
    if (!isset($_SESSION['user'])) {
        header("Location: signin.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>CookConnect</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand fw-bold d-flex align-items-center" href="#!"> <i class="fas fa-utensils text-danger me-2"></i> CookConnect</a>
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
         <style>
        #submitRecipeSection {
            background: linear-gradient(120deg, #ff512f 0%, #dd2476 100%);
            color: #fff;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        #submitRecipeSection::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.18);
            z-index: 1;
        }
        #submitRecipeSection .container {
            position: relative;
            z-index: 2;
        }
        #submitRecipeSection h2, #submitRecipeSection h6, #submitRecipeSection p {
            text-shadow: 0 2px 8px rgba(0,0,0,0.08);
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
        @media (max-width: 991px) {
            #submitRecipeSection {
                padding: 70px 0 60px 0;
            }
            #submitRecipeSection h2 {
                font-size: 2.2rem;
            }
        }
        @media (max-width: 767px) {
            footer .row > div {
                text-align: center !important;
            }
            footer .d-flex.gap-3 {
                justify-content: center;
            }
        }
    </style>
        <!-- Header-->
        <section class="py-5 bg-white" id="submitRecipeSection">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-lg-8 text-center">
        <h6 class="text-uppercase  fw-bold">Share a Recipe</h6>
        <h2 class="fw-bold"><i class="fas fa-utensils fa-lg me-2"></i>Submit your favorite dish</h2>
        <p class="text-bold">Upload your recipe and inspire other food lovers in the CookConnect community.</p>
      </div>
    </div>

        <!-- Section-->
        <section class="py-5">
            <div class="container row mt-5">
                <div class="col-md-7 mx-auto">
                    <h3>Add a New Recipe</h3>
                    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
                    <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

                    <form method="POST" enctype="multipart/form-data" class="mt-4">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Difficulty</label>
                                <select name="difficulty_level" class="form-control">
                                    <option value="Easy">Easy</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Hard">Hard</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Prep Time (mins)</label>
                                <input type="text" name="prep_time" class="form-control">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Cook Time (mins)</label>
                                <input type="text" name="cook_time" class="form-control">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Servings</label>
                                <input type="text" name="servings" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Picture</label>
                                <input type="file" name="picture" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Video</label>
                                <input type="text" name="video" placeholder="Video url" class="form-control">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Ingredients</label>
                                <textarea name="ingredients" class="form-control" rows="3" placeholder="List separated by commas or lines"></textarea>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Instructions</label>
                                <textarea name="instructions" class="form-control" rows="4" placeholder="Step-by-step instructions"></textarea>
                            </div>
                            <div class="col-12">
                                <button name="addRecipe" class="btn btn-danger" type="submit">Save Recipe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-4 mt-5" id="footerSection">
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
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
