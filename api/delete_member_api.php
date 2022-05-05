<?php session_start()?>
<?php require "../db.php";?>
<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$member = htmlspecialchars($data["email"]);

//Delete a a family member
$sql = "DELETE FROM familyMembers
    WHERE `Email`='$member'";

$result = $conn->query($sql);

if ($result == true) {
    echo json_encode(1);
} else {
    echo json_encode($conn->error);
}

// end of the file
$conn->close();