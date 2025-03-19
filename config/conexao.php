<?php
$host = "localhost";
$usuario = "root"; // Usuário padrão do MySQL no XAMPP
$senha = ""; // Senha vazia no XAMPP
$banco = "agenda_telefonica";

$conn = new mysqli($host, $usuario, $senha, $banco);

//Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

?>