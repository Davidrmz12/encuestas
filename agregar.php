<?php 
session_start();
require('conexion.php');
$cont = 0;
 
$titulo = ''; if(isset($_POST['titulo'])){ $titulo = trim($_POST['titulo']); } 
 
if(isset($_POST['enviar'])){
     if($titulo != ""){
        $num = $_POST['respuestas']; 
        $fecha = date('Y-m-d');
 
        $sql= "INSERT INTO `preguntas` (`id` ,`titulo` ,`fecha`) VALUES (NULL ,  '$titulo', '$fecha');"; 
        mysqli_query($conex, $sql);
 
        $sql = "SELECT MAX(id) as id FROM preguntas"; 
                                                      
                                                      
        $req =  mysqli_query($conex, $sql);
 
        while($result = mysqli_fetch_object($req)){
            $id_preguntas = $result->id;  
        }
 
        $sql = "INSERT INTO  `respuestas` (`id` ,`id_preguntas` ,`nombre` ,`valor`) VALUES ";
        for($i=1;$i<=$num;$i++){
            $opcnativa = trim($_POST['opc'.$i]); 
            if($opcnativa != ""){
                $sql .= "(NULL ,  '$id_preguntas',  '$opcnativa',  '0')"; 
                $cont++;
            }
            if($i == $num){
                $sql .= ";"; 
            }else{
                $sql .= ", ";
            }
        }
 
        if($cont < 2){ 
            $sql = "DELETE FROM `encuestas` WHERE id = ".$id_encuesta;
            echo "<div class='error'>Tiene que llevar por lo menos 2 opciones.</div>";
        }else{
            header('location: administrador.php'); 
        }
        mysqli_query($conex, $sql); 
    }
}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Encuestas</title>
    <link rel="stylesheet" href="./estilos/style-agregar.css">
    <link rel="icon" href="./imagenes/icono.ico">
</head>
<body>
<nav>
        <a href="index.php" class="enlace">
            <img src="./imagenes/chat.png" alt="" class="logo">
            <label for="">Encuestas</label>
        </a>
        <ul>
            <li><a href="administrador.php">Administrador</a></li>
            <li><a href="registro.php">Crear Usuario Administrador</a></li>
            <li><a href="encuesta.php">Usuarios</a></li>
            <li><a class="btna" href="cerrar.php">Cerrar Sesion
            </a></li>
        </ul>
    </nav>
<div class="wrap">
    <form action="" method="post">
    <div class="form-group">   
    <h1>Crear preguntas</h1>
        <label>Pregunta</label>
        <input name="titulo" type="text" value="<?php echo $titulo; ?>">
    </div>
    <?php
        
    if(isset($_POST['opc'])){
        $num = $_POST['respuestas']; 
        for($i=1;$i<=$num;$i++){ 
    ?>
    <div class="cf">
        <label>Respuestas <?php echo $i; ?>: </label>
        <input name="opc<?php echo $i; ?>" type="text" size="43">
    </div>
    <?php } ?>
    
        <input name="enviar" type="submit" value="Enviar">
        <input name="respuestas" type="hidden" value="<?php echo $num; ?>">
        <input name="cont" type="hidden" value="<?php echo cont; ?>">
  
    <?php }else{ ?>
    <div class="form-group"> 
        <label>Cantidad de respuestas
            <select name="respuestas">
                <?php for($i=2;$i<=20;$i++){ ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </label>
    </div>
 
    
        <input name="opc" type="submit" value="Continuar">
   
 
      <?php } ?>
    <a href="administrador.php" class="btnv">Volver</a>
    </form>
    </div>
</body>
</html>