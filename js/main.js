$(function(){
	
    
        /*********** category event ************/

        $("#category").change(function(e){
            e.preventDefault();
            var deb=$(this).val();

            $.ajax({
                type: 'post',
                data: 'id='+deb,
                url: '/admin/ajax/category.php',
                success: function(res){
                    $('#subcategory').html(res);
                }
            });
        });
        
        
        
    /*********** country event ************/

    $("#country1").change(function(e){
        e.preventDefault();
        var deb=$(this).val();

        $.ajax({
            type: 'post',
            data: 'id='+deb,
            url: '/admin/ajax/country1.php',
            success: function(res){
                console.log(res);
                $('#city1').html(res);
            }
        });
    });


    /*********** start_city ************/

    $("#city1").change(function(e){
        e.preventDefault();
        var deb=$(this).val();

        $.ajax({
            type: 'post',
            data: 'id='+deb,
            url: '/admin/ajax/city1.php',
            success: function(res){
                console.log(res);
                $('#region1').html(res);

            }
        });

    });


	
	$(".gallery-container").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        placeholder: 'prizrak-box',
        forceHelperSize: true
    });
    
    $(".chosen-select").chosen();
    
/*
    $.get('/admin/ajax/get-list-user.php', function(data){
	    $("#get-list-user").typeahead({ source:data });
	},'json');
*/
	
	$("input[data-role=prev-load]").jLoad({
		path: '/source/prev/',
		multi: false,
		admin: false,
		go_to: '',
		box: '',
		element: 'input[data-role=vklad]'
	})
	
	$(document).on('click', 'button[data-role=more-box-video]', function(){
		$(this).parents('.row-fluid').after('<div class="row-fluid">'
								+'<div class="col-md-8">'
									+'<input type="text" value="" name="video_url[]" class="form-control">'
								+'</div>'
								+'<div class="col-md-4">'
									+'<input type="hidden" value="" name="prev[]" data-role="vklad">'
									+'<input type="file" style="display: none" data-role="prev-load">'
									+'<button class="btn btn-warning" type="button" onclick="$(this).parent().find(\'input[type=file]\').click();">Превью</button>'
									+'&nbsp;&nbsp;<button class="btn btn-info" type="button" data-role="more-box-video"><i class="fa fa-plus"></i></button>'
								+'</div>'
							+'</div>');
		$(this).before('<button class="btn btn-danger" data-role="delete-video-box"><i class="fa fa-trash"></i></button>');
		$(this).remove();
		$("input[data-role=prev-load]").jLoad({
			path: '/source/prev/',
			multi: false,
			admin: false,
			go_to: '',
			box: '',
			element: 'input[data-role=vklad]'
		})
	});
	
	$(document).on('click', 'button[data-role=delete-video-box]', function(){
		$(this).parents('.row-fluid').remove();
	});
	
	tabs();
	var langTable={
            "lengthMenu": "Показывать по _MENU_ записей",
            "zeroRecords": "Ничего не найдено",
            "info": "Показано записей _PAGE_ с _PAGES_",
            "infoEmpty": "Нет совпадений",
            "infoFiltered": "(выбрано записей _MAX_ с всех)",
            "sSearch": "Поиск"
        }
	$('#users').DataTable({
		"language": langTable,
		"stateSave": true
	});
	
	var table=$('#index').DataTable({
			"language": langTable,
			"stateSave": true,
			"scrollX": true
		});
	
	$('a[data-role=column]').on( 'click', function (e) {
        e.preventDefault();
        if ($(this).hasClass('hide_column')){
	        $(this).removeClass('hide_column');
        } else {
	        $(this).addClass('hide_column');
        }
 
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
    
    $("#set-col a").addClass('hide_column');
    
    $("table.dataTable th").each(function(){
	    if ($(this).attr('aria-label')!=undefined&&$(this).attr('aria-label')!=''){
		    caption=$(this).attr('aria-label');
		    caption=caption.split(':');
		    $("a[data-target='"+caption[0]+"']").removeClass('hide_column');
	    }
    });
	
	$('#kvartirs').dataTable({
		"language": langTable
	}).columnFilter({
		aoColumns: [
					null,
					null,
				    { type: "text" },
				    { type: "text" },
				    { type: "number" },
				    { type: "number" },
				    { type: "text" },
				    { type: "text" },
				    { type: "text" },
				    { type: "text" },
				    { type: "text" },
				    { type: "text" },
				    { type: "text" },
				    null,
				    null
				]

	});
	
	$( "#photo-sort" ).sortable();
	
	$(":input").inputmask();
	
	$(document).on('click', 'button[data-role=she-box]', function(){
		$(this).parents('form').find('.form-group:last').before('<div class="form-group"><label class="col-md-2"><input type="text" value="" placeholder="время" name="time[]" class="form-control"></label><div class="col-md-9"><input type="text" value="" placeholder="текст" name="text[]" class="form-control"></div><div class="col-md-1"><button class="btn btn-danger" type="button" onclick="$(this).parents(\'.form-group\').remove();"><i class="fa fa-trash"></i></div></div>');
		//$(this).remove();
	});
	
	$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	
	/************* login **********/
	$("#login").submit(function(e){
		e.preventDefault();
		var deb=$(this).serialize();
		
		$.ajax({
			type: 'post',
			data: deb,
			url: '/admin/ajax/login.php',
			success: function(res){
				if (res==1){
					window.location.replace('/admin/home/');
				} else {
					msg('Результат', 'Не верный логин или пароль', 'error');
				}
			}
		});
		
	});
	
	$("form[data-role=edit]").submit(function(e){
		e.preventDefault();
		var deb=$(this).serialize();
		
		$.ajax({
			type: 'post',
			data: deb+'&day='+$(this).attr('data-day'),
			url: '/admin/ajax/schedule/edit.php',
			success: function(res){
				msg('Результат', res, 'success');
			}
		});
		
	});
	
	/************* change-status **********/
	$(document).on('change', 'select[data-role=change-status]', function(){
		var deb=$(this).attr('data-id'),
			val=$(this).val();
			th=$(this);
		
		$.ajax({
			type: 'post',
			data: 'id='+deb+'&val='+val,
			url: '/admin/ajax/buildings/change.php',
			success: function(res){
				msg('Результат', res, 'success');
			}
		});
		
	});
	
	/********* add Category *********/
	$("#add-category").submit(function(e){
		e.preventDefault();
		var deb=$(this).serialize();
		
		$.ajax({
			type: 'post',
			data: deb,
			url: '/admin/ajax/category/add-category.php',
			success: function(res){
				msg('Результат', res, 'success');
			}
		});
	});
	
	/********* edit Category *********/
	$("#edit-category").submit(function(e){
		e.preventDefault();
		var deb=$(this).serialize();
		
		$.ajax({
			type: 'post',
			data: deb,
			url: '/admin/ajax/category/edit-category.php',
			success: function(res){
				msg('Результат', res, 'success');
			}
		});
	});
	
	/********* delete  *********/
	$(document).on('click', 'button[data-role=delete]', function(e){
		var deb={
			role: $(this).attr('data-page'),
			id: $(this).attr('data-id')
		}
		
		var th=$(this);
		if (confirm("Удалить?")){
			$.ajax({
				type: 'post',
				data: deb,
				url: '/admin/ajax/delete.php',
				success: function(res){
					msg('Результат', res, 'success');
					th.parents('tr').remove();
				}
			});
		}
	});
	
	/********* alert  *********/
	$(document).on('click', 'button[data-role=alert]', function(e){
		var deb={
			role: $(this).attr('data-page'),
			id: $(this).attr('data-id'),
			alert: $(this).attr('data-alert')
		}
		
		var th=$(this);
		
		if (th.attr('data-alert')==1){
			th.attr('data-alert',0);
			th.find('i').css('color','black');
		} else {
			th.attr('data-alert',1);
			th.find('i').css('color','red');
		}
	
		$.ajax({
			type: 'post',
			data: deb,
			url: '/admin/ajax/alert.php',
			success: function(res){
				msg('Результат', res, 'success');
				//th.parents('tr').remove();
			}
		});
	});
	
	/********* copy  *********/
	$(document).on('click', 'button[data-role=copy]', function(e){
		var deb={
			role: $(this).attr('data-page'),
			id: $(this).attr('data-id')
		}
		var th=$(this);
		
		$.ajax({
			type: 'post',
			data: deb,
			url: '/admin/ajax/copy.php',
			success: function(res){
				window.location.reload();
			}
		});
	});
	
	/********* edit Users *********/
	$("#edit-user").submit(function(e){
		e.preventDefault();
		var deb=$(this).serialize();
		
		$.ajax({
			type: 'post',
			data: deb,
			url: '/admin/ajax/users/edit.php',
			success: function(res){
				msg('Результат', res, 'success');
			}
		});
	});
	
	/********* add *********/
	$(document).on('submit', '#save', function(e){
		e.preventDefault();
		
		/*
var error=0;
		
		$(this).find('input').each(function(){
			if ($(this).attr('name')!='file'){
				if ($.trim($(this).val())==''){
					error++;
				}
			}
		});
		
		if (error>0){
			alert("Заполните все поля!");
			return; 
		}
*/
		
		var deb=$(this).serialize();
		
		var page=$(this).attr('data-table');
		
		$.ajax({
			type: 'post',
			data: deb,
			url: '/admin/ajax/'+page+'/add.php',
			success: function(res){
				msg('Результат', res, 'success');
			}
		});
	});
	
	/********* add index *********/
	$(document).on('submit', '#save-index', function(e){
		e.preventDefault();
		
		var deb=$(this).serialize();
		
		var page=$(this).attr('data-table');
		
		$.ajax({
			type: 'post',
			data: deb+'&table='+page,
			url: '/admin/ajax/add.php',
			success: function(res){
				msg('Результат', res, 'success');
			}
		});
	});
	
	/********* edit *********/
	$(document).on('submit', '#edit', function(e){
		e.preventDefault();
		var deb=$(this).serialize();
		
		var page=$(this).attr('data-table');
		
		$.ajax({
			type: 'post',
			data: deb,
			url: '/admin/ajax/'+page+'/edit.php',
			success: function(res){
				msg('Результат', res, 'success');
			}
		});
	});
	
	/********* edit index *********/
	$(document).on('submit', '#edit-index', function(e){
		e.preventDefault();
		var deb=$(this).serialize();
		
		var page=$(this).attr('data-table');
		
		$.ajax({
			type: 'post',
			data: deb+'&table='+page,
			url: '/admin/ajax/edit.php',
			success: function(res){
				msg('Результат', res, 'success');
			}
		});
	});

        /*********** start_category ************/

        $("#start_category").change(function(e){
            e.preventDefault();
            var deb=$(this).val();

            $.ajax({
                type: 'post',
                data: 'id='+deb,
                url: '/admin/ajax/start_category.php',
                success: function(res){
                    $('#sub_category').html(res);

                }
            });

        });
        
        /*********** st_category1 ************/

        $("#st_category1").change(function(e){
            e.preventDefault();
            var deb=$(this).val();

            $.ajax({
                type: 'post',
                data: 'id='+deb,
                url: '/admin/ajax/st_category.php',
                success: function(res){
                    $('#s_category1').html(res);

                }
            });

        });


    /*********** start_country ************/

    $("#start_country").change(function(e){
        e.preventDefault();
        var deb=$(this).val();

        $.ajax({
            type: 'post',
            data: 'id='+deb,
            url: '/admin/ajax/start_country.php',
            success: function(res){
                $('#start_city').html(res);
            }
        });
    });
      /*********** s_country1 ************/

    $("#s_country1").change(function(e){
        e.preventDefault();
        var deb=$(this).val();

        $.ajax({
            type: 'post',
            data: 'id='+deb,
            url: '/admin/ajax/s_country.php',
            success: function(res){
                console.log(res);
                $('#s_city1').html(res);
            }
        });
    });

 

    /*********** start_city ************/

    $("#start_city").change(function(e){
        e.preventDefault();
        var deb=$(this).val();

        $.ajax({
            type: 'post',
            data: 'id='+deb,
            url: '/admin/ajax/start_city.php',
            success: function(res){
                console.log(res);
                $('#start_regions').html(res);

            }
        });

    });


	/********* edit *********/
	$(document).on('submit', 'form[data-form=edit]', function(e){
		e.preventDefault();
		var deb=$(this).serialize();
		
		var page=$(this).attr('data-table');
		
		$.ajax({
			type: 'post',
			data: deb,
			url: '/admin/ajax/'+page+'/edit.php',
			success: function(res){
				msg('Результат', res, 'success');
			}
		});
	});
	
	/***********  add word ***********/
	$("button[data-role=add-word]").click(function(){
		$(this).before('<form id="save" data-table="words" data-role="word_keyup"><div class="row-fluid">'+
			'<div class="col-md-3">'+
				'<input type="text" value="" placeholder="eng" name="eng" class="form-control">'+
			'</div>'+
			'<div class="col-md-3">'+
				'<input type="text" value="" name="chi" placeholder="chi" class="form-control">'+
			'</div>'+
			'<div class="col-md-3">'+
				'<button class="btn btn-success"><i class="fa fa-save"></i> Сохранить</button>'+
			'</div>'+
		'</div></form>')
	});
	
	$(document).on('keyup', 'form[data-role=word_keyup] input[type=text]', function(){
		var th=$(this).parents('form');
		if ($(this).attr('name')=='rus'){
			$.post("https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20150220T080857Z.51682f9733147b3b.790343be25a8412377d6b2eaff6d295adafa40a2&text="+$(this).val()+"&lang=en", function(res){
				th.find("input[name=eng]").val(res.text[0]);
			}, "jsonp");
			$.post("https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20150220T080857Z.51682f9733147b3b.790343be25a8412377d6b2eaff6d295adafa40a2&text="+$(this).val()+"&lang=uk", function(res){
				th.find("input[name=ukr]").val(res.text[0]);
			}, "jsonp");
		} /*
else if ($(this).attr('name')=='ukr'){
			$.post("https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20150220T080857Z.51682f9733147b3b.790343be25a8412377d6b2eaff6d295adafa40a2&text="+$(this).val()+"&lang=en", function(res){
				th.find("input[name=eng]").val(res.text[0]);
			}, "jsonp");
			$.post("https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20150220T080857Z.51682f9733147b3b.790343be25a8412377d6b2eaff6d295adafa40a2&text="+$(this).val()+"&lang=ru", function(res){
				th.find("input[name=rus]").val(res.text[0]);
			}, "jsonp");
		} else if ($(this).attr('name')=='eng'){
			$.post("https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20150220T080857Z.51682f9733147b3b.790343be25a8412377d6b2eaff6d295adafa40a2&text="+$(this).val()+"&lang=uk", function(res){
				th.find("input[name=ukr]").val(res.text[0]);
			}, "jsonp");
			$.post("https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20150220T080857Z.51682f9733147b3b.790343be25a8412377d6b2eaff6d295adafa40a2&text="+$(this).val()+"&lang=ru", function(res){
				th.find("input[name=rus]").val(res.text[0]);
			}, "jsonp");
		}
*/
	});
	
	/********** delete image ************/
	$(document).on('click', '.deleteThis', function(){
		$(this).parents('.oneDoc').remove();
	});
	
	/************ vip *************/
	$(document).on('click', 'button[data-role=vip]', function(){
		if ($(this).attr('data-toggle')==0){
			var deb={
				id: $(this).attr('data-id'),
				val: 1
			}
			$(this).html('<i class="fa fa-check"></i>').removeClass('btn-default').addClass('btn-success');
			$.post("/admin/ajax/vip/change.php", {z:deb}, function(res){});
		} else {
			var deb={
				id: $(this).attr('data-id'),
				val: 0
			}
			$(this).html('<i class="fa fa-times"></i>').removeClass('btn-success').addClass('btn-default');
			$.post("/admin/ajax/vip/change.php", {z:deb}, function(res){});
		}
	});
	
	/*********** gallery ************/
	$('.gallery-container > li').hoverIntent({
			over: showPreview,
		     timeout: 500,
		     out: hidePreview,
		     sensitivity: 4
		});
		
		function showPreview () {
			$(this).find ('.preview').fadeIn ();
		}
		
		function hidePreview () {
			$(this).find ('.preview').fadeOut ();
		}
		
		setTimeout (function () {
			$('.gallery-container > li').each (function () {
				var preview, img, width, height;
				
				preview = $(this).find ('.preview');
				img = $(this).find ('img');
				
				width = img.width ();
				height = img.height ();
				
				preview.css ({ width: width });
				preview.css ({ height: height });
				
				preview.addClass ('ui-lightbox');
			});
		}, 500);
		
	$(document).on('click', '.delete-load-photo', function(){
		$(this).parents('li').remove(); 
	});
	
	
	/********* export ***********/
	$("a[data-role=export]").click(function(){
		var arr=[],
			th=$(this);
			$("input[data-role=select-rows]:checked").each(function(){
				arr.push($(this).val());
			});
			
			if (arr.length<1){
				msg('Ошибка!', 'Вы не выбрали ни одной квартиры для экспорта', 'error');
				return;
			}
			
			$.ajax({
				type: 'post',
				url: '/admin/ajax/kvartirs/export.php',
				data: 'id='+arr,
				success: function(res){
					window.location.replace(res);
				}
			})
	});
	
	/********* filter **********/
	$(".widget-content > select").change(function(){
		if ($(this).val()!=''){
			$("#kvartirs tr").not('#kvartirs tr[data-role=title_table]').hide();
			//alert($(this).val());
			$("#kvartirs td[data-toggle="+$(this).attr('name')+"]:contains("+$(this).val()+")").parents('tr').show();
		}
		
		/*
console.log(obj);
		if (obj.length>0){
			
			for (i=0;i<obj.length;i++){
				$("#kvartirs tr:contains("+obj[i]+")").show();
			}
		} else {
			$("#kvartirs tr").show();
		}
*/
	});
});

function msg(title, text, type){
	$.msgGrowl ({
		type: type
		, title: title
		, text: text
	});
}

function getMore(value, table, element, rows, val, text){
	var deb={
		value: value,
		table: table,
		rows: rows,
		val: val, 
		text: text
	}
	$.ajax({
		type: 'post',
		data: deb,
		url: '/admin/ajax/getMore.php',	
		success: function(res){
			$("select[name="+element+"]").html(res);
		}
	})
}

function select_komplex(rayon_id){
	var deb={
		rayon_id: rayon_id
	}
	$.ajax({
		type: 'post',
		data: deb,
		url: '/admin/ajax/select_komplex.php',
		success: function(res){
			$("select[name=komplex]").html(res);
		}
	})
}

function select_liters(rayon_id){
	var deb={
		liters_id: rayon_id
	}
	$.ajax({
		type: 'post',
		data: deb,
		url: '/admin/ajax/select_liters.php',
		success: function(res){
			$("select[name=liters]").html(res);
		}
	})
}

function pageText(id){
	$.ajax({
		type: 'post',
		url: '/admin/ajax/pages/text.php',
		data: 'id='+id,
		success: function(res){
			tinyMCE.activeEditor.setContent(res);	
		}
	})
}

function boxText(id){
	$.ajax({
		type: 'post',
		url: '/admin/ajax/text-box/text.php',
		data: 'id='+id,
		success: function(res){
			tinyMCE.activeEditor.setContent(res);	
		}
	})
}

function tabs(){
	var count=$(".widget-content > form div[data-role=tabs]").size();//скільки всіх табів буде
	if (count==0){
		return;
	}
	var l=1;//лічильник
	var k=1;//лічильник
		$("#wrap").wrap('<div role="tabpanel"></div>');
		$("#wrap").before('<ul class="nav nav-tabs" role="tablist"></ul>');
		$(".widget-content > form div[data-role=tabs]").each(function(){
			if (l==1){
				$("ul[role=tablist]").append('<li role="presentation" class="active"><a href="#tab'+l+'" role="tab" data-toggle="tab">'+$(this).attr('data-name')+'</a></li>');
			} else {
				$("ul[role=tablist]").append('<li role="presentation"><a href="#tab'+l+'" role="tab" data-toggle="tab">'+$(this).attr('data-name')+'</a></li>');
			}
			l++;
		});
		$("#wrap").addClass('tab-content');
		$(".widget-content > form div[data-role=tabs]").each(function(){
			if (k==1){
				$(this).wrap('<div role="tabpanel" class="tab-pane active" id="tab'+k+'"></div>');
			} else {
				$(this).wrap('<div role="tabpanel" class="tab-pane" id="tab'+k+'"></div>');
			}
			k++;
		});
		
		//$(".widget-content > form div[data-role=tabs]").remove();//->видаляємо
}