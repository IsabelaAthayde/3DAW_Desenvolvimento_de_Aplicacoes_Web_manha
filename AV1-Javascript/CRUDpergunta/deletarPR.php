<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET['id'])) {
        echo "ID não fornecido!";
        exit;
    }

    $id = trim($_GET['id']);
    $caminhoPerg = __DIR__ . "/../../pergRes.txt";

    if (!file_exists($caminhoPerg)) {
        echo "Arquivo de perguntas não encontrado!";
        exit;
    }

    $linhas = file($caminhoPerg, FILE_IGNORE_NEW_LINES);
    $cabecalho = array_shift($linhas);
    $novaLista = [];
    $encontrado = false;

    foreach ($linhas as $linha) {
        $campos = explode(";", trim($linha));
        if ($campos[0] == $id) {
            $encontrado = true;
            continue;
        }
        $novaLista[] = implode(";", $campos);
    }

    if (!$encontrado) {
        echo "Pergunta não encontrada!";
        exit;
    }

    $arq = fopen($caminhoPerg, "w") or die("Erro ao abrir arquivo");
    fwrite($arq, $cabecalho . PHP_EOL);
    foreach ($novaLista as $linha) {
        fwrite($arq, $linha . PHP_EOL);
    }
    fclose($arq);

    echo "Pergunta excluída com sucesso!";
}
?>
