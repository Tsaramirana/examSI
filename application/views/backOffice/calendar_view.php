<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calendar</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.js'></script>
    <script src="<?php echo base_url('assets/js/index.global.js'); ?>"></script>
    <style>
        body {
            margin: 40px 10px;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Simple modal styling */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px; 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .formbeee {
            margin-top: -5vh;
        }
        .week {
            margin-left: 50vw;
            color: #fd343f;
        }
    </style>
</head>
<body>
    <span>Today is : </span><p id="ref_date"><?php echo $date_ref ; ?></p>
    <h1 class="week">Cliquez sur week pour reserver un creno !</h1>
    <div id='calendar'></div>

    <!-- Modal for selecting car and service -->
    <div id="myModal" class="modal">
        <div class="modal-content formbeee">
            <h1 id="temp"></h1>
            <span class="close">&times;</span>
            <form id="appointmentForm" action="<?php echo base_url('backOffice/RendezvousControllerInsert/insert'); ?>" method="POST">
                <input type="hidden" name="fromcalendar" value="ok">
                <input type="hidden" id="dateHeureDebut" name="dateHeureDebut">
                <label for="idService">Service:</label>
                <select id="idService" name="idService">
                    <?php foreach($services as $service): ?>
                        <option value="<?php echo $service['id']; ?>"><?php echo $service['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select id="idVoiture" name="idVoiture">
                    <?php foreach($voitures as $voiture): ?>
                        <option value="<?php echo $voiture['id']; ?>"><?php echo $voiture['numero']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Valider</button>
            </form>
        </div>
    </div>
    <a href="<?php echo site_url('backOffice/ServiceController'); ?>">Retour</a>
    <a href="<?php echo site_url('backOffice/Deconnexion'); ?>">Deconnexion</a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                initialDate: document.getElementById('ref_date').innerHTML,
                navLinks: true,
                businessHours: true,
                editable: true,
                selectable: true,
                events: <?php echo json_encode($events); ?>,
                dateClick: function(info) {
                    document.getElementById('dateHeureDebut').value = info.dateStr;
                    document.getElementById("temp").innerHTML =info.dateStr;
                    modal.style.display = "block";
                }
            });

            calendar.render();

            // Close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>

    <?php 
        $this->load->view('template/footer.php');
    ?>
</body>
</html>
