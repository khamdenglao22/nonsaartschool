<?php

?>

<!-- begin page-header -->
<h4 class="page-header">
    &nbsp;ລົງທະບຽນ
</h4>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-xl-12">
        <!-- begin panel -->


        <div class="panel panel-inverse" data-sortable-id="form-validation-1">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title">ລົງທະບຽນ</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>

                </div>
            </div>

            <div class="panel-body">
                <div class="col-xl-12 ">
                    <!-- begin form-group row -->
                    <div class="form-group row">
                        <label class="col-md-1"></label>
                        <label class="col-md-1" for="student_code">ລະຫັດນັກຮຽນ:</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="search_student_code" name="search_student_code" autocomplete="off">
                            <div class="list-group member_code" id="autocomplete_search_content"></div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" id="btn_view_student"><i class="fa fa-search" aria-hidden="true"></i> ຄົ້ນຫາ</button>
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
                            <select class="form-control" data-placeholder="...ເລືອກສົກຮຽນ...">
                                <option></option>

                            </select>
                        </div>
                    </div>
                    <br class="br">
                    <div class="form-group row member_section_empty">
                        <label class="col-md-1"></label>
                        <label class="col-md-1" for="address">ຂື້ນຊັ້ນ: </label>
                        <div class="col-md-2">
                            <select class="form-control " data-placeholder="...ເລືອກຊັ້ນ...">

                            </select>
                        </div>
                        <label class="col-md-1" for="address">ຂື້ນຫ້ອງ: </label>
                        <div class="col-md-2">
                            <select class="form-control getClassroom" data-placeholder="...ເລືອກຫ້ອງ...">

                            </select>
                        </div>
                    </div>

                    <br class="br">
                    <div class="form-group row member_section_empty">
                        <label class="col-md-1"></label>
                        <label class="col-md-1" for="address">ຄ່າຮຽນ:</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <br class="br">

                    <div id="display_view_member_section_content"></div>
                    <br class="br">
                    <div class="form-group row">
                        <label class="col-md-2" for="member_village"></label>
                        <div class="col-md-4">
                            <button class="btn btn-primary" id="btn_register">ລົງທະບຽນ</button>
                            <button hidden class="btn btn-primary" id="btn_checkin_loading" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                loading...
                            </button>
                        </div>
                    </div>

                    <br>
                </div>
            </div>


        </div>
        <!-- end panel -->
    </div>
</div>
<!-- end row -->