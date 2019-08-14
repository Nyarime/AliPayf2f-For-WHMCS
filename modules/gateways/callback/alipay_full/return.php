<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once __DIR__  . "/init.php";

$out_trade_no = $_GET['out_trade_no'];
$trade_no = $_GET['trade_no'];
$trade_status = $_GET['trade_status'];
$amount    = $_GET['total_fee'];
$invoice_id = explode("-",$out_trade_no)[1];
require_once __DIR__  ."/init_mapi.php";

use Illuminate\Database\Capsule\Manager as Capsule;
if ($callback_result){
    if($trade_status == 'TRADE_FINISHED' or $trade_status == 'TRADE_SUCCESS')
    {
            echo '<script>
            window.location.href = "'.$GATEWAY['systemurl'].'/viewinvoice.php?id='.$invoice_id.'";
            </script>';
            $invoiceid = checkCbInvoiceID($invoice_id,$GATEWAY["name"]);
            $data = Capsule::table("tblinvoices")->where("id",$invoiceid)->get()[0];
            $userid = $data->userid;
            $currency = getCurrency( $userid );
            $amount = convertCurrency( $amount, 2, $currency['id'] );
            checkCbTransID($trade_no);
            addInvoicePayment($invoice_id,$trade_no,$amount,$fee,$gatewaymodule);
    }
}
exit("入账失败 , 请联系管理员为您手工入账");