<?php
    require 'conexion.php';
    
    if (isset($_POST['registro'])){
        if(
            strlen($_POST['nombre']) >=1 &&
            strlen($_POST['email'])>=1 &&
            strlen($_POST['password']) >=1 &&
            strlen($_POST['confirm_password']) >=1
        ) {
            $nombre= trim($_POST['nombre']);
            $email= trim($_POST['email']);
            $password= MD5($_POST['password']);
            $confirm_password= MD5($_POST['confirm_password']);
            $fecha =date("d/m/y");
            $consulta="INSERT INTO users(nombre,email,password,confirm_password,fecha)
                VALUES('$nombre','$email','$password','$confirm_password','$fecha')";
            $resultado=mysqli_query($conex, $consulta);
            if($resultado){
                header("Location: administrador.php");
            }else{
                ?>
                <h3 class="error">Ocurrio un error</h3>
                <?php
            }
        }else{
            ?>
            <h3 class="error">Por favor diligenciar todos los campos</h3>
            <?php
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="./estilos/style-registro.css">
    <link rel="icon" href="./imagenes/icono.ico">
</head>
<body>
    <div class="form-container">
    <nav>
        <a href="index.php" class="enlace">
            <img src="./imagenes/chat.png" alt="" class="logo">
        </a>
    </nav>
        <h1>Crear Cuenta Administradora</h1>
    <form action="registro.php" method="POST">
        <div class="form-container">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" placeholder="Ingrese su Nombre">
                    <label for="">Correo electrónico</label>
                    <input type="text" name="email" placeholder="Ingrese su Correo">
                    <label for="">Contraseña</label>
                    <input type="password" name="password" placeholder="Ingrese su Contraseña">
                    <label for="">Confirmar contraseña</label>
                    <input type="password" name="confirm_password" placeholder="Ingrese su contraseña">
                    <input type="submit" value="Registrar" name="registro">
                </div>
        </div>
    </div>
    </form>  
</body>
</html>