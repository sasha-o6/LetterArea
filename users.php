<?php
// include_once "includes/functions.php";
include_once "includes/config.php";

if (isset($_GET["content"])) {
    $get_query = $_GET["content"];
}

$sql1 = "SELECT * FROM users";

$user_array = $link->query($sql1);
$users;

if (isset($user_array)) {
    foreach ($user_array as $user) {
        $id = $user["id"];

        $users[$id]["id"] = $id;
        $users[$id]["name"] = $user["username"];
        $users[$id]["country"] = $user["country"];
    }
    header('Content-Type: application/json');
    echo json_encode($users);
}
