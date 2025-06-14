const site_url =
  window.location.protocol +
  "//" +
  window.location.hostname +
  (window.location.port ? ":" + window.location.port + "/" : "/");

$(document).ready(function () {
  /**
      ຈັດການຂໍມູນໂຮງຮຽນ
    */

  $(".schooltale-datable").DataTable();

  /*....................
   .....Student...........
   ..............*/

  var st_sex = "";

  $(document).on("click", "#checkbox_man", function () {
    if ($(this).is(":checked")) {
      st_sex = "ຊາຍ";
    } else {
      st_sex = "ຍິງ";
    }
  });

  $(document).on("click", "#checkbox_woman", function () {
    if ($(this).is(":checked")) {
      st_sex = "ຍິງ";
    } else {
      st_sex = "ຊາຍ";
    }
  });

  $(document).on("change", "#province_id", function () {
    var province_id = $(this).val();

    console.log(province_id);
    debugger;

    getDistrict(province_id);
  });

  function getDistrict(province_id) {
    var dataString = "id=" + province_id;
    $.ajax({
      type: "POST",
      url:
        site_url + "technology/api/api.php?action=student&method=get-district",
      data: dataString,
      cache: false,
      success: function (html) {
        $(".district").html(html);
      },
    });
  }

  $(document).on("click", "#btn_add_student", function () {
    $(".modal-add-student").modal("show");
  });

  /*......................add Student.........................*/

  $("#form_add_student").on("submit", function (e) {
    e.preventDefault();

    var dataString = {
      st_name: $("#st_name").val(),
      st_sex: $("#sex").val(),
      phone: $("#phone").val(),
      dis_id: $("#dis_id").val(),
      village: $("#village").val(),
      birthday: $("#student_date").val(),
      class_id: $("#class_id").val(),
      level_id: $("#level_id").val(),
      sch_id: $("#sch_id").val(),
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "technology/api/api.php?action=student&method=add",
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

  /*......................update Student.........................*/

  $(document).on("click", ".show_modal_update_student", function () {
    var get_student_id = $(this).attr("get_student_id");

    $.post(
      site_url + "technology/api/api.php?action=student&method=view",
      { get_student_id: get_student_id },
      function (result) {
        $("#display_view_student_content").html(result);
        $(".modal-update-student").modal("show");
      }
    );
  });

  $("#form_update_student").on("submit", function (e) {
    e.preventDefault();

    var dataString = {
      st_id: $("#update_student_id").val(),
      st_name: $("#update_student_name").val(),
      st_sex: $("#update_sex").val(),
      phone: $("#update_phone").val(),
      dis_id: $("#update_dis_id").val(),
      village: $("#update_village").val(),
      birthday: $("#update_student_date").val(),
      class_id: $("#update_class_id").val(),
      level_id: $("#update_level_id").val(),
      sch_id: $("#update_sch_id").val(),
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "technology/api/api.php?action=student&method=update",
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

  /*......................Delete Student.........................*/

  $(document).on("click", ".btn_delete_student", function () {
    var st_id = $(this).attr("del_student_id");
    var dataString = { st_id: st_id };

    swal({
      title: "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້?",
      text: "ຖ້າທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ໃຫ້ກົດປຸ່ມ OK!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirm) => {
      if (confirm) {
        $.post(
          site_url + "technology/api/api.php?action=student&method=delete",
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

  /*  .............................Teacher.............................. */

  $(document).on("click", "#btn_add_teacher", function () {
    $(".modal-add-teacher").modal("show");
  });

  /*......................add Teacher.........................*/

  $("#form_add_teacher").on("submit", function (e) {
    e.preventDefault();

    var dataString = {
      teach_name: $("#teach_name").val(),
      sex: $("#sex").val(),
      phone: $("#phone").val(),
      ethic: $("#ethic").val(),
      status: $("#status").val(),
      dis_id: $("#dis_id").val(),
      village: $("#village").val(),
      birthday: $("#teacher_date").val(),
      subject: $("#subject").val(),
      subject_level: $("#subject_level").val(),
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "technology/api/api.php?action=teacher&method=add",
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

  /*......................update Teacher.........................*/

  $(document).on("click", ".show_modal_update_teacher", function () {
    var get_teacher_id = $(this).attr("get_teacher_id");

    $.post(
      site_url + "technology/api/api.php?action=teacher&method=view",
      { get_teacher_id: get_teacher_id },
      function (result) {
        $("#display_view_teacher_content").html(result);
        $(".modal-update-teacher").modal("show");
      }
    );
  });

  $("#form_update_teacher").on("submit", function (e) {
    e.preventDefault();

    var dataString = {
      teach_id: $("#update_teacher_id").val(),
      teach_name: $("#update_teach_name").val(),
      sex: $("#update_sex").val(),
      phone: $("#update_phone").val(),
      ethic: $("#update_ethic").val(),
      status: $("#update_status").val(),
      dis_id: $("#update_dis_id").val(),
      village: $("#update_village").val(),
      birthday: $("#update_teacher_date").val(),
      subject: $("#update_subject").val(),
      subject_level: $("#update_subject_level").val(),
      position: $("#update_position").val(),
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "technology/api/api.php?action=teacher&method=update",
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

  /*......................Delete Teacher.........................*/

  $(document).on("click", ".btn_delete_teacher", function () {
    var teach_id = $(this).attr("del_teacher_id");
    var dataString = { teach_id: teach_id };

    swal({
      title: "ທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້?",
      text: "ຖ້າທ່ານຕ້ອງການລຶບຂໍ້ມູນນີ້ໃຫ້ກົດປຸ່ມ OK!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((confirm) => {
      if (confirm) {
        $.post(
          site_url + "technology/api/api.php?action=teacher&method=delete",
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

  /*  ........................End.....Teacher.............................. */

  /*................................Register................................*/

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
      url: site_url + "technology/api/api.php?action=register&method=get-class",
      data: dataString,
      cache: false,
      success: function (html) {
        $(".getClassroom").html(html);
      },
    });
  }

  $(document).on("change", "#update_level_id", function () {
    var level_id = $(this).val();

    console.log(level_id);
    debugger;

    getUpdateLevel(level_id);
  });

  function getUpdateLevel(level_id) {
    var dataString = "level_id=" + level_id;
    $.ajax({
      type: "POST",
      url: site_url + "technology/api/api.php?action=register&method=get-class",
      data: dataString,
      cache: false,
      success: function (html) {
        $(".getClassroom").html(html);
      },
    });
  }

  $(document).on("click", "#btn_view_student", function () {
    var student_code = $("#search_student_code").val();
    var dataString = {
      student_code: student_code,
    };
    console.log(dataString);

    debugger;

    if (student_code != "") {
      //Section view insured info
      $.post(
        site_url + "technology/api/api.php?action=register&method=view-student",
        dataString,
        function (data) {
          $(".member_section_empty").attr("hidden", true);
          $(".br").attr("hidden", true);
          $("#display_view_member_section_content").removeAttr("hidden");
          $("#display_view_member_section_content").html(data);
          console.log(data);

          debugger;
        }
      );
    } else {
      swal("ປ້ອນລະຫັດນັກຮຽນກ່ອນ...!", {
        icon: "warning",
      });
    }
  });

  // $.post(site_url + "technology/api/api.php?action=register&method=default-load-register",function (result) {
  //     $("#display_list_register").html(result);
  //   });

  $(document).on("click", "#btn_register", function (e) {
    e.preventDefault();

    var st_id = $("#st_id").val();
    var sch_id = $("#sch_id").val();

    var dataString = {
      st_id: $("#st_id").val(),
      class_id: $("#class_id").val(),
      level_id: $("#level_id").val(),
      sch_id: $("#sch_id").val(),
      pay: $("#pay").val(),
    };

    console.log(dataString);
    debugger;

    if (dataString.pay == "") {
      swal("ປ້ອນຄ່າຮຽນກ່ອນ...!", {
        icon: "warning",
      });
    } else {
      $.post(
        site_url + "technology/api/api.php?action=register&method=add",
        dataString,
        function (result) {
          console.log(result);
          debugger;

          if (result === "S") {
            window.open(
              site_url +
                "technology/pdf/examples/print-register.php?student_id=" +
                st_id +
                "&sch_id=" +
                sch_id
            );
            // window.open(site_url + 'technology/pdf/examples/example_001.php');
            swal("ລຶບຂໍ້ມູນສຳແລັດ!", {
              icon: "success",
            });
            setTimeout(function () {
              location.reload();
            }, 1000);
          } else if (result === "H") {
            swal("ລົງທະບຽນແລ້ວ", {
              icon: "warning",
            });
          } else if (result === "K") {
            swal("ຊັ້ນຮຽນຊ້ຳ ກະລຸນາເລືອກ ຊັ້ນຮຽນໃໝ່", {
              icon: "warning",
            });
          } else {
            swal("ເກີດຂໍຜິດພາດ ກະລຸນາກວດຄືນ!", {
              icon: "warning",
            });
          }
        }
      );
    }
  });

  /*...........................End.....Register................................*/

  /*................................MOVE Student................................*/

  $(document).on("click", "#btn_view_student_move", function () {
    var search_move_code = $("#search_move_code").val();
    var dataString = {
      search_move_code: search_move_code,
    };
    console.log(dataString);
    debugger;

    //Section view insured info
    $.post(
      site_url +
        "technology/api/api.php?action=register&method=view-student-move",
      dataString,
      function (data) {
        console.log(data);
        debugger;

        if (data === "H") {
          swal("ບໍ່ໄດ້ລົງທະບຽນ!", {
            icon: "warning",
          });
        } else {
          $(".member_section_empty").attr("hidden", true);
          $(".br").attr("hidden", true);
          $("#display_view_student_move_section_content").removeAttr("hidden");
          $("#display_view_student_move_section_content").html(data);
        }
      }
    );
  });

  $(document).on("click", "#btn_add_move_class", function (e) {
    e.preventDefault();

    var dataString = {
      st_id: $("#st_id").val(),
      class_id: $("#new_class_id").val(),
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url +
        "technology/api/api.php?action=register&method=add-move-student",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ບັນທືກຂໍ້ມູນສຳແລັດ!", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຫ້ອງເກົ່າ ກາລຸນາເລືອກຫ້ອງໃໝ່ !", {
            icon: "warning",
          });
        } else if (result === "K") {
          swal("ຊັ້ນຮຽນຊ້ຳ ກະລຸນາເລືອກ ຊັ້ນຮຽນໃໝ່", {
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

  /*................................End MOVE Student................................*/

  /*...................Update Level.....................*/

  $(document).on("click", "#btn_update_level", function (e) {
    e.preventDefault();

    var old_sch_id = $("#old_sch_id").val();
    var old_level_id = $("#old_level_id").val();
    var new_sch_id = $("#new_sch_id").val();
    var new_level_id = $("#new_level_id").val();

    var dataString = {
      old_sch_id: old_sch_id,
      old_level_id: old_level_id,
      new_sch_id: new_sch_id,
      new_level_id: new_level_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url +
        "technology/api/api.php?action=updateLevel&method=update-level",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "S") {
          swal("ບັກຂໍ້ມູນສຳແລັດ!", {
            icon: "success",
          });
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else if (result === "H") {
          swal("ຊັ້ນຮຽນມີນີ້ແລ້ວ !", {
            icon: "warning",
          });
        } else if (result === "K") {
          swal("ສົກຮຽນຊ້ຳ ກະລຸນາເລືອກ ສົກຮຽນໃໝ່", {
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

  /**......................Report....................... */

  // Print Student Score
  $(document).on("click", "#btn_print_teacher", function () {
    window.open(site_url + "technology/pdf/examples/print-teacher.php");
  });

  // View Student

  $(document).on("click", "#btn_search_student", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();

    var dataString = {
      class_id: class_id,
      sch_id: sch_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "technology/api/api.php?action=student&method=student-report",
      dataString,
      function (result) {
        $("#display_view_student_list").html(result);
        // $('#data-table-fixed-header').DataTable({
        //     "destroy": true,
        // });

        console.log(result);
        debugger;
      }
    );
  });

  // Print Student

  $(document).on("click", "#btn_print_student", function () {
    debugger;

    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();

    console.log(sch_id);
    debugger;

    if (sch_id == "") {
      swal("ກະລຸນາ ເລືອກສົກຮຽນ!", {
        icon: "warning",
      });
    } else {
      window.open(
        site_url +
          "technology/pdf/examples/print-student.php?sch_id=" +
          sch_id +
          "&class_id=" +
          class_id
      );
    }
  });

  // View Recipe

  $(document).on("click", "#btn_search_recipe", function () {
    var sch_id = $("#sch_id").val();

    var dataString = {
      sch_id: sch_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "technology/api/api.php?action=register&method=recipe-report",
      dataString,
      function (result) {
        $("#display_view_recipe_list").html(result);
        // $('#data-table-fixed-header').DataTable({
        //     "destroy": true,
        // });

        console.log(result);
        debugger;
      }
    );
  });

  // Print Recipe

  $(document).on("click", "#btn_print_recipe", function () {
    var sch_id = $("#sch_id").val();

    console.log(sch_id);
    debugger;

    if (sch_id == "") {
      swal("ກະລຸນາ ເລືອກສົກຮຽນ!", {
        icon: "warning",
      });
    } else {
      window.open(
        site_url + "technology/pdf/examples/print-recipe.php?sch_id=" + sch_id
      );
    }
  });

  // View Student Register

  $(document).on("click", "#btn_search_student_register", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var st_status = $("#st_status").val();

    var dataString = {
      class_id: class_id,
      sch_id: sch_id,
      st_status: st_status,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url +
        "technology/api/api.php?action=student&method=student-register-report",
      dataString,
      function (result) {
        $("#display_view_student_register_list").html(result);
        // $('#data-table-fixed-header').DataTable({
        //     "destroy": true,
        // });

        console.log(result);
        debugger;
      }
    );
  });

  // Print Student Register

  $(document).on("click", "#btn_print_student_register", function () {
    debugger;

    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var st_status = $("#st_status").val();

    console.log(sch_id);
    debugger;

    if (sch_id == "") {
      swal("ກະລຸນາ ເລືອກສົກຮຽນ!", {
        icon: "warning",
      });
    } else {
      window.open(
        site_url +
          "technology/pdf/examples/print-student-register.php?sch_id=" +
          sch_id +
          "&class_id=" +
          class_id +
          "&status=" +
          st_status
      );
    }
  });

  /**
                                     ຈັດການຂໍມູນໂຮງຮຽນ
    */
});
