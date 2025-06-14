<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;
$api = new User();
$teacher = $api->getTeacher();
$user = $api->getUser();

?>

<h1 class="page-header">ຈັດການ <small>ຂໍ້ມູນຜູ້ໃຊ້</small></h1>
<div class="row">

    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">

                        <button class="btn btn-primary btn-sm" id="btn_add_user">
                            <i class="fa fa-plus mr-1"></i>
                            ເພີ່ມຂໍ້ມູນຜູ້ໃຊ້
                        </button>


                    </h3>
                </div>
            </div>

            <div class="panel-heading">
                <h4 class="panel-title">ຂໍ້ມູນຜູ້ໃຊ້</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>


            <div class="panel-body">
                <table id="data-table-fixed-header" class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th>ອາຈານ</th>
                            <th>ຊື່ຜູ້ໃຊ້</th>
                            <th>ສິດທີ</th>
                            
                            
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 0;
                        foreach ($user as $row) {
                            $i++;


                        ?>

                            <tr>
                                <td> <?php echo $i ?></td>
                                <td> <?php echo $row['teach_name'] ?></td>
                                <td> <?php echo $row['username'] ?></td>


                                <?php
                                if ($row['user_status'] == 1) {
                                ?>
                                    <td>ວີຊາການ</td>
                                <?php
                                } elseif ($row['user_status'] == 2) {
                                ?>
                                    <td>ອາຈານປະຈຳວີຊາ</td>
                                <?php
                                } elseif ($row['user_status'] == 3) {
                                ?>
                                    <td>ຂໍ້ມູນຂ່າວສານ</td>
                                <?php
                                } else if ($row['user_status'] == 4) {
                                ?>
                                    <td>ອຳໜ່ວຍການ</td>
                                <?php
                                }
                                ?>

                                <!-- <option value="1">ວີຊາການ</option>
                                <option value="2">ອາຈານປະຈຳວີຊາ</option>
                                <option value="3">ຂໍ້ມູນຂ່າວສານ</option>
                                <option value="4">ອຳໜ່ວຍການ</option> -->


                                <td>

                                    <a class="btn btn-secondary btn-sm show_modal_update_user" get_user_id="<?php echo $row['user_id'] ?>">
                                        <i class="fas fa-edit fa-fw"></i>
                                        ແກ້ໄຂ
                                    </a>


                                    <a class="btn btn-danger btn-sm btn_delete_user" del_user_id="<?php echo $row['user_id'] ?>">
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
<div class="modal fade modal-add-user" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_add_user" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ເພີ່ມຂໍ້ມູນຜູ້ໃຊ້</h4>
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

                            <select class="form-control  default-select2" id="teach_id" name="teach_id">
                                <option>...ເລືອກອາຈານ...</option>
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
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ລະຫັດຜ່ານ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                            ສິດທີ
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control  default-select2" id="status" name="status">
                                <option>...ເລືອກສິດທີ...</option>
                                <option value="1">ວີຊາການ</option>
                                <option value="2">ອາຈານປະຈຳວີຊາ</option>
                                <option value="3">ຂໍ້ມູນຂ່າວສານ</option>
                                <option value="4">ອຳໜ່ວຍການ</option>     
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
<div class="modal fade modal-update-user" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_update_user" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ແກ້ໄຂຂໍ້ມູນຜູ້ໃຊ້</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div id="display_view_user_content"></div>

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