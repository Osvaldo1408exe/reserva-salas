document.getElementById('addRoomForm').addEventListener('submit', function(event) {
    event.preventDefault();  

    var name = document.getElementById('name').value;
    var capacity = document.getElementById('capacity').value;
    var location = document.getElementById('location').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../Controllers/RoomController.php?action=add', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Quarto adicionado com sucesso!');
            // Fechar o modal
            var myModalEl = document.getElementById('addRoomModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
             
            window.location.reload();
        } else {
            alert('Erro ao adicionar quarto.');
        }
    };
    xhr.send('name=' + encodeURIComponent(name) + '&capacity=' + encodeURIComponent(capacity) + '&location=' + encodeURIComponent(location));
});