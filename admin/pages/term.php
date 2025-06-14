<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;
$api = new Term();
$result = $api->getTerm();
?>

<h1 class="page-header">ຈັດການ <small>ຂໍ້ມູນພາກຮຽນ</small></h1>
<div class="row">

    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">

                        <button class="btn btn-primary btn-sm" id="btn_add_term">
                            <i class="fa fa-plus mr-1"></i>
                            ເພີ່ມຂໍ້ມູນພາກຮຽນ
                        </button>


                    </h3>
                </div>
            </div>

            <div class="panel-heading">
                <h4 class="panel-title">ຂໍ້ມູນພາກຮຽນ</h4>
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
                            <th>ພາກຮຽນ</th>


                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 0;
                        foreach ($result as $row) {
                            $i++;


                        ?>

                            <tr>
                                <td> <?php echo $i ?></td>
                                <td> <?php echo $row['term_name'] ?></td>


                                <td>

                                    <a class="btn btn-secondary btn-sm show_modal_update_term" get_term_id="<?php echo $row['term_id'] ?>" get_term_name="<?php echo $row['term_name'] ?>">
                                        <i class="fas fa-edit fa-fw"></i>
                                        ແກ້ໄຂ
                                    </a>


                                    <a class="btn btn-danger btn-sm btn_delete_term" del_term_id="<?php echo $row['term_id'] ?>">
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
<div class="modal fade modal-add-term" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_add_term" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ເພີ່ມຂໍ້ມູນພາກຮຽນ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ພາກຮຽນ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="term_name" id="term_name" class="form-control">
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
<div class="modal fade modal-update-term" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_update_term" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ແກ້ໄຂພາກຮຽນ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="update_term_id" name="update_term_id">

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ພາກຮຽນ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="update_term_name" id="update_term_name" class="form-control">
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