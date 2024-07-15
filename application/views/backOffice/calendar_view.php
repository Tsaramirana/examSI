<!DOCTYPE html>
<html>
<head>
    <title>Calendrier des Rendez-vous</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="calendar"></div>

    <script>
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {
                    url: '<?php echo site_url('backOffice/RendezvousController/getEvents'); ?>',
                    method: 'GET',
                    failure: function() {
                        alert('Erreur lors du chargement des rendez-vous');
                    }
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
