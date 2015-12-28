<div class="row">
	<? if ($arg3==''){ 
	$res=sql(0, "SHOW COLUMNS FROM $arg2");
	?>
	<div class="col-md-12">
		<div class="widget stacked">
		    <div class="widget-header">
		      	<i class="icon-pencil"></i>
			  	<h3><?= $page[$arg2][index] ?></h3>
			  	<? if ($page[$arg2][add]!=''){ ?>
			  	<a href="/admin/<?= $arg2 ?>/add/" class="btn btn-primary btn-xs pull-right">add</a>
			  	<? } ?>
			  	<!-- Single button -->
			<div class="btn-group pull-right">
			  <button type="button" class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Поля <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" id="set-col">
				<? for ($i=0;$i<count($res);$i++){ ?>
			    <li><a href="javascript:;" data-target="<?= $table[$arg2][$res[$i][0]][name] ?>" data-role="column" data-column="<?= $i ?>"><?= $table[$arg2][$res[$i][0]][name] ?></a></li>
			    <? } ?>
			  </ul>
			</div>
		    </div> <!-- /.widget-header -->
			
			<div class="widget-content">
				<table id="index" class="display" cellspacing="0" width="100%">
			        <thead>
			            <tr>
				            <? 
					        for ($i=0;$i<count($res);$i++){ 
						        $array_title[]=$res[$i][0];
					        ?>
			                <th><?= $table[$arg2][$res[$i][0]][name] ?></th>
			                <? } ?>
			                <th></th>							
			            </tr>
			        </thead>
			 
			        <tbody>
				        <?
					    $index=sql(1, "$arg2", "order by id");
					    foreach ($index as $q){
						?>
			            <tr>
				            <? for ($j=0;$j<count($q)/2;$j++){ ?>
			                <td>
				                <?
					            if ($table[$arg2][$array_title[$j]][type]=='select'){
						            $tab=$table[$arg2][$array_title[$j]][table][name];
						            $val=$table[$arg2][$array_title[$j]][table][value]; 
						            $tx=$table[$arg2][$array_title[$j]][table][text];
						            $zn=$q[$j];
						            $text=sql(1, "$tab", "where $val='$zn'");
						            echo $text[0][$tx];
					            } else if (preg_match("/(jpg|jpeg|gif|bmp|png)/", $q[$j])!=0) {
						            ?>
						            <a href="/source/<?= $arg2 ?>/<?= $q[$j] ?>" class="ui-lightbox"><img src="/timthumb.php?src=/source/<?= $arg2 ?>/<?= $q[$j] ?>&zc=2&w=100&h=50" alt="" /></a><a href="/source/<?= $arg2 ?>/<?= $q[$j] ?>" class="preview"></a>
						            <?
						        } else {
						            echo $q[$j];
					            }
					            ?>
			                </td>
                            <? } ?>
			                <td class="text-right">
				                <a href="<?= $puth ?>edit/?id=<?= $q[id] ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
				                <button data-role="delete" data-page="<?= $arg2 ?>" data-id="<?= $q[id] ?>" class="btn btn-default"><i class="fa fa-trash"></i></button>
				           </td>
			            </tr>
			            <? } ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
	<? } else {
		require($arg3.'.php');	
	}
	?> 
	
</div>