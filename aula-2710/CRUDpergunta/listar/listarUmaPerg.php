<?php
header("Content-Type: application/json");
session_start();

$servidor = "localhost";
$username = "root";
$senha = "";
$database = "faeterj3dawmanha";
$conn = new mysqli($servidor, $username, $senha, $database);
if ($conn->connect_error) die(json_encode(["erro"=>"Conexão falhou"]));

$perguntas = [];
$sql = "SELECT id, pergunta, A, B, C, D, E, resposta_certa, tipo FROM Perguntas";
$resultado = $conn->query($sql);
if ($resultado) {
    while ($row = $resultado->fetch_assoc()) {
        $perguntas[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['perg'])) {
    $indice = intval($_POST['perg']);
    echo json_encode($perguntas[$indice] ?? []);
} else {
    echo json_encode($perguntas, JSON_UNESCAPED_UNICODE);
}

$conn->close();
?>
