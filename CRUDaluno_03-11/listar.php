<?php
header("Content-Type: application/json; charset=UTF-8");

$servidor = "localhost";
$database = "faeterj3dawmanha";
$usuario = "root";
$senha = "";

$conn = new mysqli($servidor, $usuario, $senha, $database);

if ($conn->connect_error) {
    echo json_encode(["erro" => "Falha na conexão com o banco de dados"]);
    exit;
}

$sql = "SELECT id, nome, email, matricula FROM alunos";
$resultado = $conn->query($sql);

$alunos = [];

if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $alunos[] = $row;
    }
}

echo json_encode($alunos, JSON_UNESCAPED_UNICODE);

$conn->close();
?>
