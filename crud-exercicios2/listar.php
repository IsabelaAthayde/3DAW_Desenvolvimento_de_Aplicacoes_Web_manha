<?php

$disciplinas = [];

if (file_exists("disciplinas.txt")) {
    $arqDisc = fopen("disciplinas.txt", "r") or die("erro");
    
    while (!feof($arqDisc)) {
        $linha = fgets($arqDisc);
        if ($linha !== false) {
            $disciplinas[] = explode(";", trim($linha));
        }
    }
    
    fclose($arqDisc);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Lista de Disciplinas</title>
</head>

<body>

    <header>
        <nav>
             <ul class="menu-lateral">
                <li><a href="index.php">Criar</a></li>
                <li><a href="listar.php">Listar</a></li>
                <li><a href="buscar.php">Buscar</a></li>
            </ul>
        </nav>
    </header>

    <h2>Lista Disciplinas</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sigla</th>
                <th>Carga Horária</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            if (count($disciplinas) > 0) {
                $i = 0;
                while (isset($disciplinas[$i])) {
                    $disciplina = $disciplinas[$i];
                    echo "<tr>";
                    echo "<td>" . $disciplina[0] . "</td>";
                    echo "<td>" . $disciplina[1] . "</td>";
                    echo "<td>" . $disciplina[2] . "</td>";
                    echo "<td>";
                    echo "<a href='alterar.php?id=$i'>Editar</a> | ";
                    echo "<a href='deletar.php?id=$i' onclick=\"return confirm('Tem certeza que deseja deletar?')\">Deletar</a>";
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                }
            } else {
                echo "<tr><td colspan='4'>Nenhuma disciplina cadastrada</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>