<?php
function showToast($mensagem, $tipo = 'success', $tempo = 4000) {
    // Tipos: success, error, warning, info
    $classes = [
        'success' => 'alert alert-success',
        'error'   => 'alert alert-danger',
        'warning' => 'alert alert-warning',
        'info'    => 'alert alert-info'
    ];

    $classe = $classes[$tipo] ?? $classes['info'];

    // ID único para cada toast
    $id = uniqid('toast_');

    echo "
    <div id='$id' class='$classe alert-dismissible fade show text-center' role='alert' 
         style='position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); 
                min-width: 300px; z-index: 9999;'>
        $mensagem
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>

    <script>
        setTimeout(function() {
            var el = document.getElementById('$id');
            if (el) {
                var bsAlert = bootstrap.Alert.getOrCreateInstance(el);
                bsAlert.close();
            }
        }, $tempo);
    </script>
    ";
}
