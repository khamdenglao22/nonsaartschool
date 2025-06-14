<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;
$api = new Student();

$student = $api->getStudent();

$province = $api->getProvince();
$district = $api->getDistrict();
$class_level = $api->getClassLevel();
$row_sch = $api->getSch();

?>

<h1 class="page-header">ຈັດການ <small>ຂໍ້ມູນັກຮຽນ</small></h1>
<div class="row">

    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">

                        <button class="btn btn-primary btn-sm" id="btn_add_student">
                            <i class="fa fa-plus mr-1"></i>
                            ເພີ່ມຂໍ້ມູນັກຮຽນ
                        </button>


                    </h3>
                </div>
            </div>

            <div class="panel-heading">
                <h4 class="panel-title">ຂໍ້ມູນັກຮຽນ</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>


            <div class="panel-body">
                <table id="data-table-fixed-header" class="table schooltale-datable table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>ລະຫັດນັກຮຽນ</th>
                            <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                            <th>ຊັ້ນຮຽນ</th>
                            <th>ຫ້ອງ</th>
                            <th>ເພດ</th>
                            <th>ເບີ</th>
                            <th>ວັນເດືອນປີເກີດ</th>
                            <th>ບ້ານ</th>
                            <th>ເມືອງ</th>
                            <th>ແຂວງ</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 0;
                        foreach ($student as $row) {
                            $i++;
                        ?>

                            <tr>
                                <td> <?php echo $i ?></td>
                                <td> <?php echo $row['st_no'] ?></td>
                                <td> <?php echo $row['st_name'] ?></td>
                                <td> <?php echo $row['level_name'] ?></td>
                                <td> <?php echo $row['class_name'] ?></td>
                                <td> <?php echo $row['sex'] ?></td>
                                <td> <?php echo $row['mobile'] ?></td>
                                <td> <?php echo ViewFormatDate($row['birthday']) ?></td>
                                <td> <?php echo $row['village'] ?></td>
                                <td> <?php echo $row['dis_name'] ?></td>
                                <td> <?php echo $row['pro_name'] ?></td>



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
            </div>
        </div>
    </div>
</div>


<!-- /Start add product modals -->
<div class="modal fade modal-add-student" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_add_student" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ເພີ່ມຂໍ້ມູນັກຮຽນ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ຊື່ ແລະ ນາມສະກຸນ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="st_name" id="st_name" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                        ເພດ
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <select class="form-control  default-select2" data-placeholder="...ເລືອກເພດ..." id="sex" name="sex">
                                <option></option>
                                <option value="ຊາຍ">ຊາຍ</option>
                                <option value="ຍິງ">ຍິງ</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                       
                        <div class="col-md-12 col-sm-12 col-xs-12">
    
                            <label class="control-label col-md-12 col-sm-12 col-xs-12"> ວັນເດືອນປີເກີດ
                            <span class="required">*</span></label>
                            <input type="text" class="form-control datepicker-here" value="<?php echo date("d/m/Y"); ?>" data-date-format="dd/m/yyyy" data-language='en' id="student_date" placeholder="dd/mm/yyyy" autocomplete="off">

                        </div>


                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ເບີ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                            ແຂວງ
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <select class="form-control  default-select2" data-placeholder="...ເລືອກແຂວງ..." id="province_id" name="province_id">
                                <option></option>
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

                            <select class="form-control district default-select2" data-placeholder="...ເລືອກເມືອງ..." id="dis_id" name="dis_id" required>
                                <option></option>

                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ບ້ານ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="village" id="village" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                            ຊັ້ນຮຽນ
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <select class="form-control  default-select2" data-placeholder="...ເລືອກຊັ້ນຮຽນ..." id="level_id" name="level_id">
                                <option></option>
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

                            <select class="form-control getClassroom default-select2" data-placeholder="...ເລືອກຫ້ອງຮຽນ..." id="class_id" name="class_id">
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                            ສົກຮຽນ
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <select class="form-control  default-select2" data-placeholder="...ເລືອກສົກຮຽນ..." id="sch_id" name="sch_id">
                                <option></option>
                                <?php
                                foreach ($row_sch as $sch) {
                                    echo '<option value="' . $sch['sch_id'] . '">' . $sch['sch_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        ປິດ
                    </button>
                    <button type="submit" class="btn btn-primary">
                        ບັນທຶກ
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
<!-- /End add product modals  -->

<!-- /Start update product modals -->
<div class="modal fade modal-update-student" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_update_student" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ແກ້ໄຂຂໍ້ມູນັກຮຽນ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div id="display_view_student_content"></div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        ປິດ
                    </button>
                    <button type="submit" class="btn btn-primary">
                        ບັນທຶກ
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
<!-- /End update product modals  -->