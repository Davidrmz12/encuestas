<?php
session_start();
require('conexion.php');
$consulta = "SELECT * FROM preguntas ORDER BY id DESC";
$resultado = mysqli_query($conex, $consulta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas</title>
    <link rel="stylesheet" href="./estilos/style-administrador.css">
    <link rel="icon" href="./imagenes/icono.ico">
</head>
<body>
<nav>
        <a href="index.php" class="enlace">
            <img src="./imagenes/chat.png" alt="" class="logo">
            <label for="">Encuestas</label>
        </a>
        <ul>
            <li><a href="login.php">Administrador</a></li>
            <li><a href="usuario.php">Usuarios</a></li>
        </ul>
    </nav>
    <form action="" method="POST">
    <div class="form-container">
    <div class="wrap">
            <h1>Preguntas</h1>
            <p>Selecione la pregunta y realice la votacion</p>
        <ul class="votacion index">
        <?php
            while($result = mysqli_fetch_object($resultado)){
                echo '<li><a href="encuestas.php?id='.$result->id.'">'.$result->titulo.'</a></li>';
            }
        ?>
        </ul>
    </div>
    </div>
</body>
</html>