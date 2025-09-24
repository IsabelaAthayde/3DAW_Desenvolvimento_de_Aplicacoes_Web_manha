<?php
    $usuarios = [];
    $caminhoUsuarios = "../usuarios.txt";

    if (file_exists($caminhoUsuarios)) {
        $arq = fopen($caminhoUsuarios, "r") or die("erro ao abrir arquivo");
        while (($linha = fgets($arq)) !== false) {
            $usuarios[] = explode(";", trim($linha));
        }
        fclose($arq);
    }

    $id = $_GET['id'];
    if ($id <= 0 || !isset($usuarios[$id])) {
        die("usuario não encontrado");
    }

    unset($usuarios[$id]);

    $arq = fopen($caminhoUsuarios, "w") or die("erro ao abrir arquivo");
    foreach ($usuarios as $usuario) {
        $linha = implode(";", $usuario) . "\n";
        fwrite($arq, $linha);
    }
    fclose($arq);

    header("Location: listar.php");
    exit;

?>