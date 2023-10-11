<?php

$conexion = mysqli_connect('localhost', 'root', '', 'correspondencia') or die(mysqli_error($mysql1));


diferencia($conexion);


function diferencia($conexion){
    if(isset($_POST['iniciar'])){
        login($conexion);
    }
}

function login($conexion){
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    
    // Realiza la consulta para verificar las credenciales
    $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$contrasena'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        // Verifica si se encontró un usuario con las credenciales proporcionadas
        if (mysqli_num_rows($resultado) == 1) {
            header("Location: index.html");
            exit();
        } else {
            // Credenciales incorrectas
            echo "Credenciales incorrectas. Intente de nuevo.";
        }
    } else {
        // Error en la consulta
        echo "Error en la consulta: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}

function insertar($conexion)
{
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $area = $_POST['area'];

    // Use prepared statements to prevent SQL injection
    $consulta = "INSERT INTO usuarios (Nombre_us,Apellidos,usuario,contraseña,area) 
    VALUES ('$nombre','$apellidos' ,'$usuario','$contraseña','$area' )";
     header('Location: usuarios.html');
    mysqli_query($conexion,$consulta);
    mysqli_close($conexion);
}
function cargarTabla($conexion){
    $consulta = "SELECT * FROM usuarios ";
    $resultado= mysqli_query($conexion, $consulta);

    while($fila= mysqli_fetch_array($resultado)){
        echo "<tr>";
        echo "<td>".$fila['id_us'];
        echo "<td>".$fila['Nombre_us'];
        echo "<td>".$fila['Apellidos'];
        echo "<td>".$fila['usuario'];
        echo "<td>".$fila['area'];
        echo"<tr>";
    }
    mysqli_close($conexion);
}

?>
