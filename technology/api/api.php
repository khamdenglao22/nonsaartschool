<?php
include_once '../core/init.php';
$created = date('Y-m-d H:i:s');


/*......................................ຈັດການຂໍ້ມູນໂຮງຮຽນ..........................................*/

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'student') {
    $api = new Student();

    if ($_REQUEST['method'] == 'get-district') {

        $province_id = htmlentities($_POST['id']);

        $api->SetProvince($province_id);
        $districts = $api->getDistrict();
        foreach ($districts as $dis) {

            echo '<option value="' . $dis['dis_id'] . '">' . $dis['dis_name'] . '</option>';
        }
    } else if ($_REQUEST['method'] == 'add') {
        //        print_r($_POST);
        //        exit();

        $st_name = htmlentities($_POST['st_name']);
        $st_sex = htmlentities($_POST['st_sex']);
        $phone = htmlentities($_POST['phone']);
        $dis_id = htmlentities($_POST['dis_id']);
        $village = htmlentities($_POST['village']);
        $class_id = htmlentities($_POST['class_id']);
        $level_id = htmlentities($_POST['level_id']);
        $sch_id = htmlentities($_POST['sch_id']);

        $birthday = $api->getFormatDate(htmlentities($_POST['birthday']));

        $st_no = generateStId();

        $api->SetSt_Name($st_name);
        $api->SetSex($st_sex);
        $api->SetMobile($phone);
        $api->SetClassId($class_id);
        $api->SetLevelId($level_id);
        $api->SetSchId($sch_id);
        $api->SetVillage($village);
        $api->SetBirthday($birthday);
        $api->SetDistrict_id($dis_id);
        $api->SetSt_No($st_no);

        $result = $api->AddStudent();
        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'view') {
        //        print_r($_POST);
        //        exit();

        $province = $api->getProvince();
        $district = $api->getDistrict();
        $class_level = $api->getClassLevel();
        $row_sch = $api->getSch();



        $st_id = htmlentities($_POST['get_student_id']);
        $api->SetStudentId($st_id);

        $row = $api->ViewStudent();


?>

        <input type="hidden" class="form-control" value="<?php echo $st_id ?>" id="update_student_id" name="update_student_id">

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ຊື່ ແລະ ນາມສະກຸນ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" name="update_student_name" id="update_student_name" value="<?php echo $row['st_name'] ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ເພດ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control  default-select2" id="update_sex" name="update_sex">
                    <option value="<?php echo $row['sex'] ?>"><?php echo $row['sex'] ?></option>
                    <option value="ຊາຍ">ຊາຍ</option>
                    <option value="ຍິງ">ຍິງ</option>

                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label class="control-label col-md-12 col-sm-12 col-xs-12"> ວັນເດືອນປີເກີດ
                    <span class="required">*</span></label>
                <input type="text" class="form-control datepicker-here" value="<?php echo ViewFormatDate($row['birthday']); ?>" data-date-format="dd/m/yyyy" data-language='en' id="update_student_date" placeholder="dd/mm/yyyy" autocomplete="off">
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ເບີ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" name="update_phone" id="update_phone" value="<?php echo $row['mobile'] ?>" class="form-control">
            </div>
        </div>



        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ແຂວງ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control  default-select2" id="province_id" name="province_id">
                    <option value="<?php echo $row['pro_id'] ?>"><?php echo $row['pro_name'] ?></option>
                    <?php
                    foreach ($province as $lv) {
                        echo '<option value="' . $lv['pro_id'] . '">' . $lv['pro_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ເມືອງ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control district default-select2" id="update_dis_id" name="update_dis_id" required>
                    <option value="<?php echo $row['dis_id'] ?>"><?php echo $row['dis_name'] ?></option>

                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ບ້ານ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" name="update_village" id="update_village" value="<?php echo $row['village'] ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ຊັ້ນຮຽນ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control  default-select2" id="update_level_id" name="update_level_id">
                    <option value="<?php echo $row['level_id'] ?>"><?php echo $row['level_name'] ?></option>
                    <?php
                    foreach ($class_level as $class) {
                        echo '<option value="' . $class['level_id'] . '">' . $class['level_name'] . '</option>';
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
                <select class="form-control getClassroom default-select2" data-placeholder="...ເລືອກຫ້ອງຮຽນ..." id="update_class_id" name="update_class_id">
                    <option value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ສົກຮຽນ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">


                <select class="form-control  default-select2" data-placeholder="...ເລືອກສົກຮຽນ..." id="update_sch_id" name="update_sch_id">
                    <option value="<?php echo $row['sch_id'] ?>"><?php echo $row['sch_name'] ?></option>
                    <?php
                    foreach ($row_sch as $sch) {
                        echo '<option value="' . $sch['sch_id'] . '">' . $sch['sch_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>


    <?php

    } else if ($_REQUEST['method'] == 'update') {
        //        print_r($_POST);
        //        exit();

        $st_id = htmlentities($_POST['st_id']);
        $st_name = htmlentities($_POST['st_name']);
        $st_sex = htmlentities($_POST['st_sex']);
        $phone = htmlentities($_POST['phone']);
        $dis_id = htmlentities($_POST['dis_id']);
        $village = htmlentities($_POST['village']);
        $class_id = htmlentities($_POST['class_id']);
        $level_id = htmlentities($_POST['level_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $birthday = $api->getFormatDate(htmlentities($_POST['birthday']));

        $api->SetStudentId($st_id);
        $api->SetSt_Name($st_name);
        $api->SetSex($st_sex);
        $api->SetMobile($phone);
        $api->SetClassId($class_id);
        $api->SetLevelId($level_id);
        $api->SetSchId($sch_id);
        $api->SetVillage($village);
        $api->SetBirthday($birthday);
        $api->SetDistrict_id($dis_id);

        $result = $api->UpdateStudent();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'delete') {
        //        print_r($_POST);
        //        exit();

        $st_id = htmlentities($_POST['st_id']);
        $api->SetStudentId($st_id);

        $result = $api->DeleteStudent();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'student-report') {

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);

        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);

        $result = $api->getViewStudentReport();


    ?>

        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>ລະຫັດນັກຮຽນ</th>
                    <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                    <th>ຫ້ອງ</th>
                    <th>ເພດ</th>
                    <th>ເບີ</th>
                    <th>ວັນເດືອນປີເກີດ</th>
                    <th>ບ້ານ</th>
                    <th>ເມືອງ</th>
                    <th>ແຂວງ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $i++;
                ?>
                    <tr class="odd gradeX">
                        <td> <?php echo $i ?></td>
                        <td> <?php echo $row['st_no'] ?></td>
                        <td> <?php echo $row['st_name'] ?></td>
                        <td> <?php echo $row['class_name'] ?></td>
                        <td> <?php echo $row['sex'] ?></td>
                        <td> <?php echo $row['mobile'] ?></td>
                        <td> <?php echo ViewFormatDate($row['birthday']) ?></td>
                        <td> <?php echo $row['village'] ?></td>
                        <td> <?php echo $row['dis_name'] ?></td>
                        <td> <?php echo $row['pro_name'] ?></td>

                    </tr>

                <?php

                }
                ?>
            </tbody>
        </table>
    <?php
    } else if ($_REQUEST['method'] == 'student-register-report') {

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $st_status = htmlentities($_POST['st_status']);

        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);
        $api->SetStatus($st_status);

        $result = $api->getViewStudentRegisterReport();


    ?>

        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>ລະຫັດນັກຮຽນ</th>
                    <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                    <th>ຫ້ອງ</th>
                    <th>ສະຖານະ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $i++;
                ?>
                    <tr class="odd gradeX">
                        <td> <?php echo $i ?></td>
                        <td> <?php echo $row['st_no'] ?></td>
                        <td> <?php echo $row['st_name'] ?></td>
                        <td> <?php echo $row['class_name'] ?></td>

                        <?php
                        if ($row['st_status'] == 1) {
                        ?>
                            <td>ຍັງບໍ່ລົງທະບຽນ</td>
                        <?php
                        } else {
                        ?>
                            <td>ລົງທະບຽນແລ້ວ</td>
                        <?php
                        }
                        ?>

                    </tr>

                <?php

                }
                ?>
            </tbody>
        </table>
    <?php
    }
}

/*......................ຈັດການຂໍ້ມູນ Update Level.........................*/

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'updateLevel') {
    $api = new UpdateLevel();

    if ($_REQUEST['method'] == 'update-level') {

        $sch_id = htmlentities($_POST['old_sch_id']);
        $level_id = htmlentities($_POST['old_level_id']);

        $new_sch_id = htmlentities($_POST['new_sch_id']);
        $new_level_id = htmlentities($_POST['new_level_id']);

        $api->SetSchId($sch_id);
        $api->SetLevelId($level_id);

        $api->SetNewSchId($new_sch_id);
        $api->SetNewLevelId($new_level_id);

        // $check = $api->getCheck();

        // if ($check['cnt'] > 0) {
        //     echo "H";
        //     exit;
        // }

        $check_sch = $api->getCheckSch();
        if ($check_sch['cnt'] > 0) {
            echo "K";
            exit;
        }

        $result = $api->AddUpdateLevel();

        if ($result == 1) {


            $api->SetNewSchId($new_sch_id);
            $result_update_sch = $api->AddUpdateSchYear();
            if ($result_update_sch == 1) {
                echo "S";
            } else {
                echo "F";
            }
        } else {
            echo "F";
        }
    }
}

/*......................ຈັດການຂໍ້ມູນ Teacher.........................*/


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'teacher') {
    $api = new Teacher();
    if ($_REQUEST['method'] == 'add') {

        $teach_name = htmlentities($_POST['teach_name']);
        $sex = htmlentities($_POST['sex']);
        $ethic = htmlentities($_POST['ethic']);
        $phone = htmlentities($_POST['phone']);
        $status = htmlentities($_POST['status']);
        $dis_id = htmlentities($_POST['dis_id']);
        $birthday = $api->getFormatDate(htmlentities($_POST['birthday']));
        $village = htmlentities($_POST['village']);
        $subject = htmlentities($_POST['subject']);
        $subject_level = htmlentities($_POST['subject_level']);


        $api->SetTeacherName($teach_name);
        $api->SetSex($sex);
        $api->SetTeacherEthic($ethic);
        $api->SetMobile($phone);
        $api->SetStatus($status);
        $api->SetDistrict_id($dis_id);
        $api->SetBirthday($birthday);
        $api->SetVillage($village);
        $api->SetSubject($subject);
        $api->SetSubjectLevel($subject_level);



        $result = $api->AddTeacher();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'view') {

        $teach_id = htmlentities($_POST['get_teacher_id']);

        $api->SetTeacherId($teach_id);
        $row = $api->ViewTeacher();


        $province = $api->getProvince();
        $district = $api->getDistrict();


    ?>

        <input type="hidden" class="form-control" value="<?php echo $teach_id ?>" id="update_teacher_id" name="update_teacher_id">

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ຊື່ ແລະ ນາມສະກຸນ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" name="update_teach_name" id="update_teach_name" value="<?php echo $row['teach_name'] ?>" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-6" for="update_sex">ເພດ <span class="required">*</span></label>
            <label class="col-md-6" for="update_status">ສະຖານະ <span class="required">*</span></label>

        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <select class="form-control default-select2" data-placeholder="...ເລືອກເພດ..." id="update_sex" name="update_sex" required>
                    <option value="<?php echo $row['sex'] ?>"><?php echo $row['sex'] ?></option>
                    <option value="ຊາຍ">ຊາຍ</option>
                    <option value="ຍິງ">ຍິງ</option>
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-control default-select2" data-placeholder="...ເລືອກສະຖານະ..." id="update_status" name="update_status" required>
                    <option value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></option>
                    <option value="ໂສດ">ໂສດ</option>
                    <option value="ແຕ່ງງານ">ແຕ່ງງານ</option>
                </select>
            </div>

        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ຊົນເຜົ່າ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <select class="form-control default-select2" data-placeholder="...ເລືອກຊົນເຜົ່າ..." id="update_ethic" name="update_ethic" required>
                    <option value="<?php echo $row['ethic'] ?>"><?php echo $row['ethic'] ?></option>
                    <option value="ມົ້ງ">ມົ້ງ</option>
                    <option value="ລາວ">ລາວ</option>
                    <option value="ກືມູ">ກືມູ</option>
                </select>
            </div>
        </div>

        <div class="form-group">

            <div class="col-md-12 col-sm-12 col-xs-12">

                <label class="control-label col-md-12 col-sm-12 col-xs-12"> ວັນເດືອນປີເກີດ
                    <span class="required">*</span></label>
                <input type="text" class="form-control datepicker-here" value="<?php echo ViewFormatDate($row['birthday']); ?>" data-date-format="dd/m/yyyy" data-language='en' id="update_teacher_date" placeholder="dd/mm/yyyy" autocomplete="off">

            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ເບີ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" name="update_phone" value="<?php echo $row['mobile'] ?>" id="update_phone" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-6" for="sex">ແຂວງ <span class="required">*</span></label>
            <label class="col-md-6" for="status">ເມືອງ <span class="required">*</span></label>

        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <select class="form-control default-select2" data-placeholder="...ເລືອກແຂວງ..." id="province_id" name="province_id" required>
                    <option value="<?php echo $row['pro_id'] ?>"><?php echo $row['pro_name'] ?></option>
                    <?php
                    foreach ($province as $lv) {
                        echo '<option value="' . $lv['pro_id'] . '">' . $lv['pro_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-control district default-select2" data-placeholder="...ເລືອກເມືອງ..." id="update_dis_id" name="update_dis_id" required>
                    <option value="<?php echo $row['dis_id'] ?>"><?php echo $row['dis_name'] ?></option>

                </select>
            </div>

        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ບ້ານ
                <span class="required">*</span></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" name="update_village" value="<?php echo $row['village'] ?>" id="update_village" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ວິຊາສະເພາະ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <select class="form-control default-select2" data-placeholder="...ເລືອກວິຊາສະເພາະ..." id="update_subject" name="update_subject" required>
                    <option value="<?php echo $row['subject'] ?>"><?php echo $row['subject'] ?></option>
                    <option value="ຄູຄະນິດສາດ">ຄູຄະນິດສາດ</option>
                    <option value="ຄູພາສາລາວ-ວັນນະຄະດີ">ຄູພາສາລາວ-ວັນນະຄະດີ</option>
                    <option value="ຄູຟີຊີກສາດ">ຄູຟີຊີກສາດ</option>
                    <option value="ຄູພາລະສຶກສາ">ຄູພາລະສຶກສາ</option>
                    <option value="ຄູຊີວະວີທະຍາ">ຄູຊີວະວີທະຍາ</option>
                    <option value="ຄູວີທະຍາສາດສັງຄົມ">ຄູວີທະຍາສາດສັງຄົມ</option>
                    <option value="ຄູເຄມີສາດ">ຄູເຄມີສາດ</option>

                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                ລະລັບການສຶກສາ
                <span class="required">*</span>
            </label>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <select class="form-control  default-select2" data-placeholder="...ເລືອກລະລັບການສຶກສາ..." id="update_subject_level" name="update_subject_level" required>
                    <option value="<?php echo $row['subject_level'] ?>"><?php echo $row['subject_level'] ?></option>
                    <option value="ຊັ້ນສູງ">ຊັ້ນສູງ</option>
                    <option value="ຊັ້ນກາງ">ຊັ້ນກາງ</option>
                    <option value="ປະລິນຍາຕີ">ປະລິນຍາຕີ</option>
                    <option value="ປະລິນຍາໂທ">ປະລິນຍາໂທ</option>
                    <option value="ປະລິນຍາເອກ">ປະລິນຍາເອກ</option>
                </select>
            </div>
        </div>



    <?php
    } else if ($_REQUEST['method'] == 'update') {

        $teach_id = htmlentities($_POST['teach_id']);
        $teach_name = htmlentities($_POST['teach_name']);
        $sex = htmlentities($_POST['sex']);
        $ethic = htmlentities($_POST['ethic']);
        $phone = htmlentities($_POST['phone']);
        $status = htmlentities($_POST['status']);
        $dis_id = htmlentities($_POST['dis_id']);
        $birthday = $api->getFormatDate(htmlentities($_POST['birthday']));
        $village = htmlentities($_POST['village']);
        $subject = htmlentities($_POST['subject']);
        $subject_level = htmlentities($_POST['subject_level']);


        $api->SetTeacherId($teach_id);
        $api->SetTeacherName($teach_name);
        $api->SetSex($sex);
        $api->SetTeacherEthic($ethic);
        $api->SetMobile($phone);
        $api->SetStatus($status);
        $api->SetDistrict_id($dis_id);
        $api->SetBirthday($birthday);
        $api->SetVillage($village);
        $api->SetSubject($subject);
        $api->SetSubjectLevel($subject_level);



        $result = $api->UpdateTeacher();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'delete') {

        $teach_id = htmlentities($_POST['teach_id']);
        $api->SetTeacherId($teach_id);

        $result = $api->DeleteTeacher();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'register') {
    $api = new Register();
    if ($_REQUEST['method'] == 'get-class') {


        $level_id = htmlentities($_POST['level_id']);

        $api->SetLevelId($level_id);
        $class = $api->getLevel();
        foreach ($class as $dis) {

            echo '<option value="' . $dis['class_id'] . '">' . $dis['class_name'] . '</option>';
        }
    } else if ($_REQUEST['method'] == 'view-student') {

        $st_no = htmlentities($_POST['student_code']);
        $api->SetStudentNo($st_no);


        // $sch_year = $api->getSch();
        $result = $api->ViewStudent();

        // if($result == 1){

        // }

        $api->SetLevelId($result['level_id']);
        $get_class = $api->ViewClass();

    ?>

        <input type="text" hidden value="<?php echo $result['st_id'] ?>" id="st_id" name="st_id" class="form-control">
        <div class="form-group row member_section_empty">
            <label class="col-md-1"></label>
            <label class="col-md-1" for="st_name">ຊື່:</label>
            <div class="col-md-4">
                <input disabled type="text" value="<?php echo $result['st_name'] ?>" class="form-control">
            </div>
        </div>
        <br>

        <div class="form-group row member_section_empty">
            <label class="col-md-1"></label>
            <label class="col-md-1" for="address">ສົກຮຽນ:</label>
            <div class="col-md-2">
                <input hidden type="text" value="<?php echo $result['sch_id'] ?>" id="sch_id" name="sch_id" class="form-control">
                <input disabled type="text" value="<?php echo $result['sch_name'] ?>" class="form-control">

            </div>
        </div>
        <br>

        <div class="form-group row member_section_empty">
            <label class="col-md-1"></label>
            <label class="col-md-1" for="address">ຂື້ນຊັ້ນ: </label>
            <div class="col-md-2">
                <input hidden type="text" value="<?php echo $result['level_id'] ?>" id="level_id" name="level_id" class="form-control">
                <input disabled type="text" value="<?php echo $result['level_name'] ?>" class="form-control">

            </div>
            <label class="col-md-1" for="address">ຂື້ນຫ້ອງ: </label>
            <div class="col-md-2">
                <select class="form-control getClassroom default-select2" data-placeholder="...ເລືອກຫ້ອງ..." id="class_id" name="class_id">
                    <option>...ເລືອກຫ້ອງ...</option>
                    <?php
                    foreach ($get_class as $cl) {
                        echo '<option value="' . $cl['class_id'] . '">' . $cl['class_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <br>

        <div class="form-group row member_section_empty">
            <label class="col-md-1"></label>
            <label class="col-md-1" for="pay">ຄ່າຮຽນ:</label>
            <div class="col-md-2">

                <?php

                $api->SetLevelId($result['level_id']);
                $api->SetSchId($result['sch_id']);
                $get_fee = $api->viewFee();

                ?>
                <!-- <input type="text" id="pay" name="pay" class="form-control"> -->
                <input disabled type="text" id="pay" name="pay" value="<?php echo $get_fee['price'] ?>" class="form-control">
            </div>
        </div>
        <br>

    <?php


    } else if ($_REQUEST['method'] == 'add') {

        $st_id = htmlentities($_POST['st_id']);
        $class_id = htmlentities($_POST['class_id']);
        $level_id = htmlentities($_POST['level_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $pay = htmlentities($_POST['pay']);

        $api->SetStudentId($st_id);
        $api->SetSchId($sch_id);
        $api->SetLevelId($level_id);
        $api->SetClassId($class_id);
        $api->SetPay($pay);

        $api->SetRegDate($created);
        $api->SetUserId($_SESSION['user_id']);

        $check_level = $api->getCheckLevel();

        // if ($check_level['cnt'] > 0) {
        //     echo "K";
        //     exit;
        // }

        $check = $api->getCheck();

        if ($check['cnt'] > 0) {
            echo "H";
            exit;
        }

        $result = $api->AddRegister();

        if ($result == 1) {

            $api->SetStudentId($st_id);
            $api->SetClassId($class_id);
            $update = $api->UpdateClass();
            if ($update == 1) {
                echo "S";
            } else {
                echo "F";
            }
        } else {
            echo "F";
        }
    } else if ($_REQUEST['method'] == 'default-load-register') {


        // $register = $api->LoadRegister();

    ?>


        <table id="data-table-fixed-header" id="report_datatable" class="table schooltale-datable table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>ລະຫັດນັກຮຽນ</th>
                    <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                    <th>ຫ້ອງໃໝ່</th>
                    <th>ສົກຮຽນ</th>
                    <th>ວັນທີ່ລົງທະບຽນ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = 0;
                foreach ($register as $row) {
                    $i++;
                ?>

                    <tr>
                        <td> <?php echo $i ?></td>
                        <td> <?php echo $row['st_no'] ?></td>
                        <td> <?php echo $row['st_name'] ?></td>
                        <td> <?php echo $row['class_name'] ?></td>
                        <td> <?php echo $row['sch_name'] ?></td>
                        <td> <?php echo $row['reg_date'] ?></td>

                        <td>

                            <a class="btn btn-secondary btn-sm show_modal_update_student" get_student_id="<?php echo $row['st_id'] ?>">
                                <i class="fas fa-edit fa-fw"></i>
                                ແກ້ໄຂ
                            </a>


                            <a class="btn btn-danger btn-sm btn_delete_student" del_student_id="<?php echo $row['st_id'] ?>">
                                <i class="fa fa-fw fa-trash"></i>
                                ລຶບ
                            </a>


                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    <?php

    } else if ($_REQUEST['method'] == 'recipe-report') {

        $sch_id = htmlentities($_POST['sch_id']);

        $api->SetSchId($sch_id);

        $result = $api->getViewRecipeReport();

        // $num_row = count($result);
    ?>

        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>

                    <th>ຊັ້ນຮຽນ</th>
                    <th>ຄ່າຮຽນ</th>
                    <th>ຈຳນວນນັກຮຽນ</th>
                    <th>ເງີນລວມ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $amount_pay = 0;
                foreach ($result as $row) {
                    $pay = $row['pay'];
                    $amount_pay += $pay;
                ?>

                    <tr class="odd gradeX">
                        <td> <?php echo $row['level_name'] ?></td>
                        <td> <?php echo $row['pay'] ?> /ຄົນ</td>
                        <td> <?php echo $row['student'] ?> ຄົນ</td>
                        <td> <?php echo number_format($row['price']) ?> ກີບ</td>

                    </tr>
                <?php
                }

                ?>

            </tbody>
        </table>
    <?php
    } else if ($_REQUEST['method'] == 'view-student-move') {

        $st_no = htmlentities($_POST['search_move_code']);

        $api->SetStudentNo($st_no);

        $result = $api->ViewStudentMove();
        if ($result == 0) {
            echo "H";
            exit;
        }
        $api->SetLevelId($result['level_id']);
        $get_class = $api->ViewClass();

    ?>

        <input type="text" hidden value="<?php echo $result['st_id'] ?>" id="st_id" name="st_id" class="form-control">
        <div class="form-group row member_section_empty">
            <label class="col-md-1"></label>
            <label class="col-md-1" for="st_name">ຊື່:</label>
            <div class="col-md-4">
                <input disabled type="text" value="<?php echo $result['st_name'] ?>" class="form-control">
            </div>
        </div>
        <br>

        <div class="form-group row member_section_empty">
            <label class="col-md-1"></label>
            <label class="col-md-1" for="address">ສົກຮຽນ:</label>
            <div class="col-md-2">
                <input hidden type="text" value="<?php echo $result['sch_id'] ?>" id="sch_id" name="sch_id" class="form-control">
                <input disabled type="text" value="<?php echo $result['sch_name'] ?>" class="form-control">

            </div>
        </div>
        <br>

        <div class="form-group row member_section_empty">
            <label class="col-md-1"></label>
            <label class="col-md-1" for="address">ຫ້ອງ: </label>
            <div class="col-md-2">
                <input disabled type="text" value="<?php echo $result['class_name'] ?>" class="form-control">

            </div>
            <label class="col-md-1" for="address">ຫ້ອງໃໝ່: </label>
            <div class="col-md-2">
                <select class="form-control getClassroom default-select2" data-placeholder="...ເລືອກຫ້ອງ..." id="new_class_id" name="new_class_id">
                    <option>...ເລືອກຫ້ອງ...</option>
                    <?php
                    foreach ($get_class as $cl) {
                        echo '<option value="' . $cl['class_id'] . '">' . $cl['class_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <br>


        <?php


    } else if ($_REQUEST['method'] == 'add-move-student') {

        $st_id = htmlentities($_POST['st_id']);
        $class_id = htmlentities($_POST['class_id']);

        $api->SetStudentId($st_id);
        $api->SetClassId($class_id);

        $check = $api->getCheckMoveStudent();

        if ($check['cnt'] > 1) {
            echo "H";
            exit;
        }

        $result = $api->AddMoveStudent();

        if ($result == 1) {
            echo "S";
        } else {
            echo "F";
        }
    }
}



/*......................ຈັດການຂໍ້ມູນໂຮງຮຽນ.........................*/
