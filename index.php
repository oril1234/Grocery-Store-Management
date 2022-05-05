<?php
session_start();
require_once "db.php";
$cookie_id = null;
$private_account_flag = 1;

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

//Checking if there is a cookie with user details
if (isset($_COOKIE['cookie_id'])) {
    $cookie_id = $_COOKIE['cookie_id'];
    $sql = "SELECT * from cookies where ID = $cookie_id";
    $result = $conn->query($sql);

    if ($result == true) {
        // We have a user name that we found
        while ($row = $result->fetch_assoc()) {

            $_SESSION['user'] = $row['Email'];
            $user = $_SESSION['user'];
            $private_account_flag = $row['Private Account'];
            if ($row['Is Family Head'] == 1) {
                $_SESSION["family_head"] = true;
            }

        }

    }

}

// Verify if the user is not logged in
if (is_null($user)) {
    header("Location:landing_page.php");
    exit();
}

//family account indication from cookie
else if ($private_account_flag == 0) {
    $sql = "SELECT `Family Name`
        from familyHeads
          where `Email` = '$user'";
    $result = $conn->query($sql);

    if ($result == true) {

        // We have a user name that we found
        while ($row = $result->fetch_assoc()) {
            $_SESSION['family_name'] = $row['Family Name'];
        }

    }

}

$action = @$_GET["act"];

switch ($action) {

    case "logout":
        session_destroy();
        if (!is_null($cookie_id)) {
            $sql = "DELETE FROM cookies where `id`=$cookie_id";
            $result = $conn->query($sql);
            setcookie("cookie_id", $cookie_id, time() - 3600, "/");
        }

        header("Location:landing_page.php");
        break;

    case "cart":
        require "cart.php";
        break;

    default:
        require "cart.php";
}