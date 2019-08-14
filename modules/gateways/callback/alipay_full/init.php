<?php
define("BASIC_PATH", __DIR__ ."/../../../../");
if (file_exists(BASIC_PATH. "init.php")){
    require_once BASIC_PATH. "init.php";
} else {
    require_once BASIC_PATH. "dbconnect.php";
}

require_once BASIC_PATH. "includes/functions.php";
require_once BASIC_PATH. "includes/gatewayfunctions.php";
require_once BASIC_PATH. "includes/invoicefunctions.php";

$fee = "0";
$gatewaymodule = "alipay_full";