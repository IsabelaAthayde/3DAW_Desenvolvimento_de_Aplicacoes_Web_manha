<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caminhoUsuarios = "./usuarios.txt"; 
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

    if ($email === '' || $senha === '') {
        echo "Preencha email e senha!";
        exit;
    }

    if (!file_exists($caminhoUsuarios)) {
        echo "Arquivo de usuários não encontrado.";
        exit;
    }

    $linhas = file($caminhoUsuarios, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $logado = false;

    foreach ($linhas as $linha) {
        $linha = trim($linha);
        if ($linha === '') continue;

        $dados = explode(";", $linha);

        if (isset($dados[0]) && strtolower(trim($dados[0])) === 'id') continue;

        if (count($dados) < 4) continue;

        $uid    = trim($dados[0]); 
        $nome   = trim($dados[1]);
        $uemail = trim($dados[2]); 
        $upass  = trim($dados[3]);

        if ($uemail === $email && $upass === $senha) {
            $_SESSION['usuario'] = $uid;
            $_SESSION['usuario_nome'] = $nome;
            $logado = true;
            break;
        }
    }

    echo $logado ? "OK" : "Email ou senha inválidos!";
}
?>
