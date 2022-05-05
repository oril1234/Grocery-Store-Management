$(document).ready(function () {
  //Header to show if request to head of family was sent successfully
  let successHeader =
    '<h5 class="col-12 modal-title text-center">Successful Request</h5>';

  //Content body to show if request to head of family was sent successfully
  let successBody = `<div class="row">
    <div class="col-2"><i class="fa fa-check message-icon success-icon"></i>
    </div>
    <div class="col-10">
        <p>Your request has just been sent. You can be notified about it when you log in</p>
    </div>
  </div>
  `;

  //Footer to show if request to head of family was sent successfully
  let successFooter = `<button  type="button" class="btn btn-primary  mr-auto"><a 
  class="link-button" href="landing_page.php">Continue</a></button>`;

  //Header to show if request to head of family was not sent successfully
  let errorHeader = '<h5 class="col-12 modal-title text-center">Error</h5>';

  //Content body to show if request to head of family was not sent successfully
  let errorBody = `<div class="row">
    <div class="col-2"><i class="fa fa-times message-icon error-icon"></i>
    </div>
    <div class="col-10">
        <p>An error occured. Email could not be traced </p>
    </div>
  </div>`;

  //Footer to show if request to head of family was not sent successfully
  let errorFooter = `<button id="continue" type="button" class="btn btn-primary"
  style="margin: 0 auto;" data-dismiss="modal" >Continue</button>`;

  $("#joinFamilyForm").submit(function (e) {
    e.preventDefault();
    let headEmail = $("#headEmail").val();

    $.post("api/join_family_api.php", {
      headEmail: headEmail,
    }).done(function (response) {
      if (response == 1) {
        // mail was successfully sent
        $("#joinFamilyModal .modal-header").html(successHeader);
        $("#joinFamilyModal .modal-body").html(successBody);
        $("#joinFamilyModal .modal-footer").html(successFooter);
        $("#joinFamilyModal").modal("show");
      } else {
        //mail was not sent
        $("#joinFamilyModal .modal-header").html(errorHeader);
        $("#joinFamilyModal .modal-body").html(errorBody);
        $("#joinFamilyModal .modal-footer").html(errorFooter);
        $("#joinFamilyModal").modal("show");
      }
    });
  });

  $(document).on("click", "#continue", function () {
    $("#joinFamilyModal").modal("hide");
  });
});
