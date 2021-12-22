<?php
include_once "includes/config.php";
$confirm_user = false;
$user_id_err = $user_name_err = "";
$aciton = $_GET["action"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($aciton == "email") {
        if (isset($_POST["user_name"]) && isset($_POST["user_id"])) {
            $sql = "SELECT * FROM users";
            $users = $link->query($sql);

            $param_user_id = $_SESSION["id"];
            $param_username = trim($_POST["user_name"]);
            $param_to_user = trim($_POST["user_id"]);
            $param_letter = trim($_POST["letter"]);


            foreach ($users as $user) {
                if ($user["username"] == $param_username && $user["id"] == $param_to_user && $param_user_id != $param_to_user) {
                    $sql = "INSERT INTO `send-mail` (`id`,`user_id`, `send_to`, `letter_text`) VALUES (NULL,'$param_user_id', '$param_to_user', '$param_letter')";
                    $link->query($sql);
                    $confirm_user = true;
                }
            }

            if ($confirm_user != true) {
                $user_id_err = $user_name_err = "This user not found!";
            }
        }
    }
}

if ($aciton == "postcard") {
    if (!isset($_POST["i_agree"])) {
        $sql = "SELECT * FROM users ORDER BY RAND() LIMIT 1";
        $users = $link->query($sql);
        $users_array = [];

        foreach ($users as $user) {
            $id = $user["id"];
            $users_array[$id]["id"] = $id;
            $users_array[$id]["username"] = $user["username"];
            $users_array[$id]["country"] = $user["country"];
            $users_array[$id]["zipcode"] = $user["zipcode"];
            $_SESSION["postcard_zipcode"] = $user["zipcode"];
        }
    } else if (isset($_POST["i_agree"])) {
        $confirm_user = true;
        $users_array = [];

        $currend_user_id = $_SESSION["id"];

        $id = $_POST["id"];
        $users_array[$id]["username"] = $_POST["username"];
        $users_array[$id]["id"] = $id;
        $users_array[$id]["country"] = $_POST["country"];
        $users_array[$id]["zipcode"] = $_SESSION["postcard_zipcode"];

        $sql = "INSERT INTO `postcards` (`id`,`user_id`, `send_to_id`) VALUES (NULL, '$currend_user_id', '$id')";
        $link->query($sql);
    }
}


if ($_SESSION["loggedin"] == true) {
    if ($aciton == "email") { ?>
        <div class="container my-5">
            <?php if ($confirm_user == true) { ?>
                <div class="alert alert-success">
                    <h3 class="mb-0">successfully sent</h3>
                </div>
            <?php } ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">User nickname</label>
                    <input type="text" name="user_name" class="form-control mb-3 <?php echo (!empty($user_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo isset($param_username) ? $param_username : ""; ?>">
                    <span class="invalid-feedback"><?php echo $user_name_err; ?></span>
                </div>

                <div class="form-group">
                    <label for="">User id</label>
                    <input type="number" min="0" name="user_id" class="form-control <?php echo (!empty($user_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo isset($param_to_user) ? $param_to_user : ""; ?>">
                    <span class="invalid-feedback"><?php echo $user_id_err; ?></span>
                </div>

                <div class="form-group">
                    <label for="">Your letter</label>
                    <textarea class="form-control" name="letter"><?php echo isset($param_letter) ? $param_letter : ""; ?></textarea>
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>

                <div class="form-group mt-5">
                    <input type="submit" class="button" value="Send">
                    <input type="reset" class="ml-3" value="Reset">
                </div>
            </form>
        </div>
    <?php
    }
    if ($aciton == "postcard") { ?>
        <div class="container my-5">
            <?php if ($confirm_user == true) { ?>
                <div class="alert alert-success">
                    <h3 class="mb-0">successfully sent</h3>
                </div>
            <?php } ?>
            <form action="" method="post">
                <div class="form-group">
                    <h3>You send to:</h3>
                    <div class="d-flex">
                        <div class="row">
                            <div class="col-lg-6 mt-4">
                                <h5>Username:</h5>
                                <input type="text" value="<?= $users_array[$id]["username"]; ?>" name="username">
                            </div>
                            <div class="col-lg-6 mt-4">
                                <h5>User id:</h5>
                                <input type="text" name="id" value="<?= $users_array[$id]["id"]; ?>">
                            </div>
                            <div class="col-lg-6 mt-4">
                                <h5>Country:</h5>
                                <input type="text" name="country" value="<?= $users_array[$id]["country"]; ?>">
                            </div>
                            <div class="col-lg-6 mt-4">
                                <h5>Zip code</h5>
                                <p><?php if (isset($_POST["i_agree"])) {
                                        echo $users_array[$id]["zipcode"];
                                    } else {
                                        echo "**********";
                                    } ?></p>
                            </div>
                        </div>
                    </div>

                    <label for="i_agree" class="mt-5">
                        <input type="checkbox" name="i_agree" id="i_agree" <?php if (isset($_POST["i_agree"])) echo "checked"; ?>>
                        I agree
                    </label>
                </div>

                <div class="form-group mt-5">
                    <input type="submit" id="agreeButton" class="button" value="I agree">
                    <input type="submit" id="anotherOne" class="" value="Another one">
                </div>
            </form>
        </div>
<?php
    }
} else {
    header("location: login.php");
    exit;
}
?>