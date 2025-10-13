<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $id = $_GET["id"];
    $pergunta = $_GET["pergunta"];
    $a = $_GET["a"];
    $b = $_GET["b"];
    $c = $_GET["c"];
    $d = $_GET["d"];
    $e = $_GET["e"];
    $respostaCerta = $_GET["respostaCerta"];

    $caminhoPerg = "./pergRes.txt";

    if (!file_exists($caminhoPerg)) {
        echo "Arquivo de perguntas não encontrado!";
        exit;
    }

    $linhas = file($caminhoPerg, FILE_IGNORE_NEW_LINES);
    $cabecalho = $linhas[0];
    $novaLista = [];
    $alterou = false;

    foreach ($linhas as $linha) {
        $campos = explode(";", trim($linha));

        if ($campos[0] == $id) {
            $campos[1] = $pergunta;
            $campos[2] = $a;
            $campos[3] = $b;
            $campos[4] = $c;
            $campos[5] = $d;
            $campos[6] = $e;
            $campos[7] = $respostaCerta;
            $alterou = true;
        }

        while (count($campos) < 8) $campos[] = "";
        $novaLista[] = implode(";", $campos);
    }

    if ($alterou) {
        $arq = fopen($caminhoPerg, "w") or die("erro ao abrir arquivo");
        fwrite($arq, $cabecalho);
        foreach ($novaLista as $linha) {
            fwrite($arq, $linha);
        }
        fclose($arq);
        echo "Pergunta alterada com sucesso!";
    } else {
        echo "ID não encontrado!";
    }
}
?>
