<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('facture_message'); ?>
<div class="container container-fluid d-flex flex-column justify-content-center align-items-center pt-5">
    <div class="mb-5">
        <h1 class="text-info">Ajouter une Facture</h1>
    </div>
    <form id="formOrder" action="<?= URLROOT ?>/facture/add" method="post" style="width: 500px;">
        <div class="form-floating mb-3">
            <input type="text" id="client" name="client" class="form-control form-control-lg <?php echo (!empty($data['client_err'])) ? 'Non valide' : ''; ?>" value="<?php echo $data['client']; ?>" required>
            <span class="invalid-feedback"><?php echo $data['client_err']; ?></span>
            <label class="form-label" for="client">Nom du client</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="caissier" name="caissier" class="form-control form-control-lg <?php echo (!empty($data['caissier_err'])) ? 'Non valide' : ''; ?>" value="<?php echo $data['caissier']; ?>" required>
            <span class="invalid-feedback"><?php echo $data['caissier_err']; ?></span>
            <label class="form-label" for="caissier">Nom du caissier</label>
        </div>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating mb-3">
                    <input type="number" id="montant" name="montant" class="form-control form-control-lg <?php echo (!empty($data['montant_err'])) ? 'Non valide' : ''; ?>" value="<?php echo $data['montant']; ?>" required>
                    <span class="invalid-feedback"><?php echo $data['montant_err']; ?></span>
                    <label class="form-label" for="montant">Montant</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating mb-3">
                    <input type="number" id="percu" name="percu" class="form-control form-control-lg <?php echo (!empty($data['percu_err'])) ? 'Non valide' : ''; ?>" value="<?php echo $data['percu']; ?>" required oninput="calculateReturn()">
                    <span id="percu_err" class="invalid-feedback"><?php echo $data['percu_err']; ?></span>
                    <label class="form-label" for="percu">Montant perçu</label>
                </div>
            </div>

            <!-- Champ Montant retourné (hidden) -->
            <input type="hidden" id="retourne" name="retourne" value="<?php echo $data['retourne']; ?>">
            
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="etat" aria-label="etat" name="etat" required>
                        <option value="Facturée" selected="">Facturée</option>
                        <option value="Payée">Payée</option>
                        <option value="Annulée">Annulée</option>
                    </select><label class="form-label" for="etat">Etat de la commande</label>
                </div>
            </div>
        </div>
        <div class="text-end form-floating mb-3">
            <a href="<?= URLROOT ?>/facture" class="btn btn-outline-dark me-3"><i class="fas fa-times"></i> Annuler</a>
            <button class="btn btn-primary" type="submit"><i class="fas fa-plus"></i> Ajouter</button>
        </div>
    </form>
</div>

<script>
function calculateReturn() {
    var montant = parseFloat(document.getElementById('montant').value);
    var percu = parseFloat(document.getElementById('percu').value);
    
    if (!isNaN(montant) && !isNaN(percu)) {
        var retourne = percu - montant;

        if (percu < montant) {
            document.getElementById('percu').classList.add('is-invalid'); // Ajouter la classe d'erreur
            document.getElementById('percu_err').innerText = "Le montant perçu doit être supérieur ou égal au montant.";
        } else {
            document.getElementById('percu').classList.remove('is-invalid'); // Enlever la classe d'erreur
            document.getElementById('percu_err').innerText = ""; // Effacer le message d'erreur
            document.getElementById('retourne').value = retourne.toFixed(2); // arrondi à 2 décimales
        }
    }
}

document.getElementById('formOrder').addEventListener('submit', function(event) {
    var montant = parseFloat(document.getElementById('montant').value);
    var percu = parseFloat(document.getElementById('percu').value);

    if (percu < montant) {
        event.preventDefault();
        alert("Le montant perçu doit être supérieur ou égal au montant de la facture.");
    }
});
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
