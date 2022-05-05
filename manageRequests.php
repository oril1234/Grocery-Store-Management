<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Manage Your Requests</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- font-awsome library for icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/indexStyle.css">

    <link rel="stylesheet" type="text/css" href="css/requestsStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


</head>

<body>
    <div id="app">
        <?php require "parts/joint.php"?>


        <!--Div containing header and requests details -->
        <div class="container" id="outerWrapper">
            <div class="jumbotron my-auto" style="margin:0">

                <div id="headerDiv">
                    <h2>Your Requests</h2>
                </div>
                <!--Div Containing requests details -->
                <div id="innerWrapper">

                    <!--Single request -->
                    <div class="requestDiv" v-for="(request,index) in requests">
                        <p class="content">
                            {{request.email}} sent a request to join your family </p>
                        <p class="time">{{request.request_date}}</p>
                        <button class="btnApprove fa fa-check"
                            @click="answerRequest(request, index, 1)">Approve</button>
                        <button class="btnDecline fa fa-times" @click="answerRequest(request, index, 0)"
                            style="margin-left:5%">Decline</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div style="height:100px" class="container"></div>


    <div style="padding-bottom:6%" class="footer navbar-fixed-bottom">
        <div class="container text-center">
            All rights reserved to Petek &copy;
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js">
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="js/‏‏requestsJS.js"></script>

</body>

</html>