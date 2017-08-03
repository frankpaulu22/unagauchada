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

function puntuacion() {

    var puninicial, punfinal;

    puninicial = document.getElementById('puninicial');
    punfinal = document.getElementById('punfinal');

    if(parseInt(puninicial.value) > parseInt(punfinal.value)){
        alert('La puntuacion final no puede ser menor a la inicial');
        return false;
    }
    else{
        return true;
    }
}

function restarFechas(fecha1, fecha2) {
    var fech1 = document.getElementById(fecha1).value;
    var fech2 = document.getElementById(fecha2).value;

if((Date.parse(fech1)) > (Date.parse(fech2))){
    alert('La fecha inicial no puede ser mayor que la fecha final');
    return false;
}
}