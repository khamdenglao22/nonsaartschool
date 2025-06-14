<?php
include_once '../core/init.php';
$created = date('Y-m-d H:i:s');



if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'student') {
    $api = new Student();
    if ($_REQUEST['method'] == 'student-report') {

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);

        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);

        $result = $api->getViewStudentReport();
?>

        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>ລະຫັດນັກຮຽນ</th>
                    <th>ຊື່ ແລະ ນາມສະກຸນ</th>
                    <th>ຫ້ອງ</th>
                    <th>ເພດ</th>
                    <th>ເບີ</th>
                    <th>ວັນເດືອນປີເກີດ</th>
                    <th>ບ້ານ</th>
                    <th>ເມືອງ</th>
                    <th>ແຂວງ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $i++;
                ?>
                    <tr class="odd gradeX">
                        <td> <?php echo $i ?></td>
                        <td> <?php echo $row['st_no'] ?></td>
                        <td> <?php echo $row['st_name'] ?></td>
                        <td> <?php echo $row['class_name'] ?></td>
                        <td> <?php echo $row['sex'] ?></td>
                        <td> <?php echo $row['mobile'] ?></td>
                        <td> <?php echo ViewFormatDate($row['birthday']) ?></td>
                        <td> <?php echo $row['village'] ?></td>
                        <td> <?php echo $row['dis_name'] ?></td>
                        <td> <?php echo $row['pro_name'] ?></td>

                    </tr>

                <?php

                }
                ?>
            </tbody>
        </table>
    <?php
    } else if ($_REQUEST['method'] == 'view-score-month') {

        $class_id = htmlentities($_POST['class_id']);
        $sch_id = htmlentities($_POST['sch_id']);
        $sub_id = htmlentities($_POST['sub_id']);
        $month = htmlentities($_POST['month_id']);

        $api->SetClassId($class_id);
        $api->SetSchId($sch_id);
        $api->SetSubjectId($sub_id);
        $api->SetMonth($month);

        $result = $api->getViewScoreMonth();


        if (empty($result)) {
            echo "H";
            exit;
        }


    ?>


        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>ນັກຮຽນ</th>
                    <th>ຄະແນນ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['st_name'] ?></td>
                        <td><?php echo $row['score'] ?></td>

                    </tr>

                <?php

                }
                ?>
            </tbody>
        </table>
    <?php

    } else if ($_REQUEST['method'] == 'recipe-report') {

        $sch_id = htmlentities($_POST['sch_id']);

        $api->SetSchId($sch_id);

        $result = $api->getViewRecipeReport();

        if (empty($result)) {
            echo "H";
            exit;
        }

        // $num_row = count($result);
    ?>

        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>

                    <th>ຊັ້ນຮຽນ</th>
                    <th>ຄ່າຮຽນ</th>
                    <th>ຈຳນວນນັກຮຽນ</th>
                    <th>ເງີນລວມ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $amount_pay = 0;
                foreach ($result as $row) {
                    $pay = $row['pay'];
                    $amount_pay += $pay;
                ?>

                    <tr class="odd gradeX">
                        <td> <?php echo $row['level_name'] ?></td>
                        <td> <?php echo $row['pay'] ?> /ຄົນ</td>
                        <td> <?php echo $row['student'] ?> ຄົນ</td>
                        <td> <?php echo number_format($row['price']) ?> ກີບ</td>

                    </tr>
                <?php
                }

                ?>

            </tbody>
        </table>
<?php
    }
}






?>