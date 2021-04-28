<?php
if (session_status() !== PHP_SESSION_ACTIVE)
{
    session_start();
}

echo (isset($_SESSION["DNIEmpleado"]) ? header("Location: ../mostrar.php") : header("Location: ../login.html"));

?>