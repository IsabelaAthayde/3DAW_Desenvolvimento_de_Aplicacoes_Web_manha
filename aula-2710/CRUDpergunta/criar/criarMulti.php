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
    $pergunta = $_GET['pergunta'];
    $rA = $_GET['rA'];
    $rB = $_GET['rB'];
    $rC = $_GET['rC'];
    $rD = $_GET['rD'];
    $rE = $_GET['rE'];
    $rCerta = $_GET['rCerta'];

    $comandoSQL = "INSERT INTO Perguntas 
        (pergunta, rA, rB, rC, rD, rE, rCerta) 
        VALUES (
            '" . $conn->real_escape_string($pergunta) . "',
            '" . $conn->real_escape_string($rA) . "',
            '" . $conn->real_escape_string($rB) . "',
            '" . $conn->real_escape_string($rC) . "',
            '" . $conn->real_escape_string($rD) . "',
            '" . $conn->real_escape_string($rE) . "',
            '" . $conn->real_escape_string($rCerta) . "'
        )";

    $resultado = $conn->query($comandoSQL);

    if ($resultado === TRUE) {
        $msg = "Pergunta cadastrada com sucesso!";
    } else {
        $msg = "Erro ao cadastrar pergunta: " . $conn->error;
    }

    echo json_encode($msg);
}

$conn->close();
?>
