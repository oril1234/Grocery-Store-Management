<?php
session_start();
unset($_SESSION['new_user']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Petek - Sign Up</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link href="css/SignUpStyle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

</head>

<body>


    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="landing_page.php">Petek</a>
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



    <!-- Div containing sign up form-->
    <div class="container formWrapper">
        <div class="jumbotron my-auto">
            <div id="headerDiv">
                <h2>Sign Up To Petek</h2>
            </div>
            <form method="POST" id="signupForm">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="" class="form-control" placeholder="Full name" type="text" id="name">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email" class="form-control" placeholder="*Email address" type="email" id="email"
                        required="required" pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="emailVerification" class="form-control" placeholder="*Retype Email" type="email"
                        id="emailVer" required="required" pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                    </div>
                    <select class="custom-select" style="max-width: 120px;">
                        <option selected="">050</option>
                        <option value="1">052</option>
                        <option value="2">053</option>
                        <option value="3">054</option>
                        <option value="3">058</option>
                    </select>
                    <input name="" class="form-control" placeholder="Phone number" type="tel" id="phone">
                </div> <!-- form-group// -->
                <div id="success"></div>
                <!-- For success/fail messages -->
                <div class="text-center small"><label>Note: Fields with a * are mandatory</label></div>
                <button type="submit" class="btn btn-primary btn-block btn-lg"
                    id="sendMessageButton">Continue</button><br>

            </form>
        </div>
    </div>



    <!-- /.container -->
    <div class="container" style="height:100px">

    </div>

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