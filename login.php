<?php
include('conexion.php');
session_start();
error_reporting (0);
if (isset($_SESSION ["nombre"])) {
    header("Location: login.php");
}
if(isset($_POST["iniciar"])){
    $email=$_POST["email"];
    $password= MD5($_POST["password"]);

    $consulta="SELECT * FROM users WHERE email='$email' AND password='$password'";
    $resultado= mysqli_query($conex,$consulta);

    if($resultado->num_rows>0){
        $row = mysqli_fetch_assoc($resultado);
        $_SESSION['nombre'] = $row['nombre'];
        header("Location: administrador.php");
    }else{
        ?>
        <h3 class="error">La contraseña o el correo son incorrectos</h3>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inico de Sesión </title>
    <link rel="stylesheet" href="./estilos/style-login.css">
    <link rel="icon" href="./imagenes/icono.ico">
</head>
<body>
    <div class="form-container">
    <nav>
        <a href="index.php" class="enlace">
            <img src="./imagenes/chat.png" alt="" class="logo">
        </a>
    </nav>
        <h1>Inicio de Sesión</h1>
    <form  method="POST">
        <div class="form-container">
                <div class="form-group">       
                    <label for="">Correo electrónico</label>
                    <input type="text" name="email" placeholder="Ingrese su Correo" value="<?php echo $_POST['email'];?>"required>
                    <label for="">Contraseña</label>
                    <input type="password" name="password" value="<?php echo $_POST['password'];?>"required>
                    <input type="submit" value="Iniciar Sesión" name="iniciar">
                </div>
        </div>
    </div>
    </form>  
</body>
</html>