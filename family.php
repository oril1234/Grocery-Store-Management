<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Your Family</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- font-awsome library for icons-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/familyStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>



</head>

<body>
    <div id="app">
        <!-- Navigation -->
        <div :class="{overlay:showRemoveModal}">
            <?php require "parts/joint.php"?>
        </div>


        <!--Table with family members -->

        <div class="container-fluid" id="tableCont">
            <div class="jumbotron">

                <div id="headerDiv">
                    <h2>Family Members</h2>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Member</th>
                            <th title="Join date of member to family" scope="col">Join Date</th>

                            <!--Add another column for removal af family member, only if the current
                     user is the family head-->
                            <?php if (isset($_SESSION['family_head'])): ?>
                            <th scope="col">Remove</th>
                            <?php endif;?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fetching the family members -->
                        <tr v-for="(member,index) in members" :data-email="member.email">
                            <td :class="{'family-head': member.family_head==member.email }">
                                {{member.email}}</td>
                            <td>{{member.join_date}}</td>
                            <td>
                                <?php if (isset($_SESSION['family_head'])): ?>
                                <button v-if="member.email!=member.family_head" @click="setToRemove(member,index)"
                                    title="Remove a member from family" type="button" class="btnRemove btn btn-danger">
                                    <span class="fa fa-trash"></span></button>
                                <?php endif;?>
                            </td>
                        </tr>


                    </tbody>
                </table>


            </div>
        </div>


        <div class="container-fluid" id="lastCont" style="height:100px">

        </div>

        <!-- This div contains the form for removing a family member -->
        <div class="overlay" v-if="showRemoveModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center ">Remove Member</h5>
                        <button type="button" class="close" @click="showRemoveModal=false">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>You are about to remove <i>{{email_to_remove}}</i> from your family list</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btnRemoveConfirm btn-danger" @click="removeMember">Remove</button>
                        <button class="btn btn-secondary" @click="showRemoveModal=false"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container -->
    <div style="padding-bottom:6%" class="footer navbar-fixed-bottom">
        <div class="container text-center">
            All rights reserved to Petek &copy;
        </div>

    </div>
    <!-- Footer -->
    <!-- Bootstrap core JavaScript -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js">
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="js/manageFamily.js"></script>

    <!-- <script src="js/indexJS.js"></script> -->

</body>

</html>