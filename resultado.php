<?php
 session_start();
require('conexion.php');
 
if(!isset($_GET['id'])){
    header('location: index.php');
}
 
$suma = 0;
$id = $_GET['id'];
$mod = mysqli_query($conex,"SELECT SUM(valor) as valor FROM respuestas WHERE id_preguntas = ".$id);
while($result = mysqli_fetch_object($mod)){
    $suma = $result->valor;
}
 
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Encuestas</title>
    <link rel="stylesheet" href="./estilos/resultado.css">
    <link rel="stylesheet" href="./estilos/stile-resultado.css">
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
$req = mysqli_query($conex, $sql);
 
while($result = mysqli_fetch_object($req)){
    if($aux == 0){
            echo "<h1>".$result->titulo."</h1>";
            echo "<ul class='votacion'>";
        $aux = 1;
    }
    echo '<li><div class="fl">'.$result->nombre.'</div><div class="fr">Votos: '.$result->valor.'</div>';
    if($suma == 0){
        echo '<div class="barra cero" style="width:0%;"></div></li>';
    }else{
        echo '<div class="barra" style="width:'.($result->valor*100/$suma).'%;">'.round($result->valor*100/$suma).'%</div></li>';
    }
 
}
echo '</ul>'; 
 
if(isset($aux)){
    echo '<span class="fr">Total: '.$suma.'</span>';
    echo '<a href="encuesta.php?id='.$id.'"" class="volver">← Volver</a>';
}
 
?>
</ul>
</form>
</div>
</body>
</html>