<?php
session_start();
include "../config/conexao.php";

//Verifica se o usuário esta logado
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

//Consulta para obter os contatos
$sql = "SELECT * FROM contatos ORDER BY nome ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Painel Administrativo</title>
        <link rel="stylesheet" href="../public/css/style.css">
    </head>
    <body>

        <h2>Painel Administrativo</h2>

        <a href="logout.php" class="logout">Sair</a>

        <h3>Adicionar Novo Contato</h3>
        <form method="post" action="../controllers/contatoController.php">
            <input type="hidden" name="acao" value="adicionar">
            <label for="ramal">Ramal:</label>
            <input type="text" name="ramal" required>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>
            <label for="setor">Setor:</label>
            <input type="text" name="setor" required>
            <label for="email">E-mail:</label>
            <input type="email" name="email" required>
            <button type="submit">Adicionar</button>
        </form>

        <h3>Lista de Contatos</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Ramal</th>
                    <th>Nome</th>
                    <th>Setor</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["ramal"] . "</td>";
                        echo "<td>" . $row["nome"] . "</td>";
                        echo "<td>" . $row["setor"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td><a href='editar.php? id=" . $row["id"] . "' class='edit'>Editar</a>
                                <a href='../controllers/contatoController.php? acao=remover&id=" . $row["id"] . "' class='delete' 
                                onclick='return confirm(\"Tem certeza que deseja excluir este contato?\")'>Excluir</a>
                                <td>";
                                    echo "<tr>";
                                }
                            } else { 
                                echo "<tr><td colspan='5'>Nenhum contato encontrado</td></tr>";
                                }
                        ?>           
            </tbody>
        </table>
    <a href="index.php">Voltar à Agenda</a>
    </body>
</html>