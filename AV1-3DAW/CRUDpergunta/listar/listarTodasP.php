<?php
session_start();

$caminhoPerg = __DIR__ . "/../../pergRes.txt";

$perguntas = [];

if (file_exists($caminhoPerg)) {
    $arq = fopen($caminhoPerg, "r") or die("Erro ao abrir arquivo");
    fgets($arq); 
    while (!feof($arq)) {
        $linha = fgets($arq);
        if ($linha !== false && trim($linha) != "") {
            $campos = explode(";", trim($linha));
            $isDiscursiva = empty($campos[2]) && empty($campos[3]) && empty($campos[4]) && empty($campos[5]);
            $campos[] = $isDiscursiva ? 'Discursiva' : 'Múltipla Escolha';
            $perguntas[] = $campos;
        }
    }
    fclose($arq);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Todas as Perguntas</title>
    <link rel="stylesheet" href="/AV1-3DAW/style.css">
    <style>
        tr:nth-child(even) {
            background-color: var(--mP-bg);
        }
        tr.discursiva {
            background-color: var(--dP-bg);
        }
    </style>
</head>
<body>
    <?php include '../../navs/nav.php'; ?>
    <?php include '../../navs/nav_perguntas.php'; ?>

    <h2>Lista de Todas as Perguntas</h2>
    <?php if (empty($perguntas)): ?>
        <p>Nenhuma pergunta cadastrada ainda.</p>
    <?php else: ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Pergunta</th>
            <th>A</th>
            <th>B</th>
            <th>C</th>
            <th>D</th>
            <th>E</th>
            <th>Resposta Certa</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($perguntas as $i => $p): ?>
            <tr class="<?php echo $p[8] === 'Discursiva' ? 'discursiva' : ''; ?>">
                <td><?php echo $p[0] ?? ''; ?></td>
                <td><?php echo $p[1] ?? ''; ?></td>
                <td><?php echo $p[2] ?? ''; ?></td>
                <td><?php echo $p[3] ?? ''; ?></td>
                <td><?php echo $p[4] ?? ''; ?></td>
                <td><?php echo $p[5] ?? ''; ?></td>
                <td><?php echo $p[6] ?? ''; ?></td>
                <td><?php echo $p[7] ?? ''; ?></td>
                <td><?php echo $p[8] ?? ''; ?></td>
                <td>
                    <?php if ($p[8] === 'Múltipla Escolha'): ?>
                        <a style="color: green;" href="/AV1-3DAW/CRUDpergunta/alterar/alterarMulti.php?id=<?php echo $p[0]; ?>">Editar</a> 
                    <?php else: ?>
                        <a style="color: green;" href="/AV1-3DAW/CRUDpergunta/alterar/alterarDisc.php?id=<?php echo $p[0]; ?>">Editar</a> 
                    <?php endif; ?>
                    <a style="color: red;" href="/AV1-3DAW/CRUDpergunta/deletarPR.php?id=<?php echo $p[0]; ?>">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

</body>
</html>
