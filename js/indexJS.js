let app = new Vue({
  el: "#app",
  data() {
    return {
      //All products in system
      products: new Array(),

      //All the products the user ever ordered
      user_products: new Array(),

      //object for both new product and edited one
      productInput: { id: "", productName: "", quantity: "", state: 0 },

      //Array of products in table/list
      tableProducts: new Array(),

      //Array of lists number within the select element
      selectArray: new Array(),

      //The currently focused list in the select element
      selected_list: "",

      //index of computed autocomplete array
      autocomplete_index: 0,

      //index of a product in the table/list
      tableIndex: 0,

      //Header of product modal
      product_title: "",

      //True if the product modal is for adding a new product, and false if for editting
      addModal: false,

      //If true product modal for adding new product or editting existing one shows up
      showModal: false,

      //If true remove product modal shows up
      showRemoveModal: false,

      //If true, message modal for success in adding/duplicating list shows up
      showMessageModal: false,

      //Header of message modal
      message_header: "",

      //content of messafe modal
      modal_message: "",

      //True if list added/duplicated successfully
      successStatus: true,

      //If true adding new product is disabled
      disableAddProduct: true,

      //If true duplicating list is disabled
      disableDuplicateList: true,

      //If true product input field, and quantity buttons in product modal are disabled
      isDisabled: true,

      //True if product input field is focused
      onFocus: false,

      //True if product input field is not focused
      onBlur: true,
    };
  },
  mounted: function () {
    this.getAllProducts();
    this.getAllUserProducts(0);

    //For hiding the autocomplete list
    $(document).on("click", function (e) {
      if (app.onBlur) {
        app.onFocus = false;
      } else {
        app.onBlur = false;
      }
    });
  },
  computed: {
    matched() {
      if (this.productInput.productName) {
        this.productInput.productName = this.capitalize(
          this.productInput.productName
        );

        //Computed array for autocomplete
        let filteredProducts = this.user_products.filter((product) => {
          return product.productName.startsWith(this.productInput.productName);
        });
        return filteredProducts;
      } else return [];
    },
  },

  methods: {
    //Get all products in system
    getAllProducts() {
      axios.post("api/get_all_products_api.php", {}).then(
        (response) => {
          $(response.data).each(function (i, product) {
            let prName = app.capitalize(product["Product Name"]);
            let id = parseInt(product["ID"]);
            app.products.push({
              id: id,
              productName: prName,
            });
          });
        },
        (error) => {
          console.log(error);
        }
      );
    },

    //Get all user products
    getAllUserProducts(list) {
      axios
        .post("api/get_user_products_api.php", {
          list: list,
        })
        .then(
          (response) => {
            /* The user can add products if he has at least one list.
           Otherwise he will first have to create a new list        
        */
            if (response.data.length > 0) {
              app.disableDuplicateList = false;
              app.disableAddProduct = false;

              let num = 0;
              let currList = 0;
              let lastList = 0;
              $(response.data).each(function (i, product) {
                let prName = app.capitalize(product["Product Name"]);

                if (!app.validateDoesNotExists(app.user_products, prName)) {
                  app.user_products.push({
                    id: product["ID"],
                    productName: prName,
                  });
                }
                currList = parseInt(product["List Number"]); //Number of the current list
                lastList = parseInt(product["Last List"]); //Number of the last list the user created
                //A condition for opening a new list
                if (currList != num) {
                  //Adding an option to the select element representing the lists of products
                  num = currList;
                  if (list == 0) {
                    app.addList(num);
                  }
                }

                //This condition applies for fetching the products of only the currently focused list or the last list
                if (
                  list != 0 ||
                  (typeof lastList != "undefined" && currList == lastList)
                ) {
                  let addedProduct = {
                    id: product["ID"],
                    productName: prName,
                    quantity: parseInt(product["Ouantity"]),
                    state: parseInt(product["State"]),
                  };
                  //Adding the prodcuts details in the list to a table
                  app.tableProducts.push(addedProduct);
                }
              });
            } else {
              app.disableDuplicateList = true;
            }

            if (list == 0) {
              app.focusLast();
            }
          },
          (error) => {
            console.log(error);
          }
        );
    },

    //Called when in order to add new product or edit existing one
    handleProductInput() {
      if (app.addModal) {
        app.addNewProduct();
      } else {
        app.updateProductDB();
      }
    },

    //Called in order to add the new product to DB
    addNewProduct() {
      let id = app.findID(app.productInput);
      let prName = app.productInput.productName;
      if (id == "") {
        return;
      }

      axios
        .post("api/add_product_to_user_api.php", {
          id: parseInt(id),
          quantity: parseInt(app.productInput.quantity),
          listNum: parseInt(app.selected_list),
        })
        .then(
          (response) => {
            if (response.data == 1) {
              app.disableDuplicateList = false;
              app.tableProducts = [];
              app.getAllUserProducts(app.selected_list);
              app.exitModal();
            } else {
              alert(`${prName} alredy exists in your list`);
            }
            app.resetProductInput();
            app.toggleModalBtns();
          },
          (error) => {
            alert("failure");
          }
        );
    },

    //Changing state of product from bought to unbought, and vice versa
    changeState(product, index) {
      product.state = product.state == 1 ? 0 : 1;
      app.productInput = Object.assign({}, product);
      app.tableProducts.splice(index, 1);
      if (product.state == 1) {
        app.tableProducts.push(product);
        app.tableIndex = app.tableProducts.length - 1;
      } else {
        app.tableProducts.splice(0, 0, product);
        app.tableIndex = 0;
      }
      app.updateProductDB(product);
    },

    //Changing quantity of products in product modal or in table/list with buttons
    changeQuantity(product, action, fromTable) {
      if (action == "+") {
        product.quantity = parseInt(product.quantity) + 1 + "";
      } else {
        product.quantity = parseInt(product.quantity) - 1 + "";
      }
      product.quantity =
        parseInt(product.quantity) > 50 ? "50" : product.quantity;
      product.quantity =
        parseInt(product.quantity) < 1 ? "1" : product.quantity;
      if (fromTable == 1) {
        app.updateProductDB(product);
      }
    },

    //Changing quantity of products in product modal or in table/list directly in product input field
    changeQuantityMan(product, index, fromTable) {
      if (fromTable == 1) {
        app.tableIndex = index;
      }

      if (product.quantity == "") {
        product.quantity = "1";
        return;
      }
      if (parseInt(product.quantity) > 50) {
        product.quantity = "50";
      }
      if (parseInt(product.quantity) < 1) {
        product.quantity = "1";
      }
      if (fromTable == 1) {
        app.updateProductDB(product);
      }
    },

    //Preparing product input for changing a product name
    setEdited(product, index) {
      app.productInput = Object.assign({}, product);
      app.tableIndex = index;

      app.showModal = true;
      app.addModal = false;
    },

    //Updating changes of products in DB
    updateProductDB(product) {
      let newID = "";
      if (app.productInput.productName == "") {
        newID = product.id;
      }

      //Finding new id in a case of changing product name
      else {
        newID = app.findID();
      }
      if (newID == "") {
        return;
      }

      axios
        .post("api/update_product_api.php", {
          id: parseInt(app.tableProducts[app.tableIndex].id),
          newID: parseInt(newID),
          state: parseInt(app.tableProducts[app.tableIndex].state),
          quantity: parseInt(app.tableProducts[app.tableIndex].quantity),
          listNum: parseInt(app.selected_list),
        })
        .then(
          (response) => {},
          (error) => {
            alert("failure");
          }
        );
    },

    //Preparing a product in table in order to be removed
    setRemoved(index) {
      app.productInput = Object.assign({}, app.tableProducts[index]);
      app.tableIndex = index;
      app.showRemoveModal = true;
      app.addModal = false;
    },

    //Removing product from table
    removeProduct() {
      //If deleted product is the only one the user ordered
      app.disableAddProduct = true;
      app.disableDuplicateList = true;
      axios
        .post("api/delete_product_api.php", {
          id: parseInt(app.tableProducts[app.tableIndex].id),
          listNum: parseInt(app.selected_list),
        })
        .then(
          (response) => {
            if (response.data == 1) {
              app.tableProducts.splice(app.tableIndex, 1);
            }
            if (app.tableProducts.length == 0) {
              app.getAllUserProducts(0);
              app.selectArray.splice(app.selected_list - 1, 1);
            } else {
              app.disableAddProduct = false;
              app.disableDuplicateList = false;
            }
            app.resetProductInput();
            app.exitModal();
          },
          (error) => {
            alert("failure");
          }
        );
    },

    //Adding a new products list with no products
    addBlankList(event) {
      app.disableDuplicateList = true;
      event.target.blur();
      let addedList = 1;
      if (app.selectArray.length > 0) {
        addedList =
          parseInt(app.selectArray[app.selectArray.length - 1].value) + 1;
      }
      app.tableProducts = [];
      app.addList(addedList);

      this.focusLast();

      app.showMessageModal = true;
      app.message_header = "List Added";
      app.modal_message = `List number ${app.selected_list} was successfully added`;
      app.successStatus = true;
    },

    //Duplicating an existing list of products
    duplicateLists() {
      let newList = app.selectArray.length + 1;
      app.selected_list = newList + "";
      app.addList(newList);
      app.focusLast();
      axios
        .post("api/duplicate_list_api.php", {
          listNum: newList,
          products: JSON.stringify(app.tableProducts),
        })
        .then(
          (response) => {
            app.showMessageModal = true;
            app.message_header = "List Duplicated";
            app.modal_message = `List number ${app.selected_list} was successfully duplicated`;
            app.successStatus = true;
            app.tableProducts = [];
            app.getAllUserProducts(parseInt(app.selected_list));
          },
          (error) => {
            alert("An error eccured");
          }
        );
    },

    //Add new list to dropdown(select) element
    addList(param) {
      app.disableAddProduct = false;
      app.selectArray.push({ value: param, text: `List ${param}` });
    },

    //Focus the last list in dropdown
    focusLast() {
      if (app.selectArray.length > 0) {
        app.selected_list = app.selectArray[app.selectArray.length - 1].value;
      }
    },

    //Change list in dtopdown of lists
    changed() {
      app.tableProducts = [];
      app.getAllUserProducts(parseInt(app.selected_list));
    },

    //Called when autocomplete item is clicked
    itemClicked(index) {
      app.productInput.id = app.matched[index].id;
      app.productInput.productName = app.matched[index].productName;
      app.onFocus = false;
      app.autocomplete_index = -1;
    },

    //Called when esc,up,down and enter key events are triggered on product input input field
    keyDown(event) {
      if (event.keyCode == 27) {
        app.onFocus = false;
        app.onBlur = true;
        event.target.blur();
      }

      //Arrow up was pressed
      if (event.keyCode == 38) {
        app.autocomplete_index =
          app.autocomplete_index == 0
            ? app.matched.length - 1
            : app.autocomplete_index - 1;
      }

      //Arrow down was pressed
      if (event.keyCode == 40) {
        app.autocomplete_index =
          app.autocomplete_index == app.matched.length - 1
            ? 0
            : app.autocomplete_index + 1;
      }

      //Enter key was pressed
      if (event.keyCode == 13) {
        app.onBlur = true;
        event.target.blur();
        if (app.autocomplete_index >= 0) {
          app.itemClicked(app.autocomplete_index);
        }
      }
    },

    //Enabling quantity buttons and input
    toggleModalBtns() {
      app.autocomplete_index = -1;
      app.productInput.quantity = "1";
      app.isDisabled = false;
      if (app.productInput.productName == "") {
        app.isDisabled = true;
        app.productInput.quantity = "";
      }
    },

    //Exiting all the modals
    exitModal() {
      app.showModal = false;
      app.showRemoveModal = false;
      app.showMessageModal = false;
      app.resetProductInput();
      app.toggleModalBtns();
    },

    //Clearing the object of product input
    resetProductInput() {
      app.productInput = {
        id: "",
        productName: "",
        quantity: "",
        state: 0,
      };
    },

    //Capitalize every word in product input
    capitalize(string) {
      return string.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
      });
    },

    //The of a product name in the autocomplete list that doesn't contain the name input
    nameRemainder(item) {
      return item.substr(this.productInput.productName.length, item.length);
    },

    //Check if id of product input exists
    findID() {
      let id = "";
      for (let i = 0, found = false; i < app.products.length && !found; i++) {
        if (app.products[i].productName == app.productInput.productName) {
          id = app.products[i].id;
          found = true;
        }
      }
      if (id == "") {
        alert("This Product doesn't exist");
      }

      return id;
    },

    //Validating the current product doesn't already exist in the user's products lists
    validateDoesNotExists(arr, value) {
      let found = false;
      arr.forEach((element) => {
        if (element["productName"] == value) {
          found = true;
        }
      });

      return found;
    },
  },
});
