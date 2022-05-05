<?php session_start();?>
<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Products</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- font-awsome library for icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/productsStyle.css">

    <link rel="stylesheet" type="text/css" href="css/autocompleteCSS.css">

</head>

<body>

    <?php require "parts/joint.php"?>

    <!--Div containing the products -->
    <div class="container productsDiv">
        <div class="card-group">

            <div class="row">
                <div id="headerDiv">
                    <h2>Products</h2>
                </div>
                <?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card col-md-3 col-sm-4 col-6">
                    <img class="card-img-top" src="<?=$row["Image Path"]?>">

                    <div class="card-body">
                        <h6 class="card-title"><?=$row["Product Name"]?></h6>
                    </div>
                </div>
                <?php endwhile;?>



            </div>
        </div>
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

</body>

</html>