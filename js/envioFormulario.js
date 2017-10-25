function envioFormulario(codigo) {
    document.getElementById('validatorTable').value = codigo;
    document.formEnvio.submit();
}

function envioDatosFormulario(codigo) {
    document.getElementById('validatorForm').value = codigo;
    document.formEnvio.submit();
}

function volverMenu() {
    document.getElementById('validatorTable').value = 'U';
    document.formEnvio.submit();
}

function volver() {
    document.getElementById('validatorForm').value = 'U';
    document.formEnvio.submit();
}

function envioDatosMenu(codigo) {
    document.getElementById('codigoMenu').value = codigo;
    document.formMenuPrincipal.submit();
}
function buscar() {
    document.getElementById('validatorTable').value = 'B';
    document.formEnvio.submit();
}
function direccion(valor) {
    document.getElementById('direccion').value = valor;
    document.getElementById('validatorTable').value = 'D';
    document.formEnvio.submit();
}