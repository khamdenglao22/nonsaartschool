<?php
if (!isLoggedIn()) echo "<script type='text/javascript'>window.location.href = '?module=login';</script>";;
$api = new Report();
$teacher = $api->getTeacher();

?>

<h1 class="page-header">ລາຍງານ <small>ຂໍ້ມູອາຈານ</small></h1>
<div class="row">

    <div class="col-xl-12">
        <div class="panel panel-inverse">
        
            <div class="panel-heading">
                <h4 class="panel-title">ລານງານຂໍ້ມູນອາຈານ</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>


            <div class="panel-body">
                <div class="form-group row">
                    <div class="col-md-10">
                    </div>
                    <div class="col-md-2">
                        <label for="rp_to_date"> &nbsp;</label>
                        <!-- <button class="btn btn-primary" id="btn_search_score" style="margin-top: 17px"> <i class="fa fa-search" aria-hidden="true"></i> ຄົ້ນຫາ</button> -->
                        <button class="btn btn-danger" id="btn_print_teacher" style="margin-top: 17px;width: 100px"> <i class="fa fa-print" aria-hidden="true"></i> ປິຼນ</button>
                    </div>


                </div><br>

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
