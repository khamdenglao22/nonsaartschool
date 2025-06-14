<?php
include_once '../core/init.php';
$created = date('Y-m-d H:i:s');


/*......................ຈັດການຂໍ້ມູນໂຮງຮຽນ.........................*/

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'score') {
    $api = new Score();
    if ($_REQUEST['method'] == 'get-subject') {

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $api->SetTeacherId($_SESSION['teach_id']);
        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);
        $subject = $api->getSubject();
        echo '<option value="">...ເລືອກວິຊາ...</option>';
        foreach ($subject as $dis) {
            echo '<option value="' . $dis['sub_id'] . '">' . $dis['sub_name'] . '</option>';
        }
    } else if ($_REQUEST['method'] == 'get-class-room') {

        $level_id = htmlentities($_POST['level_id']);

        // $api->SetTeacherId($_SESSION['teach_id']);
        $api->SetLevelId($level_id);
        $class = $api->getClassroom();
        echo '<option value="">...ເລືອກຫ້ອງ...</option>';
        foreach ($class as $row) {

            echo '<option value="' . $row['class_id'] . '">' . $row['class_name'] . '</option>';
        }
    } else if ($_REQUEST['method'] == 'view-student') {


        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);


        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);

        $result = $api->getViewStudent();
?>


        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>ນັກຮຽນ</th>
                    <th>ຄະແນນ</th>


                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['st_name'] ?></td>
                        <td>
                            <input type="text" hidden id="st_id<?php echo $x . '' . $y; ?>" name="st_id[]" value="<?php echo $row['st_id'] ?>">
                            <input type="text" id="score<?php echo $x . '' . $y; ?>" name="score[]" onkeyup="this.value = formatCurrency(this.value)" get_first_id="<?php echo $x; ?>" get_second_id="<?php echo $y; ?>" class="form-control score">
                        </td>



                    </tr>

                <?php

                }
                ?>


            </tbody>
        </table>

        <div class="form-group row">
            <div class="col-md-9">

            </div>
            <div class="col-md-2">
                <label for="rp_to_date"> &nbsp;</label>
                <button class="btn btn-primary" id="btn_add_score_student" style="margin-top: 17px"> <i class="fa fa-save" aria-hidden="true"></i> ບັກທຶກຄະແນນ</button>
                <!-- <button class="btn btn-danger" id="btn_print_teaching" style="margin-top: 17px"> <i class="fa fa-print" aria-hidden="true"></i> ປິຼນ</button> -->
            </div>
        </div>

    <?php

    } else if ($_REQUEST['method'] == 'add-score') {

        $st_id = htmlentities($_POST['st_id_value']);
        $score = htmlentities($_POST['score_value']);


        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $sub_id = htmlentities($_POST['sub_id']);
        $month = htmlentities($_POST['month_id']);


        $api->SetStudentId($st_id);
        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);
        $api->SetSubjectId($sub_id);
        $api->SetScore($score);
        $api->SetMonth($month);
        $api->SetUserId($_SESSION['user_id']);


        $check = $api->getCheck();

        if ($check['cnt'] > 0) {

            echo "H";
            exit;
        }

        $result = $api->AddScore();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'view-score-update') {

        $score_id = htmlentities($_POST['score_id']);

        $api->SetScoreId($score_id);
        $result = $api->ViewScoreUpdate();

    ?>

        <input type="hidden" class="form-control" value="<?php echo $score_id ?>" id="update_score_id" name="update_score_id">


        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ນັກຮຽນ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" disabled value="<?php echo $result['st_name'] ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ຄະແນນ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" name="update_score" id="update_score" value="<?php echo $result['score'] ?>" class="form-control">
            </div>
        </div>

    <?php

    } else if ($_REQUEST['method'] == 'update-score') {

        $score_id = htmlentities($_POST['score_id']);
        $score = htmlentities($_POST['score']);

        $api->SetScoreId($score_id);
        $api->SetScore($score);
        $result = $api->UpdateScore();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}



if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'report') {
    $api = new Report();
    if ($_REQUEST['method'] == 'view-subject') {

        $sch_id = htmlentities($_POST['sch_id']);


        $api->SetTeacherId($_SESSION['teach_id']);
        $api->SetSchId($sch_id);

        $result = $api->getViewSubject();

    ?>


        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>ວີຊາ</th>
                    <th>ຫ້ອງ</th>
                    <th>ເວລາ</th>


                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['sub_name'] ?></td>
                        <td><?php echo $row['class_name'] ?></td>
                        <td><?php echo $row['time_stady'] ?></td>

                    </tr>

                <?php

                }
                ?>


            </tbody>
        </table>

    <?php


    } else if ($_REQUEST['method'] == 'view-score') {

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $sub_id = htmlentities($_POST['sub_id']);
        $month = htmlentities($_POST['month_id']);


        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);
        $api->SetSubjectId($sub_id);
        $api->SetMonth($month);
        $api->SetUserId($_SESSION['user_id']);

        $result = $api->getViewStudentScore();


        if (empty($result)) {
            echo "H";
            exit;
        }


    ?>


        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>ນັກຮຽນ</th>
                    <th>ຄະແນນ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['st_name'] ?></td>
                        <td><?php echo $row['score'] ?></td>
                        <td>

                            <a class="btn btn-secondary btn-sm show_modal_update_score" get_score_id="<?php echo $row['score_id'] ?>">
                                <i class="fas fa-edit fa-fw"></i>
                                ແກ້ໄຂ
                            </a>
                        </td>
                    </tr>

                <?php

                }
                ?>
            </tbody>
        </table>
<?php
    }
}



/*......................ຈັດການຂໍ້ມູນໂຮງຮຽນ.........................*/
