<?
require('db.php');
//print_r($_POST);
//die();
$name=md5(date("YmdHis"));
$img = explode(',', str_replace(' ', '+', $_POST[tmp]));
//echo $img[1];
$img= base64_decode($img[1]);
$ext=explode('.', $_POST[name]);
$ext=$ext[count($ext)-1];
if (!isset($_POST[folder])||$_POST[folder]=='/source/'){
	$fpng = fopen($_SERVER['DOCUMENT_ROOT']."/source/".$name.".".$ext, "w");
} else {
	$fpng = fopen($_SERVER['DOCUMENT_ROOT'].$_POST[folder].$name.".".$ext, "w");
}
//echo $img;
//die();
fwrite($fpng,$img);
fclose($fpng);
$fname.=$name.'.'.$ext;

/*
if ($_POST[folder]=='/source/gallery/'){
	sql(2, "last_load_photo", "(img) values ('$fname')");
}
*/
sleep(1);
echo $fname;
?>