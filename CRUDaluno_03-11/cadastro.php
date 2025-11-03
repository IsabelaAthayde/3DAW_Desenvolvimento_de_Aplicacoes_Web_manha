<?php
header("Content-Type: application/json; charset=UTF-8");

$servidor = "localhost";
$usuario = "root";
$senha = "";
$database = "faeterj3dawmanha";

$conn = new mysqli($servidor, $usuario, $senha, $database);

if ($conn->connect_error) {
    echo json_encode(["erro" => "Erro ao conectar ao banco de dados"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $nome = $_GET['nome'] ?? '';
    $email = $_GET['email'] ?? '';
    $matricula = $_GET['matricula'] ?? '';

    if (!$nome || !$email || !$matricula) {
        echo json_encode(["erro" => "Todos os campos são obrigatórios"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO alunos (nome, email, matricula) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $matricula);

    if ($stmt->execute()) {
        echo json_encode(["sucesso" => "Aluno cadastrado com sucesso!", "id" => $stmt->insert_id]);
    } else {
        echo json_encode(["erro" => "Falha ao cadastrar aluno."]);
    }

    $stmt->close();
    $conn->close();
}
?>
