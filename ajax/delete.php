<?
require('../db.php');

sql(4, "$_POST[role]", "where id='$_POST[id]'");

echo 'Удалено';
?>