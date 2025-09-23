<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../includes/toast.php';
include_once __DIR__ . '/../includes/modalConfirm.php';

// Renderiza o modal
renderModalConfirm();

if (isset($_SESSION['sucesso'])) {
    showToast($_SESSION['sucesso'], 'success');
    unset($_SESSION['sucesso']);
}

if (isset($_SESSION['erro'])) {
    showToast($_SESSION['erro'], 'error');
    unset($_SESSION['erro']);
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Lista de Doadores</h2>
        <a href="/sysmeal/doador/novo" class="btn btn-primary">Cadastrar Novo Doador</a>
    </div>

    <?php if (!empty($doadores)): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doadores as $doador): ?>
                    <tr>
                        <td><?= htmlspecialchars($doador->getId()) ?></td>
                        <td><?= htmlspecialchars($doador->getNome()) ?></td>
                        <td><?= htmlspecialchars($doador->getEmail()) ?></td>
                        <td>
                            <a href="/sysmeal/doador/ver/<?= $doador->getId() ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="/sysmeal/doador/editar/<?= $doador->getId() ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="/sysmeal/doador/excluir/<?= $doador->getId() ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirmarAcao(this.href, 'Excluir Doador', 'Tem certeza que deseja excluir este doador?', 'danger')">
                                Excluir
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if (empty($doadores)): ?>
        <div class="alert alert-info">Nenhum doador cadastrado até o momento.</div>
    <?php endif; ?>
</div>