document.getElementById('btn').onclick = function valida_form() {
    if (document.getElementById("nomeCompleto").value.length < 2) {
        var errorCampo = true;
        var campo = 'Nome';
        document.getElementById("nomeCompleto").focus();
        alerts(errorCampo, campo);
        return false
    }

    if (document.getElementById("passwd").value.length < 5) {
        var errorCampo = true;
        var campo = 'Senha';
        document.getElementById("passwd").focus();
        alerts(errorCampo, campo);
        return false
    }


    if (document.getElementById("cidade").value.length < 2) {
        var errorCampo = true;
        var campo = 'Cidade';
        document.getElementById("cidade").focus();
        alerts(errorCampo, campo);
        return false
    }

    if (document.getElementById("estado").value.length == "") {
        var errorCampo = true;
        var campo = 'Estado';
        document.getElementById("estado").focus();
        alerts(errorCampo, campo);
        return false
    }

    if (document.getElementById("cep").value.length < 2) {
        var errorCampo = true;
        var campo = 'CEP';
        document.getElementById("cep").focus();
        alerts(errorCampo, campo);
        return false
    }

    if (document.getElementById("nasc").value.length == "") {
        var errorCampo = true;
        var campo = 'Nascimento';
        document.getElementById("nasc").focus();
        alerts(errorCampo, campo);
        return false
    }

    if (document.getElementById("sexo").value.length == "") {
        var errorCampo = true;
        var campo = 'Sexo';
        document.getElementById("sexo").focus();
        alerts(errorCampo, campo);
        return false
    }
}

function alerts(errorCampo, campo){
    if (errorCampo == true) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: `Por favor, preencha o campo ${campo}!`,
        });
    }
}