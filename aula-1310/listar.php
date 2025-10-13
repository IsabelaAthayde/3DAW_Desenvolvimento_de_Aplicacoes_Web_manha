<?php
$arqPerg = fopen("perguntas.txt","r") or die("Erro ao abrir arquivo");

echo "<a href='./alterar.html'>Alterar Pergunta</a><br><a href='./incluir.html'>incluir Pergunta</a>";


echo "<h2>Lista de Perguntas</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Pergunta</th><th>Tipo</th><th>Ações</th></tr>";
$linha = fgets($arqPerg);
while(!feof($arqPerg)) {
    $linha = trim(fgets($arqPerg));
    if ($linha != "") {
        $coluna = explode(";", $linha);
        if (isset($coluna[0], $coluna[1], $coluna[2])) {
            echo "<tr>
                    <td>{$coluna[0]}</td>
                    <td>{$coluna[1]}</td>
                    <td>{$coluna[2]}</td>
                    <td><a href='alterar.html?id={$coluna[0]}'>Editar</a></td>
                </tr>";
        }
    }
}
echo "</table>";

fclose($arqPerg);
?>
