
<?php

require_once("bdconexion.php");

$usuario = $_POST['usuario'];

//obtengo el departamento del administrador

$res = $conn->query("SELECT id_admin_pk FROM administrador WHERE usuario='$usuario'");
$response = $res->fetch_row();
echo $response[0];

?>