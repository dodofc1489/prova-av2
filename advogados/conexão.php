<?php
$host = "acaojuridicaav.mysql.dbaas.com.br";
$usuario = "acaojuridicaav"; 
$senha = "Dododfcd90gh@";     
$banco = "acaojuridicaav";    

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
