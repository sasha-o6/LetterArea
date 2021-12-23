<?php
include_once "includes/header.php";
include_once "includes/config.php";

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo "
    <script>
        window.location = '/login.php';
    </script>
    ";
}

$aciton = $_GET["action"];
$user_id = $_SESSION["id"];

if ($aciton == "email") {
    $sql = "SELECT `send-mail`.*, users.username, users.country FROM `send-mail` JOIN `users` ON users.id = `send-mail`.`user_id` WHERE `send-mail`.`send_to` = $user_id";
    $result = $link->query($sql);
?>
    <div class="container my-5">
        <div class="row">
            <?php
            if (mysqli_num_rows($result) == 0) {
                echo "<h2 class='warning'>You dont have letters";
            } else {
                foreach ($result as $user) {
            ?>
                    <div class="card col-lg-5 my-3 py-3 px-3 margin-card">
                        <h4 class="">User <span class="ml-3"></h4>
                        <p class="mb-0 pb-4"><?= $user["username"] ?> (<?= $user["user_id"] ?>)</p>
                        <h4>Letter</h4>
                        <p class="mb-0"><?= $user["letter_text"] ?></p>
                    </div>
            <?php
                }
            }
            ?>

        </div>
    </div>
<?php
}
if ($aciton == "postcard") {
    $sql = "SELECT postcards.*, users.username, users.country FROM `postcards` JOIN `users` ON users.id = postcards.user_id WHERE postcards.send_to_id = $user_id";
    $result = $link->query($sql);
?>
    <div class="container my-5">
        <div class="row">
            <?php
            if (mysqli_num_rows($result) == 0) {
                echo "<h2 class='warning'>You dont have letters";
            } else {
                foreach ($result as $user) {
            ?>
                    <div class="card col-lg-5 my-3 py-3 px-3 margin-card">
                        <div class="row">
                            <div class="col-lg-6 px-4">
                                <h4 class="">User <span class="ml-3"></h4>
                                <p class="mb-0"><?= $user["username"] ?> (<?= $user["user_id"] ?>)</p>
                            </div>
                            <div class="col-lg-6 px-4">
                                <h4>From</h4>
                                <p class="mb-0"><?= $user["country"] ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

        </div>
    </div>
<?php
}
include_once "includes/footer.php";
