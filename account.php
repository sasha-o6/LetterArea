<?php

include_once "includes/config.php";

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$user_id = $_SESSION["id"];

$sql_send = "SELECT * FROM `db_letterarea`.`send-mail` WHERE `user_id` = $user_id";
$sql_received = "SELECT * FROM `db_letterarea`.`send-mail` WHERE `send_to` = $user_id";

$user_info = $link->query($sql_send);
$user_info_received = $link->query($sql_received);

$user_send = mysqli_num_rows($user_info);
$user_received = mysqli_num_rows($user_info_received);

include_once "includes/header.php";
?>
<div class="container text-center pb-5">
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site. From <?php echo htmlspecialchars($_SESSION["country"]); ?></h1>
    <div class="row justify-content-center">
        <div class="col-lg-3">
            <a href="<?= get_url("change-password.php"); ?>" class="button">Change Password</a>
        </div>
        <div class="col-lg-3">
            <a href="<?= get_url("logout.php"); ?>" class="ml-4">Sign Out</a>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-lg-3">
            <h3><?= $user_send ?></h3>
            <p>sent</p>
        </div>
        <div class="col-lg-3">
            <h3><?= $user_received ?></h3>
            <p>received</p>
        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
