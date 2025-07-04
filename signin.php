<?php include('process.php');?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
        .btn-danger {
            background: linear-gradient(90deg, #ff512f 0%, #dd2476 100%);
            border: none;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(221,36,118,0.08);
        }
        .btn-danger:hover, .btn-danger:focus {
            background: #dd2476;
            color: #fff;
        }
        .toggle-password {
            position: absolute;
            top: 0;
            right: 1rem;
            height: 100%;
            display: flex !important;
            align-items: center;
            cursor: pointer;
            z-index: 10;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4">Sign In</h4>

                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" required autofocus>
                            </div>
                            <div class="mb-3 position-relative">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control pe-5" id="signin-password" required>
                                <span class="toggle-password d-flex align-items-center" style="height:38px;" onclick="togglePassword('signin-password', this)">
                                    <i class="fa fa-eye-slash text-secondary"></i>
                                </span>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-danger" name="signin" type="submit">Login</button>
                            </div>
                        </form>
                        <p class="text-center mt-3 small">
                            Don't have an account? <a href="signup.php">Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
    function togglePassword(inputId, iconSpan) {
        const input = document.getElementById(inputId);
        const icon = iconSpan.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
    </script>
</body>
</html>