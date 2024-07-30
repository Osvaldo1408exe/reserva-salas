document.getElementById('addReservationForm').addEventListener('submit', function(event) {
    event.preventDefault();  

    var room = document.getElementById('room').value;
    var start_time = document.getElementById('start_time').value;
    var end_time = document.getElementById('end_time').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../Controllers/ReservationController.php?action=add', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                alert(response.message);
                // Fechar o modal
                var myModalEl = document.getElementById('addReservationModal');
                var modal = bootstrap.Modal.getInstance(myModalEl);
                modal.hide();
                window.location.reload();
            } else {
                alert(response.message);
            }
        } else {
            alert('Erro ao adicionar reserva.');
        }
    };
    xhr.send('room=' + encodeURIComponent(room) + '&start_time=' + encodeURIComponent(start_time) + '&end_time=' + encodeURIComponent(end_time));
});