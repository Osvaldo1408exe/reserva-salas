<div class="modal fade" id="addReservationModal" tabindex="-1" aria-labelledby="addReservationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addReservationModalLabel">Adicionar Reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addReservationForm">
          <div class="mb-3">
            <label for="room" class="form-label">Sala</label>
            <select class="form-select" id="room" name="room" required>
              <option value="">Selecione a sala desejada</option>
              <?php foreach ($rooms as $room): ?>
                <option value="<?php echo $room['id']; ?>"><?php echo $room['name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="start_time" class="form-label">Hora de Início</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
          </div>
          <div class="mb-3">
            <label for="end_time" class="form-label">Hora de Término</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
          </div>
          <button type="submit" class="btn btn-primary">Reservar</button>
        </form>
      </div>
    </div>
  </div>
</div>