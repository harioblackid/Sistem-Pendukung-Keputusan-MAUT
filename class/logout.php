<?php
session_start();
include 'Core.inc.php';
$core = new Core();

echo $core->ajaxRedirect("$base_url/?pg=login");
session_destroy();
?>