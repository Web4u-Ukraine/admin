<?
$page=array(
	"category"=>array(
		"index"=>"Категории",
		"add"=>"Добавить категорию",
		"edit"=>"Редактировать категорию"
	)
);

$lang=array();

/*********** тут описуємо поля таблиці ***********/
$table=array(
	"category"=>array(
		"id"=>array(
			"name"=>"ID",
			"type"=>"hidden"
		),
		"name"=>array(
			"name"=>"Название",
			"type"=>"input"
		),
		"sub"=>array(
			"name"=>"Родительская категория",
			"type"=>"select",
			"table"=>array(
				"name"=>"category",
				"value"=>"id",
				"text"=>"name"
			),
			"change"=>""//--, таблиця, поле, where поле, value, text
		)
	)
);

$words=array(
	"eng"=>"На английском",
	"chi"=>"На китайском"
);