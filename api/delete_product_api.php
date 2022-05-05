<?php session_start()?>
<?php require "../db.php";?>
<?php
header('Content-Type: application/json');

$user = htmlspecialchars($_SESSION["user"]);
$data = json_decode(file_get_contents("php://input"), true);

$listNum = htmlspecialchars($data['listNum']);
$id = htmlspecialchars($data['id']);
$isPrivateAccount = isset($_SESSION['family_name']) ? 0 : 1;

//Delete a product from a specific list of user according to id number
$sql = "DELETE FROM usersproducts
    WHERE `User Mail`='$user' and `Product ID`=$id and `List Number`=$listNum and `Private Account`=$isPrivateAccount";

$result = $conn->query($sql);

if ($result == true) {
    echo json_encode(1);
} else {
    echo json_encode($conn->error);
}

// end of the file
$conn->close();