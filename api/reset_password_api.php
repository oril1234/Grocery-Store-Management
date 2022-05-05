<?php require "../db.php";?>
<?php
header('Content-Type: application/json');

$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

$sql = "";
$sql = "SELECT * from users where `email` = '$email'";
$result = $conn->query($sql);

//current password is wrong
if ($result == false || $result->num_rows <= 0) {
    echo json_encode($conn->error);
    $conn->close();
    exit();
}

//Updating the password
$sql = "UPDATE users
SET `password`='$password'
WHERE `email`='$email'";
$result = $conn->query($sql);

if ($result == true) {
    $subject = "Password Reset";
    $body = '<html><body>';
    $body .= '<h3 >Hello ' . $email . ',</h3>';
    $body .= '<p >You have just reset your password</p>';
    $body .= '<p >The new password is: ' . $password;
    $body .= '</body></html>';
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    if (mail($email, $subject, $body, $headers)) {
        echo json_encode(1);
    } else {
        echo json_encode($conn->error);
    }

} else {
    echo json_encode($conn->error);
}

// end of the file
$conn->close();