<?php session_start();?>
<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create New Family</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- font-awsome library for icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css\createFamilyStyle.css">

</head>

<body>

    <!-- Navigation -->
    <?php require "parts/joint.php"?>

    <!--Div containing form for creating a family -->
    <div class="container" id="formWrapper">
        <div class="jumbotron my-auto">
            <div id="headerDiv">
                <h2>Create Family</h2>
            </div>
            <form id="createFamilyForm" method="POST">
                <div class="form-group" id="instructionsDiv">

                    <p id="instructions">Please choose a name to the created family.
                        Make sure it is at least 3 letters long</p>


                </div>
                <div class="form-group">

                    <div class="input-container input-group-lg">
                        <i class="fa fa-user icon"></i>
                        <input name="familyName" class="input-field" id="familyName" type="text"
                            placeholder="Enter the name of the family" autocomplete="off" required>
                    </div>


                </div>

                <div class="form-group">
                    <button id="confirmBtn" type="submit" class="btn btn-primary">Confirm</button>

                </div>

            </form>
        </div>
    </div>

    <!-- Div with message of status of creation of family-->
    <div class="modal hide fade in" id="createFamilyModal" tabindex="-1" role="dialog" data-keyboard="false"
        data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary  mr-auto"><a
                            style="background:transparent;text-decoration: none;color:white"
                            href="index.php">Continue</a></button>
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
    <script src="js/createFamilyJS.js"></script>

</body>

</html>