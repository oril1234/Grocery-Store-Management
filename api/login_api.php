<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../db.php";

$cookies = array();

$email = htmlspecialchars($_POST["email"]);
$password = htmlspecialchars($_POST["password"]);
$remember = htmlspecialchars($_POST["remember"]);

$data["result"] = -1;

$sql = "SELECT * from users where email = '$email' AND password = '$password'";
$result = $conn->query($sql);

// Verify against the database
if ($result == true && $result->num_rows > 0) {

    $data["result"] = 0;
    $_SESSION["user"] = $email;
    $data["family_name"] = "";

    $sql = "SELECT *
    from familyMembers fm join familyHeads fh on fm.`Family Head`=fh.`Email`
    where fm.Email = '$email' AND State=0";
    $result = $conn->query($sql);

    /*
    If the state of the user is 0, it means he is a family member who still didn't log in
    to his account since his request to join a family was approved
     */
    if ($result == true && $result->num_rows > 0) {
        $data["result"] = 1;
        while ($row = $result->fetch_assoc()) {
            $data["family_name"] = $row["Family Name"];
        }

        $sql = "UPDATE familyMembers
        SET State=1
        WHERE `Email`='$email'";
        $conn->query($sql);
    } else {

        $sql = "SELECT * from familyMembers where Email = '$email' AND State=1";
        $result = $conn->query($sql);

        /*
        If the state of the user is 1, it means he is a family member who
        logged in to his account at least once since he was added,
        or he's the head of a family
         */
        if ($conn->query($sql) == true && $result->num_rows > 0) {
            $data["result"] = 2;
        }

    }

    if ($remember == "true") {
        // Save a cookie with a random number as a primary key
        $id = rand(11, 125125815);
        $sql = "INSERT INTO cookies VALUES ($id, '$email',1,0 )";
        $result = $conn->query($sql);
        if ($result == true) {

            setcookie(
                "cookie_id",
                $id,
                time() + 60 * 30, // Half an hour
                "/",
            );
        } else {
            echo json_encode($conn->error);
        }

    }

}
$data["email"] = $email;
$data["password"] = $password;
$data["remember"] = $remember;
header('Content-Type: application/json');
echo json_encode($data);
$conn->close();