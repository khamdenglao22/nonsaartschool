<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;
$api = new UpdateLevel();


$row_sch = $api->getSch();
$row_level = $api->getLevel();

?>

<h1 class="page-header">ຈັດການ <small>ຊັ້ນຮຽນໃໝ່</small></h1>
<div class="row">

    <div class="col-xl-12">
        <div class="panel panel-inverse">

            <div class="panel-heading">
                <h4 class="panel-title">ຊັ້ນຮຽນໃໝ່</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>


            <div class="panel-body">
                <div class="col-xl-12 ">
                   
                
                    <div class="form-group row member_section_empty">
                        <label class="col-md-1"></label>
                        <label class="col-md-1" for="address">ສົກຮຽນເກົ່າ: </label>
                        <div class="col-md-2">
                            <select class="form-control  default-select2" id="old_sch_id" name="old_sch_id" data-placeholder="...ເລືອກສົກຮຽນ...">
                            <option></option>
                                <?php
                                foreach ($row_sch as $sy) {
                                    echo '<option value="' . $sy['sch_id'] . '">' . $sy['sch_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-1" for="address">ຊັ້ນຮຽນເກົ່າ: </label>
                        <div class="col-md-2">
                            <select class="form-control getLevel default-select2" id="old_level_id" name="old_level_id" data-placeholder="...ເລືອກຊັ້ນ...">
                            <option></option>
                                <?php
                                foreach ($row_level as $cl) {
                                    echo '<option value="' . $cl['level_id'] . '">' . $cl['level_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>

                    <div class="form-group row member_section_empty">
                        <label class="col-md-1"></label>
                        <label class="col-md-1" for="address">ສົກຮຽນໃໝ່: </label>
                        <div class="col-md-2">
                            <select class="form-control  default-select2" id="new_sch_id" name="new_sch_id" data-placeholder="...ເລືອກສົກຮຽນໃໝ່...">
                            <option></option>
                            <?php
                                foreach ($row_sch as $sy) {
                                    echo '<option value="' . $sy['sch_id'] . '">' . $sy['sch_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-md-1" for="address">ຊັ້ນຮຽນໃໝ່: </label>
                        <div class="col-md-2">
                            <select class="form-control default-select2" id="new_level_id" name="new_level_id" data-placeholder="...ເລືອກຊັ້ນ...">
                            <option></option>
                                <?php
                                foreach ($row_level as $cl) {
                                    echo '<option value="' . $cl['level_id'] . '">' . $cl['level_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    
                    <div class="form-group row">
                        <label class="col-md-2"></label>
                        <div class="col-md-4">
                           
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-primary" id="btn_update_level">ບັນທືກ</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>