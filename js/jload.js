function log(html) {
  document.getElementById('log').innerHTML = html;
}

function onSuccess(name) {
	$("#load_files").find('.oneDoc').eq($("#load_files").find('.oneDoc').size()-1).html('<img src="/timthumb.php?src=/uploads/'+name+'&zc=1&w=150&h=150"><input type="hidden" name="img[]" value="'+name+'"><i class="fa fa-times deleteThis"></i>');
}


function onProgress(loaded, total) {
  	$("#load_files").find('.oneDoc').eq($("#load_files").find('.oneDoc').size()-1).find("progress").attr('max',total).val(loaded);
}

var form = document.getElementById('img_load');
if (form!=null){
	form.onsubmit = function() {
		for (i=0;i<this.elements.file.files.length;i++){
			var file=this.elements.file.files[i];
				$("#load_files").append('<div class="oneDoc"><progress max="100" value="0" style="margin-top:60px;width:120px"></progress></div>');
			if (file) upload(file, onSuccess, onProgress);  
		}
	  return false;
	}
}


function upload(file, onSuccess, onProgress) {

  var xhr = new XMLHttpRequest();

  xhr.onload = xhr.onerror = function() {
    if(this.responseText == 'error') {
      alert("Ошибка загрузки файла. Максимальный размер 5 Мб");
      $("#load_files").find('.oneDoc').eq($("#load_files").find('.oneDoc').size()-1).remove();
      return;
    }
    onSuccess(this.responseText);
  };

  xhr.upload.onprogress = function(event) {
  	//console.log(event);
    onProgress(event.loaded, event.total);
  }

  xhr.open("POST", "/source.php", true); 
  	var	formData = new FormData();
		formData.append("file", file);
		xhr.send(formData);

}

function get_cookie(cookie_name)
{
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
 
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return null;
}