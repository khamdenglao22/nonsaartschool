<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;

$api = new Teacher();
$teacher = $api->getTeacher();
$province = $api->getProvince();
$district = $api->getDistrict();

?>

<h1 class="page-header">ຈັດການ <small>ຂໍ້ມູອາຈານ</small></h1>
<div class="row">

    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">

                        <button class="btn btn-primary btn-sm" id="btn_add_teacher">
                            <i class="fa fa-plus mr-1"></i>
                            ເພີ່ມຂໍ້ມູນອາຈານ
                        </button>
                    </h3>
                </div>
            </div>

            <div class="panel-heading">
                <h4 class="panel-title">ຂໍ້ມູນອາຈານ</h4>
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
                            <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                            <th>ເພດ</th>
                            <th>ວັນເດືອນປີເກີດ</th>
                            <th>ສະຖານະ</th>
                            <th>ເບີ</th>
                            <th>ຊົນເຜົ່າ</th>
                            <th>ບ້ານ</th>
                            <th>ເມືອງ</th>
                            <th>ແຂວງ</th>
                            <th>ວີຊາສະເພາະ</th>
                            <th>ລະລັບການສຶກສາ</th>
             


                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 0;
                        foreach ($teacher as $row) {
                            $i++;
                        ?>

                            <tr>
                                <td> <?php echo $i ?></td>
                                <td> <?php echo $row['teach_name'] ?></td>
                                <td> <?php echo $row['sex'] ?></td>
                                <td> <?php echo ViewFormatDate($row['birthday']) ?></td>
                                <td> <?php echo $row['status'] ?></td>
                                <td> <?php echo $row['mobile'] ?></td>
                                <td> <?php echo $row['ethic'] ?></td>
                                <td> <?php echo $row['village'] ?></td>
                                <td> <?php echo $row['dis_name'] ?></td>
                                <td> <?php echo $row['pro_name'] ?></td>
                                <td> <?php echo $row['subject'] ?></td>
                                <td> <?php echo $row['subject_level'] ?></td>
                              

                                <td>

                                    <a class="btn btn-secondary btn-sm show_modal_update_teacher" get_teacher_id="<?php echo $row['teach_id'] ?>">
                                        <i class="fas fa-edit fa-fw"></i>
                                        ແກ້ໄຂ
                                    </a>


                                    <a class="btn btn-danger btn-sm btn_delete_teacher" del_teacher_id="<?php echo $row['teach_id'] ?>">
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
<div class="modal fade modal-add-teacher" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_add_teacher" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ເພີ່ມຂໍ້ມູອາຈານ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ຊື່ ແລະ ນາມສະກຸນ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="teach_name" id="teach_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6" for="sex">ເພດ <span class="required">*</span></label>
                        <label class="col-md-6" for="status">ສະຖານະ <span class="required">*</span></label>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <select class="form-control default-select2" data-placeholder="...ເລືອກເພດ..." id="sex" name="sex" required>
                                <option value=""></option>
                                <option value="ຊາຍ">ຊາຍ</option>
                                <option value="ຍິງ">ຍິງ</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control default-select2" data-placeholder="...ເລືອກສະຖານະ..." id="status" name="status" required>
                                <option value=""></option>
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
                            <select class="form-control default-select2" data-placeholder="...ເລືອກຊົນເຜົ່າ..." id="ethic" name="ethic" required>
                                <option value=""></option>
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
                            <input type="date" class="form-control datepicker-here" value="<?php echo date("d/m/Y"); ?>" data-date-format="dd/m/yyyy" data-language='en' id="teacher_date" placeholder="dd/mm/yyyy" autocomplete="off">

                        </div>


                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12"> ເບີ
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6" for="sex">ແຂວງ <span class="required">*</span></label>
                        <label class="col-md-6" for="status">ເມືອງ <span class="required">*</span></label>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <select class="form-control default-select2" data-placeholder="...ເລືອກແຂວງ..." id="province_id" name="province_id" required>
                                <option value=""></option>
                                <?php
                                foreach ($province as $lv) {
                                    echo '<option value="' . $lv['pro_id'] . '">' . $lv['pro_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control district default-select2" data-placeholder="...ເລືອກເມືອງ..." id="dis_id" name="dis_id" required>
                                <option value=""></option>
                                
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
                            ວິຊາສະເພາະ
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">

                        <select class="form-control default-select2" data-placeholder="...ເລືອກວິຊາສະເພາະ..." id="subject" name="subject" required>
                                <option></option>
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
                            <select class="form-control  default-select2" data-placeholder="...ເລືອກລະລັບການສຶກສາ..." id="subject_level" name="subject_level" required>
                                <option></option>
                                <option value="ຊັ້ນສູງ">ຊັ້ນສູງ</option>
                                <option value="ຊັ້ນກາງ">ຊັ້ນກາງ</option>
                                <option value="ປະລິນຍາຕີ">ປະລິນຍາຕີ</option>
                                <option value="ປະລິນຍາໂທ">ປະລິນຍາໂທ</option>
                                <option value="ປະລິນຍາເອກ">ປະລິນຍາເອກ</option>
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
<div class="modal fade modal-update-teacher" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form_update_teacher" action="../api/api.php" method="post" enctype="multipart/form-data">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ແກ້ໄຂຂໍ້ມູອາຈານ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div id="display_view_teacher_content"></div>

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