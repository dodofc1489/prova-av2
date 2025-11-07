<?php
include("conexao.php");
session_start();

$datahora = date('Y-m-d H:i:s');
$observacao = $_POST['observacao'];
$funcionario_id = $_POST['funcionario_id'];
$atualizado_por = $_SESSION['usuario_id'];

// Insere o feedback
$sql_feedback = "INSERT INTO tbFeedBack (datahora, observacao, funcionario_id, atualizado_por) 
VALUES (?, ?, ?, ?)";
$stmt1 = $conn->prepare($sql_feedback);
$stmt1->bind_param("ssii", $datahora, $observacao, $funcionario_id, $atualizado_por);
$stmt1->execute();
$feedback_id = $conn->insert_id;

// Insere a avaliação vinculada
$item_id = $_POST['item_id'];
$nota = $_POST['nota'];

$sql_avaliacao = "INSERT INTO tbAvaliacao (item_id, nota, feedback_id, atualizado_por) 
VALUES (?, ?, ?, ?)";
$stmt2 = $conn->prepare($sql_avaliacao);
$stmt2->bind_param("iiii", $item_id, $nota, $feedback_id, $atualizado_por);

if ($stmt2->execute()) {
    echo "Feedback e avaliação registrados com sucesso!";
} else {
    echo "Erro ao salvar avaliação: " . $conn->error;
}
?>
