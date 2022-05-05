<?php session_start()?>
<?php require "../db.php";?>
<?php
header('Content-Type: application/json');

$user = htmlspecialchars($_SESSION['user']);

$data = json_decode(file_get_contents("php://input"), true);
$listNum = htmlspecialchars($data['listNum']);
$id = htmlspecialchars($data['id']);
$newID = htmlspecialchars($data['newID']);
$quantity = htmlspecialchars($data['quantity']);
$state = htmlspecialchars($data['state']);
$isPrivateAccount = isset($_SESSION['family_name']) ? 0 : 1;

//Update quantity or product state in DB
$sql = "UPDATE usersproducts set Ouantity=$quantity, state=$state, `Product ID`=$newID
 where `Product ID`=$id and `List Number`=$listNum and
  `User Mail`='$user' and `Private Account`=$isPrivateAccount";

$result = $conn->query($sql);

if ($result == true) {
    echo json_encode($quantity);
} else {
    echo json_encode($conn->error);
}

// end of the file
$conn->close();