<h1 class="titulo">
  SISTEMA UNIVERSITARIO MARIE CURIE S.C.
</h1>
<form id="loginForm" class="card col-4 formulario" method="post">
  <h1 class="card-header text-center" style="color:white; height: 75px; background: #00000020;"><b>Iniciar Sesion</b></h1>
  <div class="card-body" style="display: flex; flex-direction: column; justify-content: center; background: #00000020;">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="mail" requierd>
      <label for="floatingInput">Nombre de Usuario:</label>    
    </div>
    <div class="input-group mb-3">
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
        <label for="floatingPassword">Contraseña</label>
      </div>
      <span class="input-group-text">
        <button type="button" id="togglePassword" class="btn btn-light" onclick="togglePasswordVisibility()">
          <i class="fa fa-eye-slash" id="eye-icon"></i>
        </button>
      </span>
    </div>
  </div>
  <div class="card-footer" style="height: 75px; background: #00000020;">
    <button class="btn btn-warning" type="submit" name="entrar"><i class="fa-solid fa-right-to-bracket"></i> Entrar</button>
  </div>
</form>