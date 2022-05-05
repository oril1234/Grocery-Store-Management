<?php require "../db.php";?>
<?php
session_start();
header('Content-Type: application/json');

$memberEmail = htmlspecialchars($_SESSION['registered_user']);
$headEmail = htmlspecialchars($_POST['headEmail']);

//Send request to head of family
$sql = "SELECT * from familyMembers where `Family Head` = '$headEmail'";
$result = $conn->query($sql);

if ($result == false || $result->num_rows <= 0) {
    echo json_encode($conn->error);
    $conn->close();
    exit();
}

//Add request
$sql = "INSERT INTO familyMembers Values('$memberEmail','$headEmail',-1,NOW())";
$result = $conn->query($sql);

if ($result == true) {
    unset($_SESSION['registered_user']);
    echo json_encode(1);

} else {
    echo json_encode($conn->error);
}

// end of the file

$conn->close();