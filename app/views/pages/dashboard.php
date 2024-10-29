<?php require APPROOT . '/views/inc/header1.php'; ?>
<section style="background: linear-gradient(52deg, black, #2a2727); min-height: 100vh;">
        <nav class="navbar navbar-dark navbar-expand-md">
            <div class="container-fluid"><a class="navbar-brand" href="#">&nbsp; <i class="fas fa-ellipsis-h"></i>&nbsp; FACTURATION</a>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav navbar-nav-scroll ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/users/admi"><i class="fas fa-users"></i>&nbsp;A propos de l'équipe</a>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link btn" title="Log out" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="fas fa-sign-out-alt"></i>&nbsp;Se deconnecter&nbsp;
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-dark navbar-expand-md" style="border-bottom: 0.1px solid var(--bs-navbar-brand-color);">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navcol-2">
                    <ul class="navbar-nav">
                        <li class="nav-item nav-item-dash">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/facture">
                            <i class="far fa-list-alt"></i>&nbsp;Listes des factures</a>
                        </li>
                        <li class="nav-item nav-item-dash">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/facture/add">
                            <i class="far fa-plus-square"></i>&nbsp;Créer un nouvelle facture</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="container py-4 py-xl-5">
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h2 class="display-2 fw-semibold text-light">Dashboard</h2>
                    </div>
                </div>
                <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                    <div class="col">
                        <div class="card" style="border-style: solid;border-color: var(--bs-card-cap-bg);background: var(--bs-gray-900);border-radius: 6px;">
                            <div class="card-body p-4">
                                <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <h4 class="text-white card-title">Total des Factures</h4>
                                <p class="text-white card-text"><?php echo isset($totalFactures) ? htmlspecialchars($totalFactures) : 'Données indisponibles'; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="border-style: solid;border-color: var(--bs-card-cap-bg);background: var(--bs-gray-900);border-radius: 6px;">
                            <div class="card-body p-4">
                                <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon">
                                    <i class="fas fa-dollar-sign"></i>                                      
                                </div>
                                <h4 class="text-white card-title">Montant Total des Factures</h4>
                                <p class="text-white card-text"><?php echo isset($montantTotal) ? htmlspecialchars($montantTotal) . ' Ar' : 'Données indisponibles'; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="border-style: solid;border-color: var(--bs-card-cap-bg);background: var(--bs-gray-900);border-radius: 6px;">
                            <div class="card-body p-4">
                                <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center d-inline-block mb-3 bs-icon">
                                    <i class="fas fa-check-circle"></i>  
                                </div>
                                <h4 class="text-white zcard-title">Factures Payées</h4>
                                <p class="text-white card-text"><?php echo isset($facturesPayees) ? htmlspecialchars($facturesPayees) : 'Données indisponibles'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="mt-4">Statistiques par État des Factures</h2>
                    <div class="chart-container">
                        <canvas id="etatFacturesChart"></canvas>
                    </div>
            </div>
        </div>
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">SE DECONNECTER</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h1 class="text-danger text-center">Voulez vous vraiment déconnecter ?</h1>
                  <p class="text-center text-danger ">(Cette action est irreversible)</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a class="btn btn-danger" href="<?= URLROOT ?>/users/logout"><i class="fas fa-sign-out-alt"></i> Se Déconnecter</a>
                </div>
              </div>
            </div>
        </div>
    </section>
                            
    <script>
        const ctx = document.getElementById('etatFacturesChart').getContext('2d');
        const etatFacturesChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Payées', 'Facturées', 'Annulées'],
                datasets: [{
                    label: '# de Factures',
                    data: [
                        <?php 
                            echo isset($facturesPayees) ? htmlspecialchars($facturesPayees) : 0;
                            echo ', ';
                            echo isset($facturesFacturees) ? htmlspecialchars($facturesFacturees) : 0;
                            echo ', ';
                            echo isset($facturesAnnulees) ? htmlspecialchars($facturesAnnulees) : 0;
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)', // Couleur pour Payées
                        'rgba(255, 206, 86, 0.6)', // Couleur pour Facturées
                        'rgba(255, 99, 132, 0.6)'   // Couleur pour Annulées
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
    
<?php require APPROOT . '/views/inc/footer.php'; ?>