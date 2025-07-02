<?php
session_start();
session_destroy(); // Remove all session variables
header("Location: signin.php"); // Redirect to sign-in page
exit;