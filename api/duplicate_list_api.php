<?php require "../db.php";?>

<?php
session_start();

header('Content-Type: application/json');

$user = htmlspecialchars($_SESSION['user']);
$data = json_decode(file_get_contents("php://input"), true);
$listNum = htmlspecialchars($data['listNum']);
$products = json_decode($data["products"]);
$isPrivateAccount = isset($_SESSION['family_name']) ? 0 : 1;

$result = true;

//Adding all the products of the current user's list to the duplicated one
foreach ($products as $product) {
    $productID = $product->id;
    $quantity = $product->quantity;
    $sql = "INSERT INTO usersProducts Values('$user',$listNum,$productID,$quantity,0,$isPrivateAccount)";
    $result = $result == true && $conn->query($sql) == true;

    if ($result == false) {
        break;
    }

}
if ($result == true) {
    echo json_encode(1);
} else {
    echo json_encode($conn->error);
}

$conn->close();