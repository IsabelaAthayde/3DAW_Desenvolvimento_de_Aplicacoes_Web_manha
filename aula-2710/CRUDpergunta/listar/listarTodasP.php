<?php
header("Content-Type: application/json");
session_start();

$servidor = "localhost";
$username = "root";
$senha = "";
$database = "faeterj3dawmanha";

$conn = new mysqli($servidor, $username, $senha, $database);

if ($conn->connect_error) {
    die(json_encode(["erro" => "Conexão falhou, avise o administrador do sistema"]));
}

$perguntas = [];
$sql = "SELECT id, pergunta, A, B, C, D, E, resposta_certa, tipo FROM Perguntas";
$resultado = $conn->query($sql);

if ($resultado) {
    while ($row = $resultado->fetch_assoc()) {
        if (empty($row['A']) && empty($row['B']) && empty($row['C']) && empty($row['D']) && empty($row['E'])) {
            $row['tipo_legivel'] = 'Discursiva';
        } else {
            $row['tipo_legivel'] = 'Múltipla Escolha';
        }
        $perguntas[] = $row;
    }
    echo json_encode($perguntas, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["erro" => "Não foi possível listar as perguntas"]);
}

$conn->close();
?>
