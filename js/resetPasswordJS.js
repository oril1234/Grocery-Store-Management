$(document).ready(function () {
  //Header shows when email wast sent successfully
  let successHeader =
    '<h5 class="col-12 modal-title text-center">Successful Reset</h5>';

  //Content body shows when email was sent successfully
  let successBody = `<div class="row">
  <div class="col-2"><i class="fa fa-check message-icon success-icon"></i>
  </div>
  <div class="col-10">
      <p>Thank you. A mail with your new temporary password was just sent to you </p>
  </div>
</div>
`;

  //Header shows when email was not sent successfully
  let errorHeader = '<h5 class="col-12 modal-title text-center">Error</h5>';

  //Content body shows when email was not sent successfully
  let errorBody = `<div class="row">
  <div class="col-2"><i class="fa fa-times message-icon error-icon"></i>
  </div>
  <div class="col-10">
      <p>An error occured. Email could not be sent </p>
  </div>
</div>`;

  //Handling reset password form submit
  $("#resetPasswordForm").submit(function (e) {
    //Generating a random password composed of a-z, A-Z, and 0-9
    let email = $("#userEmail").val();
    let password = "";
    let characters =
      "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let charactersLength = characters.length;
    for (let i = 0; i < 5; i++) {
      password += characters.charAt(
        Math.floor(Math.random() * charactersLength)
      );
    }
    $.post("api/reset_password_api.php", {
      email: email,
      password: password,
    }).done(function (response) {
      if (response == 1) {
        // mail was successfully sent
        $("#resetPassModal .modal-header").html(successHeader);
        $("#resetPassModal .modal-body").html(successBody);
        $("#resetPassModal").modal("show");
      } else {
        //mail was not sent
        $("#resetPassModal .modal-header").html(errorHeader);
        $("#resetPassModal .modal-body").html(errorBody);
        $("#resetPassModal").modal("show");
      }
    });

    e.preventDefault();
  });

  $("#resetPassModal").keypress(function (e) {
    // the enter key code was pressed
    if ($("#resetPassModal").hasClass("in") && e.which == 13) {
      $("#continue").click();
    }
  });

  $("#continue").click(function () {
    $("#resetPassModal").modal("hide");
    if ($("#resetPassModal .modal-body i").eq(0).hasClass("success-icon")) {
      window.open("landing_page.php", "_self");
    }
  });
});
