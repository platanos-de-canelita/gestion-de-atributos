 <?php
 //Incluimos la base de datos
 include_once 'bdconexion.php';

     $info=[];

     try {
       //contamos cuantas tuplas hay en la tabla de donde queremos extraer informacion
       $sql_registe=$conn->query("SELECT COUNT(*) AS total_registro FROM atributo");
       $result_register = $sql_registe->fetch_assoc();
       $total_registro = $result_register['total_registro'];

       $por_pagina = 5;
       //si no se envia una pagina en la url configuramos la busqueda en la primera pagina de resultados
       if(empty($_GET['pagina'])){
         $pagina = 1;
       }else{
         $pagina = $_GET['pagina'];
       }

       $desde = ($pagina-1) * $por_pagina;
       $total_paginas = ceil($total_registro / $por_pagina);
       //El query obtiene los resultados correspondientes al numero de paginas
         $sql = "SELECT * FROM materia ORDER BY idmateria ASC LIMIT $desde, $por_pagina";
         //Guardamos el resultado del query en una variable
         if ($datos = $conn->query($sql)) {
           //creamos un array asociativo llamado infomacion para guardar columnas
             while ($dato=$datos->fetch_assoc()) {
                //usamos utf8_encode para codificar la info de modo que acepte acentos y tildes
                 $informacion=array(
                   'sub_id'=>utf8_encode($dato['idmateria']),
                   'sub_name'=>utf8_encode($dato['nombre'])
                 );
                 $info[]=$informacion;
             }
             //finalmente enviamos el array convertido a un json
             echo json_encode($info);
         }
     } catch (Exception $e) {
         echo $e->getMessage();

     }

  ?>
