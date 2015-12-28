<?
require('../../db.php');

$text=addslashes($_POST[text]);
$img=implode('&', $_POST[img]);
$img_chief=implode('&', $_POST[img_cheif]);
$imglogo=implode('&', $_POST[imglogo]);
$page_menu=implode('&', $_POST[page_menu]);
$napoi=implode('&', $_POST[napoi]);

sql(3, "zaklad", "name='$_POST[name]', text='$text', imglogo='$imglogo', pref='$_POST[pref]', img='$img', address='$_POST[address]', phone='$_POST[phone]', timetable='$_POST[timetable]', name_chief='$_POST[name_chief]', img_chief='$img_chief', LAT='$_POST[LAT]', LNG='$_POST[LNG]' where id='$_POST[id]'");

sql(4, "menus", "where sub='$_POST[id]'");
sql(2, "menus", "(sub, page, napoi) values ('$_POST[id]', '$page_menu', '$napoi')");

echo 'Інформація оновлена';