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
        <h2 class="mb-0">Lista de Instituições</h2>
        <a href="/sysmeal/instituicao/novo" class="btn btn-primary">Cadastrar Nova Instituição</a>
    </div>

    <?php if (!empty($instituicoes)): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($instituicoes as $instituicao): ?>
                    <tr>
                        <td><?= htmlspecialchars($instituicao->getId()) ?></td>
                        <td><?= htmlspecialchars($instituicao->getNome()) ?></td>
                        <td><?= htmlspecialchars($instituicao->getEndereco()) ?></td>
                        <td>
                            <a href="/sysmeal/instituicao/ver/<?= $instituicao->getId() ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="/sysmeal/instituicao/editar/<?= $instituicao->getId() ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="/sysmeal/instituicao/excluir/<?= $instituicao->getId() ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirmarAcao(this.href, 'Excluir Instituição', 'Tem certeza que deseja excluir esta instituição?', 'danger')">
                                Excluir
                            </a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if (empty($instituicoes)): ?>
        <div class="alert alert-info">Nenhuma instituição cadastrada até o momento.</div>
    <?php endif; ?>
</div>