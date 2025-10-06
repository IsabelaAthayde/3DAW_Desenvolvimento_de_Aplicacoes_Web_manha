<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo json_encode(['erro'=>'Sessão expirada']);
    exit;
}

$usuarios = [];
$caminhoUsuarios = "../usuarios.txt";

if (file_exists($caminhoUsuarios)) {
    $arq = fopen($caminhoUsuarios, "r") or die("Erro ao abrir arquivo");
    while (($linha = fgets($arq)) !== false) {
        if (trim($linha) !== '') $usuarios[] = explode(";", trim($linha));
    }
    fclose($arq);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : $_SESSION['usuario'];
    if (!isset($usuarios[$id])) exit(json_encode(['nome'=>'','email'=>'','senha'=>'']));
    exit(json_encode([
        'nome' => $usuarios[$id][1],
        'email' => $usuarios[$id][2],
        'senha' => $usuarios[$id][3]
    ]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : $_SESSION['usuario'];
    if (!isset($usuarios[$id])) { echo "Usuário não encontrado!"; exit; }

    $usuarios[$id] = [$_POST['id'] ?? '',
        $_POST['nome'] ?? '',
        $_POST['email'] ?? '',
        $_POST['senha'] ?? ''
    ];

    $arq = fopen($caminhoUsuarios, "w") or die("Erro ao abrir arquivo");
    foreach ($usuarios as $u) {
        fwrite($arq, implode(";", $u) . "\n");
    }
    fclose($arq);
    echo "Usuário atualizado com sucesso!";
}
?>
