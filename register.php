<?php

// Check if the user is already logged in, if yes then redirect him to account page
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: account.php");
    exit;
}

// Include config file
require_once "includes/config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $country = $zipcode = "";
$username_err = $password_err = $confirm_password_err = $country_err = $zipcode_err =  "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate country
    if (empty(trim($_POST["country"]))) {
        $country_err = "Please choose a country.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE country = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_country);

            // Set parameters
            $param_country = trim($_POST["country"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);
                $country = trim($_POST["country"]);
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate country
    if (empty(trim($_POST["zipcode"]))) {
        $country_err = "Please choose a country.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE zipcode = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_zipcode);

            // Set parameters
            $param_zipcode = trim($_POST["zipcode"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);
                $zipcode = trim($_POST["zipcode"]);
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, country, zipcode) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_country, $param_zipcode);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_country = trim($country);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}

include_once "includes/header.php";

?>
<div class="container register">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Country</label>
            <select name="country" id="pet-select" class="form-control <?php echo (!empty($country_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $country; ?>">
                <option value="">--Please choose an option--</option>
                <option value="Ukraine">Ukraine</option>
                <option value="Poland">Poland</option>
                <option value="Belarus">Belarus</option>
                <option value="Moldova">Moldova</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Hungary">Hungary</option>
                <option value="Romania">Romania</option>
                <option value="Serbia">Serbia</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Latvia">Latvia</option>
                <option value="Austria">Austria</option>
                <option value="Estonia">Estonia</option>
                <option value="Germany">Germany</option>
                <option value="Croatia">Croatia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Italy">Italy</option>
                <option value="France">France</option>
                <option value="Spain">Spain</option>
                <option value="Portugal">Portugal</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Denmark">Denmark</option>
                <option value="Norway">Norway</option>
                <option value="Sweden">Sweden</option>
                <option value="Belgium">Belgium</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Greece">Greece</option>
                <option value="Turkey">Turkey</option>
                <option value="Georgia">Georgia</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Israel">Israel</option>
            </select>
            <!-- <input type="text" name="country" class="form-control <?php echo (!empty($country_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $country; ?>"> -->
            <span class="invalid-feedback"><?php echo $country_err; ?></span>
        </div>

        <div class="form-group">
            <label>Zip code of the mail where you will pick up the letter</label>
            <input type="text" name="zipcode" class="form-control <?php echo (!empty($zipcode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $zipcode; ?>">
            <span class="invalid-feedback"><?php echo $zipcode; ?></span>
        </div>

        <div class="form-group">
            <input type="submit" class="button" value="Submit">
            <input type="reset" class="ml-3" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
<?php
include_once "includes/footer.php";
