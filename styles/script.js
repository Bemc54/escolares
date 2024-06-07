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
function mostrarInformacion() {
    Swal.fire({
      title: 'Iconos',
      html: `
            <b style="display: flex; flex-direction: column; align-items: center;">
                <div class="btn btn-icon btn-info"><i class="fa fa-edit"></i></div> Editar Infromación del Anuncio
                <div class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></div> Eliminar Anuncio
                <div class="btn btn-icon btn-secondary"><i class="fa-solid fa-pause"></i></div> Pausar Anuncio
                <div class="btn btn-icon btn-primary"><i class="fa fa-play"></i></div> Reactivar Anuncio
                <button class="btn btn-icon btn-success" onclick="agregarAdd()"><span class="fa fa-plus"></span></button> Agregar un nuevo anuncio
            </b>
            `,
      icon: 'question',
      confirmButtonText: 'Cerrar',
    });
}
function mostrarInformacion1() {
    Swal.fire({
      title: 'Información',
      html: `
            <b style="display: flex; flex-direction: column; align-items: center;">
                En esta sección se puede modificar el nombre de un empleado que se haya ingresado mal a la base de datos, para así evitar que los tomates no se acumulen de manera correcta con el siguiente botón:
                <div class="btn btn-icon btn-info"><i class="fa-solid fa-pen-to-square"></i></div>
                Eliminar el registro de la base de datos de un empleado que ya no será considerado para acumular tomates con el siguiente botón:
                <div class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></div>
                Eliminar todos los registros de los tomates para empezar con una nueva acumulación del año en curso, con el siguiente botón:
                <div class="btn btn-icon btn-warning"><i class="fa fa-trash-can"></i></div>
            </b>
            `,
      icon: 'question',
      confirmButtonText: 'Cerrar',
    });
}
function invitadosInformacion() {
    Swal.fire({
      title: 'Iconos',
      html: `
            <b style="display: flex; flex-direction: column; align-items: center;">
                <div class="btn btn-icon btn-info"><i class="fa fa-edit"></i></div> Editar Infromación del Empleado
                <div class="btn btn-icon btn-danger"><i class="fa fa-trash"></i></div> Eliminar Empleado de la base de datos
                <div style="background-color: #F8D7DA; padding: 4px; border-radius: 4px;">Empleado dado de Baja, además se añadirá la fecha de Baja en la columna correspondiente</div>
            </b>
            `,
      icon: 'question',
      confirmButtonText: 'Cerrar',
    });
}
//   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   ////   Formularios   //
function registrarAlumno() {
    Swal.fire({
        title: "Registrar Alumno",
        html: `
            <form class="p-3 card bg-info" action="" method="post" enctype="multipart/form-data">
                <div style="margin-bottom:2%">
                    <input type="hidden" value="1" name="pause">
                    <div class="form-floating mb-1">
                        <input autocomplete="off" class="form-control" type="text" id="floatingInput" name="nombre" required placeholder="">
                        <label for="floatingInput">Nombre</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input autocomplete="off" class="form-control" type="number" id="floatingInput" name="telefono" required placeholder="">
                        <label for="floatingInput">Telefono</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input autocomplete="off" class="form-control" type="mail" id="floatingInput" name="correo" required placeholder="">
                        <label for="floatingInput">Correo</label>
                    </div>
                    <div class="form-floating mb-1">
                        <select class="form-select" aria-label="Default select example" name="grado_estudio" required>
                            <option selected value="Bachillerato">Bachillerato</option>
                            <option value="Carrera Semi-Escolarizada">Carrera Semi-Escolarizada</option>
                            <option value="Carrera Escolarizada">Carrera Escolarizada</option>
                            <option value="Maestria">Maestria</option>
                        </select>
                        <label for="floatingInput">Nivel de Estudio</label>
                    </div>
                    <div class="form-floating mb-1">
                        <select class="form-select" aria-label="Default select example" name="carrera">
                            <option selected value="">Seleccione</option>
                            <option value="Psicologia">Psicologia</option>
                            <option value="Derecho">Derecho</option>
                            <option value="Ingenria Industrial">Ingenria Industrial</option>
                            <option value="Trabajo Social">Trabajo Social</option>
                            <option value="Psicopedagogia">Psicopedagogia</option>
                            <option value="Ingles">Ingles</option>
                            <option value="Proteccion Civil">Proteccion Civil</option>
                        </select>
                        <label for="floatingInput">En caso de Escolarizado o Sabado y Domingo</label>
                    </div>
                </div>
                <button type="submit" name="guardar" class="btn btn-success"><i class="fa-solid fa-cloud-arrow-up"></i> Guardar Anuncio</button>
            </form>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 600,
    });
}
function crearPago() {
    Swal.fire({
        title: "Crear Pago",
        html: `
            <form class="p-3 card bg-warning-subtle" action="" method="post" enctype="multipart/form-data">
                <div style="margin-bottom:2%">
                    <div class="form-floating mb-1">
                        <select class="form-select" aria-label="Default select example" name="concepto" required>
                            <option value="Examen Unico">Examen Unico</option>
                            <option value="Mensualidad">Mensualidad</option>
                            <option value="Inscripcion">Inscripcion</option>
                            <option value="Reinscripcion">Reinscripcion</option>
                        </select>
                        <label for="floatingInput">Concepto</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input autocomplete="off" class="form-control" type="text" id="floatingInput" name="monto" required placeholder="">
                        <label for="floatingInput">Monto</label>
                    </div>
                    <div class="form-floating mb-1">
                        <select class="form-select" aria-label="Default select example" name="tipo_alumno" required>
                            <option selected value="Bachillerato">Bachillerato</option>
                            <option value="Carrera Semi-Escolarizada">Carrera Semi-Escolarizada</option>
                            <option value="Carrera Escolarizada">Carrera Escolarizada</option>
                            <option value="Maestria">Maestria</option>
                        </select>
                        <label for="floatingInput">Tipo de Alumno que lo debe Pagar</label>
                    </div>
                </div>
                <button type="submit" name="crear" class="btn btn-success"><i class="fa-solid fa-dollar-sign"></i> Guardar Pago</button>
            </form>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 600,
    });
}
function cargarAlumnos() {
    Swal.fire({
        title: "Carga Masiva de Alumnos",
        html: `
            <form class="p-3 card bg-info-subtle" action="index.php?seccion=procesarAlumnos" method="post" enctype="multipart/form-data">
            <span class="badge bg-dark">Recuerda que tu Excel debe tener la siguiente estructura:</span>
                <table style="margin-top:2%" class="table table-dark table-bordered">
                <thead>
                    <tr class="table-dark">
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Grado de Estudio</th>
                    </tr>
                </thead>
                </table>
                <div style="margin-bottom:2%">
                    <input type="file" id="alumnos" name="alumnos" accept=".xlsx" class="form-control">
                </div>
                <button type="submit" name="cargar" class="btn btn-success"><i class="fa-solid fa-cloud-arrow-up"></i> Cargar Alumnos</button>
            </form>
        `,
        showCloseButton: true,
        showConfirmButton: false,
        width: 500,
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