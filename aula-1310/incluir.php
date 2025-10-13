<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $tipo = $_POST["tipo"];

    if ($id == "" || $pergunta == "" || $tipo == "") {
        echo "Preencha todos os campos!";
        exit;
    }

    $arqPerg = fopen("perguntas.txt","a") or die("Erro ao abrir arquivo");

    $linha = $id . ";" . $pergunta . ";" . $tipo . "\n";
    fwrite($arqPerg, $linha);
    fclose($arqPerg);

    echo "Pergunta cadastrada com sucesso!";
}
?>
