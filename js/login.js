$(document).ready(function () {
  $("#btn-login").on("click", function (e) {
    e.preventDefault();
    const username = $("#username").val();
    const password = $("#password").val();

    if (username === "" || password === "") {
      alert("Please enter your email and password.");
    } else {
      $.ajax({
        url: "session.php",
        method: "POST",
        data: {
          username: username,
          password: password,
        },
        success: function (response) {
          $("#response").html(response);
          if (response.indexOf("success") >= 0) {
            window.location = "home.php";
          }
        },
        dataType: "text",
      });
    }
  });
});
