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
    <script src="../js/login.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

</head>

<body>
<?php include '../templates/header.php'; ?>
<div class="container">
  <div id="row">
  <div class="row">
      <div class="col-md-12 titulo">
          <h2 id="tipo-inicio">Inicia sesión</h2>
      </div>
  </div>

  <div class="row" style="padding-left: 20em; padding-right: 20em">
    <div id="message" style="width:100%;"></div>
    <form class="col-md-12" id="LoginForm">
      <div class="btn-group" style="margin-left : 18%; margin-top:5%;" role="group" aria-label="Basic example">
        <button type="button" onclick="setTypeLogin('Administrador')" class="btn btn-secondary" style="background : rgb(30, 53, 94); font-weight:600;">Administrador</button>
        <button type="button" onclick="setTypeLogin('Encargado')" class="btn btn-secondary" style="background : rgb(30, 53, 94); font-weight:600;">Encargado</button>
        <button type="button" onclick="setTypeLogin('Profesor')" class="btn btn-secondary" style="background : rgb(30, 53, 94); font-weight:600;">Profesor</button>
      </div>
      <br><br>
      <input type="text" class="form-control" name="txtusuario" value="" placeholder="Usuario"><br><br>
      <input type="password" class="form-control" name="txtpass" value="" placeholder="Contraseña"><br><br>
    </form>
    <button class="btn" id="btn-login" disabled name="login" onclick="Login()">Iniciar sesión</button>
  </div>

  <br>
  <br>
  <br>
  <br>
  </div>
</div>
</body>
</html>
