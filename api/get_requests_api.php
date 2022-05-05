<?php
session_start();
require "../db.php";?>
<?php
header('Content-Type: application/json');

$user = htmlspecialchars($_SESSION['user']);
$sql = "";
$data = json_decode(file_get_contents("php://input"), true);
$head = $_SESSION["user"];
$sql = "SELECT * FROM Familymembers WHERE `Family Head`='$head' and `State`=-1
Order By `Join Date` DESC";

$result = $conn->query($sql);

$requests = array();

if ($result == true) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
    echo json_encode($requests);
} else {
    echo json_encode($conn->error);
}

$conn->close();