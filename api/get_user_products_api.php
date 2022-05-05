<?php
session_start();
require "../db.php";?>
<?php
header('Content-Type: application/json');

$user = htmlspecialchars($_SESSION['user']);
$sql = "";
$data = json_decode(file_get_contents("php://input"), true);
$list = htmlspecialchars($data['list']);
$isPrivateAccount = isset($_SESSION['family_name']) ? 0 : 1;

//Fetching the products of all the lists the user created
if ($list == 0) {
    $sql = "SELECT up.`List Number`, p.ID,p.`Product Name`, up.Ouantity,up.State,lastList.`Last List`
    FROM usersproducts up JOIN products p ON up.`Product ID`=p.ID,
    (SELECT MAX(`List Number`)`Last List`
     FROM `usersproducts`
     WHERE `Private Account`=$isPrivateAccount
     AND `User Mail`='$user'
    )lastList
    WHERE up.`User Mail`='$user'
    AND `Private Account`=$isPrivateAccount
    ORDER BY up.`List Number`, up.`State`,p.`Product Name`";

//Fetching the products of a specific list of the user
} else {
    $sql = "SELECT up.`List Number`, p.ID,p.`Product Name`, up.Ouantity,up.State
     FROM usersproducts up JOIN products p ON up.`Product ID`=p.ID
     WHERE up.`User Mail`='$user' AND up.`List Number`=$list AND `Private Account`=$isPrivateAccount
     ORDER BY up.`State`,p.`Product Name`";
}

$result = $conn->query($sql);
$products = array();

if ($result == true) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode($conn->error);
}

$conn->close();