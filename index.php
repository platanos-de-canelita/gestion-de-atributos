<?php
  session_start();
  if (session_status() === PHP_SESSION_ACTIVE && $_SESSION['usuario']!="") {

  }else{
  	header("Location: login.php");
  	exit();
  }
 ?>
 <?php include 'templates/head.php'; ?>
 <h1 >Bienvenido</h1>
 <div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Selecciona una materia</h3>
      <div class="contenedor" id="materias">

      </div>
    </div>
    <div class="col-sm-4">
      <h3>Selecciona un examen</h3>
      <div class="contenedor" id="examenes">

      </div>
    </div>
    <div class="col-sm-4">
      <h3>Calificacion</h3>
      <div class="contenedor">

      </div>
    </div>
  </div>
</div>
