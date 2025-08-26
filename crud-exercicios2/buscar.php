<?php

$disciplinas = [];
$busca = '';
$resultados = [];

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busca = trim($_POST['busca']);

    if (isset($busca) && $busca != '') {
        $i = 0;
        while (isset($disciplinas[$i])) {
            $disciplina = $disciplinas[$i];
            
            if (isset($disciplina[0]) && isset($disciplina[1])) {
                if (stripos($disciplina[0], $busca) !== false || stripos($disciplina[1], $busca) !== false) {
                    $resultados[] = $disciplina;
                }
            }
            $i++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Buscar Disciplina</title>
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

    <h2>Buscar Disciplinas</h2>
    <form action="buscar.php" method="POST">
        <input type="text" name="busca" placeholder="Nome ou Sigla da Disciplina">
        <input type="submit" value="Buscar">
    </form>

    <?php

    if (isset($busca) && $busca != '') {
        echo "<h3>Resultados da Busca para \"$busca\"</h3>";
        
  
        if (count($resultados) > 0) {
            echo "<table border='1'>";
            echo "<thead><tr><th>Nome</th><th>Sigla</th><th>Carga Horária</th></tr></thead>";
            echo "<tbody>";

            $i = 0;
            while(isset($resultados[$i])) {
                $disciplina = $resultados[$i];
                echo "<tr>";
                echo "<td>" . $disciplina[0] . "</td>";
                echo "<td>" . $disciplina[1] . "</td>";
                echo "<td>" . $disciplina[2] . "</td>";
                echo "</tr>";
                $i++;
            }
            echo "</tbody>";
            echo "</table>";
        } else {

            echo "<p>Nenhuma disciplina encontrada para \"$busca\"</p>";
        }
    }
    ?>
</body>

</html>