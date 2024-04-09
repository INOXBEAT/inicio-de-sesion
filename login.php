<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: inicio.php");
            exit();
        } else {
            echo "Nombre de usuario o contraseña incorrectos.";
        }
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="form-background">
            <h1>Iniciar sesión</h1>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Usuario">
                <br>
                <input type="password" name="password" placeholder="Contraseña">
                <br><br>
                <input type="submit" value="Ingresar">
            </form>
        </div>
        <div class="login">
            <p>¿Eres nuevo? <a href="#">Regístrate</a></p>
        </div>
    </div>
</body>

</html>
