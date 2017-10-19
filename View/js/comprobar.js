function comprobar_NOTAS(){ return(esVacio(Form.AUTOR)  && comprobarText(Form.AUTOR, 15) &&  esVacio(Form.FECHA)  && validarFecha(Form.FECHA) && esVacio(Form.CONTENIDO)  && comprobarText(Form.CONTENIDO, 100) &&  esVacio(Form.COMPARTIDO) ) } 
function comprobar_USUARIOS(){ return(esVacio(Form.login)  && comprobarText(Form.login, 10) &&  esVacio(Form.password) ) } 
