let app = new Vue({
  el: "#app",
  data() {
    return {
      members: new Array(),
      showRemoveModal: false,
      email_to_remove: "",
      tableIndex: -1,
    };
  },
  mounted: function () {
    this.getAllMembers();
  },

  methods: {
    //Get all user family members
    getAllMembers() {
      axios.post("api/get_family_members_api.php", {}).then(
        (response) => {
          $(response.data).each(function (i, member) {
            app.members.push({
              email: member["Email"],
              family_head: member["Family Head"],
              join_date: member["Join Date"],
            });
          });
        },
        (error) => {
          console.log(error);
        }
      );
    },

    //Preperaring for removal of family member
    setToRemove(member, index) {
      app.email_to_remove = member.email;
      app.tableIndex = index;
      app.showRemoveModal = true;
    },

    //Remove family member
    removeMember() {
      axios
        .post("api/delete_member_api.php", {
          email: app.email_to_remove,
        })
        .then(
          (response) => {
            if (response.data == 1) {
              app.members.splice(app.tableIndex, 1);
              app.email_to_remove = "";
              app.showRemoveModal = false;
            }
          },
          (error) => {
            alert("failure");
          }
        );
    },
  },
});
