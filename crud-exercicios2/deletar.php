<?php

$disciplinas = [];
if (file_exists("disciplinas.txt")) {
    $arqDisc = fopen("disciplinas.txt", "r") or die("erro ao abrir arquivo");
    while (($linha = fgets($arqDisc)) !== false) {
        $disciplinas[] = explode(";", trim($linha));
    }
    fclose($arqDisc);
}

$id = $_GET['id'];
if ($id == -1 || !isset($disciplinas[$id])) {
    die("Disciplina não encontrada");
}

unset($disciplinas[$id]);

$arqDisc = fopen("disciplinas.txt", "w") or die("erro ao abrir arquivo");
foreach ($disciplinas as $disciplina) {
    $linha = implode(";", $disciplina) . "\n";
    fwrite($arqDisc, $linha);
}
fclose($arqDisc);

header("Location: listar.php");
exit;