<?php
session_start();
include "../config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = md5($_POST["senha"]);

    $sql = "SELECT * FROM admin WHERE usuario = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $_SESSION["admin"] = $usuario;
        header("Location: painel.php");
        exit();
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Administrativo</title>
        <link rel="stylesheet" href="../public/css/style.css">
    </head>
    <body>

        <h2>Login Administrativo</h2>
    
        <form method="post">
            <label for="usuario">Usuário:</label>
            <input type="text" name="usuario" required>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>
            <button type="submit">Entrar</button>
        </form>

        <?php
        if (isset($erro)) {echo "<p style='color: red;'>$erro</p>"; };
        ?>

        <a href="index.php">Voltar à Agenda</a>
    </body>
</html>