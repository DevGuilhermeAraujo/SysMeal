<div class="container mt-4">
    <h2 class="mb-4">Detalhes da Instituição</h2>

    <?php if (!empty($instituicao)): ?>
        <ul class="list-group">
            <li class="list-group-item"><strong>ID:</strong> <?= htmlspecialchars($instituicao->getId()) ?></li>
            <li class="list-group-item"><strong>Nome:</strong> <?= htmlspecialchars($instituicao->getNome()) ?></li>
            <li class="list-group-item"><strong>Endereço:</strong> <?= htmlspecialchars($instituicao->getEndereco()) ?></li>
        </ul>

        <div class="mt-3">
            <a href="/sysmeal/instituicao/editar/<?= $instituicao->getId() ?>" class="btn btn-warning">Editar</a>
            <a href="/sysmeal/instituicao/listar" class="btn btn-secondary">Voltar</a>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Instituição não encontrada.</div>
        <a href="/sysmeal/instituicao/editar/" class="btn btn-secondary">Voltar</a>
    <?php endif; ?>
</div>
