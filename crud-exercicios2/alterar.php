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

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        die("Disciplina não encontrada");
    }

    if (isset($disciplinas[$id])) {
        $disciplina = $disciplinas[$id];
    } else {
        die("Disciplina não encontrada");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $sigla = $_POST['sigla'];
        $carga = $_POST['carga'];

        $disciplinas[$id] = [$nome, $sigla, $carga];

        $arqDisc = fopen("disciplinas.txt", "w") or die("erro");
        
        $i = 0;
        while (isset($disciplinas[$i])) {
            $disciplina_salvar = $disciplinas[$i];
            
            $linha = $disciplina_salvar[0] . ";" . $disciplina_salvar[1] . ";" . $disciplina_salvar[2] . "\n";
            
            fwrite($arqDisc, $linha);
            $i++;
        }
        
        fclose($arqDisc);

        header("Location: listar.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Alterar Disciplina</title>
    <style>
        .alinhado label {
            display: inline-block;
            width: 120px;
            margin-right: 10px;
            margin-top: 0;
            margin-bottom: 0;
        }
        p {
            margin-top: 0;
            margin-bottom: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: fit-content;
            gap: 20px;
        }
        form input[type="submit"] {
            width: 200px;
            margin-left: 120px;

        }
    </style>
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

    <h2>Alterar Disciplina</h2>

    <form action="alterar.php?id=<?php echo $id; ?>" method="POST">
        <p class="alinhado">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo "$disciplina[0]"; ?>">
        </p>

        <p class="alinhado">
            <label for="sigla">Sigla:</label>
            <input type="text" name="sigla" id="sigla" value="<?php echo "$disciplina[1]"; ?>">
        </p>

        <p class="alinhado">
            <label for="carga">Carga Horária:</label>
            <input type="text" name="carga" id="carga" value="<?php echo "$disciplina[2]"; ?>">
        </p>

        <input type="submit" value="Salvar Alterações">
    </form>
    
</body>

</html>