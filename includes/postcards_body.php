<?php
include_once "includes/config.php";
$confirm_user = false;
$user_id_err = $user_name_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

if ($_SESSION["loggedin"] == true) { ?>
    <div class="container my-5">
        <?php if ($confirm_user == true) { ?>
            <div class="alert alert-success">
                <h3 class="mb-0">successfully sent</h3>
            </div>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
} else {
    header("location: login.php");
    exit;
}
?>