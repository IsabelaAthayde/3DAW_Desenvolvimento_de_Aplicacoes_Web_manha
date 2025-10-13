<?php

$caminhoPerg = "./pergRes.txt";
$perguntas = [];
$i = 0;

header('Content-Type: application/json');

if (file_exists($caminhoPerg)) {
    $arq = fopen($caminhoPerg, "r") or die("Erro ao abrir arquivo");
    fgets($arq); 
    while (!feof($arq)) {
        $linha = fgets($arq);
        if ($linha !== false && trim($linha) != "") {
            $campos = explode(";", trim($linha));

            $perguntas[i] = [
                "id" => $campos[0],
                "perg" => $campos[1],
                "a" => $campos[2],
                "b" => $campos[3],
                "c" => $campos[4],
                "d" => $campos[5],
                "e" => $campos[6],
                "rc" => $campos[7];
            ];

            $i++;
        }
    }
    $jsonString = json_encode($perguntas);
    echo $jsonString;
    fclose($arq);
}


?>

