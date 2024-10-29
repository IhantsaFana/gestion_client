<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('facture_message'); ?>
<main>
  <div class="container">
      <div class="row">
          <div class="col-lg-8 col-sm mb-3 mx-auto">
              <h1 class="fs-4 text-center lead text-primary">Applicaton de facturation</h1>
          </div>
      </div>
      <div class="row">
          <div class="dropdown-divider border-warning"></div>
          <div class="row">
              <div class="col-md-6">
                  <h1>Listes des Factures</h1>
              </div>
              <div class="col-md-6 d-flex justify-content-end">
                  <div style="margin: auto;">
                    <a href="<?= URLROOT ?>/facture/add" class="btn btn-primary btn-sm me-3" type="button">
                      <i class="fas fa-folder-plus"></i>&nbsp;Nouveau
                    </a>
                    <button class="btn btn-success btn-sm me-3" id="exportBtn" type="button">
                      <i class="fas fa-table"></i>&nbsp;Exporter
                    </button>
                    <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#viderFactureModal">
                      <i class="fas fa-folder-plus"></i>&nbsp;Vider toutes les factures
                    </button>
                  </div>
              </div>
          </div>
          <div class="dropdown-divider border-warning"></div>
      </div>
      
      <div class="row">
      <div class="table-responsive" id="orderTable">
        <table class="table table-striped table-hover">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Client</th>
              <th>Caissier</th>
              <th>Montant</th>
              <th>Perçu</th>
              <th>Retourné</th>
              <th>État</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($data['factures'] as $facture) : ?>
              <tr>
                <td scope="row"><?php echo $facture->id; ?></td>
                <td><?php echo $facture->client; ?></td>
                <td><?php echo $facture->caissier; ?></td>
                <td><?php echo number_format($facture->montant, 0, '.', ' '); ?> Ar</td>
                <td><?php echo number_format($facture->percu, 0, '.', ' '); ?> Ar</td>
                <td><?php echo number_format($facture->retourne, 0, '.', ' '); ?> Ar</td>
                <td><span class="badge bg-info text-dark"><?php echo $facture->etat; ?></span></td>
                <td class="d-flex justify-content-center">
                  <button class="btn text-info me-2" title="Détails" data-bs-toggle="modal" data-bs-target="#detailFactureModal<?php echo $facture->id; ?>">
                    <i class="fas fa-info-circle"></i>
                  </button>
                  <a href="<?php echo URLROOT; ?>/facture/edit/<?php echo $facture->id; ?>" class="btn text-primary me-2" title="Modifier" data-bs-toggle="tooltip" data-bs-placement="top">
                    <i class="far fa-edit"></i>
                  </a>
                  <button class="btn text-danger" title="Supprimer" data-bs-toggle="modal" data-bs-target="#deleteFactureModal<?php echo $facture->id; ?>">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </td>
              </tr>

                <!-- Modal du detail facture -->
                <div class="modal fade" id="detailFactureModal<?php echo $facture->id; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $facture->id; ?>" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Détail de la facture #<?php echo $facture->id; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p><strong>Nom du Client :</strong> <?php echo $facture->client; ?></p>
                      <p><strong>Nom du Caissier :</strong> <?php echo $facture->caissier; ?></p>
                      <p><strong>Montant :</strong> <?php echo number_format($facture->montant, 0, '.', ' '); ?> Ar</p>
                      <p><strong>Montant Perçus:</strong> <?php echo number_format($facture->percu, 0, '.', ' '); ?> Ar</p>
                      <p><strong>Montant Retournés :</strong> <?php echo number_format($facture->retourne, 0, '.', ' '); ?> Ar</p>
                      <p><strong>Etat de la commande :</strong> <?php echo $facture->etat; ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Fermer</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal de confirmation pour la suppression -->
              <div class="modal fade" id="deleteFactureModal<?php echo $facture->id; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $facture->id; ?>" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Supprimer la facture #<?php echo $facture->id; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Êtes-vous sûr de vouloir supprimer cette facture ?</p>
                      <p><strong>Nom du Client :</strong> <?php echo $facture->client; ?></p>
                      <p><strong>Montant :</strong> <?php echo number_format($facture->montant, 0, '.', ' '); ?> Ar</p>
                      <p class="text-center text-danger ">(Cette action est irreversible)</p>
                    </div>
                    <div class="modal-footer">
                      <form method="POST" action="<?= URLROOT ?>/facture/delete/<?= $facture->id ?>">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Annuler</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!------------ Vider la table de facture -------------->
              <div class="modal fade" id="viderFactureModal" tabindex="-1" aria-labelledby="viderModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-uppercase text-center">Supprimer toutes les factures</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h3 class="text-center text-danger">Etes-vous sûr de supprimer toutes les Factures ?</h3>
                      <br>
                      <br>
                      <p class="text-center text-danger ">(Cette action est irreversible)</p>
                    </div>
                    <div class="modal-footer">
                      <form method="POST" action="<?= URLROOT ?>/facture/vider">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Annuler</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
