$(document).ready(function () {
  let currPass = $("#currPass");
  let newPass = $("#newPass");
  let confirmPass = $("#newPassConf");

  //Header to show if password changed successfully
  let successHeader =
    '<h5 class="col-12 modal-title text-center">Successful Change</h5>';

  //Content body to show if passwordchanged successfully
  let successBody = `<div class="row">
  <div class="col-2"><i class="fa fa-check message-icon success-icon"></i>
  </div>
  <div class="col-10">
      <p>You successfully changed your password. </p>
  </div>
</div>`;

  //Header to show if error occured changing password
  let errorHeader = '<h5 class="col-12 modal-title text-center">Error</h5>';

  //Content body to show if error occured changing password
  let errorCurrPassBody = `<div class="row">
  <div class="col-2"><i class="fa fa-times message-icon error-icon"></i>
  </div>
  <div class="col-10">
      <p>Current Password is wrong. </p>
  </div>
</div>`;

  //Show if anothewr error occured
  let errorNotChangedBody = `<div class="row">
  <div class="col-2"><i class="fa fa-times message-icon error-icon"></i>
  </div>
  <div class="col-10">
      <p>An error occured. Password was not changed. </p>
  </div>
</div>`;

  //Check the format of current password is valid
  function validateCurrentPassword() {
    if (currPass.val().length < 5) {
      alert("Your current password must contain at least 5 characters");
      return false;
    } else {
      return true;
    }
  }

  //Check the format of new password is valid
  function validateNewPassword() {
    if (newPass.val().length >= 5) {
      if (newPass.val() != confirmPass.val()) {
        alert("Passwords Don't Match");
        return false;
      } else {
        return true;
      }
    } else {
      alert(
        "Password must contain at least 5 characters and length is " +
          $(newPass).val().length
      );
      return false;
    }
  }

  //submitting change password form
  $("#changePasswordForm").submit(function (e) {
    if (validateCurrentPassword() && validateNewPassword()) {
      $.post("api/change_password_api.php", {
        currPass: currPass.val(),
        newPass: newPass.val(),
      }).done(function (response) {
        if (response == 1) {
          // password was successfully changed
          $("#changePassModal .modal-header").html(successHeader);
          $("#changePassModal .modal-body").html(successBody);
          $("#changePassModal").modal("show");
        } else if (response == 0) {
          //The current password is wrong
          $("#changePassModal .modal-header").html(errorHeader);
          $("#changePassModal .modal-body").html(errorCurrPassBody);
          $("#changePassModal").modal("show");
        } else {
          //Another error
          $("#changePassModal .modal-header").html(errorHeader);
          $("#changePassModal .modal-body").html(errorNotChangedBody);
          $("#changePassModal").modal("show");
        }
      });
    }
    e.preventDefault();
  });

  $("#changePassModal").keypress(function (e) {
    // the enter key code was pressed
    if ($("#changePassModal").hasClass("in") && e.which == 13) {
      $("#continue").click();
    }
  });

  $("#continue").click(function () {
    $("#changePassModal").modal("hide");
    if ($("#changePassModal .modal-body i").eq(0).hasClass("success-icon")) {
      window.open("index.php", "_self");
    }
  });
});
