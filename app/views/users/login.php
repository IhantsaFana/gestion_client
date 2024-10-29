<header class="header">
<?php require APPROOT . '/views/inc/header1.php'; ?>
<div class="container container-fluid d-flex justify-content-center" >
    <div class="col-md-6 mx-auto">
        <div class="card card-body mt-5" style="width: 500px; background: rgba(255,255,255,0.3)">
            <?php flash('register_success'); ?>
            <h2>Login</h2>
            <p>Remplir les champs pour s'authentifier.</p>
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="form-group">
                    <label>Email:<sup>*</sup></label>
                    <input type="text" name="email" class="form-control form-control-lg bg-transparent <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-group">
                    <label>Mot de passe:<sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg bg-transparent <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input type="submit" class="btn btn-success btn-block mt-5" value="Se connecter">
                        <a href="<?php echo URLROOT; ?>/users/register" class="btn bg-transparent">Pas de compte? S'inscrire</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</header>
<?php require APPROOT . '/views/inc/footer.php'; ?>
