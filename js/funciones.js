var BASE_URL = "http://127.0.0.1:8080/agenda/";

function listar()
{
	var tabla = $("#tabla-tareas");
	var pagina = $("input[name=p]").val();
	tabla.html("");
	$.ajax({
		url:BASE_URL+"agenda/lista",
		type:"get",
		data:{"p":pagina},
		dataType:"json",
		success:
			function(response)
			{
				var tabla_datos = "";

				$(response).each(function(clave,valor){
					tabla_datos = "<tr>";
					tabla_datos+="<td>"+valor.id_usuario_tarea+"</td>";
					tabla_datos+="<td>"+valor.tarea+"</td>";
					tabla_datos+="<td>"+valor.descripcion+"</td>";
					tabla_datos+="<td>"+valor.estado+"</td>";
					tabla_datos+="<td><a href='#' onclick='cargarTarea("+valor.id_usuario_tarea+")' class='btn btn-primary btn-block'>Editar</a>";
					tabla_datos+="<a href='#' onclick='askEliminarTarea("+valor.id_usuario_tarea+")' class='btn btn-danger btn-block'>Eliminar</a>";
					tabla_datos+="<a href='#' onclick='' class='btn btn-success btn-block'>pendiente</a>";
					tabla_datos+="<a href='#' onclick='' class='btn btn-info btn-block'>terminada</a>";
					tabla_datos+="</td></tr>";
					tabla.append(tabla_datos);
				});
			},
		error:
			function(response)
			{
				alert(response.responseText);
			},
		before:
			function()
			{

			},
		complete:
			function()
			{

			}
	});

}

//listar();

/*function pagina(p)
{
	event.preventDefault();
	$("input[name=p").val(p);
	listar();
}*/

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
				//alert(response)
				$("#myModal").modal("hide");
				listar();
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
	var descripcion = $("textarea[name=txt_descripcion]").val();
	var token = $("input[name=_token]").val();
	var datos = {"txt_tarea":tarea,"txt_descripcion":descripcion,"_token":token};
	//alert(datos.txt_tarea+" "+datos._token);
	var route = BASE_URL+"agenda/agregar";
	$.ajax({
		url:route,
		type:"post",
		data:datos,
		success:
			function(response)
			{
				//alert(response);
				$("#success-add-task").removeClass("hide").addClass("show");
				$("#mensaje-success").html(response);
				$("#error-add-task").addClass("hide").removeClass("show");
				listar();
				$("input[name=txt_tarea]").val("");
				$("textarea[name=txt_descripcion]").val("");
			},
		error:
			function(response)
			{
				$("#error-add-task").removeClass("hide").addClass("show");
				$("#mensaje-error").html(response.responseText);
				console.log(response);
			}
	});

}

var delete_task = 0;

function askEliminarTarea(id)
{
	event.preventDefault();
	$("#myModalDanger").modal("show");
	delete_task = id;
}

function eliminarTarea()
{
	event.preventDefault();
		var token = $("input[name=_token]").val();
		var metodo = $("input[name=_method]").val();
		var datos = {"_token":token,"_method":metodo,"id_tarea":delete_task};
		var route = BASE_URL+"agenda/eliminar_tarea"; 
		//alert("second");
		$.ajax({
		url:route,
		type:"post",
		data:datos,
		//dataType:"json",
		success:
			function(response)
			{
				//alert(response);
				$("#myModalDanger").modal("hide");
				listar();
			},
		error:
			function(response)
			{
				alert("Error: "+response);
			}
		});
}


//funcion para modificar el estado de la tarea a pendiente o terminada
function estado(id,estado)
{
	event.preventDefault();
	//alert("ok");
	var token = $("input[name=_token]").val();
	var datos = {"id_tarea":id,"_token":token,"_method":"PUT"};
	var route = BASE_URL+"agenda/"+estado;
	//alert(route);
	$.ajax({
		url:route,
		type:"post",
		data:datos,
		success:
			function(response)
			{
				alert(response);
				listar();
				$("alert").html(response);
			},
		error:
			function(response)
			{
				alert(response.responseText);
				$("alert").html(response.responseText);
			}
	});
}


//funciones usuario


function registroUsuario()
{
	event.preventDefault();
	var datos = $("#form-registro-usuario").serialize();
	var route = BASE_URL+"agenda/registrar";
	var rutaCaptcha = BASE_URL+"agenda/captcha";
	//alert(datos);
	$.ajax({
		url:route,
		type:"post",
		data:datos,
		success:
			function(response)
			{
				$("#success-add-user").removeClass("hide").addClass("show");
				$("#mensaje-success").html(response);
				$("#error-add-user").addClass("hide").removeClass("show");
				document.getElementById("captcha").src=rutaCaptcha;
			},
		error:
			function(response)
			{
				$("#error-add-user").removeClass("hide").addClass("show");
				$("#mensaje-error").html(response.responseText);
				$("#success-add-user").removeClass("show").addClass("hide");
				document.getElementById("captcha").src=rutaCaptcha;
			}
	});
}