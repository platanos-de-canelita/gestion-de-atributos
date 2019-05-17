
<?php include '../templates/header.php'; ?>
<div class="container">
  <div id="row">
  <div class="row">
      <div class="col-md-12 titulo">
          <h2>Registrate como profesor</h2>
      </div>
  </div>

  <div class="row" style="padding-left: 20em; padding-right: 20em">
    <br>
    <form class="col-sm-12"  action="../function/funciones_profesores/registrarse.php" method="post">
      <br><br>
      <input type="text" class="form-control" name="txtusuario" value="" placeholder="Usuario"><br><br>
      <input type="password" class="form-control" name="txtpass" value="" placeholder="Contraseña"><br><br>
      <input type="password" class="form-control" name="txtcpass" value="" placeholder="Confirma tu contraseña"><br><br>
      <input type="text" class="form-control" name="txtnombre" value="" placeholder="Nombre"><br><br>
      <input type="text" class="form-control" name="txtcorreo" value="" placeholder="Email"><br><br>
      <button type="submit" class="btn btn-primary" name="login">Registrarse</button>
    </form>
  </div>

  <br>
  <br>
  <br>
  <br>
  </div>
</div>
