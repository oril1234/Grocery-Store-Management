<?php
session_start();
//Password can't be generated if no email address was posted
if (!isset($_SESSION['new_user'])) {
    header("Location:signUp.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Petek - Password</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/SignUpStyle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

</head>

<body>


    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="landing_Page.php">Petek</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                <span style="color:white" class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="signUp.php">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--Div containing password form -->
    <div class="container formWrapper">
        <div class="jumbotron">
            <div id="headerDiv">
                <h2>Password Form</h2>
            </div>
            <form id="passwordForm" method="POST">
                <input type="hidden" id="email" value="<?=$_POST['email'];?>" />
                <div class="form-header">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name="" class="form-control" placeholder="Password" type="password" id="pass"
                        required="required">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name="" class="form-control" placeholder="Confirm Password" type="password" id="confirmPass"
                        required="required">
                </div> <!-- form-group// -->
                <div id="success"></div>
                <!-- For success/fail messages -->
                <button type="submit" class="btn btn-primary btn-block btn-lg" id="loginNewUserButton">Sign
                    Up</button><br>
            </form>
        </div>
    </div>

    <div class="modal hide fade in" id="registerModal" tabindex="-1" role="dialog" data-keyboard="false"
        data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button id="continue" type="button" class="btn btn-primary" style="margin: 0 auto;">
                        Continue</button>`

                </div>
            </div>
        </div>
    </div>



    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container"><br><br>
            <p class="m-0 text-center text-white">All rights reserved to Petek &copy;</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <!-- JS Password validation-->
    <script src="js\signUpJS.js"></script>

</body>

</html>