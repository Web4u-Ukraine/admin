<div class="col-md-12">
	<div class="widget stacked">
	    <div class="widget-header">
	      	<i class="icon-pencil"></i>
		  	<h3><?= $page[$arg2][add] ?></h3>
	    </div> <!-- /.widget-header -->
		    
		<div class="widget-content">
			<form action="/" role="form" class="form-horizontal col-md-12" id="save-index" data-table="<?= $arg2 ?>">
				<div id="wrap">
					<div data-role="tabs" data-name="Общая информация">
						<?
						$string=implode("|", $lang);
						$res=sql(0, "SHOW COLUMNS FROM $arg2");
						foreach ($res as $row){
							//if (preg_match("/($string)/", $row[0])==0){
								switch ($table[$arg2][$row[0]][type]){
									case 'input':
										?>
										<div class="form-group">
											<label class="col-md-2"><?= $table[$arg2][$row[0]][name] ?></label>
											<div class="col-md-6">
												<input type="text" class="form-control <? if ($row[0]=='data') echo 'datepicker'; ?>" name="<?= $row[0] ?>">
											</div>
										</div> <!-- /.form-group -->
										<?
										break;
										
									case 'select':
										?>
										<div class="form-group">
											<label class="col-md-2"><?= $table[$arg2][$row[0]][name] ?></label>
											<div class="col-md-6">
												<select name="<?= $row[0] ?>" class="form-control" <? if ($table[$arg2][$row[0]][change]!="") echo 'onchange="'.$table[$arg2][$row[0]][change].'"'; ?>>
													<option value="">--</option>
													<?
													if (count($table[$arg2][$row[0]][table])>0){
													$option_table=$table[$arg2][$row[0]][table][name];
													$value=$table[$arg2][$row[0]][table][value];
													$text=$table[$arg2][$row[0]][table][text];
													$where=$table[$arg2][$row[0]][table][where];
													$option=sql(1, "$option_table", "$where");
													foreach ($option as $label){
														?>
														<option value="<?= $label[$value] ?>"><?= $label[$text] ?></option>
														<?
													} }
													?>
												</select>
											</div>
										</div>
										<?
										break;
										
									case 'textarea':
										?>
										<div class="form-group">
											<label class="col-md-2"><?= $table[$arg2][$row[0]][name] ?></label>
											<div class="col-md-10">
												<textarea class="form-control  <?= $table[$arg2][$row[0]]['class'] ?>" rows="5" name="<?= $row[0] ?>"></textarea>
											</div>
										</div>
										<?
										break;
										
									case 'file':
										?>
										<div class="form-group">
											<label class="col-md-2"><?= $table[$arg2][$row[0]][name] ?></label>
											<div class="col-md-10">
												<ul class="gallery-container" data-name="<?= $row[0] ?>">
													
												</ul>
												<input type="file" id="<?= $row[0] ?>" style="display: none;">
												<button class="btn btn-primary" type="button" onclick="$('#<?= $row[0] ?>').click();"><i class="fa fa-arrow-down"> Загрузить</i></button>
											</div>
											<script>
											  function handleFileSelect(evt) {
											    var files = evt.target.files; // FileList object
											
											    // Loop through the FileList and render image files as thumbnails.
											    for (var i = 0, f; f = files[i]; i++) {
											
											      // Only process image files.
											      if (!f.type.match('image.*')) {
											        continue;
											      }
											
											      var reader = new FileReader();
											
											      // Closure to capture the file information.
											      reader.onload = (function(theFile) {
											        return function(e) {
												      $.post("/admin/source.php", {tmp:e.target.result, name:$("#<?= $row[0] ?>").val(), folder:'/source/<?= $arg2 ?>/'}, function(res){
													    $(".gallery-container[data-name=<?= $row[0] ?>]").append('<li><a href="/source/<?= $arg2 ?>/'+res+'" class="ui-lightbox"><img src="/timthumb.php?src=/source/<?= $arg2 ?>/'+res+'&zc=2&w=185&h=125" alt="" /></a><a href="/source/<?= $arg2 ?>/'+res+'" class="preview"></a><input type="hidden" value="'+res+'" name="<?= $row[0] ?>[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>');
														  $("#<?= $row[0] ?>").val('');
												      })
											          // Render thumbnail.
											        };
											      })(f);
											
											      // Read in the image file as a data URL.
											      reader.readAsDataURL(f);
											    }
											  }
											
											  document.getElementById('<?= $row[0] ?>').addEventListener('change', handleFileSelect, false);
											</script>
										</div>
										<?
										break;
								}
							//}
						}
						?>
					</div>
					
					<? foreach ($lang as $l){ ?>
					<div data-role="tabs" data-name="<?= $words[$l] ?>">
						<?
						$res=sql(0, "SHOW COLUMNS FROM $arg2");
						foreach ($res as $row){
							if (substr_count($row[0], $l)>0){
								switch ($table[$arg2][$row[0]][type]){
									case 'input':
										?>
										<div class="form-group">
											<label class="col-md-2"><?= $table[$arg2][$row[0]][name] ?></label>
											<div class="col-md-6">
												<input type="text" class="form-control <? if ($row[0]=='data') echo 'datepicker'; ?>" name="<?= $row[0] ?>">
											</div>
										</div> <!-- /.form-group -->
										<?
										break;
										
									case 'select':
										?>
										<div class="form-group">
											<label class="col-md-2"><?= $table[$arg2][$row[0]][name] ?></label>
											<div class="col-md-6">
												<select name="<?= $row[0] ?>" class="form-control" <? if ($table[$arg2][$row[0]][change]!="") echo 'onchange="'.$table[$arg2][$row[0]][change].'"'; ?>>
													<option value="">--</option>
													<?
													if (count($table[$arg2][$row[0]][table])>0){
													$option_table=$table[$arg2][$row[0]][table][name];
													$value=$table[$arg2][$row[0]][table][value];
													$text=$table[$arg2][$row[0]][table][text];
													$where=$table[$arg2][$row[0]][table][where];
													$option=sql(1, "$option_table", "$where");
													foreach ($option as $label){
														?>
														<option value="<?= $label[$value] ?>"><?= $label[$text] ?></option>
														<?
													} }
													?>
												</select>
											</div>
										</div>
										<?
										break;
										
									case 'textarea':
										?>
										<div class="form-group">
											<label class="col-md-2"><?= $table[$arg2][$row[0]][name] ?></label>
											<div class="col-md-6">
												<textarea class="form-control <?= $table[$arg2][$row[0]]['class'] ?>" rows="5" name="<?= $row[0] ?>"></textarea>
											</div>
										</div>
										<?
										break;
										
									case 'file':
										?>
										<div class="form-group">
											<label class="col-md-2"><?= $table[$arg2][$row[0]][name] ?></label>
											<div class="col-md-10">
												<ul class="gallery-container" data-name="<?= $row[0] ?>">
													
												</ul>
												<input type="file" id="<?= $row[0] ?>" style="display: none;">
												<button class="btn btn-primary" type="button" onclick="$('#<?= $row[0] ?>').click();"><i class="fa fa-arrow-down"> Загрузить</i></button>
											</div>
											<script>
											  function handleFileSelect(evt) {
											    var files = evt.target.files; // FileList object
											
											    // Loop through the FileList and render image files as thumbnails.
											    for (var i = 0, f; f = files[i]; i++) {
											
											      // Only process image files.
											      if (!f.type.match('image.*')) {
											        continue;
											      }
											
											      var reader = new FileReader();
											
											      // Closure to capture the file information.
											      reader.onload = (function(theFile) {
											        return function(e) {
												      $.post("/admin/source.php", {tmp:e.target.result, name:$("#<?= $row[0] ?>").val(), folder:'/source/<?= $arg2 ?>/'}, function(res){
													    $(".gallery-container[data-name=<?= $row[0] ?>]").append('<li><a href="/source/<?= $arg2 ?>/'+res+'" class="ui-lightbox"><img src="/timthumb.php?src=/source/<?= $arg2 ?>/'+res+'&zc=2&w=185&h=125" alt="" /></a><a href="/source/<?= $arg2 ?>/'+res+'" class="preview"></a><input type="hidden" value="'+res+'" name="<?= $row[0] ?>[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>');
														  $("#<?= $row[0] ?>").val('');
												      })
											          // Render thumbnail.
											        };
											      })(f);
											
											      // Read in the image file as a data URL.
											      reader.readAsDataURL(f);
											    }
											  }
											
											  document.getElementById('<?= $row[0] ?>').addEventListener('change', handleFileSelect, false);
											</script>
										</div>
										<?
										break;
								}
							}
						}
						?>
						 
						
					</div> <!-- /.tabs -->
					<? } ?>
				
				</div>
	            
				<div class="form-group">			
					<div class="col-md-offset-2 col-md-10">
						<button type="submit" class="btn btn-default">Сохранить</button>
					</div>
				</div> <!-- /.form-group -->
			</form>
		</div>
	</div>
</div>