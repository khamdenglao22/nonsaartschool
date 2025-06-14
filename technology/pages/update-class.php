<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;


?>

<h1 class="page-header">ຍ້າຍ <small>ຫ້ອງຮຽນ</small></h1>
<div class="row">

    <div class="col-xl-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">ຍ້າຍຫ້ອງຮຽນ</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>


            <div class="panel-body">
                <div class="col-xl-12 ">
                    <!-- begin form-group row -->
                    <div class="form-group row">
                        <label class="col-md-1"></label>
                        <label class="col-md-1" for="student_code">ລະຫັດນັກຮຽນ:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="search_move_code" name="search_student_code" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" id="btn_view_student_move"><i class="fa fa-search" aria-hidden="true"></i> ຄົ້ນຫາ</button>
                        </div>
                    </div><br>
                    <div class="form-group row member_section_empty">
                        <label class="col-md-1"></label>
                        <label class="col-md-1" for="full_name">ຊື່:</label>
                        <div class="col-md-4">
                            <input disabled type="text" class="form-control">
                        </div>
                    </div>
                    <br class="br">

                    <div class="form-group row member_section_empty">
                        <label class="col-md-1"></label>
                        <label class="col-md-1" for="address">ສົກຮຽນ:</label>
                        <div class="col-md-2">
                            <input type="text" disabled class="form-control">
                        </div>
                    </div>
                    <br class="br">
                    <div class="form-group row member_section_empty">
                        <label class="col-md-1"></label>
                        <label class="col-md-1" for="address">ຫ້ອງ:</label>
                        <div class="col-md-2">
                            <input type="text" disabled class="form-control">
                        </div>
                        <label class="col-md-1" for="address">ຍ້າຍຫ້ອງ: </label>
                        <div class="col-md-2">
                            <select class="form-control getClassroom default-select2" data-placeholder="...ເລືອກຫ້ອງ...">

                            </select>
                        </div>
                    </div>
                    <br class="br">

                    <div id="display_view_student_move_section_content"></div>
                    <br class="br">
                    <div class="form-group row">
                        <label class="col-md-6" for="member_village"></label>
                        <div class="col-md-4">
                            <button class="btn btn-primary" id="btn_add_move_class">ຍ້າຍຫ້ອງ</button>
                        </div>
                    </div>

                    <br>
                </div>
            </div>
        </div>
    </div>
</div>