<!DOCTYPE html>
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

    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <link rel="stylesheet" type="text/css" href="css/autocompleteCSS.css">
    <link rel="stylesheet" type="text/css" href="css/indexStyle.css">


    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


</head>

<body>

    <div id="app">
        <!-- Navigation -->
        <div :class="{overlay:showModal || showRemoveModal || showMessageModal}">
            <?php require "parts/joint.php"?>
        </div>
        <!-- Page Content -->


        <div class="overlay" v-if="showModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title w-100 text-center ">{{product_title}}</h3>
                        <button class="close" @click=exitModal><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row white-div">
                            <div class="col-md-6">
                                <label for="ProductName:"><strong>Product Name:</strong> </label><br>
                                <input @blur="onBlur=true" @focus="onFocus = true; onBlur = false;" @keydown="keyDown"
                                    type="text" class="form-control" v-model="productInput.productName"
                                    @input="toggleModalBtns" autocomplete="off">
                                <div class="autocomplete-items" v-if="matched.length>0 && onFocus">
                                    <div :data-id="item.id" v-for="(item,index) in matched"
                                        :class="{autocomplete_active: index==autocomplete_index}"
                                        @click="itemClicked(index)">
                                        <span>
                                            <strong>{{productInput.productName}}</strong>{{nameRemainder(item.productName)}}</span>
                                    </div>
                                </div>
                            </div>
                            <div v-if="addModal" class="col-md-6">
                                <label for="Quantity"><strong>Quantity:</strong> </label><br>
                                <div id="qty-div-form">
                                    <button type="button" class="qty-btn" @click="changeQuantity(productInput,'-',0)"
                                        :disabled="isDisabled">-</button>
                                    <input @input="changeQuantityMan(productInput,-1,0)" id="quntityInput" type="number"
                                        class="qtyInput" max=50 min=1 v-model="productInput.quantity" required
                                        :disabled="isDisabled">
                                    <button type="button" class="qty-btn" @click="changeQuantity(productInput,'+',0)"
                                        :disabled="isDisabled">+</button>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button @click="handleProductInput" type="button" class="btn btn-success mr-auto"
                            :disabled="isDisabled"><span class="fa fa-check"></span>
                            Confirm</button>
                        <button @click="exitModal" type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- /Table with products lists  -->
        <div class="container-fluid" id="tableCont" style="padding-bottom:0;margin-top:10%">
            <div class="jumbotron">
                <div id="headerDiv" style="text-align:center">
                    <h2>Products List</h2>
                </div>

                <table id="productsTable" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            <th title="Quantity of the product" scope="col">Quantity</th>
                            <th scope="col">State</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr :class="{markBought:product.state==1}" v-for="(product,index) in tableProducts"
                            :data-id="product.id">
                            <td class="productName">{{product.productName}}</td>
                            <td class="tdQty">
                                <div class="qty-div">
                                    <button @click="changeQuantity(product,index, '-',1)"
                                        title="Decrement quantity of product" class="qty-btn">-</button>
                                    <input type="number" @input="changeQuantityMan(product,index,1)" class="qtyInput"
                                        min="1" max="50" v-model="product.quantity">
                                    <button @click="changeQuantity(product,index, '+',1)"
                                        title=" Increment quantity of product" class="qty-btn">+</button>
                                </div>
                            </td>
                            <td class="include">
                                <button v-if="product.state==0" @click="changeState(product,index)" class="buyProduct"
                                    title="Include product in bought products group">Include</button>
                                <button v-else @click="changeState(product,index)" class="buyProduct"
                                    title="Exclude product from bought products group">Exclude</button>
                            </td>
                            <td>
                                <button @click="setEdited(product,index);product_title='Edit Product'"
                                    title="Edit prodcut name" class=btnEditProductName>
                                    <span class="fa fa-pencil-square-o"></span>
                                </button>
                            </td>
                            <td>
                                <button @click="setRemoved(index)" title="Remove product from list" type="button"
                                    class="btnRemove btn btn-danger">
                                    <span style="font-size:10pt" class="fa fa-trash"></span></button>
                            </td>
                        <tr>


                    </tbody>
                </table>
            </div>
        </div>




        <!--Div that contains buttons to add products, blank or duplicated lists -->
        <div class="container-fluid" id="lastCont">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-4">
                        <button @click="showModal=true;addModal=true;product_title='Add Product'"
                            class="btn btn-primary" :disabled="disableAddProduct">
                            <span class=" fa fa-plus"></span> Add Product</button>
                    </div>
                    <div v-cloak class="col-4" id="selectDiv">
                        <label>Change list:</label><br>
                        <select @change="changed" v-model="selected_list" id="lists">
                            <option v-for="option in selectArray" :value="option.value">
                                {{option.text}}
                            </option>
                        </select>
                    </div>
                    <div class="col-4">
                        <button @click.left="addBlankList($event)" type="button" class="btn btn-primary">
                            <span class="fa fa-plus"></span> Add New List</button></td>
                    </div>

                </div>
                <div class="row">
                    <div class="col-4">

                    </div>
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary" @click="duplicateLists"
                            :disabled="disableDuplicateList">
                            <span class="fa fa-plus"></span> Duplicate List</button></td>
                    </div>

                </div>
            </div>
        </div>

        <!-- Div for removal of a product-->
        <div :class="{overlay: showRemoveModal}" v-if="showRemoveModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center ">Remove A Product</h5>
                        <button class="close" @click="exitModal"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>You are about to delete <i>{{productInput.productName}}</i> from list number
                            {{selected_list}}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button @click="removeProduct" class="btn btnRemoveConfirm btn-danger">Remove</button>
                        <button @click="exitModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Div to confirm addition of a product-->
        <div class="overlay" v-if="showMessageModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title w-100 text-center ">{{message_header}}</h3>
                    </div>
                    <div class="modal-body">
                        <div v-if="successStatus" class="row">
                            <div class="col-2"><i class="fa fa-check message-icon success-icon"></i>
                            </div>
                            <div class="col-10">
                                <p class="message-paragraph">{{modal_message}}</p>
                            </div>
                        </div>
                        <div v-else class="row">
                            <div class="col-2"><i class="fa fa-times message-icon error-icon"></i>
                            </div>
                            <div class="col-10">
                                <p class="message-paragraph">{{modal_message}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click.left="showMessageModal=false" id="continue" type="button" class="btn btn-primary"
                            style="margin: 0 auto;">Continue</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="container" style="height:30px">

    </div>

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


    <script src="js/indexJS.js"></script>


</body>
<style>

</style>

</html>