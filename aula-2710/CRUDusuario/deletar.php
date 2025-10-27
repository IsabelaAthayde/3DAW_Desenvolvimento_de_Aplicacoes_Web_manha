<?php
header("Content-Type: application/json");

if (!isset($_GET['id'])) {
    echo json_encode(["erro"=>"ID não fornecido"]);
    exit;
}

$id = intval($_GET['id']);

$conn = new mysqli("localhost", "root", "", "faeterj3dawmanha");
if ($conn->connect_error) die(json_encode(["erro"=>"Conexão falhou"]));

$stmt = $conn->prepare("DELETE FROM Usuarios WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["sucesso"=>"Usuário deletado com sucesso"]);
} else {
    echo json_encode(["erro"=>"Falha ao deletar usuário"]);
}

$stmt->close();
$conn->close();
?>
