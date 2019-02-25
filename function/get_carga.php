<?php
include_once 'bdconexion.php';

    $info=[];

    try {
      $sql_registe=$conn->query("SELECT COUNT(*) AS total_registro FROM mst_subject");
      $result_register = $sql_registe->fetch_assoc();
      $total_registro = $result_register['total_registro'];

      $por_pagina = 5;

      if(empty($_GET['pagina'])){
        $pagina = 1;
      }else{
        $pagina = $_GET['pagina'];
      }

      $desde = ($pagina-1) * $por_pagina;
      $total_paginas = ceil($total_registro / $por_pagina);
      $sql = "SELECT * FROM mst_subject ORDER BY sub_id ASC LIMIT $desde, $por_pagina";
        if ($datos = $conn->query($sql)) {
            while ($dato=$datos->fetch_assoc()) {
                $informacion=array(
                  'sub_id'=>utf8_encode($dato['sub_id']),
                  'sub_name'=>utf8_encode($dato['sub_name'])
                );
                $info[]=$informacion;
            }

            echo json_encode($info);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }

 ?>
