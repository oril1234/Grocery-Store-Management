<?php session_start()?>
<?php require "../db.php";?>
<?php
header('Content-Type: application/json');

$user = htmlspecialchars($_SESSION['user']);
$current = htmlspecialchars($_POST['currPass']);
$new = htmlspecialchars($_POST['newPass']);

$sql = "";
$sql = "SELECT * from users where email = '$user' AND password = '$current'";
$result = $conn->query($sql);

//current password is wrong
if ($result == false || $result->num_rows <= 0) {
    echo json_encode(0);
    exit();
}

//Updating the quantity of a specific products in a user's list
$sql = "UPDATE users
SET password=$new
WHERE `email`='$user'";

$result = $conn->query($sql);

if ($result == true) {
    echo json_encode(1);
} else {
    echo json_encode($conn->error);
}
// end of the file
$conn->close();