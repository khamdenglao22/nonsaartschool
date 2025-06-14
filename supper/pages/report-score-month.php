<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;

$api = new Report();

$sch = $api->getSch();
$class_level = $api->getClassLevel();
$subject = $api->getSubject();

?>


<h1 class="page-header">ລາຍງານ<small>ຂໍ້ມູນຄະແນນປະຈຳເດືອນ</small></h1>
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
                        ລາຍງານຄະແນນປະຈຳເດືືອນ
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

                        <div class="col-md-2">
                            <label for="rp_to_date">ສົກຮຽນ</label>
                            <select class="form-control  default-select2" data-placeholder="...ເລືອກສົກຮຽນ..." id="sch_id" name="sch_id" required>
                                <option></option>
                                <?php
                                foreach ($sch as $sy) {

                                    echo '<option value="' . $sy['sch_id'] . '">' . $sy['sch_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>



                        <div class="col-md-2">
                            <label for="rp_to_date">ວີຊາ</label>
                            <select class="form-control default-select2" data-placeholder="...ເລືອກວິຊາ..." id="sub_id" name="sub_id" required>
                                <option></option>
                                <?php
                                foreach ($subject as $sj) {

                                    echo '<option value="' . $sj['sub_id'] . '">' . $sj['sub_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="rp_to_date">ຊັ້ນຮຽນ</label>
                            <select class="form-control default-select2" data-placeholder="...ເລືອກຊັ້ນ..." id="level_id" name="level_id" required>
                                <option></option>
                                <?php
                                foreach ($class_level as $cl) {

                                    echo '<option value="' . $cl['level_id'] . '">' . $cl['level_name'] . '</option>';
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
                            <label for="rp_to_date">ເດືອນ</label>
                            <select class="form-control default-select2" data-placeholder="...ເລືອກເດືອນ..." id="month_id" name="month_id" required>
                                <option></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>

                            </select>
                        </div>

                        <!-- <div class="col-md-3">
                            <label for="rp_to_date">code</label>
                            <input type="text" class="form-control"  id="text_rp_code" name="text_rp_code" autocomplete="off">
                        </div> -->

                        <div class="col-md-2">
                            <label for="rp_to_date"> &nbsp;</label>
                            <button class="btn btn-primary" id="btn_search_score_month" style="margin-top: 17px"> <i class="fa fa-search" aria-hidden="true"></i> ຄົ້ນຫາ</button>
                            <button class="btn btn-danger" id="btn_print_score_month" style="margin-top: 17px"> <i class="fa fa-print" aria-hidden="true"></i> ປິຼນ</button>
                        </div>


                    </div><br>


                    <div id="display_view_score_month_list" class="col-md-12"> </div>

                    

                </div>
            </div>


            <!-- end result-list -->

        </div>
        <!-- end result-container -->
    </div>
    <!-- end col-12 -->
</div>
<!-- end row -->