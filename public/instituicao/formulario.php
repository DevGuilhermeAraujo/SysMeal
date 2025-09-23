<?php
// Se os dados vierem do controller
$id = $dados['id'] ?? null;
$edicao = !is_null($id);
?>

<div class="container mt-4">
    <h2 class="mb-4"><?= $edicao ? 'Editar Instituição' : 'Nova Instituição' ?></h2>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post" action="/sysmeal/instituicao/<?= $edicao ? 'atualizar/' . $id : 'criar' ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" 
                   class="form-control" 
                   id="nome" 
                   name="nome" 
                   value="<?= htmlspecialchars($dados['nome'] ?? '') ?>" 
                   required>
        </div>

        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" 
                   class="form-control" 
                   id="endereco" 
                   name="endereco" 
                   value="<?= htmlspecialchars($dados['endereco'] ?? '') ?>" 
                   required>
        </div>

        <button type="submit" class="btn btn-success">
            <?= $edicao ? 'Atualizar' : 'Cadastrar' ?>
        </button>
        <a href="/sysmeal/instituicao/listar" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
