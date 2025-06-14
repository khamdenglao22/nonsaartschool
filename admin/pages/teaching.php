<?php

if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;

$api = new Teaching();

$teaching = $api->getTeaching();
$teacher = $api->getTeacher();
$subject = $api->getSubject();
$class_level = $api->getClassLevel();
$sch = $api->getSch();

?>


<h1 class="page-header">ຈັດການ <small>ຂໍ້ມູນອາຈານປະຈຳວີຊາ</small></h1>
<div class="row">

    <div class="col-xl-12">

        <div class="panel panel-inverse">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">

                        <button class="btn btn-primary btn-sm" id="btn_add_teaching">
                            <i class="fa fa-plus mr-1"></i>
                            ເພີ່ມຂໍ້ມູນອາຈານປະຈຳວີຊາ
                        </button>


                    </h3>
                </div>
            </div>

            <div class="panel-heading">
                <h4 class="panel-title">ຂໍ້ມູນອາຈານປະຈຳວີຊາ</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>


            <div class="panel-body">
                <table id="data-table-fixed-header" class="table table-striped schooltale-datable table-bordered align-middle">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th>ອາຈານ</th>
                            <th>ວີຊາ</th>
                            <th>ຫ້ອງ</th>
                            <th>ສົກຮຽນ</th>


                            <th></th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $i = 0;
                        foreach ($teaching as $row) {
                            $i++;

                        ?>

                            <tr>
                                <td> <?php echo $i ?></td>
                                <td> <?php echo $row['teach_name'] ?></td>
                                <td> <?php echo $row['sub_name'] ?></td>
                                <td> <?php echo $row['class_name'] ?></td>
                                <td> <?php echo $row['sch_name'] ?></td>
                                

                                <td>

                                    <a class="btn btn-secondary btn-sm show_modal_update_teaching" get_teaching_id="<?php echo $row['teaching_id'] ?>">
                                        <i class="fas fa-edit fa-fw"></i>
                                       ແກ້ໄຂ
                                    </a>


                                    <a class="btn btn-danger btn-sm btn_delete_teaching" del_teaching_id="<?php echo $row['teaching_id'] ?>">
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
<div class="modal fade modal-add-teaching" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_add_teaching" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ເພີ່ມຂໍ້ມູນອາຈານປະຈຳວີຊາ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                            ອາຈານ
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <select class="form-control  default-select2" data-placeholder="...ເລືອກອາຈານ..." id="teach_id" name="teach_id">
                                <option></option>
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

                            <select class="form-control  default-select2" data-placeholder="...ເລືອກວີຊາ..."  id="sub_id" name="sub_id">
                                <option></option>
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
                                <option></option>
                                <?php
                                foreach ($class_level as $cr) {

                                    echo '<option value="' . $cr['level_id'] . '">' .$cr['level_name'] . '</option>';
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

                            <select class="form-control getClassroom default-select2" data-placeholder="...ເລືອກຫ້ອງ..." id="class_id" name="class_id">
                                <option></option>
                                
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                            ສົກຮຽນ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <select class="form-control  default-select2" data-placeholder="...ເລືອກສົກຮຽນ..." id="sch_id" name="sch_id">
                                <option></option>
                                <?php
                                foreach ($sch as $sy) {

                                    echo '<option value="' . $sy['sch_id'] . '">' .$sy['sch_name'] . '</option>';
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
<div class="modal fade modal-update-teaching" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_update_teaching" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ແກ້ໄຂ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div id="display_view_teaching_content"></div>

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