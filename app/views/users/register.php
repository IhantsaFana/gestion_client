<header class="header">
<?php require APPROOT . '/views/inc/header1.php'; ?>
<div class="container container-fluid d-flex justify-content-center">
    <div class="col-md-6 mx-auto">
        <div class="card card-body mt-5" style="width: 500px; background: rgba(255,255,255,0.3)">
            <h2>Inscription</h2>
            <p>Veuillez remplir ce formulaire pour vous inscrire.</p>
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <div class="form-group">
                    <label>Nom:<sup>*</sup></label>
                    <input type="text" name="name" class="form-control form-control-lg bg-transparent <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                </div>
                <div class="form-group">
                    <label>Email:<sup>*</sup></label>
                    <input type="text" name="email" class="form-control form-control-lg bg-transparent <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-group">
                            <label>Mot de passe:<sup>*</sup></label>
                            <input type="password" name="password" class="form-control form-control-lg bg-transparent <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label>Confirmer le mot de passe:<sup>*</sup></label>
                            <input type="password" name="confirm_password" class="form-control form-control-lg bg-transparent <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="S'inscrire" class="btn btn-success btn-block">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn bg-transparent">Vous avez de compte? Se connecter</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</header>
<?php require APPROOT . '/views/inc/footer.php'; ?>
