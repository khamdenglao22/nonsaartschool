<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;
$api = new ClassRoom();
$classroom = $api->getClassRoom();
$level = $api->getLevel();
?>

<h1 class="page-header">ຈັດການ <small>ຂໍ້ມູນຫ້ອງຮຽນ</small></h1>
<div class="row">
    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <button class="btn btn-primary btn-sm" id="btn_add_room">
                            <i class="fa fa-plus mr-1"></i>
                            ເພີ່ມຂໍ້ມູນຫ້ອງຮຽນ
                        </button>
                    </h3>
                </div>
            </div>
            <div class="panel-heading">
                <h4 class="panel-title">ຂໍ້ມູນຫ້ອງຮຽນ</h4>
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
                            <th width="10%">#</th>
                            <th>ຊັ້ນ</th>
                            <th>ຫ້ອງ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($classroom as $row) {
                            $i++;
                        ?>
                            <tr>
                                <td> <?php echo $i ?></td>
                                <td> <?php echo $row['level_name'] ?></td>
                                <td> <?php echo $row['class_name'] ?></td>
                                <td>
                                    <a class="btn btn-secondary btn-sm show_modal_update_room" get_room_id="<?php echo $row['class_id'] ?>">
                                        <i class="fas fa-edit fa-fw"></i>
                                        ແກ້ໄຂ
                                    </a>
                                    <a class="btn btn-danger btn-sm btn_delete_room" del_room_id="<?php echo $row['class_id'] ?>">
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
<div class="modal fade modal-add-room" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_add_room" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ເພີ່ມຂໍ້ມູນຫ້ອງຮຽນ</h4>
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

                            <select class="form-control  default-select2" id="level_id" name="level_id">
                                <option>...ເລືອກຊັ້ນຮຽນ...</option>
                                <?php
                                foreach ($level as $lv) {
                                    echo '<option value="' . $lv['level_id'] . '">' . $lv['level_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ຫ້ອງ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="class_name" id="class_name" class="form-control">
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
<div class="modal fade modal-update-room" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_update_room" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ແກ້ໄຂຊັ້ນຮຽນ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="display_view_room_content"></div>
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