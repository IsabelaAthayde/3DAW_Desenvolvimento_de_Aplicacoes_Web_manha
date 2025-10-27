<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["erro"=>"Método inválido"]);
    exit;
}

$id = intval($_POST['id'] ?? 0);
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!$id || !$nome || !$email) {
    echo json_encode(["erro"=>"Campos obrigatórios ausentes"]);
    exit;
}

$conn = new mysqli("localhost", "root", "", "faeterj3dawmanha");
if ($conn->connect_error) die(json_encode(["erro"=>"Conexão falhou"]));

if ($senha) {
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE Usuarios SET nome=?, email=?, senha=? WHERE id=?");
    $stmt->bind_param("sssi", $nome, $email, $senhaHash, $id);
} else {
    $stmt = $conn->prepare("UPDATE Usuarios SET nome=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $nome, $email, $id);
}

if ($stmt->execute()) {
    echo json_encode(["sucesso"=>"Usuário atualizado com sucesso"]);
} else {
    echo json_encode(["erro"=>"Falha ao atualizar usuário"]);
}

$stmt->close();
$conn->close();
?>
