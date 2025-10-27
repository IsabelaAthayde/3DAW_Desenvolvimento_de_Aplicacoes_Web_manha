<?php
header("Content-Type: application/json");

$servidor = "localhost";
$username = "root";
$senha = "";
$database = "faeterj3dawmanha";

$conn = new mysqli($servidor, $username, $senha, $database);

if ($conn->connect_error) {
    die(json_encode(["erro" => "Conexão falhou, avise o administrador do sistema"]));
}

$perguntas = [];
$sql = "SELECT id, pergunta, tipo, assunto FROM Perguntas";
$resultado = $conn->query($sql);

if ($resultado) {
    while ($row = $resultado->fetch_assoc()) {
        $perguntas[] = $row;
    }
    echo json_encode($perguntas, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["erro" => "Não foi possível listar as perguntas"]);
}

$conn->close();
?>
