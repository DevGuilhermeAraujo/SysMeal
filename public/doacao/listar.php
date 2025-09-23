<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Lista de Doações</h2>
        <a href="/sysmeal/doacao/novo" class="btn btn-primary">Registrar Nova Doação</a>
    </div>

    <!-- Lista de doações SEM instituição -->
    <h4>Doações disponíveis</h4>
    <?php if (!empty($doacoesSemInstituicao)): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Doador</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doacoesSemInstituicao as $doacao): ?>
                    <tr>
                        <td><?= htmlspecialchars($doacao->getId()) ?></td>
                        <td><?= htmlspecialchars($doacao->getNomeDoador()) ?></td>
                        <td><?= htmlspecialchars($doacao->getDescricao()) ?></td> 
                        <td><?= htmlspecialchars($doacao->getDataDoacao()) ?></td>
                        <td>
                            <a href="/sysmeal/doacao/ver/<?= $doacao->getId() ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="/sysmeal/doacao/editar/<?= $doacao->getId() ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="/sysmeal/doacao/excluir/<?= $doacao->getId() ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirmarAcao(this.href, 'Excluir Doação', 'Tem certeza que deseja excluir esta doação?', 'danger')">
                                Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Nenhuma doação disponível no momento.</div>
    <?php endif; ?>


    <!-- Lista de doações COM instituição -->
    <h4 class="mt-5">Doações atribuídas a instituições</h4>
    <?php if (!empty($doacoesComInstituicao)): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Instituição</th>
                    <th>Descrição</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doacoesComInstituicao as $doacao): ?>
                    <tr>
                        <td><?= htmlspecialchars($doacao->getId()) ?></td>
                        <td><?= htmlspecialchars($doacao->getNomeInstituicao()) ?></td>
                        <td><?= htmlspecialchars($doacao->getDescricao()) ?></td> 
                        <td><?= htmlspecialchars($doacao->getDataDoacao()) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Nenhuma doação foi atribuída a instituições ainda.</div>
    <?php endif; ?>
</div>
