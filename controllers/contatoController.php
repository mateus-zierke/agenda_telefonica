<?php
include "../config/conexao.php";

$acao = $_REQUEST["acao"] ?? '';

if ($acao == "adicionar") {
    $ramal = $_POST["ramal"];
    $nome = $_POST["nome"];
    $setor = $_POST["setor"];
    $email = $_POST["email"];

    $sql = "INSERT INTO contatos (ramal, nome, setor, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $ramal, $nome, $setor, $email);

    if($stmt->execute()) {
        header("Location: ../views/painel.php");
    } else {
        echo "Erro ao adicionar contato!";
    }
}

if ($acao == "remover") {
    $id = $_GET["id"];

    $sql = "DELETE FROM contatos WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../views/painel.php");
    } else {
        echo "Erro ao remover contato!";
    }
}

if ($acao == "editar") {
    $id = $_POST["id"];
    $ramal = $_POST["ramal"];
    $nome = $_POST["nome"];
    $setor = $_POST["setor"];
    $email = $_POST["email"];

    $sql = "UPDATE contatos SET ramal=?, nome=?, setor=?, email=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $ramal, $nome, $setor, $email, $id);

    if($stmt->execute()) {
        header("Location: ../views/painel.php");
    } else {
        echo "Erro ao atualizar contato!";
    }
}

?>