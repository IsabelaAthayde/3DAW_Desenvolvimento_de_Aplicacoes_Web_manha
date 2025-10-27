<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET['id'])) {
        echo json_encode(["erro" => "ID não fornecido"]);
        exit;
    }

    $id = intval($_GET['id']); 

    $servidor = "localhost";
    $username = "root";
    $senha = "";
    $database = "faeterj3dawmanha";

    $conn = new mysqli($servidor, $username, $senha, $database);
    if ($conn->connect_error) {
        echo json_encode(["erro" => "Conexão falhou"]);
        exit;
    }

    $sqlCheck = "SELECT id FROM Perguntas WHERE id = ?";
    $stmt = $conn->prepare($sqlCheck);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        echo json_encode(["erro" => "Pergunta não encontrada"]);
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    $sqlDel = "DELETE FROM Perguntas WHERE id = ?";
    $stmt = $conn->prepare($sqlDel);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["sucesso" => "Pergunta excluída com sucesso"]);
    } else {
        echo json_encode(["erro" => "Falha ao excluir a pergunta"]);
    }

    $stmt->close();
    $conn->close();
}
?>
