function validaremail() {
    var email, direccion;
    email = document.getElementById("email").value;    
    direccion = /\w+@\w+\.+[a-z]/;
    
    if (!direccion.test(email)) {
        alert("No es una direccion de email valida");
        return false;
    }
}

function validartelefono() {
    var telefono;
    telefono = document.getElementById("telefono").value;
    
    if (isNaN(telefono)) {
        alert("El telefono tiene que ser un numero");
        document.getElementById("telefono").value="";
        return false;
	}
}

function validarnumero() {
    var numtarjeta, codigo;
    numtarjeta = document.getElementById("numtarjeta").value;
    codigo = document.getElementById("codigo").value;
    
    if (isNaN(numtarjeta)) {
        alert("El numero de tarjeta debe ser un numero");
        document.getElementById("numtarjeta").value="";
        return false;
    }

    if (isNaN(codigo)) {
        alert("Ell codigo de seguridad es un numero");
        document.getElementById("codigo").value="";
        return false;
    }
}

function calcularcreditos() {
    var total, cantidad;
    cantidad = document.getElementById("cantcredi").value;

    if (cantidad>=0) {
        total = 50*cantidad;
        document.getElementById("total").value="$"+total;
    }
    
}