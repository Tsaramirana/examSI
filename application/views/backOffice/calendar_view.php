<body id="accueil-body">
    <div class="container-fluid" id="accueil-container">
        <div class="row col-md-12">
            <!-- SIDEBAR -->
            <div class="col-md-2" id="adminsidebar">
                <div class="row col-md-12" id="logo">
                    <img src="<?php echo base_url('assets/images/logo.png'); ?>">                
                </div>
                <div class="row col-md-12" id="adminsidebar-buttons">
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Accueil</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Services</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Heure de référence</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Devis</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Liste RDV</a>
                    <a href="<?php echo site_url() ?>" class="sidebar-item">Importation de données</a>
                    <a href="<?php echo site_url() ?>" class="active-item2 sidebar-item">Gestion des slots</a>
                </div>
                <div class="row col-md-12 admin-disconnec">
                    <a href="" onclick="return confirm('Voulez-vous vraiement réinitialiser votre base de donnée? Cette action est irréversible');">Réinitialisation</a>
                    <a href="<?php echo site_url() ?>">Déconnexion</a>
                </div>
            </div>
            <!-- SIDEBAR -->

            <div class="col-md-1"></div>
            <!-- CONTENT -->
            <div class="col-md-8" id="accueil-content">
                <div class="row col-md-12" id="text-accueil-content">
                    <h1 class="title-emphase">Liste des rendez-vous</h1>
                </div>
                <div class="row col-md-12" id="calendar"></div>
            </div>
            <!-- CONTENT -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {
                    url: '',
                    method: 'GET',
                    failure: function() {
                        alert('Erreur lors du chargement des rendez-vous');
                    }
                }
            });
            calendar.render();
        });
    </script>
