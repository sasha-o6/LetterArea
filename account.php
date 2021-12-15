<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "includes/header.php";
?>
<div class="container text-center pb-5">
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.<?php echo htmlspecialchars($_SESSION["country"]); ?></h1>
    <p>
        <a href="<?= get_url("change-password.php"); ?>" class="button">Change Password</a>
        <a href="<?= get_url("logout.php"); ?>" class="ml-4">Sign Out</a>
    </p>
</div>
<?php
include_once "includes/footer.php";
