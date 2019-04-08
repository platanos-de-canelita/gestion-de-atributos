<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seguimiento de atributos</title>
    <!--Fuentes de google-->
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|PT+Sans+Narrow" rel="stylesheet">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/main.css">


</head>

<body>
<?php include '../templates/header.php'; ?>
<div class="container">
  <div id="row">
  <div class="row">
      <div class="col-md-12 titulo">
          <h2>Registro como administrador</h2>
      </div>
  </div>

  <div class="row" style="padding-left: 20em; padding-right: 20em">
    <br>
    <form class="col-md-12"  action="../function/registro.php" method="post">
      <br><br>
      <input type="text" class="form-control" name="txtusuario" value="" placeholder="Usuario"><br><br>
      <input type="password" class="form-control" name="txtpass" value="" placeholder="Contraseña"><br><br>
      <input type="password" class="form-control" name="txtcpass" value="" placeholder="Confirmar contraseña"><br><br>
      <button type="submit" class="btn" name="login">Iniciar sesión</button>
    </form>
  </div>

  <br>
  <br>
  <br>
  <br>
  </div>
</div>
</body>
</html>
