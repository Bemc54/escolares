<?php
    if (!isset($_SESSION['rol'])){
        echo '
            <script type="text/javascript">
                Swal.fire({
                    icon: "info",
                    title: "No tienes Permiso para entrar",
                    text: "Necesitas Iniciar Sesión para entrar a cualquier parte del sistema",
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "index.php";
                });
            </script>
        ';
    } elseif (isset($_SESSION['rol']) && $_SESSION['rol'] == 'sx' || $_SESSION['rol'] == 'Admin') {
        $idal = $_GET['idal'];
        $idpa = $_GET['idpa'];
        $con = $_GET['con'];
        $mon = $_GET['mon'];
        $nombreUsu = $_SESSION['nombre'];
        $fechaActual = date('d/m/Y');
        $cobrar = new ControladorIngresos();
        $cobrar -> guardarIngreso();
        echo '
            <form class="card p-4 col-5 bg-secondary" action="" method="post" enctype="multipart/form-data">
                <h4>Confirmar Cobro</h4>
                <div calss="mb-2">
                <input type="hidden" name="id_al" value="'.$idal.'">
                <input type="hidden" name="id_pa" value="'.$idpa.'">
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" readonly type="text" id="floatingInput" name="cobrador" value="'.$nombreUsu.'">
                        <label for="floatingInput">Cobrador</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" readonly type="text" id="floatingInput" name="concep" value="'.$con.'">
                        <label for="floatingInput">Concepto</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" type="number" id="floatingInput" name="monto_pagado" value="'.$mon.'">
                        <label for="floatingInput">Monto</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" readonly type="text" id="floatingInput" name="fecha_pago" value="'.$fechaActual.'">
                        <label for="floatingInput">Fecha de Pago</label>
                    </div>
                    <div class="form-floating mb-1">
                        <select class="form-select" aria-label="Default select example" name="metodo" required>
                            <option>Seleccione el Metodo de Pago</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="Transferencia">Transferencia</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Deposito">Deposito</option>
                            <option value="Tarjeta de Credito">Tarjeta de Credito</option>
                            <option value="Tarjeta de Debito">Tarjeta de Debito</option>
                            <option value="Cuenta Corriente">Cuenta Corriente</option>
                            <option value="Otros">Otros</option>
                        </select>
                        <label for="floatingInput">Tipo de Alumno que lo debe Pagar</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" type="text" id="floatingInput" name="comentario" placeholder="Comentario (Opcional)">
                        <label for="floatingInput">Comentario (Opcional)</label>
                    </div>
                </div>
                <button class="btn btn-success" type="submit" name="cobrar"><i class="fa fa-cash-register"></i> Realizar Cobro</button>
            </form>
        ';
    } else {
        echo '
            <script type="text/javascript">
                Swal.fire({
                    icon: "info",
                    title: "No tienes Permiso para entrar",
                    text: "Tu nivel de Usuario no tiene permitido entrar aquí",
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "index.php";
                });
            </script>
        ';
    }
?>