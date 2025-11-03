<?php
header("Content-Type: application/json; charset=UTF-8");

$servidor = "localhost";
$database = "faeterj3dawmanha";
$usuario = "root";
$senha = "";

$conn = new mysqli($servidor, $usuario, $senha, $database);
if ($conn->connect_error) {
    echo json_encode(["erro" => "Conexão falhou"]);
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo json_encode(["erro" => "ID inválido ou não fornecido"]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM Alunos WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(["sucesso" => "Aluno deletado com sucesso"]);
    } else {
        echo json_encode(["erro" => "Aluno não encontrado"]);
    }
} else {
    echo json_encode(["erro" => "Erro ao deletar aluno"]);
}

$stmt->close();
$conn->close();
?>
