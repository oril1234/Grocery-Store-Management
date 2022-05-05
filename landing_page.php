<?php
session_start();
unset($_SESSION['registered_user']);
unset($_SESSION['new_user']);

if (isset($_SESSION["user"])) {
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome To Petek</title>



    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="css/landingPageStyle.css">
</head>

<body>

    <nav class="navbar fixed-top navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="landing_page.php">Petek</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                <span style="color:white" class="fa fa-bars"></span>

            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-in"></i>
                            Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signUp.php"><i class="fa fa-user-plus"></i> Sign Up</a>
                    </li>


                </ul>

            </div>
        </div>
    </nav>

    <!-- Headers and sub-headers -->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading" id="upper-heading">Welcome To Petek!
            </div>
            <div class="masthead-subheading" id="middle-heading">Want to shop quickly and reliably online?
            </div>

            <div class="masthead-heading text-uppercase">You are in the right place!</div>
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#loginModal">
                Login To Start</button>
            <br><br>
            <span id="spanNotResistered">Not registered?</span> <a style="background-color:transparent"
                id="createAnAccount" class="nav-link" href="signUp.php"> Create an
                account</a>

        </div>
    </header>


    <!-- Modal of login -->
    <div class="container">
        <div class="modal" tabindex="-1" role="dialog" id="loginModal">
            <div class="modal-dialog modal-dialog-centered genericModal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title  w-100 text-center ">Login To Petek</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="loginForm" method="POST" action="index.php">
                            <div class="form-group">
                                <label><strong> Email:</strong></label>
                                <div class="input-container">
                                    <i class="fa fa-user icon"></i>
                                    <input name="userEmail" autocomplete="off" id="userEmail" class="input-field"
                                        type="text" placeholder="Enter your user mail" name="usrnm" required>
                                </div>

                            </div>
                            <div class="form-group" id="passwordDiv">
                                <label><strong> Password:</strong></label>
                                <div class="input-container">
                                    <i class="fa fa-lock icon"></i></i>
                                    <input id="userPassword" class="input-field" type="password"
                                        placeholder=" Enter your password" name="pswnm" required>
                                </div>

                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember" id="remember" value="true"> Remember
                                    me</label>
                            </div>
                            <div class="form-group" id="buttonsGroup">
                                <button type="submit" class="btn btn-primary justify-content-left">Login</button>
                                <button id="resetBtn" type="button" class="btn btn-secondary mr-auto">Reset</button>

                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a id="forgotPassword" href="resetPassword.php">I forgot my password</a>
                    </div>
                </div>
            </div>
        </div>


        <!--Div containing form for choosing kind of account the user wants to login to -->
        <div class="modal" tabindex="-1" role="dialog" id="chooseAccountModal" data-keyboard="false"
            data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered genericNodal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title  w-100 text-center ">Choose account</h3>

                    </div>
                    <div class="modal-body">
                        <form id="chooseAccountForm" method="POST" action="afterChooseAccount.php">
                            <div class="form-group">
                                <p></p>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="account_type" id="privateAccount"
                                        checked value="private account">
                                    <label class="form-check-label" for="privateAccount">
                                        Private Account
                                    </label>

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="account_type" id="familyAccount"
                                        value="family account">
                                    <label class="form-check-label" for="familyAccount">
                                        Family Account
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="d-none btnSubmit">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btnProceed btn-primary mr-auto">Proceed</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="container" style="height:200px">

    </div>

    <div style="padding-bottom:6%" class="footer navbar-fixed-bottom">
        <div class="container text-center">
            All rights reserved to Petek &copy;
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="js/loginJS.js"></script>


</body>

</html>