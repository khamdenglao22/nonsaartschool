const site_url =
  window.location.protocol +
  "//" +
  window.location.hostname +
  (window.location.port ? ":" + window.location.port + "/" : "/");

$(document).ready(function () {
  /*..................ຈັດການຂໍ້ມູນໂຮງຮຽນ........................*/

  // Print Student Score
  $(document).on("click", "#btn_print_teacher", function () {
    window.open(site_url + "supper/pdf/examples/print-teacher.php");
  });

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

  // report student

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
      site_url + "supper/api/api.php?action=student&method=student-report",
      dataString,
      function (result) {
        $("#display_view_student_list").html(result);
        // $('#data-table-fixed-header').DataTable({
        //     "destroy": true,
        // });
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
          "supper/pdf/examples/print-student.php?sch_id=" +
          sch_id +
          "&class_id=" +
          class_id
      );
    }
  });

  // View Score month
  $(document).on("click", "#btn_search_score_month", function () {
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
      site_url + "supper/api/api.php?action=student&method=view-score-month",
      dataString,
      function (result) {
        console.log(result);
        debugger;

        if (result === "H") {
          swal("ເດືອນນີ້ຍັງບໍ່ມີຄະແນນວີຊານີ້!", {
            icon: "warning",
          });
        } else {
          $("#display_view_score_month_list").html(result);
        }
      }
    );
  });

  // Print Score Month
  $(document).on("click", "#btn_print_score_month", function () {
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
          "supper/pdf/examples/print-score-month.php?sch_id=" +
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

  // Print Score Term
  $(document).on("click", "#btn_print_score_term", function () {
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
          "supper/pdf/examples/print-score-term.php?sch_id=" +
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

  // View Recipe

  $(document).on("click", "#btn_search_recipe", function () {
    var sch_id = $("#sch_id").val();

    var dataString = {
      sch_id: sch_id,
    };

    console.log(dataString);
    debugger;

    $.post(
      site_url + "supper/api/api.php?action=student&method=recipe-report",
      dataString,
      function (result) {
        if (result === "H") {
          swal("ລາຍຮັບໃນປີນີ້ຍັງບໍ່ມີ...!", {
            icon: "warning",
          });
        } else {
          $("#display_view_recipe_list").html(result);

          console.log(result);
          debugger;
        }
      }
    );
  });

  /*..................ຈັດການຂໍ້ມູນໂຮງຮຽນ........................*/
});
