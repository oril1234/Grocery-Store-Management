<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reset Password</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- font-awsome library for icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css\custom.css">
    <link rel="stylesheet" type="text/css" href="css\ResetPasswordStyle.css">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg">
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

    <!--Div containing reset password form -->
    <div class="container" id="formWrapper">
        <div class="jumbotron my-auto">
            <div id="headerDiv">
                <h2>Reset Password</h2>
            </div>
            <form id="resetPasswordForm" method="POST" style="width:100%">
                <div class="form-group" id="instructionsDiv">

                    <p id="instructions">Please fill in your email, so we will send you a new temporary password</p>


                </div>
                <div class="form-group">

                    <div class="input-container input-group-lg">
                        <i class="fa fa-user icon"></i>
                        <input name="userEmail" autocomplete="off" id="userEmail" class="input-field" type="email"
                            placeholder="Enter your user mail" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" name="usrnm" required>
                    </div>


                </div>

                <div class="form-group">
                    <button id="confirmBtn" type="submit" class="btn btn-primary">Confirm</button>

                </div>

            </form>

        </div>
    </div>

    <!--Div containing message regrading status of reset password -->
    <div class="modal hide fade in" id="resetPassModal" tabindex="-1" role="dialog" data-keyboard="false"
        data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">


                </div>
                <div class="modal-footer">
                    <button id="continue" type="button" class="btn btn-primary"
                        style="margin: 0 auto;">Continue</button>
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
    <script src="js/resetPasswordJS.js"></script>

</body>

</html>