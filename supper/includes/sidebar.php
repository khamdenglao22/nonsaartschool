<?php
function url_origin($s, $use_forwarded_host = false)
{
    $ssl      = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
    $sp       = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port     = $s['SERVER_PORT'];
    $port     = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
    $host     = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host     = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}
function full_url($s, $use_forwarded_host = false)
{
    return url_origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
}

$absolute_url = full_url($_SERVER);


?>

<div id="sidebar" class="app-sidebar">

    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

        <div class="menu">
            <div class="menu-item d-flex">
                <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </div>


            <!-- <div class="menu-item has-sub active">
                <a href="?module=report-teacher" class="menu-link ">
                    <div class="menu-icon">
                        <i class="nav-icon fas fa-home"></i>
                    </div>
                    <div class="menu-text">
                        ໜ້າຫຼັກ
                    </div>
                </a>
            </div> -->
            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'supper/?module=report-teacher') {
                                        echo "active";
                                    } ?>">
                <a href="?module=report-teacher" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ລາຍງານຂໍ້ມູນອາຈານ
                    </div>
                </a>
            </div>


            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'supper/?module=report-student') {
                                        echo "active";
                                    } ?>">
                <a href="?module=report-student" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ລາຍງານຂໍ້ມູນັກຮຽນ
                    </div>
                </a>
            </div>


            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'supper/?module=report-score-month') {
                                        echo "active";
                                    } ?>">
                <a href="?module=report-score-month" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ລາຍງານຄະແນນປະຈຳເດືອນ
                    </div>
                </a>
            </div>


            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'supper/?module=report-score-term') {
                                        echo "active";
                                    } ?>">
                <a href="?module=report-score-term" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ລາຍງານຄະແນນພາກຮຽນ
                    </div>
                </a>
            </div>


            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'supper/?module=report-recipe') {
                                        echo "active";
                                    } ?>">
                <a href="?module=report-recipe" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ລາຍງານລາຍຮັບ
                    </div>
                </a>
            </div>



        </div>

    </div>

</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>