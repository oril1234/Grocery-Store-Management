<?php
session_start();
require "../db.php";?>
<?php

header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);
$email = htmlspecialchars($data['email']);
$status = htmlspecialchars($data['status']);

//updating approved member
if ($status == 1) {
    $sql = "UPDATE familyMembers
    SET State=0
    WHERE `Email`='$email'";
    $result = $conn->query($sql);
    if ($result == true) {
        echo json_encode(1);
    } else {
        echo json_encode($conn->error);

    }

}
//Deleting a rquest that was declined
else {
    $sql = "DELETE FROM familyMembers
    WHERE `Email`='$email'";
    $result = $conn->query($sql);
    if ($result == true) {
        echo json_encode(1);
    } else {
        echo json_encode($conn->error);
    }
}

$conn->close();