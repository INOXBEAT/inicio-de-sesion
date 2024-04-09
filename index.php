<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Aquí podrías mostrar el contenido de la página de inicio
echo "Bienvenido!";
?>
