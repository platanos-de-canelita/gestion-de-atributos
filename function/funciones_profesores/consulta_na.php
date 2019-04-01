<?php
 include_once 'bdconexion.php';
$mi_consulta='SELECT * FROM profesor WHERE status = 0';
$result=mysqli_query($conn, $mi_consulta);



  while($row = mysqli_fetch_assoc($result))
            {
              echo '<tr>';
              echo      '<td>'.$row["idprofesor"].' </td>';
              echo      '<td>'.$row["nombre"].' </td>';
              echo      '<td> '.$row["e_mail"].' </td>';
              echo      '<td><button class="btn btn-primary _sa" id="_sa" onclick="acepar_profe('.$row["idprofesor"].')">Aceptar</button>
    							</td>';
              echo       '</tr>';
            }


echo "</table>";
?>
