<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;
$api = new Student();

$class_level = $api->getClassLevel();
$row_sch = $api->getSch();

?>

<h1 class="page-header">ລາຍງານ <small>ຂໍ້ມູນລົງທະບຽນ</small></h1>
<div class="row">

    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <div class="card">
                <div class="card-header">
                    <div class="form-group row">

                        <div class="col-md-3">
                            <label for="rp_to_date">ສົກຮຽນ</label>
                            <select class="form-control  default-select2" data-placeholder="...ເລືອກສົກຮຽນ..." id="sch_id" name="sch_id" required>
                                <option></option>
                                <?php
                                foreach ($row_sch as $sy) {

                                    echo '<option value="' . $sy['sch_id'] . '">' . $sy['sch_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="rp_to_date">ຊັ້ນຮຽນ</label>
                            <select class="form-control  default-select2" data-placeholder="...ເລືອກຊັ້ນຮຽນ..." id="level_id" name="level_id" required>
                                <option></option>
                                <?php
                                foreach ($class_level as $sy) {

                                    echo '<option value="' . $sy['level_id'] . '">' . $sy['level_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>


                        <div class="col-md-2">
                            <label for="rp_to_date">ຫ້ອງ</label>
                            <select class="form-control getClassroom default-select2" data-placeholder="...ເລືອກຫ້ອງ..." id="class_id" name="class_id" required>
                                <option></option>

                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="rp_to_date">ຖານະລົງທະບຽນ</label>
                            <select class="form-control default-select2" data-placeholder="...ເລືອກສະຖານະ..." id="st_status" name="st_status" required>
                                <option></option>
                                <option value="1">ຍັງບໍ່ລົງທະບຽນ</option>
                                <option value="2">ລົງທະບຽນແລ້ວ</option>
                
                            </select>
                        </div>


                        <div class="col-md-2">
                            <label for="rp_to_date"> &nbsp;</label>
                            <button class="btn btn-primary" id="btn_search_student_register" style="margin-top: 17px"> <i class="fa fa-search" aria-hidden="true"></i> ຄົ້ນຫາ</button>
                            <button class="btn btn-danger" id="btn_print_student_register" style="margin-top: 17px"> <i class="fa fa-print" aria-hidden="true"></i> ປິຼນ</button>
                        </div>


                    </div><br>
                </div>
            </div>

            <div class="panel-heading">
                <h4 class="panel-title">ລາຍງານຂໍ້ມູນລົງທະບຽນ</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>


            <div class="panel-body">

               <div id="display_view_student_register_list" class="col-md-12"> </div>

            </div>
        </div>
    </div>
</div>