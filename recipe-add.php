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
        <title>Recipe App</title>
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
                <a class="navbar-brand" href="#!"> <i class="fas fa-utensils text-danger me-2"></i> CookConnect</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    </ul>
                    <?php if (isset($_SESSION['user'])) {?>
                        <a href="add-recipe.php" class="btn btn-danger mx-1"><i class="bi-plus me-1"></i> Recipe</a>
                        <a href="signout.php" class="btn btn-danger mx-1">Sign Out</a>
                    <?php }else{?>
                        <a href="signin.php" class="btn btn-danger mx-1">Sign In</a>
                    <?php } ?>
                </div>
            </div>
        </nav>
         <style>
        #submitRecipeSection {
            background: linear-gradient(to right, red, yellow);
            color: white; /* Text color for contrast */
            padding: 100px 0; /* Vertical padding for height */
            text-align: center;
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
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; CookConnect 2025  All Rights Reserved</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
