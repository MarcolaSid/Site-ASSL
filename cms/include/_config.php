<?php
setlocale(LC_TIME,"pt_BR");
date_default_timezone_set("America/Sao_Paulo");

header("Content-Type: text/html; charset=utf-8");
ini_set("default_charset","UTF-8");

ini_set("display_errors",1);
error_reporting(E_ALL^E_NOTICE^E_WARNING);

include("../inc/adodb/adodb.inc.php");

 $conn = NewADOConnection("mysqli");
 $conn->connect("localhost","asslcom_user", "eP93u47JYio6GNK", "asslcom_cms");

$db->debug = false;
?>
