<?php
session_start();
require_once ('../../app/Config.php');

if(!isset($_SESSION["nombre"]))
{
  header("Location: ../mod_usuario/usuario.php");
}else {
  if (isset($_SESSION["privilegio"]) and  $_SESSION["privilegio"] == "Administrador"){
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ingresar Compras</title>
        <!-- llamamos hoja de estilos css -->
        <?php require_once('../../app/Header_admin.php'); ?>
        <script type="text/javascript">
            
        </script>
    </head>
    <body>
      <section id="container">
      <header>

      </header>
        <?php require_once('../mod_administrador/menu_administrador.php'); ?>
        <section id="mainContainer">
          <article id="contenido">
<?php
/*print_r($_POST); exit;*/
echo"<center>";



/*$idmedica=$_POST["idmedica"];*/
$id_proveedor=$_POST["id_proveedor"];
$detalle=$_POST["detalle"];
$litros=$_POST["litros"];
$fecha=$_POST["fecha"];


$sql="insert into compras(id_compra,detalle,litros,fecha,id_proveedor)

values(null,'$detalle','$litros','$fecha','$id_proveedor')";



$conexion = mysqli_connect("localhost","root","","servicios");
mysqli_select_db($conexion,"servicios");


$resultado = mysqli_query($conexion,$sql);



$sql1="select existencia as exist from control order by id_control DESC LIMIT 1";

/*echo $sql; */

$conexion = mysqli_connect("localhost","root","","servicios");
mysqli_select_db($conexion,"servicios");


$resultado1 = mysqli_query($conexion,$sql1);


$datos = mysqli_fetch_assoc($resultado1);
$exis = $datos['exist'];
if(empty($exis)){
  $exis = 0;
}else{
  $exis = $exis;
}
$compra = $litros;
$venta = 0;
$existencia  = $exis + $compra;
$fecha = $fecha;
$proveedores_id_proveedor = $id_proveedor;
$productores_id_productor = 0;






$sql2="insert into control(id_control,compra,venta,existencia,fecha,id_proveedor,id_productor)

values(null,$compra,$venta,$existencia,'$fecha',$proveedores_id_proveedor,$productores_id_productor)";
/*echo $sql2; exit;*/
$conexion = mysqli_connect("localhost","root","","servicios");
mysqli_select_db($conexion,"servicios");


$resultado2 = mysqli_query($conexion,$sql2);



if(!$resultado2){//
echo 'errror...';
}


?>









<h3>Sus datos Fueron Almacenados Exitosamente</h3>

<p>
    <a class='btn btn-info' href='http://localhost/servicios/modulos/mod_administrar_compras/administrar_compras.php'>Regresar</a>
</p>  
	







</center>




              <p>&nbsp;</p>
              <p>&nbsp;</p>                  
            
          </article>
        
        </section>
                          
      <footer>
          <div> Desarrollado por Baron, Gonzalez y Hernandez agosto 2017 </div> 
      </footer>
      </section>
    </body>
    <?php   
    }else{
      header("Location: " . BASE_URL . "app/404.php");
    }
  }  ?>
</html>