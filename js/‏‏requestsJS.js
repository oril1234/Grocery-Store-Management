let app = new Vue({
  el: "#app",
  data() {
    return {
      requests: new Array(),
    };
  },
  mounted: function () {
    this.getAllRequests();
  },

  methods: {
    //Get all user Requests
    getAllRequests() {
      axios.post("api/get_requests_api.php", {}).then(
        (response) => {
          $(response.data).each(function (i, member) {
            app.requests.push({
              email: member["Email"],
              family_head: member["Family Head"],
              request_date: member["Join Date"],
            });
          });
        },
        (error) => {
          console.log(error);
        }
      );
    },

    //Approval or declining of requests
    answerRequest(request, index, status) {
      axios
        .post("api/answer_request_api.php", {
          email: request.email,
          status: status,
        })
        .then(
          (response) => {
            if (response.data == 1) {
              app.requests.splice(index, 1);
              if (app.requests.length == 0) {
                $(".badge").text("");
              } else {
                $(".badge").text(`${app.requests.length}`);
              }
            }
          },
          (error) => {
            alert("failure");
          }
        );
    },
  },
});
