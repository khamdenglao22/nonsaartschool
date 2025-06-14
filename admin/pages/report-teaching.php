<?php
$api = new ReportTeaching();

$sch = $api->getSch();
$level = $api->getClassLevel();

?>


<h1 class="page-header">ລາຍງານ<small>ຂໍ້ມູນອາຈານປະຈຳວີຊາ</small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin result-container -->
        <div class="result-container">

            <div class="d-block d-md-flex align-items-center mb-3">
                <!-- begin filter -->
                <div class="d-flex">
                    <!-- begin dropdown -->
                    <div class=" mr-2">

                    </div>
                    <!-- end dropdown -->
                </div>
                <!-- end filter -->
            </div>
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">
                        ຂໍ້ມູນອາຈານປະຈຳວີຊາ
                    </h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>

                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="form-group row">

                        <!-- <div class="col-md-2">
                            <label for="rp_from_date">From Date</label>
                            <input type="text" class="form-control gym_datepicker" value="<?php echo date('d/m/Y') ?>" id="rpch_from_date" name="rpch_from_date" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <label for="rp_to_date">To Date</label>
                            <input type="text" class="form-control gym_datepicker" value="<?php echo date('d/m/Y') ?>" id="rpch_to_date" name="rpch_to_date" autocomplete="off">
                        </div> -->
                       

                        <div class="col-md-3">
                            <label for="rp_to_date">ສົກຮຽນ</label>
                            <select class="form-control  default-select2" data-placeholder="...ເລືອກສົກຮຽນ..." id="sch_year" name="sch_year" required>
                                <option></option>
                                <?php
                                foreach ($sch as $sy) {

                                    echo '<option value="' . $sy['sch_id'] . '">' . $sy['sch_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="rp_to_date">ຊັ້ນຮຽນ</label>
                            <select class="form-control  default-select2" data-placeholder="...ເລືອກຊັ້ນຮຽນ..." id="level_id" name="level_id" required>
                                <option></option>
                                <?php
                                foreach ($level as $lv) {

                                    echo '<option value="' . $lv['level_id'] . '">' . $lv['level_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>


                        <div class="col-md-3">
                            <label for="rp_to_date">ຫັອງຮຽນ</label>
                            <select class="form-control getClassroom default-select2" data-placeholder="...ເລືອກຫັອງຮຽນ..." id="class_id" name="class_id" required>
                                <option></option>
                                
                            </select>
                        </div>

                        <!-- <div class="col-md-3">
                            <label for="rp_to_date">code</label>
                            <input type="text" class="form-control"  id="text_rp_code" name="text_rp_code" autocomplete="off">
                        </div> -->

                        <div class="col-md-2">
                            <label for="rp_to_date"> &nbsp;</label>
                            <button class="btn btn-primary" id="btn_search_report_teaching" style="margin-top: 17px"> <i class="fa fa-search" aria-hidden="true"></i> ຄົ້ນຫາ</button>
                            <button class="btn btn-danger" id="btn_print_teaching" style="margin-top: 17px"> <i class="fa fa-print" aria-hidden="true"></i> ປິຼນ</button>
                        </div>


                    </div><br>


                    <div id="display_teaching_list" class="col-md-12"> </div>


                </div>
            </div>


            <!-- end result-list -->

        </div>
        <!-- end result-container -->
    </div>
    <!-- end col-12 -->
</div>
<!-- end row -->