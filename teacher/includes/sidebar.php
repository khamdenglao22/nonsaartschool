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

            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'teacher/?module=score') {
                                        echo "active";
                                    } ?>">
                <a href="?module=score" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ຈັດການຄະແນນ
                    </div>
                </a>
            </div>
            <div class="menu-item has-sub <?php if ($absolute_url == SITE_URL . 'teacher/?module=report-score' || $absolute_url == SITE_URL . 'teacher/?module=report-subject') {
                                                echo "active";
                                            } ?>">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-table"></i>
                    </div>
                    <div class="menu-text">ລາຍງານ</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">

                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'teacher/?module=report-score') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-score" class="menu-link">
                            <div class="menu-text">ລາຍງານຂໍ້ມູນຄະແນນ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'teacher/?module=report-subject') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-subject" class="menu-link">
                            <div class="menu-text">ລາຍງານຂໍ້ມູນລາຍວີຊາຮຽນ</div>
                        </a>
                    </div>
                    <!-- <div class="menu-item">
                        <a href="?module=class-level" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນຊັ້ນຮຽນ</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="?module=teacher" class="menu-link">
                           <div class="menu-text">ຂໍ້ມູນຫ້ອງຮຽນ</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="?module=teacher" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນສົກຮຽນ</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="?module=teacher" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນພາກຮຽນ</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="?module=user" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນຜູ້ໃຊ້ລະບົບ</div>
                        </a>
                    </div>
                    <div class="menu-item has-sub">
                        <a href="javascript:;" class="menu-link">
                            <div class="menu-text">Managed Tables</div>
                            <div class="menu-caret"></div>
                        </a>
                        <div class="menu-submenu">
                            <div class="menu-item">
                                <a href="table_manage_select.html" class="menu-link">
                                    <div class="menu-text">Select</div>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="table_manage_combine.html" class="menu-link">
                                    <div class="menu-text">Extension Combination</div>
                                </a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

        </div>

    </div>

</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>