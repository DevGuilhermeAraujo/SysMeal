<?php
function renderModalConfirm() {
    echo '
    <!-- Modal Genérico de Confirmação -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="confirmModalLabel">Confirmação</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
          <div class="modal-body" id="confirmModalBody">
            Tem certeza que deseja executar esta ação?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <a href="#" id="confirmBtn" class="btn btn-primary">Confirmar</a>
          </div>
        </div>
      </div>
    </div>

    <script>
      function confirmarAcao(url, titulo = "Confirmação", mensagem = "Tem certeza que deseja executar esta ação?", cor = "primary") {
          document.getElementById("confirmModalLabel").innerText = titulo;
          document.getElementById("confirmModalBody").innerText = mensagem;

          // Muda a cor do header dinamicamente
          let header = document.querySelector("#confirmModal .modal-header");
          header.className = "modal-header bg-" + cor + " text-white";

          let confirmBtn = document.getElementById("confirmBtn");
          confirmBtn.setAttribute("href", url);

          var myModal = new bootstrap.Modal(document.getElementById("confirmModal"));
          myModal.show();
          return false;
      }
    </script>
    ';
}
