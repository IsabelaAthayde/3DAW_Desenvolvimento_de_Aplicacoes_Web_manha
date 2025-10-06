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

if (empty($perguntas)) {
    echo "<p>Nenhuma pergunta cadastrada ainda.</p>";
    exit;
}
?>

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
    <?php foreach ($perguntas as $p): ?>
        <tr class="<?= $p[8] === 'Discursiva' ? 'discursiva' : ''; ?>">
            <td><?= htmlspecialchars($p[0] ?? ''); ?></td>
            <td><?= htmlspecialchars($p[1] ?? ''); ?></td>
            <td><?= htmlspecialchars($p[2] ?? ''); ?></td>
            <td><?= htmlspecialchars($p[3] ?? ''); ?></td>
            <td><?= htmlspecialchars($p[4] ?? ''); ?></td>
            <td><?= htmlspecialchars($p[5] ?? ''); ?></td>
            <td><?= htmlspecialchars($p[6] ?? ''); ?></td>
            <td><?= htmlspecialchars($p[7] ?? ''); ?></td>
            <td><?= htmlspecialchars($p[8] ?? ''); ?></td>
            <td>
                <?php if ($p[8] === 'Múltipla Escolha'): ?>
                    <a style="color: green;" href="/AV1-Javascript/CRUDpergunta/alterar/alterarMulti.php?id=<?= urlencode($p[0]); ?>">Editar</a>
                <?php else: ?>
                    <a style="color: green;" href="/AV1-Javascript/CRUDpergunta/alterar/alterarDisc.php?id=<?= urlencode($p[0]); ?>">Editar</a>
                <?php endif; ?>
                <a style="color: red;" href="/AV1-Javascript/CRUDpergunta/deletarPR.php?id=<?= urlencode($p[0]); ?>">Deletar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
