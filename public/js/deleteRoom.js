let deleteRoomId = null;

function confirmDelete(id) {
    deleteRoomId = id;
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteRoomModal'));
    deleteModal.show();
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    fetch('../Controllers/RoomController.php?action=delete', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'id': deleteRoomId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            location.reload(); 
        } else {
            alert('Erro ao deletar o quarto.');
        }
    });
});
