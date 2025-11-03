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

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = intval($_GET['id'] ?? 0);
    if (!$id) {
        echo json_encode(["erro" => "ID não fornecido"]);
        exit;
    }

    $stmt = $conn->prepare("SELECT id, nome, email, matricula FROM Alunos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo json_encode($resultado->fetch_assoc(), JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["erro" => "Aluno não encontrado"]);
    }

    $stmt->close();
    $conn->close();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id'] ?? 0);
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $matricula = $_POST['matricula'] ?? '';

    if (!$id || !$nome || !$email || !$matricula) {
        echo json_encode(["erro" => "Todos os campos são obrigatórios"]);
        exit;
    }

    $stmt = $conn->prepare("UPDATE Alunos SET nome = ?, email = ?, matricula = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nome, $email, $matricula, $id);

    if ($stmt->execute()) {
        echo json_encode(["sucesso" => "Aluno atualizado com sucesso"]);
    } else {
        echo json_encode(["erro" => "Erro ao atualizar aluno"]);
    }

    $stmt->close();
    $conn->close();
    exit;
}

echo json_encode(["erro" => "Método inválido"]);
?>
