<?php
// Se os dados vierem do controller
$id = $dados['id'] ?? null;
$edicao = !is_null($id);
?>

<div class="container mt-4">
    <h2 class="mb-4"><?= $edicao ? 'Editar Doador' : 'Novo Doador' ?></h2>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post" action="/sysmeal/doador/<?= $edicao ? 'atualizar/' . $id : 'criar' ?>">

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
            <label for="email" class="form-label">Email</label>
            <input type="email" 
                   class="form-control" 
                   id="email" 
                   name="email" 
                   value="<?= htmlspecialchars($dados['email'] ?? '') ?>" 
                   required>
        </div>

        <button type="submit" class="btn btn-success">
            <?= $edicao ? 'Atualizar' : 'Cadastrar' ?>
        </button>
        <a href="/sysmeal/doador/listar" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
