<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $id = $_GET["id"];
    $pergunta = $_GET["pergunta"];
    $resposta = $_GET["resposta"];

    $caminhoPerg = __DIR__ . "/../../pergRes.txt";

    if (!file_exists($caminhoPerg)) {
        echo "Arquivo de perguntas não encontrado!";
        exit;
    }

    $linhas = file($caminhoPerg, FILE_IGNORE_NEW_LINES);
    $header = array_shift($linhas); // remove o cabeçalho

    $novaLista = [];
    $alterou = false;

    foreach ($linhas as $linha) {
        $campos = explode(";", trim($linha));

        if ($campos[0] == $id) {
            $campos[1] = $pergunta;
            $campos[7] = $resposta;
            $alterou = true;
        }

        while (count($campos) < 8) $campos[] = "";
        $novaLista[] = implode(";", $campos);
    }

    if ($alterou) {
        $arq = fopen($caminhoPerg, "w") or die("erro ao abrir arquivo");
        fwrite($arq, $header . PHP_EOL);
        foreach ($novaLista as $linha) {
            fwrite($arq, $linha . PHP_EOL);
        }
        fclose($arq);
        echo "Pergunta alterada com sucesso!";
    } else {
        echo "ID da pergunta não encontrado!";
    }
}
?>
