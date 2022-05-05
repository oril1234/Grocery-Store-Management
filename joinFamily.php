<?php
session_start();
if (!isset($_SESSION['registered_user'])) {
    header("Location:landing_page.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Join A Family</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- font-awsome library for icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css\custom.css">
    <link rel="stylesheet" type="text/css" href="css\joinFamilyStyle.css">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="landing_page.php">Petek</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

            </div>
        </div>
    </nav>

    <!--Div cotaining form for joining family -->
    <div class="container" id="formWrapper">
        <div class="jumbotron my-auto">
            <div id="headerDiv">
                <h2>Join A Family Request</h2>
            </div>
            <form id="joinFamilyForm" method="POST">
                <div class="form-group" id="instructionsDiv">

                    <p id="instructions">Please fill in the mail address of head of family you want to join,
                        and we will send them your request</p>


                </div>
                <div class="form-group">

                    <div class="input-container input-group-lg">
                        <i class="fa fa-user icon"></i>
                        <input name="userEmail" autocomplete="off" id="headEmail" class="input-field" type="email"
                            placeholder="Enter head of family mail" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="usrnm"
                            required>
                    </div>


                </div>

                <div class="form-group">
                    <button id="confirmBtn" type="submit" class="btn btn-primary">send Request</button>

                </div>

            </form>

        </div>
    </div>

    <!--Div containing status of sending join request to family -->
    <div class="modal hide fade in" id="joinFamilyModal" tabindex="-1" role="dialog" data-keyboard="false"
        data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary  mr-auto"><a class="link-button"
                            href="landing_page.php">Continue</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="height:100px;">

    </div>





    <div style="padding-bottom:6%" class="footer navbar-fixed-bottom">
        <div class="container text-center">
            All rights reserved to Petek &copy;
        </div>

    </div>
    <!-- Footer -->
    <!-- Bootstrap core JavaScript -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="js/joinFamilyJ.js"></script>

</body>

</html>