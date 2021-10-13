<?php
if (session_status() !== PHP_SESSION_ACTIVE)
{
    session_start();
}
echo (isset($_SESSION["DNIEmpleado"]) ? header("Location: index_BD.php") : header("Location: ../login.html"));

?>