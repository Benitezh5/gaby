function validarcliente(){
	var  nombre = $('#nombre').val();
	var  apellido = $('#apellido').val();
	var  suscripcion = $('#suscripcion').val();
	var  genero = $('#genero').val();

	if(nombre.length==0){
		$('#nombre').css("boxShadow", "0px 0px 15px red");
		$('#nombre').attr("placeholder", "Campo Requerido");
		return false;
	}else{
		$('#nombre').css("boxShadow", "0px 0px 15px green");
	}
	if(apellido.length==0){
		$('#apellido').css("boxShadow", "0px 0px 15px red");
		$('#apellido').attr("placeholder", "Campo Requerido");
		return false;
	}else{
		$('#apellido').css("boxShadow", "0px 0px 15px green");
	}
	if(suscripcion.length==0){
		$('#suscripcion').css("boxShadow", "0px 0px 15px red");
		$('#suscripcion').attr("placeholder", "Campo Requerido");
		return false;
	}else{
		$('#suscripcion').css("boxShadow", "0px 0px 15px green");
	}
	if(genero.length==0){
		$('#genero').css("boxShadow", "0px 0px 15px red");
		$('#genero').attr("placeholder", "Campo Requerido");
		return false;
	}else{
		$('#genero').css("boxShadow", "0px 0px 15px green");
	}

	return true;
}