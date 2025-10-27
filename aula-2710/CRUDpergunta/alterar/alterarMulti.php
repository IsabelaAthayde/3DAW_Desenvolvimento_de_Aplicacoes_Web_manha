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
    $a = $_GET["a"];
    $b = $_GET["b"];
    $c = $_GET["c"];
    $d = $_GET["d"];
    $e = $_GET["e"];
    $respostaCerta = $_GET["respostaCerta"];

    $comandoSQL = "UPDATE Perguntas 
                   SET pergunta = '" . $conn->real_escape_string($pergunta) . "',
                       rA = '" . $conn->real_escape_string($a) . "',
                       rB = '" . $conn->real_escape_string($b) . "',
                       rC = '" . $conn->real_escape_string($c) . "',
                       rD = '" . $conn->real_escape_string($d) . "',
                       rE = '" . $conn->real_escape_string($e) . "',
                       rCerta = '" . $conn->real_escape_string($respostaCerta) . "'
                   WHERE id = " . intval($id);

    $resultado = $conn->query($comandoSQL);

    if ($resultado === TRUE && $conn->affected_rows > 0) {
        echo json_encode("Pergunta alterada com sucesso!");
    } else {
        echo json_encode("ID não encontrado ou erro ao alterar: " . $conn->error);
    }
}

$conn->close();
?>
