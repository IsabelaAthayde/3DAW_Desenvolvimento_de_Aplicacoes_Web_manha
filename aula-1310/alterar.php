<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $tipo = $_POST["tipo"];
    $msg = "";

    $arqPerg = fopen("perguntas.txt","r") or die("Erro ao abrir arquivo");
    $arqNovo = fopen("perguntasNovo.txt","w") or die("Erro ao abrir arquivo");

    while(!feof($arqPerg)) {
        $linha = trim(fgets($arqPerg));
        if ($linha != "") {
            $colunaDados = explode(";", $linha);
            if ($colunaDados[0] == $id) {
                $linha = $id . ";" . $pergunta . ";" . $tipo . "\n";
            } else {
                $linha = $colunaDados[0] . ";" . $colunaDados[1] . ";" . $colunaDados[2] . "\n";
            }
            fwrite($arqNovo, $linha);
        }
    }

    fclose($arqPerg);
    fclose($arqNovo);

    rename("perguntasNovo.txt", "perguntas.txt");
    $msg = "Pergunta alterada com sucesso!";
    echo $msg;
}
?>
