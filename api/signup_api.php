<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../db.php";
$_SESSION['registered_user'] = $_SESSION['new_user'];
unset($_SESSION['new_user']);

$email = htmlspecialchars(@$_SESSION['registered_user']);
$password = htmlspecialchars(@$_POST['password']);

$data["result"] = 0;

// Verify against the database
if ($stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)")) {
    $stmt->bind_param("ss", $email, $password);

    $stmt->execute();
    $data["result"] = $stmt->affected_rows;
    $stmt->close();

}

$data["email"] = $email;
$data["password"] = $password;

header('Content-Type: application/json');
echo json_encode($data);