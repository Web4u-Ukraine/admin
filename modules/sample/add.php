<div class="col-md-9">
	<div class="widget stacked">
	    <div class="widget-header">
	      	<i class="icon-pencil"></i>
		  	<h3>Добавити заклад</h3>
	    </div> <!-- /.widget-header -->
		    
		<div class="widget-content">
			<form action="/" role="form" class="form-horizontal col-md-12" id="save" data-table="news">
				
                <div class="form-group">
					<label class="col-md-2">Назва</label>
					<div class="col-md-10">
						<input type="text" name="name" value="" class="form-control" />
					</div>
				</div> <!-- /.form-group -->
				

				<div class="form-group">
					<label class="col-md-2">Текст</label>
					<div class="col-md-10">
						<textarea name="text" class="form-control editor" style="width:100%" rows="10"></textarea>
					</div>
				</div> <!-- /.form-group -->
	            
	            <div class="form-group">
					<label class="col-md-2">Фото</label>
					<div class="col-md-10">
						<ul class="gallery-container">
							
						</ul>
						<div class="load">
							<input type="file" id="files" name="file">
							<button class="btn btn-primary" id="button-load"><i class="fa fa-arrow-down"> Загрузить</i></button>
						</div>
						<script>
						  function handleFileSelect(evt) {
							$("#button-load").find('i').removeClass('fa-arrow-down').addClass('fa-spinner fa-pulse');
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
							      $.post("/admin/source.php", {tmp:e.target.result, name:$("#files").val()}, function(res){
								    $(".gallery-container").append('<li><a href="/source/'+res+'" class="ui-lightbox"><img src="/timthumb.php?src=/source/'+res+'&zc=1&w=185&h=125" alt="" /></a><a href="/source/'+res+'" class="preview"></a><input type="hidden" value="'+res+'" name="img[]"><i class="fa fa-times fa-2x delete-load-photo"></i></li>');
									  $("#files").val('');
									  $("#button-load").find('i').removeClass('fa-spinner fa-pulse').addClass('fa-arrow-down');
							      })
						          // Render thumbnail.
						        };
						      })(f);
						
						      // Read in the image file as a data URL.
						      reader.readAsDataURL(f);
						    }
						  }
						
						  document.getElementById('files').addEventListener('change', handleFileSelect, false);
						</script>
					</div>
				</div> <!-- /.form-group -->

                <div class="form-group">
                    <label class="col-md-2">Адреса</label>
                    <div class="col-md-10">
                        <input type="text" name="address" value="" class="form-control" />
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label class="col-md-2">Телефон</label>
                    <div class="col-md-10">
                        <input type="text" name="phone" value="" class="form-control" />
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label class="col-md-2">Графік роботи</label>
                    <div class="col-md-10">
                        <input type="text" name="timetable" value="" class="form-control" />
                    </div>
                </div> <!-- /.form-group -->
	            
				<div class="form-group">			
					<div class="col-md-offset-2 col-md-10">
						<button type="submit" class="btn btn-default">Зберегти</button>
					</div>
				</div> <!-- /.form-group -->
			</form>
		</div>
	</div>
</div>