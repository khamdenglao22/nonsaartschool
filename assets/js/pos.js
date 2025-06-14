const site_url =
  window.location.protocol +
  "//" +
  window.location.hostname +
  (window.location.port ? ":" + window.location.port + "/" : "/");

$(document).ready(function () {
  /**
   * LOGIN
   * AUTHENTICATION
   */

  $("#loginForm").on("submit", function (e) {
    e.preventDefault();
    const username = $("#username").val();
    const password = $("#password").val();

    debugger;

    const data = {
      username: username,
      password: password,
    };
    $("#btn-login").attr("hidden", true);
    $("#btn-login-loading").removeAttr("hidden", true);
    $.post(site_url + "api/auth.php?action=login", data, function (result) {
      //koj bug lis no
      console.log(result);
      debugger;

      if (result === "1") {
        setTimeout(function () {
          window.location.href = site_url + "admin";
        }, 1000);
      } else if (result === "2") {
        setTimeout(function () {
          window.location.href = site_url + "teacher";
        }, 1000);
      } else if (result === "3") {
        setTimeout(function () {
          window.location.href = site_url + "technology";
        }, 1000);
      } else if (result === "4") {
        setTimeout(function () {
          window.location.href = site_url + "supper";
        }, 1000);
      } else {
        $("#btn-login").removeAttr("hidden", true);
        $("#btn-login-loading").attr("hidden", true);
        swal(
          "ຜູ້ໃຊ້ ແລະລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ ກະລຸນາລອງໃໝ່ອີກຄັ້ງ....",
          "",
          "warning"
        );
        return false;
      }
    });
  });
});
