<div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoomModalLabel">Editar Sala</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRoomForm">
                    <input type="hidden" id="editRoomId" name="id">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCapacity" class="form-label">Capacidade</label>
                        <input type="number" class="form-control" id="editCapacity" name="capacity" required>
                    </div>
                    <div class="mb-3">
                        <label for="editLocation" class="form-label">Localização</label>
                        <input type="text" class="form-control" id="editLocation" name="location" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Atualizar Sala</button>
                </form>
            </div>
        </div>
    </div>
</div>
