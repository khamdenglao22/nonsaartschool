<?php
if (!isset($_SESSION)) {
    session_start();
}
session_unset();
session_destroy();

echo "<script type=\"text/javascript\">window.location.href = '../?module=login';</script>";
exit();