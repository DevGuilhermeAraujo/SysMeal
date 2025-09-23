<div class="container mt-4">
    <h2 class="mb-4">Detalhes do Doador</h2>

    <?php if (!empty($doador)): ?>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> <?= htmlspecialchars($doador->getId()) ?></li>
            <li class="list-group-item"><strong>Nome:</strong> <?= htmlspecialchars($doador->getNome()) ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($doador->getEmail()) ?></li>
        </ul>

        <div class="mt-3">
            <a href="/sysmeal/doador/editar/<?= $doador->getId() ?>" class="btn btn-warning">Editar</a>
            <a href="/sysmeal/doador/listar" class="btn btn-secondary">Voltar</a>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Doador não encontrado.</div>
        <a href="/sysmeal/doador/editar/" class="btn btn-secondary">Voltar</a>
    <?php endif; ?>
</div>
