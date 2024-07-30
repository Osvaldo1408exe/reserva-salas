
function createReservationsChart(rooms, reservations) {
    var ctx = document.getElementById('RoomMostReservated').getContext('2d');
    var RoomMostReservated = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: rooms,
            datasets: [{
                label: 'Número de Reservas',
                data: reservations,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
