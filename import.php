<?
require('db.php');
require_once $_SERVER['DOCUMENT_ROOT']."/поиск/admin/Excel/reader.php";

$name=md5(date("YmdHis"));
$img = explode(',', $_POST[tmp]);
$img= base64_decode($img[1]);
$ext=explode('.', $_POST[name]);
$ext=$ext[count($ext)-1];
$fpng = fopen($_SERVER['DOCUMENT_ROOT']."/поиск/import/".$name.".".$ext, "w");
fwrite($fpng,$img);
fclose($fpng);
$fname.=$name.'.'.$ext;

$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding("UTF-8"); //Кодировка выходных данных
$data->read($_SERVER['DOCUMENT_ROOT'].'/поиск/import/'.$fname);
//$res=db_select("truncate table x1_category");
for ($i=1; $i<=$data->sheets[0]["numRows"]; $i++){
/*
	if ($data->sheets[0]["cells"][$i][6]!=''){
		$parent=$data->sheets[0]["cells"][$i][6];
	} else if ($data->sheets[0]["cells"][$i][5]!=''){
		$parent=$data->sheets[0]["cells"][$i][5];
	} else if ($data->sheets[0]["cells"][$i][4]!=''){
		$parent=$data->sheets[0]["cells"][$i][4];
	} else if ($data->sheets[0]["cells"][$i][3]!=''){
		$parent=$data->sheets[0]["cells"][$i][3];
	} else if ($data->sheets[0]["cells"][$i][2]!=''){
		$parent=$data->sheets[0]["cells"][$i][2];
	}
	
	if ($parent=='10917'){
		$parent=0;
	}
*/
	
	$ident=$data->sheets[0]["cells"][$i][1];
	$komplex=$data->sheets[0]["cells"][$i][2];
	$rayons=$data->sheets[0]["cells"][$i][3];
	$liters=$data->sheets[0]["cells"][$i][4];
	$podpod=$data->sheets[0]["cells"][$i][5];
	$etag=$data->sheets[0]["cells"][$i][6];
	$nomer=$data->sheets[0]["cells"][$i][7];
	$komnat=$data->sheets[0]["cells"][$i][8];
	$plosha_all=$data->sheets[0]["cells"][$i][9];
	$plosha_gul=$data->sheets[0]["cells"][$i][10];
	$plosha_kuh=$data->sheets[0]["cells"][$i][11];
	$price_za_metr=$data->sheets[0]["cells"][$i][12];
	$price_all=$data->sheets[0]["cells"][$i][13];
	
	//$name=addslashes(preg_replace('|[0-9]+.|', '', $data->sheets[0]["cells"][$i][7]));
	
	//$pref=str2url($name);
	
/*
	if ($parent!=0){
		$res=db_select("select id from x1_category where ident='$parent'");
		$row=mysql_fetch_array($res);
		$sub=$row[0];
	} else {
		$sub=0;
	}
*/
	if ($ident!=''){	
		sql(3, "kvartirs", "etag='$etag', nomer='$nomer', komnat='$komnat', plosha_all='$plosha_all', plosha_gul='$plosha_gul', plosha_kuh='$plosha_kuh', price_za_metr='$price_za_metr', price_all='$price_all', podpod='$podpod', komplex='$komplex', rayon='$rayons', liters='$liters' where id='$ident'");
	} else {
		sql(2, "kvartirs", "(komplex, rayon, liters, etag, nomer, komnat, plosha_all, plosha_gul, plosha_kuh, price_za_metr, price_all, podpod) values ('$komplex', '$rayons', '$liters', '$etag', '$nomer', '$komnat', '$plosha_all', '$plosha_gul', '$plosha_kuh', '$price_za_metr', '$price_all', '$podpod')");
	}
	
}

echo 'Информация обновлена';