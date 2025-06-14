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

            <!-- <p style="color: #fff;"><?php echo $absolute_url; ?></p>
            <p style="color: #fff;"><?php echo SITE_URL; ?></p> -->


            <!-- <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=teaching') {
                                        echo "active";
                                    } ?> ">
                <a href="?module=teaching" class="menu-link">
                    <div class="menu-icon">
                        <i class="nav-icon fas fa-home"></i>
                    </div>
                    <div class="menu-text">
                        ໜ້າຫຼັກ
                    </div>
                </a>
            </div> -->
            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=score-term') {
                                        echo "active";
                                    } ?> ">
                <a href="?module=score-term" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ຈັດການຄະແນນພາກຮຽນ
                    </div>
                </a>
            </div>
            <div class="menu-item has-sub <?php if ($absolute_url == SITE_URL . 'admin/?module=teaching' || $absolute_url == SITE_URL . 'admin/?module=subject' || $absolute_url == SITE_URL . 'admin/?module=class-level' || $absolute_url == SITE_URL . 'admin/?module=class-room' || $absolute_url == SITE_URL . 'admin/?module=school-fee' || $absolute_url == SITE_URL . 'admin/?module=school-year' || $absolute_url == SITE_URL . 'admin/?module=term') {
                                                echo "active";
                                            } ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-table"></i>
                    </div>
                    <div class="menu-text">ຈັດການຂໍ້ມູນ</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">

                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=teaching') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=teaching" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນອາຈານປະຈຳວີຊາ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=subject') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=subject" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນລາຍວີຊາຮຽນ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=class-level') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=class-level" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນຊັ້ນຮຽນ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=class-room') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=class-room" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນຫ້ອງຮຽນ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=school-fee') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=school-fee" class="menu-link">
                            <div class="menu-text">ຄ່າຮຽນ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=school-year') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=school-year" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນສົກຮຽນ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=term') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=term" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນພາກຮຽນ</div>
                        </a>
                    </div>
                    <!-- <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=user') {
                                                    echo "active";
                                                } ?>">
                        <a href="?module=user" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນຜູ້ໃຊ້ລະບົບ</div>
                        </a>
                    </div> -->

                </div>
            </div>
            <div class="menu-item has-sub <?php if ($absolute_url == SITE_URL . 'admin/?module=report-teaching' || $absolute_url == SITE_URL . 'admin/?module=report-score' || $absolute_url == SITE_URL . 'admin/?module=report-score-term' || $absolute_url == SITE_URL . 'admin/?module=report-score-student' || $absolute_url == SITE_URL . 'admin/?module=report-score-term-student') {
                                                echo "active";
                                            } ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-cash-register"></i>
                    </div>
                    <div class="menu-text">ຂໍ້ມູນການລາຍງານ</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=report-teaching') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-teaching" class="menu-link">
                            <div class="menu-text">ລາຍງານຂໍ້ມູນອາຈານປະຈຳວິຊາ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=report-score') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-score" class="menu-link">
                            <div class="menu-text">ລາຍງານຄະແນນປະຈຳເດືອນ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=report-score-term') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-score-term" class="menu-link">
                            <div class="menu-text">ລາຍງານຄະແນນພາກ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=report-score-student') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-score-student" class="menu-link">
                            <div class="menu-text">ລາຍງານຄະແນນບຸກຄົນ</div>
                        </a>
                    </div>

                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=report-score-term-student') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-score-term-student" class="menu-link">
                            <div class="menu-text">ລາຍງານຄະແນນພາກຮຽນບຸກຄົນ</div>
                        </a>
                    </div>
                    <!-- <div class="menu-item">
                        <a href="pos_table_booking.html" target="_blank" class="menu-link">
                            <div class="menu-text">Table Booking</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="pos_menu_stock.html" target="_blank" class="menu-link">
                            <div class="menu-text">Menu Stock</div>
                        </a>
                    </div> -->
                </div>
            </div>

            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'admin/?module=user') {
                                        echo "active";
                                    } ?>">
                <a href="?module=user" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ຂໍ້ມູນຜູ້ໃຊ້
                    </div>
                </a>
            </div>
        </div>

    </div>

</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>