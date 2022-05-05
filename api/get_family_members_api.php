<?php
session_start();
require "../db.php";?>
<?php
header('Content-Type: application/json');
$member = $_SESSION["user"];
$sql = "SELECT * FROM Familymembers WHERE `Family Head`='$member' and `State`=1
                    Order By `Join Date`";
$result = $conn->query($sql);

$members = array();

if ($result == true) {
    while ($row = $result->fetch_assoc()) {
        $members[] = $row;
    }
    echo json_encode($members);
} else {
    echo json_encode($conn->error);
}

$conn->close();