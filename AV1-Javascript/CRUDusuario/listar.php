<?php
$usuarios = [];
$caminhoUsuarios = "../usuarios.txt";

if (file_exists($caminhoUsuarios)) {
    $arq = fopen($caminhoUsuarios, "r") or die("Erro ao abrir arquivo");
    while (($linha = fgets($arq)) !== false) {
        if (trim($linha) !== '') {
            $usuarios[] = explode(";", trim($linha));
        }
    }
    fclose($arq);
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if (isset($usuarios[$id])) {
        unset($usuarios[$id]);
        $arq = fopen($caminhoUsuarios, "w") or die("Erro ao abrir arquivo");
        foreach ($usuarios as $u) {
            fwrite($arq, implode(";", $u) . "\n");
        }
        fclose($arq);
        echo "Usuário deletado com sucesso!";
        exit;
    }
}

$usuariosJson = array_slice($usuarios, 1);
header('Content-Type: application/json');
echo json_encode($usuariosJson);
?>
