<?php include_once "includes/functions.php";

// Initialize the session
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= get_url("css/style.css"); ?>">

    <title>LetterArea</title>
</head>

<body>

    <header>
        <div class="container">
            <div class="row  align-items-center">
                <div class="col-lg-2 logo">
                    <a href="<?= get_url(""); ?>" class="no-line">
                        <img src="<?= get_url("img/logo.png"); ?>" alt="site logo">
                    </a>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <nav>
                        <ul class="row justify-content-between">
                            <li><a href="<?= get_url("about.php"); ?>">About</a></li>
                            <li class="dropdown"><a href="javascript:;">Services</a>
                                <ul>
                                    <li><a href="<?= get_url("services.php/?action=postcard"); ?>">Postcard</a></li>
                                    <li><a href="<?= get_url("services.php/?action=email"); ?>">Email</a></li>
                                    <li><a href="<?= get_url("services.php/?action=santa"); ?>">Santa</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= get_url("my-lists.php"); ?>">Incoming letters</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-3 text-center d-flex align-items-center">
                    <?php
                    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) { ?>
                        <a href="<?= get_url("my-lists.php"); ?>" class="mr-1 ml-auto">My Letters</a>
                        <a href="<?= get_url("account.php"); ?>" class="button ml-auto" id="register-button">Account</a>
                    <?php } else { ?>
                        <a id="login-button" href="<?= get_url("login.php"); ?>">Log in</a>
                        <a href="<?= get_url("register.php"); ?>" class="button" id="register-button">Create an account</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>
    <main>