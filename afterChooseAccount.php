<?php
//This page is for preventing resubmission to index.php page
session_start();
require_once "db.php";

//unset($_SESSION['family_name']);
if (isset($_POST['account_type'])) {
    $account_type = $_POST['account_type'];
    $user = $_SESSION['user'];
    if ($account_type == "family account") {
        $sql = "SELECT fm.`Email`, fm.`Family Head`, fh.`Family Name`
        from familyMembers fm join familyHeads fh
        on fm.`Family Head`=fh.`Email`
          where fm.`Email` = '$user'";

        $result = $conn->query($sql);

        if ($result == true) {
            while ($row = $result->fetch_assoc()) {

                /*
                In a case the user logged in to a family account
                he will perform actions under the name of the head of the family
                 */
                $_SESSION['user'] = $row['Family Head'];

                //Checking if the family member is also its head
                if ($_SESSION['user'] == $row['Email']) {
                    $_SESSION["family_head"] = true;
                }

                $_SESSION['family_name'] = $row['Family Name'];
            }

            //If the user has cookie, it is updated to be one that represents a family account
            if (isset($_COOKIE["cookie_id"])) {
                $private_account_flag = isset($_SESSION["family_name"]) ? 0 : 1;
                $family_head_flag = isset($_SESSION["family_head"]) ? 1 : 0;

                $cookie_id = $_COOKIE["cookie_id"];
                $sql = "UPDATE cookies
                SET `Private Account`=$private_account_flag, `Is Family Head`=$family_head_flag
                WHERE `ID`=$cookie_id";
                $conn->query($sql);
            }

        }
    }

}
$conn->close();
header("Location:index.php");