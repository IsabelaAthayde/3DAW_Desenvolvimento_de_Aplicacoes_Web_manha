<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["erro" => "Método inválido"]);
    exit;
}

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!$nome || !$email || !$senha) {
    echo json_encode(["erro" => "Todos os campos são obrigatórios"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "faeterj3dawmanha");
if ($conn->connect_error) die(json_encode(["erro"=>"Conexão falhou"]));

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO Usuarios (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senhaHash);

if ($stmt->execute()) {
    echo json_encode(["sucesso"=>"Usuário cadastrado com sucesso", "id"=>$stmt->insert_id]);
} else {
    echo json_encode(["erro"=>"Falha ao cadastrar usuário"]);
}

$stmt->close();
$conn->close();
?>
