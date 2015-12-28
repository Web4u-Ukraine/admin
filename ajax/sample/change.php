<?
require('../../db.php');

sql(3, "zaklad", "name='$_POST[name]', text='$_POST[text]', pref='$_POST[pref]' where id='$_POST[id]'");

echo 'Информация обновлена';