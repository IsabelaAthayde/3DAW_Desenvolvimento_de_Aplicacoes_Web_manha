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

$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

if ($busca === '') {
    echo json_encode(["erro" => "Nenhum termo de busca informado"]);
    exit;
}

$stmt = $conn->prepare("SELECT id, nome, email FROM Alunos WHERE nome LIKE ? OR email LIKE ?");
$like = "%$busca%";
$stmt->bind_param("ss", $like, $like);
$stmt->execute();
$result = $stmt->get_result();

$alunos = [];
while ($row = $result->fetch_assoc()) {
    $alunos[] = $row;
}

echo json_encode($alunos, JSON_UNESCAPED_UNICODE);

$stmt->close();
$conn->close();
?>
