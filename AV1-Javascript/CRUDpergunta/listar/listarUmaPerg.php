<?php
$caminhoPerg = __DIR__ . "/../../pergRes.txt";
$perguntas = [];

if (file_exists($caminhoPerg)) {
    $arq = fopen($caminhoPerg, "r") or die("Erro");
    while (!feof($arq)) {
        $linha = fgets($arq);
        if ($linha && trim($linha) != "" && strpos($linha, "pergunta") === false) {
            $perguntas[] = explode(";", trim($linha));
        }
    }
    fclose($arq);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['perg'])) {
    $indice = intval($_POST['perg']);
    echo json_encode($perguntas[$indice] ?? []);
} else {
    echo json_encode($perguntas);
}
?>
