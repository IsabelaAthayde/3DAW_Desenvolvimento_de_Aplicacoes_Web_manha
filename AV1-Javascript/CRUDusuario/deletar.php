<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $usuarios = [];
    $caminhoUsuarios = "../usuarios.txt";

    if (file_exists($caminhoUsuarios)) {
        $arq = fopen($caminhoUsuarios, "r") or die("Erro ao abrir arquivo");
        while (($linha = fgets($arq)) !== false) {
            $usuarios[] = explode(";", trim($linha));
        }
        fclose($arq);
    }

    $id = $_GET['id'] ?? null;
    if ($id === null || $id <= 0 || !isset($usuarios[$id])) {
        die("Usuário não encontrado");
    }

    unset($usuarios[$id]);

    $arq = fopen($caminhoUsuarios, "w") or die("Erro ao abrir arquivo");
    foreach ($usuarios as $usuario) {
        fwrite($arq, implode(";", $usuario) . "\n");
    }
    fclose($arq);

    echo "Usuário excluído com sucesso!";
}
?>
