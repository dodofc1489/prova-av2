<?php
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome  = trim($_POST["nome"]);
    $login = trim($_POST["login"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $verifica = $conn->prepare("SELECT login FROM seguranca_tbUsuarios WHERE login = ?");
    $verifica->bind_param("s", $login);
    $verifica->execute();
    $resultado = $verifica->get_result();

    if ($resultado->num_rows > 0) {
        echo "Este login já está em uso.";
        exit;
    }

    $sql = $conn->prepare("INSERT INTO seguranca_tbUsuarios (nome, login, senha) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $nome, $login, $senha);

    if ($sql->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $sql->error;
    }

    $sql->close();
    $verifica->close();
}

$conn->close();
?>
