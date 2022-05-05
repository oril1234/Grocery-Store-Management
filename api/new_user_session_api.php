<?php
session_start();
header('Content-Type: application/json');
$_SESSION['new_user'] = htmlspecialchars($_POST['email']);

echo json_encode(1);