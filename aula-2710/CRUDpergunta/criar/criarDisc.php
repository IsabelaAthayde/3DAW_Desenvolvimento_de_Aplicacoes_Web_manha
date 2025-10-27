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
    $resp = $_GET['resp'];

    $comandoSQL = "INSERT INTO Perguntas (pergunta, rA, rB, rC, rD, rE, rCerta) 
                   VALUES (
                       '" . $conn->real_escape_string($pergunta) . "',
                       '', '', '', '', '',
                       '" . $conn->real_escape_string($resp) . "'
                   )";

    $resultado = $conn->query($comandoSQL);

    if ($resultado === TRUE) {
        $msg = "Pergunta discursiva cadastrada com sucesso!";
    } else {
        $msg = "Erro ao cadastrar pergunta discursiva: " . $conn->error;
    }

    echo json_encode($msg);
}

$conn->close();
?>
