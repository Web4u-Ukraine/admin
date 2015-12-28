<div class="row">
	<? if ($arg3==''){ ?>
	<div class="col-md-12">
		<div class="widget stacked">
		    <div class="widget-header">
		      	<i class="icon-pencil"></i>
			  	<h3>Заклади</h3>
		    </div> <!-- /.widget-header -->
			    
			<div class="widget-content">
				<table id="users" class="display" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>ID</th>
			                <th>Назва</th>
			                <th>Текст</th>
			                <th>Pref</th>
                            <th>Адреса</th>
                            <th>Телефон</th>
                            <th>Графік роботи</th>
                            <th>ПІБ ШЕф-кухаря</th>
			                <th></th>
			            </tr>
			        </thead>
			 
			        <tbody>
				        <?
					    $zaklad=sql(1, "zaklad", "order by id");
					    foreach ($zaklad as $q){
						?>
			            <tr>
			                <td><?= $q[id] ?></td>
			                <td><?= $q[name] ?></td>
			                <td><?= dlina($q[text],20) ?></td>
			                <td><?= $q[pref] ?></td>
                            <td><?= $q[address] ?></td>
                            <td><?= $q[phone] ?></td>
                            <td><?= $q[timetable] ?></td>
                            <td><?= $q[name_chief] ?></td>
			                <td class="text-right">
				                <a href="<?= $path ?>edit/?id=<?= $q[id] ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
				                <button data-role="delete" data-page="zaklad" data-id="<?= $q[id] ?>" class="btn btn-default"><i class="fa fa-trash"></i></button>
			                </td>
			            </tr>
			            <? } ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
	<? } else {

		require($arg2.'/'.$arg3.'.php');	
	}
	?> 
</div>