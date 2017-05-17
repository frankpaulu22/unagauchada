function validarlogin() {
    var usuario, clave, direccion;
    usuario = document.getElementById("usuario").value;
    clave = document.getElementById("clave").value;
    
    direccion = /\w+@\w+\.+[a-z]/;
    
    if (usuario === "" || clave === "") {
        alert("Complete ambos campos");
        return false;
    }
    else if (usuario.length>50) {
        alert("Usuario incorrecto");
        return false;
    }
    else if (clave.length>20) {
        alert("Clave incorrecta");
        return false;
    }
    else if (!direccion.test(usuario)) {
        alert("El usuario no es una direccion de email valida");
        return false;
    }
}