<?php
    include_once 'includes/header.php';
    if (!isset($_REQUEST['module'])) {
        echo "<script type=\"text/javascript\">window.location.href = '?module=report-teacher';</script>";
    }
?>

    <div id="app" class="app app-header-fixed app-sidebar-fixed ">
        <?php
        include_once 'includes/navbar.php';
        include_once 'includes/sidebar.php';
        ?>

        <div id="content" class="app-content">

            <?php
            if (isset($_REQUEST['module'])) {
                if (empty($_REQUEST['module']) || $_REQUEST['module'] == '' || $_REQUEST['module'] == 'report-teacher') {

                    include_once 'pages/report-teacher.php';
                } else {
                    if ($_REQUEST['module'] == 'report-teacher') {

                        include_once('pages/report-teacher.php');
                    } else {
                        include_once 'pages/' . $_REQUEST['module'] . '.php';
                    }
                }
            } else
                include_once 'pages/report-teacher.php';
            ?>
        </div>
    </div>
<?php
    require 'includes/footer.php';


?>