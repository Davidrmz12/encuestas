<?php
require('conexion.php');
        $id = $_GET['id'];
    if(!isset($_GET['id'])){
        header('location: administrador.php');
    }
 
    if(isset($_POST['votar']))
    {
 
        if(isset($_POST['valor'])){
            $respuestas = $_POST['valor'];
            $mod = mysqli_query($conex, "SELECT * FROM respuestas WHERE id = ".$respuestas);
            while($result = mysqli_fetch_object($mod)){
                $valor = $result->valor + 1; 
                mysqli_query($conex,"UPDATE respuestas SET valor =  '".$valor."' WHERE id = ".$respuestas); 
            }
            header('location: resultado.php?id='.$id); 
        }
    }
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Sistema de encuestas</title>
    <link rel="stylesheet" href="./estilos/style-encuesta.css">
    <link rel="stylesheet" href="./estilos/style-encuesta2.css">
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
            <li><a href="usuario.php">Usuarios</a></li>
            <li><a class="btna" href="cerrar.php">Cerrar Sesion
            </a></li>
        </ul>
    </nav>
 
<div class="wrap">
 
<form action="" method="post">
<?php
$aux = 0;
$sql = "SELECT a.titulo as titulo, a.fecha as fecha, b.id as id, b.nombre as nombre, b.valor as valor FROM preguntas a INNER JOIN respuestas b ON a.id = b.id_preguntas WHERE a.id = ".$id;
$resultado = mysqli_query($conex, $sql);
 
while($result = mysqli_fetch_object($resultado)){
 
    if($aux == 0){
        echo '<h1>'.$result->titulo.'</h1>';
 
        echo '<ul class="votacion">';
        $aux = 1;
    }
 
    echo '<li><label><input name="valor" type="radio" value="'.$result->id.'"><span>'.$result->nombre.'</span></label></li>';
 
}
    echo '</ul>'; 
 
    if(!isset($_POST['valor'])){
        echo "<div class='error'>Selecciona una opcion.</div>";
    }
 
    echo '<a href="resultado.php?id='.$id.'" class="resultado">Ver Resultados</a>';
    echo '<a href="administrador.php" class="volver">Volver</a>';
 
?>
 
</form>
</div>
 
</body>
</html>