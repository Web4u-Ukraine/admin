<?php
date_default_timezone_set('Europe/Kiev');
session_start();
$login=$_SESSION['login_admin'];
$access=$_SESSION[access];
$puth=$_SERVER["REQUEST_URI"];

$inputstring=($_SERVER["REQUEST_URI"]);
$inputstring=str_replace(array("(",")","'","+"),'',$inputstring);
$splitArray = explode('/',$inputstring); 

$arg1=$splitArray[1];
$arg2=$splitArray[2];
$arg3=$splitArray[3];
$arg4=$splitArray[4];
$arg5=$splitArray[5];
$arg6=$splitArray[6];

if ($arg1!=''){ $pref="$arg1"; }
if ($arg2!=''){ $pref="$arg2"; }
if ($arg3!=''){ $pref="$arg3"; }
if ($arg4!=''){ $pref="$arg4"; }
if ($arg5!=''){ $pref="$arg5"; }
if ($arg6!=''){ $pref="$arg6"; }

$date_day=date("d");
$date_month=date("m");
$date_year=date("Y");
$date_hour=date("H");
$date_min=date("i");
include('db.php');
include('config.php');
include('modules/header.php');
include('modules/top.php');
if ($arg2==''){
	include('modules/login.php');
} else {
	if (file_exists('modules/'.$arg2.'.php')){
		include('modules/'.$arg2.'.php');
	} else {
		include('modules/index.php');
	}
}
include('modules/footer.php');
?>