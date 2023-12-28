function validateForm() {
    var inputUsername = document.getElementById("username");
    var inputPassword = document.getElementById("password");
    if (inputUsername.value === "" || inputPassword.value === "") {
     ("Please fill in all fields.");
      return false;
    }
}