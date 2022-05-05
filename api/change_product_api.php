<?php session_start()?>
<?php require "../db.php";?>
<?php
header('Content-Type: application/json');

$user = htmlspecialchars($_SESSION['user']);
$listNum = htmlspecialchars($_POST['listNum']);
$oldID = htmlspecialchars($_POST['oldID']);
$newID = htmlspecialchars($_POST['newID']);
$isPrivateAccount = isset($_SESSION['family_name']) ? 0 : 1;

//Updating edited product name
$sql = "UPDATE usersproducts
    set `Product ID`=$newID
    where `Product ID`=$oldID and `List Number`=$listNum and `User Mail`='$user'
    and `Private Account`=$isPrivateAccount";
$result = $conn->query($sql);

if ($result == true) {
    echo json_encode(1);
} else {
    echo json_encode($conn->error);
}

// end of the file
$conn->close();