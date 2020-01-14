<script>
	$(document).ready(function(){

		mostrarCliente();

		function mostrarCliente(){

			$.ajax({
				type: 'ajax',
				url:  '<?= base_url("clienteC/get_cliente")?>',
				dataType: 'json',

				success: function(datos){
					var tabla="";
					var i;
					var n=1;

					for(i=0; i<datos.length; i++){
						tabla+=
						'<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].nombre+'</td>'+
						'<td>'+datos[i].apellido+'</td>'+
						'<td>'+datos[i].nombre_suscripcion+'</td>'+
						'<td>'+datos[i].nombre_genero+'</td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-danger btn-sm borrar" data="'+datos[i].id_cliente+'">Eliminar<a>'+'</td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-info btn-sm item-edi" data="'+datos[i].id_cliente+'">Editar<a>'+'</td>'+

						n++;
						'</tr>';
					}
					$('#tabla_cliente').html(tabla);
				}

			});

		}

		$('#tabla_cliente').on("click", ".borrar", function(){
			$id=$(this).attr("data");
			$('#modalBorrar').modal("show");
			$('#btnBorrar').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url:  '<?= base_url("clienteC/eliminar")?>',
					data:  {id:$id},
					dataType:  'json',
					success: function(respuesta){
						$('#modalBorrar').modal("hide");
						if(respuesta==true){
							alertify.notify("Eliminado Exitosamente!", "success", 10, null);
							mostrarCliente();
						}else{
							alertify.notify("rror al Eliminar!", "error", 10, null);	
						}
					}


				});


			});
		});

		$('#nueCli').click(function(){
			$('#cliente').modal("show");
			$('#cliente').find(".modal-title").text("Nuevo Cliente");
			$('#formCliente').attr("action", "<?= base_url("clienteC/ingresar")?>");

		});

		get_suscripcion();

		function get_suscripcion(){

			$.ajax({
				type: 'ajax',
				url:  '<?= base_url("clienteC/get_suscripcion")?>',
				dataType: 'json',

				success: function(datos){
					var op ="";
					var i;

					op+="<option value=''>--Seleccionar Suscripcion--</option>";

					for(i=0; i<datos.length; i++){
						op+="<option value='"+datos[i].id_suscripcion+"'>"+datos[i].nombre_suscripcion+"</option>";
					}
					$('#suscripcion').html(op);
				}
			});
		}

		get_genero();

		function get_genero(){

			$.ajax({
				type: 'ajax',
				url:  '<?= base_url("clienteC/get_genero")?>',
				dataType: 'json',

				success: function(datos){
					var op ="";
					var i;

					op+="<option value=''>--Seleccionar Genero--</option>";

					for(i=0; i<datos.length; i++){
						op+="<option value='"+datos[i].id_genero+"'>"+datos[i].nombre_genero+"</option>";
					}
					$('#genero').html(op);
				}
			});
		}

		$('#btnGuardar').click(function(){
			$url= $('#formCliente').attr("action");
			$data= $('#formCliente').serialize();
			if(validarcliente()==true){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url:  $url,
					data: $data,
					dataType: 'json',

					success: function(respuesta){
						$('#cliente').modal("hide");
						if(respuesta=="add"){
							alertify.notify("Ingresado Exitosamente!", "success", 10, null);
							mostrarCliente();
						}else if(respuesta=="edi"){
							alertify.notify("Actualizado Exitosamente!", "success", 10, null);	
							mostrarCliente();
						}else{
							alertify.notify("error al Ingresar!", "error", 10, null);
						}
						$('#formCliente')[0].reset();
					}
				});
			}
		});



		$('#tabla_cliente').on("click", ".item-edi", function(){
			var $id= $(this).attr("data");
		

			$('#cliente').modal("show");
			$('#cliente').find(".modal-title").text("Editar Cliente");
			$('#formCliente').attr("action", "<?= base_url("clienteC/actualizar")?>");
			$.ajax({

				type:'ajax',
				method: 'post',
				url:  '<?= base_url("clienteC/get_datos")?>',
				data: {id:$id},
				dataType: 'json',



				success: function(datos){
					
					$('#id').val(datos.id_cliente);
					$('#nombre').val(datos.nombre);
					$('#apellido').val(datos.apellido);
					$('#suscripcion').val(datos.id_suscripcion);
					$('#genero').val(datos.id_genero);
				}
			});

		});




	});




</script>