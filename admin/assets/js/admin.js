const site_url =
  window.location.protocol +
  "//" +
  window.location.hostname +
  (window.location.port ? ":" + window.location.port + "/" : "/");

$(document).ready(function () {
  /**
      ຈັດການຂໍມູນໂຮງຮຽນ
    */

  $(document).on("change", "#level_id", function () {
    var level_id = $(this).val();

    console.log(level_id);
    debugger;

    getLevel(level_id);
  });

  function getLevel(level_id) {
    var dataString = "level_id=" + level_id;
    $.ajax({
      type: "POST",
      url: site_url + "admin/api/api.php?action=teaching&method=get-class",
      data: dataString,
      cache: false,
      success: function (html) {
        $(".getClassroom").html(html);
      },
    });
  }

  $(".schooltale-datable").DataTable();

  /*.........................ຊັ້ນຮຽນ.........................*/

  $(document).on("click", "#btn_add_level", function () {
    $(".modal-add-level").modal("show");
  });

  $(document).on("click", ".show_modal_update_level", function () {
    var get_edit_level_id = $(this).attr("get_level_id");
    var get_edit_level_name = $(this).attr("get_level_name");

    $("#update_level_id").val(get_edit_level_id);
    $("#update_level_name").val(get_edit_level_name);

    $(".modal-update-level").modal("show");
  });

  /*................................add class level .............................. */

  $("#form_add_level").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      level_name: $("#level_name").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=level&method=add",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ບັນທຶກສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*..........................edit class level........................ */

  $("#form_update_level").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      update_level_id: $("#update_level_id").val(),
      update_level_name: $("#update_level_name").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=level&method=update",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ແກ້ໄຂ ສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*..........................delete class level........................ */

  $(document).on("click", ".btn_delete_level", function () {
    var level_id = $(this).attr("del_level_id");
    var dataString = { level_id: level_id };

    swal({
      title: "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້?",
      text: "ຖ້າທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ໃຫ້ກົດປຸ່ມ OK!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirm) => {
      if (confirm) {
        $.post(
          site_url + "admin/api/api.php?action=level&method=delete",
          dataString,
          function (result) {
            console.log(result);
            debugger;
            if (result === "S") {
              swal("ລຶບຂໍ້ມູນສຳແລັດ!", {
                icon: "success",
              });
              setTimeout(function () {
                location.reload();
              }, 500);
            } else {
              swal("ເກິດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
                icon: "warning",
              });
            }
          }
        );
      }
    });
  });

  /*....................
    .....ສົກຮຽນ...........
    ..............*/

  $(document).on("click", "#btn_add_sch", function () {
    $(".modal-add-sch").modal("show");
  });

  /*......................add ສົກຮຽນ.........................*/

  $("#form_add_sch").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      sch_name: $("#sch_name").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=sch&method=add",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ບັນທຶກສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................update ສົກຮຽນ.........................*/

  $(document).on("click", ".show_modal_update_sch", function () {
    var get_edit_sch_id = $(this).attr("get_sch_id");
    var get_edit_sch_name = $(this).attr("get_sch_name");

    $("#update_sch_id").val(get_edit_sch_id);
    $("#update_sch_name").val(get_edit_sch_name);

    $(".modal-update-sch").modal("show");
  });

  $("#form_update_sch").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      update_sch_id: $("#update_sch_id").val(),
      update_sch_name: $("#update_sch_name").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=sch&method=update",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ແກ້ໄຂ ສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................Delete ສົກຮຽນ.........................*/

  $(document).on("click", ".btn_delete_sch", function () {
    var sch_id = $(this).attr("del_sch_id");
    var dataString = { sch_id: sch_id };

    swal({
      title: "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້?",
      text: "ຖ້າທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ໃຫ້ກົດປຸ່ມ OK!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirm) => {
      if (confirm) {
        $.post(
          site_url + "admin/api/api.php?action=sch&method=delete",
          dataString,
          function (result) {
            console.log(result);
            debugger;
            if (result === "S") {
              swal("ລຶບຂໍ້ມູນສຳແລັດ!", {
                icon: "success",
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              swal("ເກິດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
                icon: "warning",
              });
            }
          }
        );
      }
    });
  });

  /*....................
    .....ພາກຮຽນ...........
    ..............*/

  $(document).on("click", "#btn_add_term", function () {
    $(".modal-add-term").modal("show");
  });

  /*......................add ພາກຮຽນ.........................*/

  $("#form_add_term").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      term_name: $("#term_name").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=term&method=add",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ບັນທຶກສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................update ພາກຮຽນ.........................*/

  $(document).on("click", ".show_modal_update_term", function () {
    var get_edit_term_id = $(this).attr("get_term_id");
    var get_edit_term_name = $(this).attr("get_term_name");

    $("#update_term_id").val(get_edit_term_id);
    $("#update_term_name").val(get_edit_term_name);

    $(".modal-update-term").modal("show");
  });

  $("#form_update_term").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      update_term_id: $("#update_term_id").val(),
      update_term_name: $("#update_term_name").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=term&method=update",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ແກ້ໄຂ ສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................Delete ພາກຮຽນ.........................*/

  $(document).on("click", ".btn_delete_term", function () {
    var term_id = $(this).attr("del_term_id");
    var dataString = { term_id: term_id };

    swal({
      title: "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້?",
      text: "ຖ້າທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ໃຫ້ກົດປຸ່ມ OK!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirm) => {
      if (confirm) {
        $.post(
          site_url + "admin/api/api.php?action=term&method=delete",
          dataString,
          function (result) {
            console.log(result);
            debugger;
            if (result === "S") {
              swal("ລຶບຂໍ້ມູນສຳແລັດ!", {
                icon: "success",
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              swal("ເກິດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
                icon: "warning",
              });
            }
          }
        );
      }
    });
  });

  /*....................
       .....ຫ້ອງຮຽນ...........
       ..............*/

  $(document).on("click", "#btn_add_fee", function () {
    $(".modal-add-fee").modal("show");
  });

  /*......................add ຫ້ອງຮຽນ.........................*/

  $("#form_add_fee").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      price: $("#price").val(),
      sch_id: $("#sch_id").val(),
      level_id: $("#level_id").val(),
    };

    console.log(dataString);
    debugger;
    $.post(
      site_url + "admin/api/api.php?action=school-fee&method=add",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ບັນທຶກສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................Delete ຄ່າຮຽນ.........................*/
  $(document).on("click", ".btn_delete_fee", function () {
    var school_id = $(this).attr("del_fee_id");
    var dataString = { school_id: school_id };

    swal({
      title: "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້?",
      text: "ຖ້າທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ໃຫ້ກົດປຸ່ມ OK!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirm) => {
      if (confirm) {
        $.post(
          site_url + "admin/api/api.php?action=school-fee&method=delete",
          dataString,
          function (result) {
            console.log(result);
            debugger;
            if (result === "S") {
              swal("ລຶບຂໍ້ມູນສຳແລັດ!", {
                icon: "success",
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              swal("ເກິດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
                icon: "warning",
              });
            }
          }
        );
      }
    });
  });

  /*....................
       .....ຫ້ອງຮຽນ...........
       ..............*/

  $(document).on("click", "#btn_add_room", function () {
    $(".modal-add-room").modal("show");
  });

  /*......................add ຫ້ອງຮຽນ.........................*/

  $("#form_add_room").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      class_name: $("#class_name").val(),
      level_id: $("#level_id").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=room&method=add",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ບັນທຶກສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................update ຫ້ອງຮຽນ.........................*/

  $(document).on("click", ".show_modal_update_room", function () {
    var get_class_id = $(this).attr("get_room_id");
    $.post(
      site_url + "admin/api/api.php?action=room&method=view",
      { get_class_id: get_class_id },
      function (result) {
        $("#display_view_room_content").html(result);

        $(".modal-update-room").modal("show");
      }
    );
  });

  $("#form_update_room").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      update_class_id: $("#update_class_id").val(),
      update_class_name: $("#update_class_name").val(),
      update_level_id: $("#update_level_id").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=room&method=update",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ແກ້ໄຂ ສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................Delete ຫ້ອງຮຽນ.........................*/

  $(document).on("click", ".btn_delete_room", function () {
    var class_id = $(this).attr("del_room_id");
    var dataString = { class_id: class_id };

    swal({
      title: "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້?",
      text: "ຖ້າທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ໃຫ້ກົດປຸ່ມ OK!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirm) => {
      if (confirm) {
        $.post(
          site_url + "admin/api/api.php?action=room&method=delete",
          dataString,
          function (result) {
            console.log(result);
            debugger;
            if (result === "S") {
              swal("ລຶບຂໍ້ມູນສຳແລັດ!", {
                icon: "success",
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              swal("ເກິດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
                icon: "warning",
              });
            }
          }
        );
      }
    });
  });

  /*....................
      .....ວີຊາຮຽນ...........
      ..............*/

  $(document).on("click", "#btn_add_sub", function () {
    $(".modal-add-sub").modal("show");
  });

  /*......................add ວີຊາຮຽນ.........................*/

  $("#form_add_sub").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      sub_name: $("#sub_name").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=subject&method=add",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ບັນທຶກສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................update ວີຊາຮຽນ.........................*/

  $(document).on("click", ".show_modal_update_sub", function () {
    var get_edit_sub_id = $(this).attr("get_sub_id");
    var get_edit_sub_name = $(this).attr("get_sub_name");

    $("#update_sub_id").val(get_edit_sub_id);
    $("#update_sub_name").val(get_edit_sub_name);

    $(".modal-update-sub").modal("show");
  });

  $("#form_update_sub").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      update_sub_id: $("#update_sub_id").val(),
      update_sub_name: $("#update_sub_name").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=subject&method=update",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ແກ້ໄຂ ສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................Delete ວີຊາຮຽນ.........................*/

  $(document).on("click", ".btn_delete_sub", function () {
    var sub_id = $(this).attr("del_sub_id");
    var dataString = { sub_id: sub_id };

    swal({
      title: "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້?",
      text: "ຖ້າທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ໃຫ້ກົດປຸ່ມ OK!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirm) => {
      if (confirm) {
        $.post(
          site_url + "admin/api/api.php?action=subject&method=delete",
          dataString,
          function (result) {
            console.log(result);
            debugger;
            if (result === "S") {
              swal("ລຶບຂໍ້ມູນສຳແລັດ!", {
                icon: "success",
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              swal("ເກິດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
                icon: "warning",
              });
            }
          }
        );
      }
    });
  });

  /*....................
      .....ອາຈານປະຈຳວີຊາ...........
      ..............*/

  $(document).on("click", "#btn_add_teaching", function () {
    $(".modal-add-teaching").modal("show");
  });

  /*......................add ອາຈານປະຈຳວີຊາ.........................*/

  $("#form_add_teaching").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      teach_id: $("#teach_id").val(),
      sub_id: $("#sub_id").val(),
      class_id: $("#class_id").val(),
      sch_id: $("#sch_id").val(),
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "admin/api/api.php?action=teaching&method=add",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ບັນທຶກສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ວີຊານີ້ມີແລ້ວ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................update ອາຈານປະຈຳວີຊາ.........................*/

  $(document).on("click", ".show_modal_update_teaching", function () {
    var get_teaching_id = $(this).attr("get_teaching_id");
    $.post(
      site_url + "admin/api/api.php?action=teaching&method=view",
      { get_teaching_id: get_teaching_id },
      function (result) {
        $("#display_view_teaching_content").html(result);
        $(".modal-update-teaching").modal("show");
      }
    );
  });

  $("#form_update_teaching").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      teaching_id: $("#update_teaching_id").val(),
      teach_id: $("#update_teach_id").val(),
      sub_id: $("#update_sub_id").val(),
      class_id: $("#update_class_id").val(),
      sch_id: $("#update_sch_id").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=teaching&method=update",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ແກ້ໄຂ ສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................Delete ອາຈານປະຈຳວີຊາ.........................*/

  $(document).on("click", ".btn_delete_teaching", function () {
    var teaching_id = $(this).attr("del_teaching_id");
    var dataString = { teaching_id: teaching_id };

    swal({
      title: "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້?",
      text: "ຖ້າທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ໃຫ້ກົດປຸ່ມ OK!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirm) => {
      if (confirm) {
        $.post(
          site_url + "admin/api/api.php?action=teaching&method=delete",
          dataString,
          function (result) {
            console.log(result);
            debugger;
            if (result === "S") {
              swal("ລຶບຂໍ້ມູນສຳແລັດ!", {
                icon: "success",
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              swal("ເກິດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
                icon: "warning",
              });
            }
          }
        );
      }
    });
  });

  //Report Teaching
  $(document).on("click", "#btn_search_report_teaching", function () {
    var sch_id = $("#sch_year").val();
    var class_id = $("#class_id").val();

    var dataString = {
      class_id: class_id,
      sch_id: sch_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "admin/api/api.php?action=teaching&method=report-teaching",
      dataString,
      function (result) {
        $("#display_teaching_list").html(result);
        // $('#data-table-fixed-header').DataTable({
        //     "destroy": true,
        // });
      }
    );
  });

  // Print Teaching Subject
  $(document).on("click", "#btn_print_teaching", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_year").val();

    console.log(sch_id);
    debugger;

    if (sch_id == "") {
      swal("ກະລຸນາ ເລືອກສົກຮຽນ!", {
        icon: "warning",
      });
    } else {
      // window.open(site_url + '/pdf/examples/print-stock.php?from_date='+from_date+'&to_date='+to_date);

      window.open(
        site_url +
          "admin/pdf/examples/print-teaching.php?class_id=" +
          class_id +
          "&sch_id=" +
          sch_id
      );
    }
  });

  /*....................
      .....ຜູ້ໃຊ້...........
      ..............*/

  $(document).on("click", "#btn_add_user", function () {
    $(".modal-add-user").modal("show");
  });

  /*......................add ຜູ້ໃຊ້.........................*/

  $("#form_add_user").on("submit", function (e) {
    e.preventDefault();
    var dataString = {
      username: $("#username").val(),
      password: $("#password").val(),
      teach_id: $("#teach_id").val(),
      status: $("#status").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=user&method=add",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ບັນທຶກສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................update ຜູ້ໃຊ້.........................*/

  $(document).on("click", ".show_modal_update_user", function () {
    var get_user_id = $(this).attr("get_user_id");
    $.post(
      site_url + "admin/api/api.php?action=user&method=view",
      { get_user_id: get_user_id },
      function (result) {
        $("#display_view_user_content").html(result);
        $(".modal-update-user").modal("show");
      }
    );
  });

  $("#form_update_user").on("submit", function (e) {
    e.preventDefault();

    var dataString = {
      user_id: $("#update_user_id").val(),
      username: $("#update_username").val(),
      password: $("#update_password").val(),
      teach_id: $("#update_teach_id").val(),
      status: $("#update_status").val(),
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "admin/api/api.php?action=user&method=update",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ແກ້ໄຂ ສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຂໍ້ມູນນີ້ຊ້ຳກັນ", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*......................Delete ຜູ້ໃຊ້.........................*/

  $(document).on("click", ".btn_delete_user", function () {
    var user_id = $(this).attr("del_user_id");
    var dataString = { user_id: user_id };

    swal({
      title: "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້?",
      text: "ຖ້າທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ໃຫ້ກົດປຸ່ມ OK!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirm) => {
      if (confirm) {
        $.post(
          site_url + "admin/api/api.php?action=user&method=delete",
          dataString,
          function (result) {
            console.log(result);
            debugger;
            if (result === "S") {
              swal("ລຶບຂໍ້ມູນສຳແລັດ!", {
                icon: "success",
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              swal("ເກິດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
                icon: "warning",
              });
            }
          }
        );
      }
    });
  });

  /**..........................Add Score Term ....................... */

  // View Student term
  $(document).on("click", "#btn_search_student_class_term", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();

    var dataString = {
      class_id: class_id,
      sch_id: sch_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "admin/api/api.php?action=score-term&method=view-student-term",
      dataString,
      function (result) {
        $("#display_view_student_term_list").html(result);
        // $('#data-table-fixed-header').DataTable({
        //     "destroy": true,
        // });
      }
    );
  });

  // Add Score Student Term

  $(document).on("click", "#btn_add_score_student_term", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var sub_id = $("#sub_id").val();
    var term_id = $("#term_id").val();

    // ຮັບຄ່າແບບ array

    var st_id = [];
    $('input[name^="st_id"]').each(function (event) {
      st_id.push($(this).val());
    });

    var score = [];

    // $('input[name^="score"]').each(function (event) {
    //     score.push($(this).val());
    // });
    $('input[name^="score"]').each(function (event) {
      if (
        parseInt(
          Number(
            $(this)
              .val()
              .replace(/[^0-9\.-]+/g, "")
          )
        ) != 0
      ) {
        score.push(
          parseInt(
            Number(
              $(this)
                .val()
                .replace(/[^0-9\.-]+/g, "")
            )
          )
        );
      } else {
        score.push(0);
      }
    });

    var st_id_value = st_id.join(",");
    var score_values = score.join(",");

    var dataString = {
      st_id_value: st_id_value,
      score_value: score_values,
      class_id: class_id,
      sch_id: sch_id,
      sub_id: sub_id,
      term_id: term_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "admin/api/api.php?action=score-term&method=add-score-term",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ແກ້ໄຂ ສຳແລັດ", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຄະແນນວີຊານີ້ມີແລ້ວ!", {
            icon: "warning",
          });
        } else {
          swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /**.........................end.Add Score Term ....................... */

  /*.......................report score term.................... */

  // View Class Score
  $(document).on("click", "#btn_search_score_class_term", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var sub_id = $("#sub_id").val();
    var month_id = $("#month_id").val();

    var dataString = {
      class_id: class_id,
      sch_id: sch_id,
      sub_id: sub_id,
      month_id: month_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "admin/api/api.php?action=report&method=view-score-class-term",
      dataString,
      function (result) {
        $("#display_view_score_class_list").html(result);

        console.log(result);
        debugger;

        if (result === "H") {
          swal("ເດືອນນີ້ຍັງບໍ່ມີຄະແນນວີຊານີ້!", {
            icon: "warning",
          });
        }
      }
    );
  });

  // Print Student Score
  $(document).on("click", "#btn_print_score_class_term", function () {
    debugger;

    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var sub_id = $("#sub_id").val();
    var month_id = $("#month_id").val();

    console.log(sch_id);
    debugger;

    if (sch_id == "") {
      swal("ກະລຸນາ ເລືອກສົກຮຽນ!", {
        icon: "warning",
      });
    } else {
      // window.open(site_url + '/pdf/examples/print-stock.php?from_date='+from_date+'&to_date='+to_date);

      window.open(
        site_url +
          "admin/pdf/examples/print-score-term.php?sch_id=" +
          sch_id +
          "&sub_id=" +
          sub_id +
          "&class_id=" +
          class_id +
          "&month=" +
          month_id
      );
    }
  });

  /*......................update score.........................*/

  $(document).on("click", ".show_modal_update_score_term", function () {
    var score_id = $(this).attr("get_score_id");

    console.log(score_id);
    debugger;

    $.post(
      site_url +
        "admin/api/api.php?action=score-term&method=view-score-update-term",
      { score_id: score_id },
      function (result) {
        $("#display_view_update_score_term_content").html(result);
        $(".modal-update-score-term").modal("show");
      }
    );
  });

  $("#form_update_score_term").on("submit", function (e) {
    e.preventDefault();

    var dataString = {
      score_id: $("#update_score_id").val(),
      score: $("#update_score").val(),
    };
    $.post(
      site_url + "admin/api/api.php?action=score-term&method=update-score-term",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("Success full!", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 500);
        } else if (result === "H") {
          swal("Already taken!", {
            icon: "warning",
          });
        } else {
          swal("Something went wrong!", {
            icon: "warning",
          });
        }
      }
    );
  });

  /*............................end report score term.............................. */

  // View Class Score
  $(document).on("click", "#btn_search_score_class", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var sub_id = $("#sub_id").val();
    var month_id = $("#month_id").val();

    var dataString = {
      class_id: class_id,
      sch_id: sch_id,
      sub_id: sub_id,
      month_id: month_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "admin/api/api.php?action=report&method=view-score-class",
      dataString,
      function (result) {
        $("#display_view_score_class_list").html(result);
        // $('#data-table-fixed-header').DataTable({
        //     "destroy": true,
        // });

        console.log(result);
        debugger;

        if (result === "H") {
          swal("ເດືອນນີ້ຍັງບໍ່ມີຄະແນນວີຊານີ້!", {
            icon: "warning",
          });
        }
      }
    );
  });

  // Print Student Score
  $(document).on("click", "#btn_print_score_class", function () {
    debugger;

    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var sub_id = $("#sub_id").val();
    var month_id = $("#month_id").val();

    console.log(sch_id);
    debugger;

    if (sch_id == "") {
      swal("ກະລຸນາ ເລືອກສົກຮຽນ!", {
        icon: "warning",
      });
    } else {
      // window.open(site_url + '/pdf/examples/print-stock.php?from_date='+from_date+'&to_date='+to_date);

      window.open(
        site_url +
          "admin/pdf/examples/print-score-class.php?sch_id=" +
          sch_id +
          "&sub_id=" +
          sub_id +
          "&class_id=" +
          class_id +
          "&month=" +
          month_id
      );
    }
  });

  // View Student

  $(document).on("change", "#class_id", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();

    var dataString = {
      class_id: class_id,
      sch_id: sch_id,
    };

    console.log(dataString);
    debugger;

    $.ajax({
      type: "POST",
      url: site_url + "admin/api/api.php?action=report&method=get-student",
      data: dataString,
      cache: false,
      success: function (html) {
        $(".getStudent").html(html);

        console.log(html);
        debugger;
      },
    });
  });

  // View Score Student
  $(document).on("click", "#btn_search_score_student", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var st_id = $("#st_id").val();
    var month_id = $("#month_id").val();

    var dataString = {
      st_id: st_id,
      class_id: class_id,
      sch_id: sch_id,
      month_id: month_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "admin/api/api.php?action=report&method=view-score-student",
      dataString,
      function (result) {
        $("#display_view_score_student_list").html(result);
        // $('#data-table-fixed-header').DataTable({
        //     "destroy": true,
        // });

        console.log(result);
        debugger;

        if (result === "H") {
          swal("ເດືອນນີ້ຍັງບໍ່ມີຄະແນນວີຊານີ້!", {
            icon: "warning",
          });
        }
      }
    );
  });

  // Print Score Student
  $(document).on("click", "#btn_print_score_student", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var st_id = $("#st_id").val();
    var month_id = $("#month_id").val();

    console.log(sch_id);
    debugger;

    if (sch_id == "") {
      swal("ກະລຸນາ ເລືອກສົກຮຽນ!", {
        icon: "warning",
      });
    } else {
      // window.open(site_url + '/pdf/examples/print-stock.php?from_date='+from_date+'&to_date='+to_date);

      window.open(
        site_url +
          "admin/pdf/examples/print-score-student.php?sch_id=" +
          sch_id +
          "&st_id=" +
          st_id +
          "&class_id=" +
          class_id +
          "&month=" +
          month_id
      );
    }
  });

  // Print Score Student Term
  $(document).on("click", "#btn_print_score_term_student", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var st_id = $("#st_id").val();
    var month_id = $("#month_id").val();

    console.log(sch_id);
    debugger;

    if (sch_id == "") {
      swal("ກະລຸນາ ເລືອກສົກຮຽນ!", {
        icon: "warning",
      });
    } else {
      // window.open(site_url + '/pdf/examples/print-stock.php?from_date='+from_date+'&to_date='+to_date);

      window.open(
        site_url +
          "admin/pdf/examples/print-score-term-student.php?sch_id=" +
          sch_id +
          "&st_id=" +
          st_id +
          "&class_id=" +
          class_id +
          "&month=" +
          month_id
      );
    }
  });

  /**
      ຈັດການຂໍມູນໂຮງຮຽນ
    */
});
