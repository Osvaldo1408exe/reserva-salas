let deleteReservationId = null;

function confirmDelete(id) {
    deleteReservationId = id;
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteReservationModal'));
    deleteModal.show();
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    fetch('../Controllers/ReservationController.php?action=delete', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'id': deleteReservationId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            location.reload(); 
        } else {
            alert('Erro ao deletar a reserva.');
        }
    });
});