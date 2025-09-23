<div class="container mt-4">
    <?php if(!empty($hide_hero) && $hide_hero === false): ?>
        <div class="jumbotron text-center bg-primary text-white p-4 rounded mb-4">
            <h1>Bem-vindo ao Painel de Doações!</h1>
            <p>Acompanhe aqui os dados e estatísticas mais importantes.</p>
        </div>
    <?php endif; ?>

    <!-- Cartões de estatísticas -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Doações Totais</h5>
                    <p class="card-text display-4"><?= $stats['total_doacoes'] ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Doadores Cadastrados</h5>
                    <p class="card-text display-4"><?= $stats['total_doadores'] ?? 0 ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Solicitações Pendentes</h5>
                    <p class="card-text display-4"><?= $stats['solicitacoes_pendentes'] ?? 0 ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Doações por Categoria</h5>
            <canvas id="doacoesChart" height="100"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('doacoesChart').getContext('2d');
const doacoesChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_keys($stats['doacoes_por_categoria'] ?? [])) ?>,
        datasets: [{
            label: 'Quantidade de Doações',
            data: <?= json_encode(array_values($stats['doacoes_por_categoria'] ?? [])) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
