// Verifica si el documento está completamente cargado
if (document.readyState === 'complete') {
    // Llama directamente a la función que se ejecuta cuando el documento está listo
    onDocumentReady();
} else {
    // Espera a que el documento esté completamente cargado antes de llamar a la función
    document.addEventListener('DOMContentLoaded', onDocumentReady);
}
// Define la función que se ejecuta cuando el documento está listo
function onDocumentReady() {
    var fields = document.getElementsByTagName('input');
    for (var i = 0; i < fields.length; i++) {
        fields[i].autocomplete = 'off';
    }
}
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('floatingPassword');
    const eyeIcon = document.getElementById('eye-icon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    }
}
//   Tablas   //
$(document).ready(function () {
    $('#anuncios').DataTable();
    $('#empleados').DataTable();
});
//   Infomracion   ////   Infomracion   ////   Infomracion   ////   Infomracion   ////   Infomracion   ////   Infomracion   ////   Infomracion   ////   Infomracion   ////   Infomracion   ////   Infomracion   ////   Infomracion   ////   Infomracion   ////   Infomracion   //
function infoPagosAl() {
    Swal.fire({
      title: 'Iconos',
      html: `
            <b style="display: flex; flex-direction: column; align-items: center;">
                <div class="btn btn-info"><i class="fa fa-edit"></i> Editar Alumno</div> Editar Infromación del Alumno
                <div class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar Alumno</div> Eliminar Alumno
                <div class="btn btn-success"><i class="fa fa-cash-register"></i> Realizar Cobro</div> Cobrar al Alumno
                <div class="btn btn-icon btn-success"><i class="fa fa-receipt"></i></div> Crear Ticket de Pago
                <div class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></div> Eliminar Pago
            </b>
            `,
      icon: 'question',
      confirmButtonText: 'Cerrar',
    });
}
function InfoAlumnos() {
    Swal.fire({
      title: 'Información',
      html: `
            <b style="display: flex; flex-direction: column; align-items: center;">
                <div class="btn btn-icon btn-info"><i class="fa fa-edit"></i></div> Editar Infromación del Alumno
                <div class="btn btn-icon btn-light"><i class="fa fa-user-graduate"></i></div> Crear nuevo Alumno <br><br>
                Para poder realizar un corbo sera necesario pulsar el nombre del alumno y entrar a la sección de pagos del alumno
            </b>
            `,
      icon: 'question',
      confirmButtonText: 'Cerrar',
    });
}
function InfoPagos() {
    Swal.fire({
      title: 'Iconos',
      html: `
            <b style="display: flex; flex-direction: column; align-items: center;">
                <div class="btn btn-icon btn-info"><i class="fa fa-edit"></i></div> Editar Infromación del Pago
                <div class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></div> Eliminar Pago
                <div class="btn btn-icon btn-success"><i class="fa fa-dollar-sign"></i></div> Crear nuevo Pago
            </b>
            `,
      icon: 'question',
      confirmButtonText: 'Cerrar',
    });
}
//   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   //
function crearUsuarios() {
    Swal.fire({
        title: "Crear nuevo usuario",
        html: `
            <form class="p-3 card bg-info" action="" method="post" enctype="multipart/form-data">
                <div style="margin-bottom:2%">
                    <div class="form-floating mb-1">
                        <input autocomplete="off" class="form-control" type="text" id="floatingInput" name="nom_usu" required placeholder="">
                        <label for="floatingInput">Nombre</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input autocomplete="off" class="form-control" type="number" id="floatingInput" name="tel" required placeholder="">
                        <label for="floatingInput">Telefono</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input autocomplete="off" class="form-control" type="mail" id="floatingInput" name="mail" required placeholder="">
                        <label for="floatingInput">Correo</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input autocomplete="off" class="form-control" type="password" id="floatingInput" name="pass" required placeholder="">
                        <label for="floatingInput">Contraseña</label>
                    </div>
                    <div class="form-floating mb-1">
                        <select class="form-select" aria-label="Default select example" name="rol" required>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Conta">Conta</option>
                            <option value="sx">sx</option>
                        </select>
                        <label for="floatingInput">Rol</label>
                    </div>
                </div>
                <button type="submit" name="usuario" class="btn btn-success"><i class="fa-solid fa-cloud-arrow-up"></i> Guardar Anuncio</button>
            </form>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 600,
    });
}
function addCarrera() {
    Swal.fire({
        title: "Coloque el nombre de la nueva carrera",
        html: `
            <form class="p-3 card bg-secondary-subtle" action="" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-1">
                    <input autocomplete="off" class="form-control" type="text" id="floatingInput" name="carreras" required placeholder="">
                    <label for="floatingInput">Nombre</label>
                </div>
                <button type="submit" name="crearCarrera" class="btn btn-danger">Crear Carrera Nueva</button>
            </form>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 400,
    });
}
function addConcepto() {
    Swal.fire({
        title: "Coloque el nombre de la nueva carrera",
        html: `
            <form class="p-3 card bg-secondary-subtle" action="" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-1">
                    <input autocomplete="off" class="form-control" type="text" id="floatingInput" name="concepto_pago" required placeholder="">
                    <label for="floatingInput">Nombre</label>
                </div>
                <button type="submit" name="crearConcepto" class="btn btn-danger">Crear Concepto Nuevo</button>
            </form>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 400,
    });
}
function exportarTomates() {
    Swal.fire({
        title: "Exportar Tomates",
        html: `
            <form class="formulario bg-dark" action="index.php?seccion=listasTomates" method="post" enctype="multipart/form-data">
                <button type="submit" name="PDF" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> PDF</button>
                <button type="submit" name="EXCEL" class="btn btn-success"><i class="bi bi-file-earmark-spreadsheet"></i> EXCEL</button>
            </form>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 500,
    });
}
function corteDia() {
    Swal.fire({
        title: "Seleccione el dia que desea adquirir el corte",
        html: `
            <form class="p-3 card bg-secondary-subtle" action="index.php?seccion=corteDia" method="post" enctype="multipart/form-data">
                <div calss="form-floating mb-1" style="margin-bottom:2%">
                    <input type="date" id="dia" name="dia" class="form-control">
                </div>
                <button type="submit" name="imprimir" class="btn btn-danger"><i class="fa-solid fa-cash-register"></i> Crear Corte</button>
            </form>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 400,
    });
}
function consultarAdeudo() {
    Swal.fire({
        title: "Seleccione rango de fechas para consultar los adeudos",
        html: `
            <form class="p-3 card bg-secondary-subtle" action="index.php?seccion=listaAdeudos" method="post" enctype="multipart/form-data">
                <div calss="form-floating mb-1" style="margin-bottom:2%">
                    <input type="date" id="inicio" name="inicio" class="form-control">
                </div>
                <div calss="form-floating mb-1" style="margin-bottom:2%">
                    <input type="date" id="fin" name="fin" class="form-control">
                </div>
                <button type="submit" name="imprimir" class="btn btn-danger"><i class="fa-solid fa-cash-register"></i> Consultar</button>
            </form>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 400,
    });
}
function corteRango() {
    Swal.fire({
        title: "Seleccione rango de fechas para corte de caja",
        html: `
            <form class="p-3 card bg-secondary-subtle" action="index.php?seccion=corteRango" method="post" enctype="multipart/form-data">
                <div calss="form-floating mb-1" style="margin-bottom:2%">
                    <input type="date" id="inicio" name="inicio" class="form-control">
                </div>
                <div calss="form-floating mb-1" style="margin-bottom:2%">
                    <input type="date" id="fin" name="fin" class="form-control">
                </div>
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-cash-register"></i> Consultar</button>
            </form>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 400,
    });
}
function borrarTomates() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-outline-danger",
          cancelButton: "btn btn-outline-secondary"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Quieres Eliminar la Lista de Tomates?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, quiero eliminarla",
        cancelButtonText: "No, mantener registros",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "index.php?seccion=tomatesAcumulados&accion=eliminar";
        } else if (result.dismiss === Swal.DismissReason.cancel) {}
    });
}
function menuAcciones() {
    Swal.fire({
        title: "Acciones",
        html: `
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" onclick="cargarAlumnos()"><i class="fa-solid fa-cloud-arrow-up"></i> Carga Masiva de Alumnos</button>
                <a class="btn btn-success" href="index.php?seccion=machoteAlumnos"><i class="bi bi-file-earmark-spreadsheet"></i> Machote Alumnos</a>
            </div>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 500,
    });
}