<?php require "../db.php";?>
<?php
session_start();
header('Content-Type: application/json');

$user = htmlspecialchars($_SESSION['user']);
$familyName = htmlspecialchars($_POST['familyName']);

//SQL query to check if the newly added product already exists in the specific user's list
$sql = "SELECT * FROM familyHeads WHERE `Email`='$user'";
$result = $conn->query($sql);

//Check the query result
if ($result->num_rows == 0) {
    //Adding the new family
    $sql = "INSERT INTO familyHeads Values('$user','$familyName')";
    $result = $conn->query($sql);
    $result = $result == true && $conn->query("INSERT INTO `familyMembers`
    VALUES ('$user','$user',1,now())");
    if ($result == true) {
        echo json_encode(1);
    } else {
        echo json_encode(0);
    }
} else {
    echo json_encode(0);
}

// end of the file
$conn->close();