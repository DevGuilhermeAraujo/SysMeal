<?php
// Determinar o modo do formulário
$edicao = $edicao ?? false;
$solicitar = $solicitar ?? false;
?>

<div class="container mt-4">
    <h2 class="mb-4">
        <?= $solicitar ? 'Solicitar Doação' : ($edicao ? 'Editar Doação' : 'Nova Doação') ?>
    </h2>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= 
        $solicitar ? '/sysmeal/doacao/confirmarSolicitacao/' . ($id ?? $dados['id'] ?? '') : ($edicao 
                ? '/sysmeal/doacao/atualizar/' . ($id ?? $dados['id'] ?? '') 
                : '/sysmeal/doacao/criar') 
    ?>">

        <?php if (!$solicitar): ?>
            <!-- Select de doadores apenas no cadastro/edição -->
            <div class="mb-3">
                <label for="doador_id" class="form-label">Doador</label>
                <select class="form-select" id="doador_id" name="doador_id" required>
                    <option value="">Selecione um doador</option>
                    <?php foreach ($doadores as $d): ?>
                        <option value="<?= $d->getId() ?>" 
                            <?= (isset($dados['doador_id']) && $dados['doador_id'] == $d->getId()) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($d->getNome()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Descrição da doação -->
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" required><?= htmlspecialchars($dados['descricao'] ?? '') ?></textarea>
            </div>

            <!-- Data da doação -->
            <div class="mb-3">
                <label for="data_doacao" class="form-label">Data da Doação</label>
                <input type="date" 
                       class="form-control" 
                       id="data_doacao" 
                       name="data_doacao" 
                       value="<?= htmlspecialchars($dados['data_doacao'] ?? date('Y-m-d')) ?>" 
                       required>
            </div>

        <?php else: ?>
            <!-- Select de instituições apenas no solicitar doação -->
            <div class="mb-3">
                <label for="instituicao_id" class="form-label">Selecionar Instituição</label>
                <select name="instituicao_id" id="instituicao_id" class="form-select" required>
                    <option value="">-- Escolha uma instituição --</option>
                    <?php foreach($instituicoes as $inst): ?>
                        <option value="<?= $inst->getId() ?>" 
                            <?= (isset($dados['instituicao_id']) && $dados['instituicao_id'] == $inst->getId()) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($inst->getNome()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success">
            <?= $solicitar ? 'Confirmar' : ($edicao ? 'Atualizar' : 'Cadastrar') ?>
        </button>
        <a href="<?= $solicitar 
                    ? '/sysmeal/doacao/ver/' . ($id ?? $dados['id'] ?? '') 
                    : '/sysmeal/doacao/listar' ?>" 
           class="btn btn-secondary">
           Cancelar
        </a>
    </form>
</div>
