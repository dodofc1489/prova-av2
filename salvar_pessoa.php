<?php
include("conexao.php");
session_start();

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$nascimento = $_POST['nascimento'];
$telefone = $_POST['telefone'];
$pessoa_tipo_id = $_POST['pessoa_tipo_id']; // se existir no seu form
$atualizado_por = $_SESSION['usuario_id'];

$sql = "INSERT INTO cadastro_tbPessoas 
(nome, cpf, nascimento, telefone, pessoa_tipo_id, atualizado_por) 
VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssii", $nome, $cpf, $nascimento, $telefone, $pessoa_tipo_id, $atualizado_por);

if ($stmt->execute()) {
    echo "Pessoa cadastrada!";
} else {
    echo "Erro: " . $conn->error;
}
?>
