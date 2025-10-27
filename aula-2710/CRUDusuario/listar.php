<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "faeterj3dawmanha");
if ($conn->connect_error) die(json_encode(["erro"=>"Conexão falhou"]));

$resultado = $conn->query("SELECT id, nome, email FROM Usuarios");

$usuarios = [];
while ($row = $resultado->fetch_assoc()) {
    $usuarios[] = $row;
}

echo json_encode($usuarios, JSON_UNESCAPED_UNICODE);

$conn->close();
?>
