const site_url =
  window.location.protocol +
  "//" +
  window.location.hostname +
  (window.location.port ? ":" + window.location.port + "/" : "/");

$(document).ready(function () {
  /*..................ຈັດການຂໍ້ມູນໂຮງຮຽນ........................*/

  $(document).on("change", "#level_id", function () {
    var level_id = $(this).val();

    console.log(level_id);
    debugger;

    getSubject(level_id);
  });

  function getSubject(level_id) {
    var dataString = "level_id=" + level_id;
    $.ajax({
      type: "POST",
      url: site_url + "teacher/api/api.php?action=score&method=get-class-room",
      data: dataString,
      cache: false,
      success: function (html) {
        $(".getClassroom").html(html);
      },
    });
  }

  $(document).on("change", "#class_id", function () {
    var class_id = $(this).val();
    var sch_id = $("#sch_id").val();

    console.log(class_id);
    debugger;

    var dataString = {
      class_id: class_id,
      sch_id: sch_id,
    };
    console.log(dataString);
    debugger;
    $.ajax({
      type: "POST",
      url: site_url + "teacher/api/api.php?action=score&method=get-subject",
      data: dataString,
      cache: false,
      success: function (html) {
        $(".getSubject").html(html);

        console.log(html);
        debugger;
      },
    });
  });

  // View Student
  $(document).on("click", "#btn_search_student_class", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();

    var dataString = {
      class_id: class_id,
      sch_id: sch_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "teacher/api/api.php?action=score&method=view-student",
      dataString,
      function (result) {
        $("#display_view_student_list").html(result);
        // $('#data-table-fixed-header').DataTable({
        //     "destroy": true,
        // });
      }
    );
  });

  // Add Score Student

  $(document).on("click", "#btn_add_score_student", function () {
    var class_id = $("#class_id").val();
    var sch_id = $("#sch_id").val();
    var sub_id = $("#sub_id").val();
    var month_id = $("#month_id").val();

    // var dataString = {
    //     st_id:st_id,
    //     class_id: class_id,
    //     sch_id: sch_id,
    //     sub_id:sub_id,
    //     score:score,
    //     month_id:month_id
    // };

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
      month_id: month_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "teacher/api/api.php?action=score&method=add-score",
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

  /*......................update score.........................*/

  $(document).on("click", ".show_modal_update_score", function () {
    var score_id = $(this).attr("get_score_id");

    console.log(score_id);
    debugger;

    $.post(
      site_url + "teacher/api/api.php?action=score&method=view-score-update",
      { score_id: score_id },
      function (result) {
        $("#display_view_update_score_content").html(result);
        $(".modal-update-score").modal("show");
      }
    );
  });

  $("#form_update_score").on("submit", function (e) {
    e.preventDefault();

    var dataString = {
      score_id: $("#update_score_id").val(),
      score: $("#update_score").val(),
    };
    $.post(
      site_url + "teacher/api/api.php?action=score&method=update-score",
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

  // View Subject

  $(document).on("click", "#btn_search_subject", function () {
    var sch_id = $("#search_sch_id").val();

    var dataString = {
      sch_id: sch_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "teacher/api/api.php?action=report&method=view-subject",
      dataString,
      function (result) {
        $("#display_view_subject_list").html(result);
        // $('#data-table-fixed-header').DataTable({
        //     "destroy": true,
        // });
      }
    );
  });

  // print subject

  $(document).on("click", "#btn_print_subject", function () {
    var sch_id = $("#search_sch_id").val();

    console.log(sch_id);
    debugger;

    if (sch_id == "") {
      swal("ກະລຸນາ ເລືອກສົກຮຽນ!", {
        icon: "warning",
      });
    } else {
      window.open(
        site_url + "teacher/pdf/examples/print-subject.php?sch_id=" + sch_id
      );
    }
  });

  // View Student Score
  $(document).on("click", "#btn_search_score", function () {
    debugger;

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
      site_url + "teacher/api/api.php?action=report&method=view-score",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "H") {
          swal("ເດືອນນີ້ຍັງບໍ່ມີຄະແນນວີຊານີ້!", {
            icon: "warning",
          });
        } else {
          $("#display_view_score_list").html(result);
        }
      }
    );
  });

  // Print Student Score
  $(document).on("click", "#btn_print_score", function () {
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
      window.open(
        site_url +
          "teacher/pdf/examples/print-score.php?sch_id=" +
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

  /*..................ຈັດການຂໍ້ມູນໂຮງຮຽນ........................*/
});
