$(document).ready(function () {
  //Header to show if family created successfully
  let successHeader =
    '<h5 class="col-12 modal-title text-center">Successful Request</h5>';

  //Content body to show if family created successfully
  let successBody = `<div class="row">
    <div class="col-2"><i class="fa fa-check message-icon success-icon"></i>
    </div>
    <div class="col-10">
        <p>Family has been successfully created.</p>
    </div>
  </div>
  `;

  //Header to show if was not created successfully
  let errorHeader = '<h5 class="col-12 modal-title text-center">Error</h5>';

  //Content body to show if family was not created successfully
  let errorBody = `<div class="row">
    <div class="col-2"><i class="fa fa-times message-icon error-icon"></i>
    </div>
    <div class="col-10">
        <p>An error occured. You have already created a family </p>
    </div>
  </div>`;

  //Submitting create family form
  $("#createFamilyForm").submit(function (e) {
    e.preventDefault();
    let familyName = $("#familyName").val();

    let pattern = new RegExp("[A-Za-z]{3}");
    if (!pattern.test(familyName)) {
      alert("The format of the family name doesn't meet the rules");
    } else {
      $.post("api/create_family_api.php", {
        familyName: familyName,
      }).done(function (response) {
        $("#createFamilyModal").modal("show");
        if (response == 1) {
          // mail was successfully sent
          $("#createFamilyModal .modal-header").html(successHeader);
          $("#createFamilyModal .modal-body").html(successBody);
        } else {
          //mail was not sent
          $("#createFamilyModal .modal-header").html(errorHeader);
          $("#createFamilyModal .modal-body").html(errorBody);
        }
      });
    }
  });
});
