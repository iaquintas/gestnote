
	function comprobarText(campo,size) {
		if (campo.value.length>size) {
			valormaximo = (10 ** size) -1;
		alert('Longitud incorrecta. El atributo ' + campo.name + 'debe ser maximo ' + valormaximo + ' y es ' + campo.value);
		campo.style.borderColor="#FF0000";
		campo.blur();
		return false;
	}
	campo.style.bordercolor='green';
	return true;
}



  	function comprobarInt(campo,size) {
			var expresion = /[^0-9]/;
			 if(expresion.test(campo.value)){
	    	alert('ERROR. El atributo ' + campo.name + ' Debe contener solo numeros');
	    	campo.style.borderColor="#FF0000";
	  		return false;

	  	}else{


	  		if (campo.value.length>size ) {
	      		alert('Longitud incorrecta. El atributo ' + campo.name + 'debe ser maximo ' + size + ' y es ' + campo.value.length);
	          campo.style.borderColor="#FF0000";
	      		return false;
	    		}
	  			campo.style.bordercolor='green';
	  			campo.blur();
					return true;
	  		}

	    	}

  	function esVacio(campo){

  		if ((campo.value == null) || (campo.value.length == 0)){
			campo.style.borderColor="#FF0000";
			alert('El atributo ' + campo.name + ' no puede ser vacio');
				campo.blur();
  			return false;

  		}
  		else{
				campo.style.borderColor="#40FF00";
  			return true;
  		}
  	}
		function validarFecha(campo) {
      var RegExPattern = /^[0][1-9]|[12][0-9]|3[01]\/|-[0][1-9]|[1][0-2]\/|-[0-9][0-9][0-9][0-9]$/; 
			///^([0][1-9]|[12][0-9]|3[01])(\/|-)([0][1-9]|[1][0-2])\2(\/|-)([0-9][0-9][0-9][0-9]))$/;
     if(RegExPattern.test(campo.value)) {
						campo.style.borderColor="#40FF00";
						return true;
      } else {
						alert('La fecha introducida no es valida!');
						campo.style.borderColor="#FF0000";
						campo.blur();
            return false;

      }
}
