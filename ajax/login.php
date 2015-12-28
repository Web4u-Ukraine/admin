<?
session_start();
require('../db.php');

$login=strip_tags($_POST[username]);
$pass=md5($_POST[password]);

$yes=sql(1, "admin", "where login='$login' and pass='$pass'");
if (count($yes)>0){
	echo 1;
	$_SESSION[login_admin]=$login;
	$_SESSION[access]=$yes[0][access];
} else {
	echo 0;
	unset($_SESSION[login_admin]);
	unset($_SESSION[access]);
}