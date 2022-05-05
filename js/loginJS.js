$(document).ready(function () {
  //Handle login submit event
  $("#loginForm").submit(function (e) {
    e.preventDefault();
    let email = $("#userEmail").val();
    let password = $("#userPassword").val();
    let remember = $("#remember").prop("checked");
    resetLoginForm();

    $.post("api/login_api.php", {
      email: email,
      password: password,
      remember: remember,
    }).done(function (data) {
      if (data.result == 0) {
        // User logged in successfully
        window.open("index.php", "_self");
      } else if (data.result == 1) {
        $("#loginModal").modal("hide");
        $("#chooseAccountModal .form-group p")
          .html(`Your request to join ${data.family_name} family has just
been approved. You can now choose which account you want to log in to`);
        $("#chooseAccountModal").modal("show");
      } else if (data.result == 2) {
        $("#chooseAccountModal .form-group p").html(
          `You have two types of accounts. Which one do you want to login to?`
        );
        $("#chooseAccountModal").modal("show");
      } else {
        alert("Your email or password are incorrect. please try again");
        $("#userEmail").focus();
      }
    });
  });

  //Handle reset button event
  $("#resetBtn").click(function () {
    resetLoginForm();
  });

  //Function to reset login form fields
  function resetLoginForm() {
    $("#userEmail").val("");
    $("#userPassword").val("");
  }

  $(".btnProceed").click(function () {
    $("#chooseAccountForm .btnSubmit").click();
  });
});
