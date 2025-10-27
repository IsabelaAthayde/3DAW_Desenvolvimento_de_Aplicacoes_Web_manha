<?php
header("Content-Type: application/json");

if (!isset($_GET['id'])) {
    echo json_encode(["erro"=>"ID não fornecido"]);
    exit;
}

$id = intval($_GET['id']);

$conn = new mysqli("localhost", "root", "", "faeterj3dawmanha");
if ($conn->connect_error) die(json_encode(["erro"=>"Conexão falhou"]));

$stmt = $conn->prepare("SELECT id, nome, email FROM Usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    echo json_encode($user, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["erro"=>"Usuário não encontrado"]);
}

$stmt->close();
$conn->close();
?>
