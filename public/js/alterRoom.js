function editRoom(room) {
    document.getElementById('editRoomId').value = room.id;
    document.getElementById('editName').value = room.name;
    document.getElementById('editCapacity').value = room.capacity;
    document.getElementById('editLocation').value = room.location;

    const editModal = new bootstrap.Modal(document.getElementById('editRoomModal'));
    editModal.show();
}

document.getElementById('editRoomForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    formData.append('action', 'edit');

    fetch('../Controllers/RoomController.php?action=edit', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Quarto atualizado com sucesso!');
            location.reload(); 
        } else {
            alert('Erro ao atualizar o quarto.');
        }
    });
});
