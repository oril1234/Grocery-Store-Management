<?php
require "db.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Petek</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- font-awsome library for icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/headerStyle.css">


</head>


<body>
    <nav class="navbar fixed-top navbar-expand-lg  fixed-top">
        <div style="lightpink" class="container-fluid">
            <a class="navbar-brand" href="index.php">Petek</a>
            <span id="connectedUser">
                <?php
if (isset($_SESSION['family_name'])) {
    echo @$_SESSION['family_name'] . ' Family';

} else {
    echo @$_SESSION['user'];
}

?>
            </span>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                <span style="color:white" class="fa fa-bars"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarResponsive">

                <ul class="navbar-nav ml-auto">

                    <!-- -->
                    <?php if (isset($_SESSION['family_head'])): ?>
                    <?php
$head = $_SESSION["user"];

$sql = "SELECT * FROM Familymembers WHERE `Family Head`='$head' and `State`=-1";
$result = $conn->query($sql);
$requests_details = $result->fetch_all();
$len = count($requests_details);

?>


                    <li class="dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown">
                            <?php if ($len > 0): ?>
                            <span class="badge">
                                <?=count($requests_details);?>
                            </span>
                            <?php endif?>
                            <i title="Requests" class="fa fa-bell" aria-hidden="true"></i></a>
                        <?php if ($len > 0): ?>
                        <ul class="dropdown-menu" style="padding-left:2px;padding-right:2px;width:425px">

                            <li><a href="manageRequests.php">You have <?=count($requests_details) . " new requests
                            to join your family"?> </a></li>

                        </ul>
                        <?php endif?>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="Products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="family.php">Manage Family</a></li>
                    <?php endif;?>

                    <?php
$user = $_SESSION['user'];
$sql = "SELECT * FROM Familymembers WHERE `Email`='$user' and state <>-1 ";
$result = $conn->query($sql);

?>
                    <!-- This accounts for a family member who is not its head -->
                    <?php if ($result->num_rows > 0 && !isset($_SESSION["family_head"])
    && isset($_SESSION["family_name"])): ?>
                    <li class="nav-item"><a class="nav-link" href="family.php">Your Family</a></li>
                    <?php endif;?>

                    <?php
$member = $_SESSION["user"];
$sql = "SELECT * FROM Familymembers WHERE `Email`='$member'";
$result = $conn->query($sql);
?>
                    <?php if ($result->num_rows == 0): ?>
                    <li class="nav-item">
                        <a class="nav-link" href=" createFamily.php" disabled> Create Family </a>
                    </li>
                    <?php endif?>

                    <?php if (!isset($_SESSION["family_name"])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="changePassword.php"> Change Password </a>
                    </li>
                    <?php endif?>
                    <li class="nav-item">
                        <a class="nav-link" id="logOut" href="./?act=logout"> Log Out </a>
                    </li>



                </ul>
            </div>


        </div>
    </nav>
</body>


</html>