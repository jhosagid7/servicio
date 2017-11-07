<?php
session_start();
require_once ('../../app/Config.php');

if(!isset($_SESSION["nombre"]))
{
  header("Location: ../mod_usuario/usuario.php");
}else {
if (isset($_SESSION["privilegio"]) and  $_SESSION["privilegio"] == "Administrador" || $_SESSION["privilegio"] == "Usuario"){
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema</title>
        <!-- llamamos hoja de estilos css -->
        <?php require_once('../../app/Header_admin.php'); ?>
        <script type="text/javascript">
            
        </script>
    </head>
    <body>
     <!-- Main content -->
        <section class="content">
            <section id="container">
                <header>
                </header>
                <?php require_once('../../modulos/mod_administrador/menu_administrador.php'); ?>
                    <section id="mainContainer">
                      <article id="contenido">
                      <?php
                           $conexion=mysqli_connect("localhost","root","","servicios");
                          mysqli_select_db($conexion,"servicios");

                          $buscar=mysqli_query($conexion,"select v.id_ventas as codigo, pd.nombre_empresa_prod, pd.rif_prod, pd.nombre_contacto_prod, pd.cedula_contacto_prod, v.tipo_prod, v.litros, v.fecha from ventas  v, productores pd");

                          echo"<h1>Ver control</h1> <a class='btn btn-danger small' href='reporte_general_ventas_pdf.php' >Descargar PDF</a>";
                          echo"<table id='reporte_general'  class='table table-striped table-bordered' cellspacing='0' width='100%'  >
                          <tr>
                          <th>C&oacute;digo</th>
                          <th>Nombre Empresa</th>
                          <th>Rif</th>
                          <th>Nombre Contacto</th>
                          <th>Cedula Contacto</th>
                          <th>Detalle</th>
                          <th>Litros</th>
                          <th>Fecha</th>
                          </tr>";

                          while($dato=mysqli_fetch_array($buscar))
                          {
                          echo"<tr><td>";
                          echo $dato["codigo"];
                          echo"</td><td>";

                          echo $dato["nombre_empresa_prod"];
                          echo"</td><td>";

                          echo $dato["rif_prod"];
                          echo"</td><td>";

                          echo $dato["nombre_contacto_prod"];
                          echo"</td><td>";

                          echo $dato["cedula_contacto_prod"];
                          echo"</td><td>";


                          echo $dato["tipo_prod"];
                          echo"</td><td>";

                          echo $dato["litros"];
                          echo"</td><td>";

                          echo $dato["fecha"];
                          echo"</td>";

                          }

                          echo"</table>";
                          $num=mysqli_num_rows($buscar);

                          echo"<h3>Numero de ventas: $num</h3>";
                          
                          echo"<p                                                         >
                              <a class='btn btn-info' href=http://localhost/servicios/modulos/mod_administrar_control/administrar_control.php>Regresar</a>
                              ";
                            



                         
                          ?>

                      </article>
                        <footer>
                            <div> Desarrollado por Baron, Gonzalez y Hernandez agosto 2017 </div> 
                        </footer>
                    </section>
                </section>

        </section>
                
        
    </body>

 <?php   
    }else{
         header("Location: " . BASE_URL . "app/404.php");
    }
}      ?>
</html>

<script ;>
  
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#reporte_general').DataTable();
} );  
</script>