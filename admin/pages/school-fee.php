<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;

$api = new Fee();
$fee = $api->getFee();
$level = $api->getLevel();
$sch = $api->getSch();


// SELECT SUM(pay) AS pay,tb_school_fee.level_id,COUNT(tb_register.st_id) AS student FROM `tb_school_fee` INNER JOIN `tb_register` ON tb_school_fee.school_id=tb_register.school_id GROUP BY tb_school_fee.level_id;

// SELECT SUM(pay) AS pay,level_name,COUNT(st_id) AS student FROM `tb_register` INNER JOIN tb_class_level ON tb_register.level_id=tb_class_level.level_id GROUP BY tb_register.level_id;
?>

<h1 class="page-header">ຈັດການ <small>ຄ່າຮຽນ</small></h1>
<div class="row">

    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">

                        <button class="btn btn-primary btn-sm" id="btn_add_fee">
                            <i class="fa fa-plus mr-1"></i>
                            ເພີ່ມຄ່າຮຽນ
                        </button>


                    </h3>
                </div>
            </div>

            <div class="panel-heading">
                <h4 class="panel-title">ຄ່າຮຽນ</h4>
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
                            <th>ຊັ້ນ</th>
                            <th>ຄ່າຮຽນ</th>
                            <th>ສົກຮຽນ</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 0;
                        foreach ($fee as $row) {
                            $i++;


                        ?>

                            <tr>
                                <td> <?php echo $i ?></td>
                                <td> <?php echo $row['level_name'] ?></td>
                                <td> <?php echo $row['price'] ?></td>
                                <td> <?php echo $row['sch_name'] ?></td>


                                <td>

                                    <a class="btn btn-secondary btn-sm show_modal_update_level" get_level_id="<?php echo $row['level_id'] ?>" get_level_name="<?php echo $row['level_name'] ?>">
                                        <i class="fas fa-edit fa-fw"></i>
                                        ແກ້ໄຂ
                                    </a>


                                    <a class="btn btn-danger btn-sm btn_delete_fee" del_fee_id="<?php echo $row['school_id'] ?>">
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
<div class="modal fade modal-add-fee" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_add_fee" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ເພີ່ມຄ່າຮຽນ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                            ຊັ້ນ
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control  default-select2" data-placeholder="...ເລືອກຊັ້ນ..." id="level_id" name="level_id">
                                <option></option>
                                <?php
                                foreach ($level as $lv) {
                                    echo '<option value="' . $lv['level_id'] . '">' . $lv['level_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ຄ່າຮຽນ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="price" id="price" class="form-control">
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
                                foreach ($sch as $sh) {
                                    echo '<option value="' . $sh['sch_id'] . '">' . $sh['sch_name'] . '</option>';
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
<div class="modal fade modal-update-level" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_update_level" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ແກ້ໄຂຊັ້ນຮຽນ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="update_level_id" name="update_level_id">

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ຊັ້ນ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="update_level_name" id="update_level_name" class="form-control">
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
<!-- /End update product modals  -->