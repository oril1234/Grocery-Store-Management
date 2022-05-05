<?php require "../db.php";?>
<?php
session_start();
header('Content-Type: application/json');

$user = htmlspecialchars($_SESSION['user']);
$data = json_decode(file_get_contents("php://input"), true);
$id = htmlspecialchars($data['id']);
$listNum = htmlspecialchars($data['listNum']);
$quantity = htmlspecialchars($data['quantity']);
$isPrivateAccount = isset($_SESSION['family_name']) ? 0 : 1;

//SQL query to check if the newly added product already exists in the specific user's list
$sql = "SELECT `Product ID` FROM usersProducts WHERE `User Mail`='$user' and `Product ID`=$id
and `List Number`=$listNum and `Private Account`=$isPrivateAccount";
$result = $conn->query($sql);

//Check the query result
if ($result->num_rows == 0) {
    //Adding the product to db If itdoesn't exist in the specific list
    $sql = "INSERT INTO usersProducts Values('$user',$listNum,$id,$quantity,0,$isPrivateAccount )";
    $result = $conn->query($sql);
    if ($result == true) {
        echo json_encode(1);
    } else {
        echo json_encode($conn->error);
    }
} else {
    echo json_encode(0);
}

// end of the file
$conn->close();