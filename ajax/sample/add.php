<?
require('../../db.php');

foreach ($_POST as $key=>$val){
	if ($key=='img'){
		$body1.=$key.',';
		$body2.="'".implode('&', $val)."',";
	} else {
		$body1.=$key.',';
		$body2.="'".$val."',";
	}
}

//$pref=str2url($_POST[name]);
$data=date("Y-m-d H:i:s");
$body1.="data, author";
$body2.="'".$data."','admin'";

sql(2, "news", "($body1) values ($body2)");

echo 'Информация добавлена';