function initializeCalendar(events) {
    var calendarEl = document.getElementById('CalendaryReservations');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: events
    });
    calendar.render();
}
