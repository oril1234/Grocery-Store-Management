$(document).ready(function () {
  let password = $("#pass");
  let confirm_password = $("#confirmPass");
  let email = $("#email").val();
  let emailVerification = $("#emailVer").val();

  password.change(function () {
    validatePassword();
  });

  confirm_password.keyup(function () {
    validatePassword();
  });

  //Submit sign up form
  $("#signupForm").submit(function (e) {
    e.preventDefault();
    email = $("#email").val();
    emailVerification = $("#emailVer").val();
    if (email == emailVerification) {
      $.post("api/new_user_session_api.php", {
        email: email,
      }).done(function (data) {
        if (data == 1) {
          window.open("password.php", "_self");
        }
      });
    } else {
      alert("email address and its verification are not equal");
    }
  });

  function validatePassword() {
    if (password.val().length >= 5) {
      if (password.val() != confirm_password.val()) {
        confirm_password[0].setCustomValidity("Passwords Don't Match");
        return false;
      } else {
        confirm_password[0].setCustomValidity("");
        return true;
      }
    } else {
      confirm_password[0].setCustomValidity(
        "Password must be at least 5 characters"
      );
      return false;
    }
  }

  //Header to show if user was registered successfully
  let successHeader =
    '<h5 class="col-12 modal-title text-center">Successful Registration</h5>';

  //Content body to show if user was registered successfully
  let successBody = `<div class="row">
  <div class="col-2"><i class="fa fa-check icon success-icon"></i>
  </div>
  <div class="col-10">
      <p>You successfully registered to Petek! What would you like to do next? </p>
  </div>
</div>
`;

  //Footer to show if user was registered successfully
  let successFooter = `<button type="button" class="btn btn-primary" style="margin: 0 auto;">
<a class="link-button" href="landing_page.php">Go To Main Page</a></button>
<button id="continueA" type="button" class="btn btn-primary" style="margin: 0 auto;">
    <a class="link-button" href="joinFamily.php">Join A Family</a></button>`;

  //Header to show if user was not registered successfully
  let errorHeader = '<h5 class="col-12 modal-title text-center">Error</h5>';

  //Content body to show if user was registered successfully
  let errorBody = `<div class="row">
  <div class="col-2"><i class="fa fa-times icon error-icon"></i>
  </div>
  <div class="col-10">
      <p>This email already exists </p>
  </div>
</div>`;

  //Handle Sign Up submit event
  $("#passwordForm").submit(function (e) {
    e.preventDefault();

    if (validatePassword()) {
      //Request a sign up
      $.post("api/signup_api.php", {
        password: password.val(),
      }).done(function (data) {
        if (data.result == 1) {
          // User signed successfully
          $("#registerModal .modal-header").html(successHeader);
          $("#registerModal .modal-body").html(successBody);
          $("#registerModal .modal-footer").html(successFooter);
          $("#registerModal").modal("show");
        } else {
          // User failed to sign up
          $("#registerModal .modal-header").html(errorHeader);
          $("#registerModal .modal-body").html(errorBody);
          $("#registerModal").modal("show");
        }
        console.log(data);
      });
    }
  });

  $("#registerModal").keypress(function (e) {
    // the enter key code was pressed
    if ($("#registerModal").hasClass("in") && e.which == 13) {
      $("#continue").click();
    }
  });

  $("#continue").click(function () {
    $("#registerModal").modal("hide");
  });
});
