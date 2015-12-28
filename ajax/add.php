<?
session_start();
require('../db.php');

$more=array();
$not=array("table");

$q=new createSql($_POST);
$res=$q->addSql($more, $not);

sql(2, "$_POST[table]", "$res");

echo "Информация добавлена";
?>