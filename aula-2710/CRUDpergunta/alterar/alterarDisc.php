<?php
$servidor = "localhost";
$username = "root";
$senha = "";
$database = "faeterj3dawmanha";

$conn = new mysqli($servidor, $username, $senha, $database);
if ($conn->connect_error) {
    die("Conexão falhou, avise o administrador do sistema");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    $pergunta = $_GET["pergunta"];
    $resposta = $_GET["resposta"];

    $comandoSQL = "UPDATE Perguntas 
                   SET pergunta = '" . $conn->real_escape_string($pergunta) . "', 
                       rCerta = '" . $conn->real_escape_string($resposta) . "' 
                   WHERE id = " . intval($id);

    $resultado = $conn->query($comandoSQL);

    if ($resultado === TRUE && $conn->affected_rows > 0) {
        echo json_encode("Pergunta alterada com sucesso!");
    } else {
        echo json_encode("ID da pergunta não encontrado ou erro ao alterar: " . $conn->error);
    }
}

$conn->close();
?>
