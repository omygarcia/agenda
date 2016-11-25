var BASE_URL = "http://127.0.0.1:8080/agenda/";

function cargarTarea(id)
{
	event.preventDefault();
	//alert(id);
	var datos = {"id_tarea":id};
	var route = BASE_URL+"agenda/editar";
	$.ajax({
		url:route,
		type:"post",
		data:datos,
		dataType:"json",
		success: 
			function(response)
			{
				//alert(response.id_usuario_tarea+"\n"+response.tarea+"\n"+response.descripcion+"\n"+response.estado);
				$("input[name=txt_id_tarea_modal]").val(response.id_usuario_tarea);
				$("input[name=txt_tarea_modal]").val(response.tarea);
				$("textarea[name=txt_descripcion_modal]").val(response.descripcion);
				$("#slp_estado_modal > option[value='"+response.estado+"']").attr("selected","selected");
				$("#myModal").modal("show");
			},
		error:
			function(response)
			{
				alert("error");
			}
	});
}

function actualizarTarea()
{
	event.preventDefault();
	//alert(id);
	
	var id = $("input[name=txt_id_tarea_modal]").val();
	var txt_tarea = $("input[name=txt_tarea_modal]").val();
	var txt_descripcion = $("textarea[name=txt_descripcion_modal]").val();
	var slp_estado = $("#slp_estado_modal").val();
	var token = $("input[name=_token]").val();
	var metodo = $("input[name=_method]").val();
	var datos = {"_token":token,"_method":metodo,"txt_id_tarea_modal":id,"txt_tarea_modal":txt_tarea,"txt_descripcion_modal":txt_descripcion,"slp_estado_modal":slp_estado};
	var route = BASE_URL+"agenda/modificarTarea";
	$.ajax({
		url:route,
		type:"post",
		data:datos,
		success: 
			function(response)
			{
				alert(response)
			},
		error:
			function(response)
			{
				alert("error");
			}
	});
}

function registrarTarea()
{
	event.preventDefault();
	//alert("todo ok");
	var tarea = $("input[name=txt_tarea]").val();
	var descripcion = $("input[name=txt_descripcion]").val();
	var token = $("input[name=_token]").val();
	var datos = {"txt_tarea":tarea,"txt_descripcion":descripcion,"token":token};
	$.ajax({
		url:BASE_URL+"agenda/agregar",
		type:"post",
		datos:datos,
		dataType:"json",
		success:
			function(response)
			{
				alert(response.mensaje);
			}
	});

}

function eliminarTarea(id)
{
	event.preventDefault();
	var resp = confirm("¿Estas seguro de eliminar esta tarea?");
	if(resp == true)
	{
		alert("first");
		var token = $("input[name=_token]").val();
		var datos = {"token":token,"id":id};
		alert("second");
		$.ajax({
		url:BASE_URL+"agenda/eliminar_tarea",
		type:"post",
		datos:datos,
		dataType:"json",
		success:
			function(response)
			{
				alert(response.mensaje);
			},
		error:
			function(response)
			{
				alert(response.error);
			}
		});
	}
}