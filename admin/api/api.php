<?php
include_once '../core/init.php';
$created = date('Y-m-d H:i:s');


/*......................ຈັດການຂໍ້ມູນໂຮງຮຽນ.........................*/



/*......................class level.........................*/

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'level') {
    $api = new Level();
    if ($_REQUEST['method'] == 'add') {

        //    print_r($_POST);
        //    exit();

        $level_name = htmlentities($_POST['level_name']);
        $api->SetName($level_name);

        $check = $api->getCheck();

        if ($check['cnt'] > 0) {
            echo "H";
            exit;
        }

        $result = $api->AddLevel();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'delete') {
        //        print_r($_POST);
        //        exit();
        $level_id = htmlentities($_POST['level_id']);
        $api->SetId($level_id);

        $result = $api->DeleteLevel();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'update') {

        $level_id = htmlentities($_POST['update_level_id']);
        $level_name = htmlentities($_POST['update_level_name']);

        $api->SetId($level_id);
        $api->SetName($level_name);

        $check = $api->getCheck();

        if ($check['cnt'] > 0) {
            echo "H";
            exit;
        }

        $result = $api->UpdateLevel();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}

/*......................school year.........................*/

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'sch') {
    $api = new SchoolYear();
    if ($_REQUEST['method'] == 'add') {

        $sch_name = htmlentities($_POST['sch_name']);
        $api->SetName($sch_name);

        $check = $api->getCheck();

        if ($check['cnt'] > 0) {
            echo "H";
            exit;
        }

        $result = $api->AddSchoolYear();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'delete') {

        $sch_id = htmlentities($_POST['sch_id']);
        $api->SetId($sch_id);

        $result = $api->DeleteSch();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'update') {

        $sch_id = htmlentities($_POST['update_sch_id']);
        $sch_name = htmlentities($_POST['update_sch_name']);

        $api->SetId($sch_id);
        $api->SetName($sch_name);

        $check = $api->getCheck();

        if ($check['cnt'] > 0) {
            echo "H";
            exit;
        }

        $result = $api->UpdateSch();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}

/*......................Term.........................*/

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'term') {
    $api = new Term();
    if ($_REQUEST['method'] == 'add') {

        $term_name = htmlentities($_POST['term_name']);
        $api->SetName($term_name);


        $check = $api->getCheck();

        if ($check['cnt'] > 0) {
            echo "H";
            exit;
        }

        $result = $api->AddTerm();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'delete') {

        $term_id = htmlentities($_POST['term_id']);
        $api->SetId($term_id);

        $result = $api->DeleteTerm();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'update') {

        $term_id = htmlentities($_POST['update_term_id']);
        $term_name = htmlentities($_POST['update_term_name']);

        $api->SetId($term_id);
        $api->SetName($term_name);

        $check = $api->getCheck();

        if ($check['cnt'] > 0) {
            echo "H";
            exit;
        }

        $result = $api->UpdateTerm();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}

/*......................Class Room.........................*/

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'room') {
    $api = new ClassRoom();
    if ($_REQUEST['method'] == 'add') {

        //    print_r($_POST);
        //    exit();

        $class_name = htmlentities($_POST['class_name']);
        $level_id = htmlentities($_POST['level_id']);

        $api->SetClassName($class_name);
        $api->SetLevelId($level_id);

        //   $check = $api->getCheckClass();

        //   if($check['cnt']>0){
        //     echo "H";
        //     exit;
        //    }

        $result = $api->AddClassRoom();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'delete') {

        $class_id = htmlentities($_POST['class_id']);
        $api->SetClassId($class_id);

        $result = $api->DeleteClassRoom();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'view') {

        $class_id = htmlentities($_POST['get_class_id']);
        $api->SetClassId($class_id);

        $row = $api->ViewClassRoom();
        $level = $api->getLevel();

?>

        <input type="hidden" class="form-control" value="<?php echo $class_id ?>" id="update_class_id" name="update_class_id">

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ຊັ້ນ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control  default-select2" id="update_level_id" name="update_level_id">
                    <option value="<?php echo $row['level_id'] ?>"><?php echo $row['level_name'] ?></option>
                    <?php
                    foreach ($level as $lv) {
                        echo '<option value="' . $lv['level_id'] . '">' . $lv['level_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ຊັ້ນ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" name="update_class_name" id="update_class_name" value="<?php echo $row['class_name'] ?>" class="form-control">
            </div>
        </div>



        <script>
            // $(document).ready(function(){
            //     $("#default-select2").select2();
            // });
        </script>

    <?php
    } else if ($_REQUEST['method'] == 'update') {

        //    print_r($_POST);
        //    exit();

        $class_id = htmlentities($_POST['update_class_id']);
        $class_name = htmlentities($_POST['update_class_name']);
        $level_id = htmlentities($_POST['update_level_id']);

        $api->SetClassId($class_id);
        $api->SetClassName($class_name);
        $api->SetLevelId($level_id);

        $result = $api->UpdateClassRoom();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}

/*..........................Subject.........................*/


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'subject') {
    $api = new Subject();
    if ($_REQUEST['method'] == 'add') {

        //    print_r($_POST);
        //    exit();

        $sub_name = htmlentities($_POST['sub_name']);
        $api->SetSubName($sub_name);

        $check = $api->getCheck();

        if ($check['cnt'] > 0) {
            echo "H";
            exit;
        }

        $result = $api->AddSubject();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'update') {

        $sub_id = htmlentities($_POST['update_sub_id']);
        $sub_name = htmlentities($_POST['update_sub_name']);

        $api->SetSubId($sub_id);
        $api->SetSubName($sub_name);

        $check = $api->getCheck();

        if ($check['cnt'] > 0) {
            echo "H";
            exit;
        }

        $result = $api->UpdateSubject();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'delete') {

        $sub_id = htmlentities($_POST['sub_id']);
        $api->SetSubId($sub_id);

        $result = $api->DeleteSubject();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}

/*......................User.........................*/


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'user') {
    $api = new User();
    if ($_REQUEST['method'] == 'add') {

        //    print_r($_POST);
        //    exit();

        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
        $teach_id = htmlentities($_POST['teach_id']);
        $status = htmlentities($_POST['status']);

        $api->setUsername($username);
        $api->setPassword($password);
        $api->setTeachId($teach_id);
        $api->setStatus($status);

        $result = $api->AddUser();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'view') {

        $teacher = $api->getTeacher();

        $user_id = htmlentities($_POST['get_user_id']);
        $api->setUserId($user_id);
        $row = $api->getViewUser();

    ?>

        <input type="hidden" class="form-control" value="<?php echo $user_id ?>" id="update_user_id" name="update_user_id">


        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ອາຈານ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control  default-select2" id="update_teach_id" name="update_teach_id">
                    <option value="<?php echo $row['teach_id'] ?>"><?php echo $row['teach_name'] ?></option>
                    <?php
                    foreach ($teacher as $lv) {
                        echo '<option value="' . $lv['teach_id'] . '">' . $lv['teach_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ຊື່ຜູ້ໃຊ້
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" name="update_username" id="update_username" value="<?php echo $row['username'] ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ລະຫັດຜ່ານ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="password" name="update_password" id="update_password" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ສິດທີ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control  default-select2" id="update_status" name="update_status">
                    <?php
                    if ($row['user_status'] == '1') {
                    ?>
                        <option value="1">ວີຊາການ</option>
                    <?php
                    } else if ($row['user_status'] == '2') {
                    ?>
                        <option value="2">ອາຈານປະຈຳວີຊາ</option>
                    <?php
                    }
                    if ($row['user_status'] == '3') {
                    ?>
                        <option value="3">ຂໍ້ມູນຂ່າວສານ</option>
                    <?php
                    }
                    if ($row['user_status'] == '4') {
                    ?>
                        <option value="4">ອຳໜ່ວຍການ</option>
                    <?php
                    }

                    ?>
                    <option value="1">ວີຊາການ</option>
                    <option value="2">ອາຈານປະຈຳວີຊາ</option>
                    <option value="3">ຂໍ້ມູນຂ່າວສານ</option>
                    <option value="4">ອຳໜ່ວຍການ</option>
                </select>
            </div>
        </div>

    <?php

    } else if ($_REQUEST['method'] == 'update') {

        //    print_r($_POST);
        //    exit();

        $user_id = htmlentities($_POST['user_id']);
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
        $teach_id = htmlentities($_POST['teach_id']);
        $status = htmlentities($_POST['status']);

        $api->setUserId($user_id);
        $api->setUsername($username);
        $api->setPassword($password);
        $api->setTeachId($teach_id);
        $api->setStatus($status);

        $result = $api->editUser();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'delete') {

        //    print_r($_POST);
        //    exit();

        $user_id = htmlentities($_POST['user_id']);
        $api->setUserId($user_id);


        $result = $api->DeleteUser();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}



/*......................Teaching.........................*/


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'teaching') {
    $api = new Teaching();
    if ($_REQUEST['method'] == 'get-class') {


        $level_id = htmlentities($_POST['level_id']);

        $api->SetLevelId($level_id);
        $class = $api->getLevel();
        echo '<option></option>';
        foreach ($class as $dis) {

            echo '<option value="' . $dis['class_id'] . '">' . $dis['class_name'] . '</option>';
        }
    } else if ($_REQUEST['method'] == 'add') {

        $teach_id = htmlentities($_POST['teach_id']);
        $sub_id = htmlentities($_POST['sub_id']);
        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);

        $api->SetTeacherId($teach_id);
        $api->SetSubId($sub_id);
        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);

        $check = $api->getCheckTeaching();

        if ($check['cnt'] > 0) {
            echo "H";
            exit;
        }

        $checkSubject = $api->getCheckTeachingSubject();

        if ($checkSubject['cnt'] > 0) {
            echo "H";
            exit;
        }

        $result = $api->AddTeaching();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'view') {

        $teaching_id = htmlentities($_POST['get_teaching_id']);

        $api->SetTeachingId($teaching_id);
        $row = $api->getViewTeaching();

        $teacher = $api->getTeacher();
        $subject = $api->getSubject();
        $class_level = $api->getClassLevel();
        $sch = $api->getSch();



    ?>

        <input type="hidden" class="form-control" value="<?php echo $teaching_id ?>" id="update_teaching_id" name="update_teaching_id">


        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ອາຈານ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control  default-select2" data-placeholder="...ເລືອກອາຈານ..." id="update_teach_id" name="update_teach_id">
                    <option value="<?php echo $row['teach_id'] ?>"><?php echo $row['teach_name'] ?></option>
                    <?php
                    foreach ($teacher as $th) {
                        echo '<option value="' . $th['teach_id'] . '">' . $th['teach_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ວີຊາ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control  default-select2" data-placeholder="...ເລືອກວີຊາ..." id="update_sub_id" name="update_sub_id">
                    <option value="<?php echo $row['sub_id'] ?>"><?php echo $row['sub_name'] ?></option>
                    <?php
                    foreach ($subject as $sub) {

                        echo '<option value="' . $sub['sub_id'] . '">' . $sub['sub_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ຊັ້ນຮຽນ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control  default-select2" data-placeholder="...ເລືອກຊັ້ນຮຽນ..." id="level_id" name="level_id">
                    <option value="<?php echo $row['level_id'] ?>"><?php echo $row['level_name'] ?></option>
                    <?php
                    foreach ($class_level as $cr) {

                        echo '<option value="' . $cr['level_id'] . '">' . $cr['level_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ຫ້ອງ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control getClassroom default-select2" data-placeholder="...ເລືອກຫ້ອງ..." id="update_class_id" name="update_class_id">
                    <option value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>

                </select>
            </div>
        </div>



        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ສົກຮຽນ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <select class="form-control  default-select2" data-placeholder="...ເລືອກສົກຮຽນ..." id="update_sch_id" name="update_sch_id">
                    <option value="<?php echo $row['sch_id'] ?>"><?php echo $row['sch_name'] ?></option>
                    <?php
                    foreach ($sch as $sy) {

                        echo '<option value="' . $sy['sch_id'] . '">' . $sy['sch_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>




    <?php


    } else if ($_REQUEST['method'] == 'update') {

        $teaching_id = htmlentities($_POST['teaching_id']);
        $teach_id = htmlentities($_POST['teach_id']);
        $sub_id = htmlentities($_POST['sub_id']);
        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);

        $api->SetTeachingId($teaching_id);
        $api->SetTeacherId($teach_id);
        $api->SetSubId($sub_id);
        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);

        $result = $api->UpdateTeaching();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'delete') {

        $teaching_id = htmlentities($_POST['teaching_id']);
        $api->SetTeachingId($teaching_id);


        $result = $api->DeleteTeaching();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'report-teaching') {

        $report = new ReportTeaching();

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);

        $report->SetClassId($class_id);
        $report->SetSchId($sch_id);

        $result = $report->getTeachingReport();

    ?>


        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>ອາຈານ</th>
                    <th>ວີຊາ</th>
                    <th>ຫ້ອງ</th>
                    <th>ສົກຮຽນ</th>
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
                        <td><?php echo $row['teach_name'] ?></td>
                        <td><?php echo $row['sub_name'] ?></td>
                        <td><?php echo $row['class_name'] ?></td>
                        <td><?php echo $row['sch_name'] ?></td>
                    </tr>

                <?php

                }
                ?>


            </tbody>
        </table>

    <?php

    }
}


/*..........................Add Score Term......................*/

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'school-fee') {
    $api = new Fee();
    if ($_REQUEST['method'] == 'add') {

        $price = htmlentities($_POST['price']);
        $level_id = htmlentities($_POST['level_id']);
        $sch_id = htmlentities($_POST['sch_id']);

        $api->SetPrice($price);
        $api->SetLevelId($level_id);
        $api->SetSchId($sch_id);

        $result = $api->AddSchoolFee();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'delete') {

        $fee_id = htmlentities($_POST['school_id']);

        $api->SetFeeId($fee_id);

        $result = $api->DeleteFee();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}


/*..........................Add Score Term......................*/

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'score-term') {
    $api = new ScoreTerm();
    if ($_REQUEST['method'] == 'view-student-term') {


        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);


        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);

        $result = $api->getViewStudentTerm();

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
                <button class="btn btn-primary" id="btn_add_score_student_term" style="margin-top: 17px"> <i class="fa fa-save" aria-hidden="true"></i> ບັກທຶກຄະແນນ</button>
                <!-- <button class="btn btn-danger" id="btn_print_teaching" style="margin-top: 17px"> <i class="fa fa-print" aria-hidden="true"></i> ປິຼນ</button> -->
            </div>
        </div>

    <?php

    } else if ($_REQUEST['method'] == 'add-score-term') {

        $st_id = htmlentities($_POST['st_id_value']);
        $score = htmlentities($_POST['score_value']);


        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $sub_id = htmlentities($_POST['sub_id']);
        $month = htmlentities($_POST['term_id']);


        $api->SetStudentId($st_id);
        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);
        $api->SetSubjectId($sub_id);
        $api->SetScore($score);
        $api->SetMonth($month);
        $api->SetUserId($_SESSION['user_id']);


        $check = $api->getCheckTerm();

        if ($check['cnt'] > 0) {

            echo "H";
            exit;
        }

        $result = $api->AddScoreTerm();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'view-score-update-term') {

        $score_id = htmlentities($_POST['score_id']);

        $api->SetScoreId($score_id);
        $result = $api->ViewScoreUpdateTerm();

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

    } else if ($_REQUEST['method'] == 'update-score-term') {

        $score_id = htmlentities($_POST['score_id']);
        $score = htmlentities($_POST['score']);

        $api->SetScoreId($score_id);
        $api->SetScore($score);
        $result = $api->UpdateScoreTerm();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}


/*......................Report.........................*/


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'report') {
    $api = new Report();
    if ($_REQUEST['method'] == 'view-score-class') {

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $sub_id = htmlentities($_POST['sub_id']);
        $month = htmlentities($_POST['month_id']);


        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);
        $api->SetSubjectId($sub_id);
        $api->SetMonth($month);

        $result = $api->getViewClassScore();


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
                        <td><?php echo $row['score'] ?></td>

                    </tr>

                <?php

                }
                ?>
            </tbody>
        </table>
    <?php

    } else if ($_REQUEST['method'] == 'get-student') {

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);

        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);

        $student = $api->getStudent();
        echo '<option></option>';
        foreach ($student as $st) {

            echo '<option value="' . $st['st_id'] . '">' . $st['st_name'] . '</option>';
        }
    } else if ($_REQUEST['method'] == 'view-score-student') {

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $st_id = htmlentities($_POST['st_id']);
        $month = htmlentities($_POST['month_id']);


        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);
        $api->SetStudentId($st_id);
        $api->SetMonth($month);

        $result = $api->getViewScoreStudent();


    ?>


        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>ວີຊາ</th>
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
                        <td><?php echo $row['sub_name'] ?></td>
                        <td><?php echo $row['score'] ?></td>

                    </tr>

                <?php

                }
                ?>
            </tbody>
        </table>
    <?php

    } else if ($_REQUEST['method'] == 'view-score-class-term') {

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $sub_id = htmlentities($_POST['sub_id']);
        $month = htmlentities($_POST['month_id']);


        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);
        $api->SetSubjectId($sub_id);
        $api->SetMonth($month);

        $result = $api->getViewClassScoreTerm();

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

                            <a class="btn btn-secondary btn-sm show_modal_update_score_term" get_score_id="<?php echo $row['score_id'] ?>">
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
