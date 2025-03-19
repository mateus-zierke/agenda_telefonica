<?php
include "../config/conexao.php";

//Consulta para obter os contatos ordenados pelo nome
$sql = "SELECT * FROM contatos ORDER BY nome ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agenda Telefônica</title>
        <link rel="stylesheet" href="../public/css/style.css">
    </head>
    <body>

        <h2>Agenda Telefônica</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>Ramal</th>
                    <th>Nome</th>
                    <th>Setor</th>
                    <th>Email</th>
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
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum contato encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="login.php">Acessar Painel Administrativo</a>
    </body>
</html>