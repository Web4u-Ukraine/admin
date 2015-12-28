<?
session_start();
require('../db.php');

$more=array();
$not=array("table");

$editSql=new createSql($_POST);
$editSql=$editSql->editSql($not);

sql(3, "$_POST[table]", "$editSql where id='$_POST[id]'");

echo "Информация обновлена";
?>