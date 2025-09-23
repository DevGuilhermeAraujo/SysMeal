<div class="container mt-4">
    <h2 class="mb-4">Detalhes da Doação</h2>

    <?php if (!empty($doacao)): ?>
        <ul class="list-group">
            <li class="list-group-item">
                <strong>ID:</strong> <?= htmlspecialchars($doacao->getId()) ?>
            </li>
            <li class="list-group-item">
                <strong>Doador:</strong>
                <?= htmlspecialchars($doacao->getNomeDoador() ?? 'N/A') ?>
            </li>
            <!-- <li class="list-group-item">
                <strong>Instituição:</strong> 
                 //htmlspecialchars($doacao->getInstituicaoNome() ?? 'N/A') ?>
            </li> -->
            <li class="list-group-item">
                <strong>Descrição:</strong> <?= nl2br(htmlspecialchars($doacao->getDescricao())) ?>
            </li>
            <li class="list-group-item">
                <strong>Data da Doação:</strong>
                <?= htmlspecialchars(date('d/m/Y', strtotime($doacao->getDataDoacao()))) ?>
            </li>
        </ul>

        <div class="mt-3">
            <a href="/sysmeal/doacao/editar/<?= $doacao->getId() ?>" class="btn btn-warning">Editar</a>
            <a href="/sysmeal/doacao/listar" class="btn btn-secondary">Voltar</a>
            <a href="/sysmeal/doacao/solicitar/<?= $doacao->getId() ?>" class="btn btn-success">Solicitar Doação</a>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Doação não encontrada.</div>
        <a href="/sysmeal/doacao/listar" class="btn btn-secondary">Voltar</a>
    <?php endif; ?>
</div>