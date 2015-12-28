<div class="col-md-12">
	<div class="widget stacked">
	    <div class="widget-header">
	      	<i class="icon-pencil"></i>
		  	<h3>Редагувати заклад</h3>
	    </div> <!-- /.widget-header -->
		<?
		$zaklad=sql(1, "zaklad", "where id='$_REQUEST[id]'");
		$q=$zaklad[0];
		?>
		<div class="widget-content">
			<form action="/" role="form" class="form-horizontal col-md-12" id="edit" data-table="<?= $arg2 ?>">
				<div id="wrap">
					<div data-role="tabs" data-name="Інформація">
						<input type="hidden" value="<?= $q[id] ?>" name="id">
		
		                <div class="form-group">
							<label class="col-md-2">Назва</label>
							<div class="col-md-10">
								<input type="text" name="name" value="<?= $q[name] ?>" class="form-control" />
							</div>
						</div> <!-- /.form-group -->
		
		
						<div class="form-group">
							<label class="col-md-2">Текст</label>
							<div class="col-md-10">
								<textarea name="text" class="form-control editor" style="width:100%" rows="10"><?= $q[text] ?></textarea>
							</div>
						</div> <!-- /.form-group -->
		
		                <div class="form-group">
		                    <label class="col-md-2">Pref</label>
		                    <div class="col-md-10">
		                        <input type="text" name="pref" value="<?= $q[pref] ?>" class="form-control" />
		                    </div>
		                </div> <!-- /.form-group -->
					</div>
					
					<div data-role="tabs" data-name="Адреса та фото">
						<div class="form-group">
	                        <label class="col-md-2">Логотип</label>
	                        <div class="col-md-10">
	                            <ul class="gallery-container" data-id="1">
	                                <li><a href="/source/<?= $q[imglogo] ?>" class="ui-lightbox"><img src="/timthumb.php?src=/source/<?= $q[imglogo] ?>&zc=1&w=185&h=125" alt="" /></a><a href="/source/<?= $q[imglogo] ?>" class="preview"></a><input type="hidden" value="<?= $q[imglogo] ?>" name="imglogo[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>
	                            </ul>
	                            <div class="load">
	                                <input type="file" id="files1">
	                                <button class="btn btn-primary"><i class="fa fa-arrow-down"> Загрузити</i></button>
	                            </div>
	                            <script>
	                                function handleFileSelect1(evt) {
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
	                                                $.post("/admin/source.php", {tmp:e.target.result, name:$("#files1").val()}, function(res){
	                                                    $(".gallery-container[data-id=1]").append('<li><a href="/source/'+res+'" class="ui-lightbox"><img src="/timthumb.php?src=/source/'+res+'&zc=1&w=185&h=125" alt="" /></a><a href="/source/'+res+'" class="preview"></a><input type="hidden" value="'+res+'" name="imglogo[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>');
	                                                    $("#files").val('');
	                                                })
	                                                // Render thumbnail.
	                                            };
	                                        })(f);
	
	                                        // Read in the image file as a data URL.
	                                        reader.readAsDataURL(f);
	                                    }
	                                }
	
	                                document.getElementById('files1').addEventListener('change', handleFileSelect1, false);
	                            </script>
	                        </div>
	                    </div> <!-- /.form-group -->
		                <div class="form-group">
		                    <label class="col-md-2">Фото</label>
		                    <div class="col-md-10">
		                        <ul class="gallery-container" data-id="2">
	                                <li><a href="/source/<?= $q[img] ?>" class="ui-lightbox"><img src="/timthumb.php?src=/source/<?= $q[img] ?>&zc=1&w=185&h=125" alt="" /></a><a href="/source/<?= $q[img] ?>" class="preview"></a><input type="hidden" value="<?= $q[img] ?>" name="img[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>
		                        </ul>
		                        <div class="load">
		                            <input type="file" id="files2">
		                            <button class="btn btn-primary"><i class="fa fa-arrow-down"> Загрузити</i></button>
		                        </div>
		                        <script>
		                            function handleFileSelect2(evt) {
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
		                                            $.post("/admin/source.php", {tmp:e.target.result, name:$("#files2").val()}, function(res){
		                                                $(".gallery-container[data-id=2]").append('<li><a href="/source/'+res+'" class="ui-lightbox"><img src="/timthumb.php?src=/source/'+res+'&zc=1&w=185&h=125" alt="" /></a><a href="/source/'+res+'" class="preview"></a><input type="hidden" value="'+res+'" name="img[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>');
		                                                $("#files").val('');
		                                            })
		                                            // Render thumbnail.
		                                        };
		                                    })(f);
		
		                                    // Read in the image file as a data URL.
		                                    reader.readAsDataURL(f);
		                                }
		                            }
		
		                            document.getElementById('files2').addEventListener('change', handleFileSelect2, false);
		                        </script>
		                    </div>
		                </div> <!-- /.form-group -->
		
		                <div class="form-group">
		                    <label class="col-md-2">Адреса</label>
		                    <div class="col-md-10">
		                        <input type="text" name="address" value="<?= $q[address] ?>" class="form-control" />
		                    </div>
		                </div> <!-- /.form-group -->
		
		                <div class="form-group">
		                    <label class="col-md-2">Телефон</label>
		                    <div class="col-md-10">
		                        <input type="text" name="phone" value="<?= $q[phone] ?>" class="form-control" />
		                    </div>
		                </div> <!-- /.form-group -->
		
		                <div class="form-group">
		                    <label class="col-md-2">Графік роботи</label>
		                    <div class="col-md-10">
		                        <input type="text" name="timetable" value="<?= $q[timetable] ?>" class="form-control" />
		                    </div>
		                </div> <!-- /.form-group -->
	
	
	                    <div class="form-group">
	                        <label class="col-md-2">LAT</label>
	                        <div class="col-md-10">
	                            <input type="text" name="LAT" value="<?= $q[LAT] ?>" class="form-control" />
	                        </div>
	                    </div> <!-- /.form-group -->
	
	                    <div class="form-group">
	                        <label class="col-md-2">LNG</label>
	                        <div class="col-md-10">
	                            <input type="text" name="LNG" value="<?= $q[LNG] ?>" class="form-control" />
	                        </div>
	                    </div> <!-- /.form-group -->
					</div>
					
					<div data-role="tabs" data-name="Шеф-кухар">
	                    <div class="form-group">
	                        <label class="col-md-2">ПІБ Шеф-кухаря</label>
	                        <div class="col-md-10">
	                            <input type="text" name="name_chief" value="<?= $q[name_chief] ?>" class="form-control" />
	                        </div>
	                    </div> <!-- /.form-group -->
	
	                    <div class="form-group">
	                        <label class="col-md-2">Фото Шеф-кухаря</label>
	                        <div class="col-md-10">
	                            <ul class="gallery-container" data-id="3">
	                                <li><a href="/source/<?= $q[img_chief] ?>" class="ui-lightbox"><img src="/timthumb.php?src=/source/<?= $q[img_chief] ?>&zc=1&w=185&h=125" alt="" /></a><a href="/source/<?= $q[img_chief] ?>" class="preview"></a><input type="hidden" value="<?= $q[img_chief] ?>" name="img_cheif[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>
	                            </ul>
	                            <div class="load">
	                                <input type="file" id="files3">
	                                <button class="btn btn-primary" id="button-load"><i class="fa fa-arrow-down"> Загрузити</i></button>
	                            </div>
	                            <script>
	                                function handleFileSelect3(evt) {
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
	                                                $.post("/admin/source.php", {tmp:e.target.result, name:$("#files3").val()}, function(res){
	                                                    $(".gallery-container[data-id=3]").append('<li><a href="/source/'+res+'" class="ui-lightbox"><img src="/timthumb.php?src=/source/'+res+'&zc=1&w=185&h=125" alt="" /></a><a href="/source/'+res+'" class="preview"></a><input type="hidden" value="'+res+'" name="img_cheif[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>');
	                                                })
	                                                // Render thumbnail.
	                                            };
	                                        })(f);
	
	                                        // Read in the image file as a data URL.
	                                        reader.readAsDataURL(f);
	                                    }
	                                    $("#files3").val('');
	                                }
	
	                                document.getElementById('files3').addEventListener('change', handleFileSelect3, false);
	                            </script>
	                        </div>
	                    </div> <!-- /.form-group -->
	
	                </div>
					
					<div data-role="tabs" data-name="Кухня">
		                <div class="form-group">
		                    <label class="col-md-2">Сторінки меню</label>
		                    <div class="col-md-10">
		                        <ul class="gallery-container" data-id="4">
			                        <?
				                    $menu=sql(1, "menus", "where sub='$q[id]'");
				                    $mimg=explode('&', $menu[0][page]);
				                    foreach ($mimg as $m){
					                ?>
	                                <li><a href="/source/menu/<?= $m ?>" class="ui-lightbox"><img src="/timthumb.php?src=/source/menu/<?= $m ?>&zc=1&w=185&h=125" alt="" /></a><a href="/source/menu/<?= $m ?>" class="preview"></a><input type="hidden" value="<?= $m ?>" name="page_menu[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>
	                                <? } ?>
		                        </ul>
		                        <div class="load">
		                            <input type="file" multiple="true" id="menu">
		                            <button class="btn btn-primary"><i class="fa fa-arrow-down"> Загрузити</i></button>
		                        </div>
		                    </div>
		                </div> <!-- /.form-group -->
		
					</div>
					
					<div data-role="tabs" data-name="Напої">
		                <div class="form-group">
		                    <label class="col-md-2">Сторінки меню</label>
		                    <div class="col-md-10">
		                        <ul class="gallery-container" data-id="5">
			                        <?
				                    $menu=sql(1, "menus", "where sub='$q[id]'");
				                    $mimg=explode('&', $menu[0][napoi]);
				                    foreach ($mimg as $m){
					                ?>
	                                <li><a href="/source/menu/<?= $m ?>" class="ui-lightbox"><img src="/timthumb.php?src=/source/menu/<?= $m ?>&zc=1&w=185&h=125" alt="" /></a><a href="/source/menu/<?= $m ?>" class="preview"></a><input type="hidden" value="<?= $m ?>" name="napoi[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>
	                                <? } ?>
		                        </ul>
		                        <div class="load">
		                            <input type="file" multiple="true" id="napoi">
		                            <button class="btn btn-primary"><i class="fa fa-arrow-down"> Загрузити</i></button>
		                        </div>
		                    </div>
		                </div> <!-- /.form-group -->
		
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-offset-2 col-md-10">
						<button type="submit" class="btn btn-default">Зберегти</button>
					</div>
				</div> <!-- /.form-group -->
			</form>
		</div>
	</div>
</div>

