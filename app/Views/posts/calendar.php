<style>
  .fc-col-header-cell-cushion, .fc-daygrid-day-number {
    text-decoration: none;
    color: black;
  }
</style>
<div id='calendar'></div>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
 <script>
  document.addEventListener('DOMContentLoaded', function() {

    let events = <?= json_encode($posts) ?>;
    let eventsUi = events.map((ele) => {
      return {
        title: ele.title,
        allDay: true,
        start: ele.date,
        url: '/posts/'+ele.slug
      }
    })

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      firstDay: 1,
      locale: 'es',
      buttonText: {
        today: 'Hoy'
      },
      height: 'auto',
      events: eventsUi
    });

    calendar.render();

  });
</script>

