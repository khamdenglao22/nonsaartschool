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

            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'technology/?module=register') {
                                        echo "active";
                                    } ?>">
                <a href="?module=register" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ລົງທະບຽນ
                    </div>
                </a>
            </div>

            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'technology/?module=update-level') {
                                        echo "active";
                                    } ?>">
                <a href="?module=update-level" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ຈັດການຊັ້ນຮຽນໃໝ່
                    </div>
                </a>
            </div>


            <div class="menu-item <?php if ($absolute_url == SITE_URL . 'technology/?module=update-class') {
                                        echo "active";
                                    } ?>">
                <a href="?module=update-class" class="menu-link">
                    <div class="menu-icon">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </div>
                    <div class="menu-text">
                        ຈັດການການຍ້າຍຫ້ອງ
                    </div>
                </a>
            </div>


            <div class="menu-item has-sub <?php if ($absolute_url == SITE_URL . 'technology/?module=teacher' || $absolute_url == SITE_URL . 'technology/?module=student') {
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

                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'technology/?module=teacher') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=teacher" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນອາຈານ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'technology/?module=student') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=student" class="menu-link">
                            <div class="menu-text">ຂໍ້ມູນນັກຮຽນ</div>
                        </a>
                    </div>


                </div>
            </div>
            <div class="menu-item has-sub <?php if ($absolute_url == SITE_URL . 'technology/?module=report-teacher' || $absolute_url == SITE_URL . 'technology/?module=report-student' || $absolute_url == SITE_URL . 'technology/?module=report-register' || $absolute_url == SITE_URL . 'technology/?module=report-recipe') {
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
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'technology/?module=report-teacher') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-teacher" class="menu-link">
                            <div class="menu-text">ລາຍງານຂໍ້ມູນອາຈານ</div>
                        </a>
                    </div>
                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'technology/?module=report-student') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-student" class="menu-link">
                            <div class="menu-text">ລາຍງານຂໍ້ມູນນັກຮຽນ</div>
                        </a>
                    </div>

                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'technology/?module=report-register') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-register" class="menu-link">
                            <div class="menu-text">ລາຍງານຂໍ້ມູນລົງທະບຽນ</div>
                        </a>
                    </div>

                    <div class="menu-item <?php if ($absolute_url == SITE_URL . 'technology/?module=report-recipe') {
                                                echo "active";
                                            } ?>">
                        <a href="?module=report-recipe" class="menu-link">
                            <div class="menu-text">ລາຍງານລາຍຮັບ</div>
                        </a>
                    </div>

                </div>
            </div>

            <!-- <div class="menu-item has-sub">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <div class="menu-text">Page Options</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="page_blank.html" class="menu-link">
                            <div class="menu-text">Blank Page</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="page_with_footer.html" class="menu-link">
                            <div class="menu-text">Page with Footer</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="page_without_sidebar.html" class="menu-link">
                            <div class="menu-text">Page without Sidebar</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="page_with_right_sidebar.html" class="menu-link">
                            <div class="menu-text">Page with Right Sidebar</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="page_with_minified_sidebar.html" class="menu-link">
                            <div class="menu-text">Page with Minified Sidebar</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item has-sub">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-key"></i>
                    </div>
                    <div class="menu-text">Login & Register</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item">
                        <a href="login.html" class="menu-link">
                            <div class="menu-text">Login</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="login_v2.html" class="menu-link">
                            <div class="menu-text">Login v2</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="login_v3.html" class="menu-link">
                            <div class="menu-text">Login v3</div>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="register_v3.html" class="menu-link">
                            <div class="menu-text">Register v3</div>
                        </a>
                    </div>
                </div>
            </div> -->


        </div>

    </div>

</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>