<?php
header("Content-Type: application/json");

$caminhoPerg = __DIR__ . "/../../pergRes.txt";
$perguntas = [];

if (file_exists($caminhoPerg)) {
    $arq = fopen($caminhoPerg, "r") or die(json_encode(["erro" => "Arquivo não encontrado"]));
    fgets($arq); 
    while (!feof($arq)) {
        $linha = fgets($arq);
        if ($linha && trim($linha) !== "") {
            $perguntas[] = explode(";", trim($linha));
        }
    }
    fclose($arq);
}

echo json_encode($perguntas, JSON_UNESCAPED_UNICODE);
