<?php
session_start();
include "../config/conexao.php";

//Verifica se o usuário esta logado
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

//Verifica se um ID foi passado via GET
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: painel.php");
    exit();
}

$id = $_GET["id"];

//Busca os dados do contato pelo ID
$sql = "SELECT * FROM contatos WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0) {
    header("Location: painel.php");
    exit();
}

$contato = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Contato</title>
        <link rel="stylesheet" href="../public/css/style.css">
    </head>
    <body>

        <h2>Editar Contato</h2>

        <form method="post" action="../controllers/contatoController.php">
            <input type="hidden" name="acao" value="editar">
            <input type="hidden" name="id" value="<?= $contato['id'] ?>">
            <label for="ramal">Ramal:</label>
            <input type="text" name="ramal" value="<?= $contato['ramal'] ?>" required>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?= $contato['nome'] ?>" required>
            <label for="setor">Setor:</label>
            <input type="text" name="setor" value="<?= $contato['setor'] ?>" required>
            <label for="email">E-mail:</label>
            <input type="email" name="email" value="<?= $contato['email'] ?>" required>
            <button type="submit">Atualizar</button>
        </form>

        <a href="painel.php">Voltar ao Painel</a>
    </body>
</html>