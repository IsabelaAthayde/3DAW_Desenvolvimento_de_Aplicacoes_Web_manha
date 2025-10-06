<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    echo "Usuário não logado!";
    exit;
}
?>

<div class="sub-nav">
    <a href="/AV1-3DAW/CRUDusuario/listar.php">Listar Usuários</a>
    <a href="/AV1-3DAW/CRUDusuario/buscar.php">Buscar Usuários</a>
    <a href="/AV1-3DAW/CRUDusuario/alterar.php?id=<?php echo $_SESSION['usuario']; ?>">Alterar meu Perfil</a>
</div>
