<?
require('db.php');
session_start();
ini_set("display_errors", "0");
// Include the PHPWord.php, all other classes were loaded by an autoloader
require_once '../phpword/PHPWord.php';

// Create a new PHPWord Object
$PHPWord = new PHPWord();

// Every element you want to append to the word document is placed in a section. So you need a section:
$section = $PHPWord->createSection();

$komplex=sql(1, "komplex", "where id='$_POST[id]'");
$q=$komplex[0];
$r=$komplex[0][rayon];
$rayon=sql(1, "rayons", "where id='$r'");
$city=sql(1, "ceo", "where id='$q[city]'");
$teh=sql(1, "tehnologi", "where id='$q[tehnologi_stroy]'");
$kv=sql(1, "services", "where id='$q[data_zdach]'");
$ck=sql(1, "count_komtan", "where id in ($q[count_komtan_gk])");
foreach ($ck as $j){
	$ckom[]=$j[name];
}
// After creating a section, you can append elements:
//$section->addText('Hello world!');
// You can directly style your text by giving the addText function an array:
$section->addText($komplex[0][name], array('size'=>16, 'bold'=>true));
$section->addText('Район: '.$rayon[0][name], array('size'=>15));
$section->addText('Город: '.$city[0][name]);
$section->addText('Адрес: '.$q[maps]);
$section->addText('');
$section->addText('Описание', array('size'=>14, 'bold'=>true));
$section->addText('Застройщик: '.$q[zastroy]);
$section->addText('Срок сдачи ЖК: '.$kv[0][name]);
$section->addText('Площадь застройки: '.$q[plosha]);
$section->addText('Кол-во домов: '.$q[count_hous]);
$section->addText('Кол-во подъездов: '.$q[count_pid]);
$section->addText('Кол-во этажей: '.$q[count_pov]);
$section->addText('Цена от: '.$q[price_z_ot]);
$section->addText('Цена до: '.$q[price_z_do]);
$section->addText('Количество комнат: '.implode(', ', $ckom));
$section->addText('Резерв/бронь: '.$q[rez_bron]);
$section->addText('Тип оплаты: '.$q[type_pay]);
$section->addText('');
$section->addText('Паркинг', array('size'=>14, 'bold'=>true));
$section->addText('Наземная или подземная: '.$q[parking]);
$section->addText('Кол-во мест: '.$q[count_parking]);
$section->addText('Цена: '.$q[price_parking]);
$section->addText('');
$section->addText('Жилая недвижимость', array('size'=>14, 'bold'=>true));
$section->addText('Высота этажа: '.$q[height_etag]);
$section->addText('Количество комнат (от и до): '.$q[count_komnat]);
$section->addText('Площадь кв.м. (от и до): '.$q[plosha_kva]);
$section->addText('Стоимость за кв. м.: '.$q[price_kva]);
$section->addText('Балкон/лоджия: '.$q[balkons]);
$section->addText('Отделка: '.$q[otdelka]);
$section->addText('');
$section->addText('Коммерческая недвижимость', array('size'=>14, 'bold'=>true));
$section->addText('Литеры: '.$q[kom_liter]);
$section->addText('Площадь офиса: '.$q[kom_plosha]);
$section->addText('Цена за кв. м. без отделки: '.$q[kom_price]);
$section->addText('');
$section->addText('Тех. характеристики', array('size'=>14, 'bold'=>true));
$section->addText('Кол-во секций: '.$q[count_section]);
$section->addText('Технология строительства: '.$teh[0][name]);
$section->addText('Материал внешних стен: '.$q[mat_vhesh_sten]);
$section->addText('Кол-во лифтов: '.$q[count_lift]);
$section->addText('Безопасность: '.$q[bezopasnost]);
$section->addText('Коммуникации: '.$q[comunikation]);
$section->addText('');
$section->addText('Соц. инфраструктура', array('size'=>14, 'bold'=>true));
$section->addText('Транспорт: '.$q[transport]);
$section->addText('Больница (поликлиника): '.$q[bolniza]);
$section->addText('Детсад: '.$q[detsad]);
$section->addText('Школа: '.$q[shkola]);
$section->addText('Аптека: '.$q[apteka]);
$section->addText('Универсам (магазин): '.$q[universam]);
$section->addText('Торговый центр: '.$q[torg_center]);
$section->addText('Парк (зеленая зона): '.$q[park]);

// If you often need the same style again you can create a user defined style to the word document
// and give the addText function the name of the style:
//$PHPWord->addFontStyle('myOwnStyle', array('name'=>'Verdana', 'size'=>14, 'color'=>'1B2232'));
//$section->addText('Hello world! I am formatted by a user defined style', 'myOwnStyle');

// You can also putthe appended element to local object an call functions like this:
/*
$myTextElement = $section->addText('Hello World!');
$myTextElement->setBold();
$myTextElement->setName('Verdana');
$myTextElement->setSize(22);
*/

// At least write the document to webspace:
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save($_SERVER['DOCUMENT_ROOT'].'/поиск/docs/komplex_'.date("H:i d.m.Y").'.docx');
echo '/поиск/docs/komplex_'.date("H:i d.m.Y").'.docx';