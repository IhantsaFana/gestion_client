<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('facture_message'); ?>
<div class="container container-fluid d-flex flex-column justify-content-center align-items-center pt-5">
    <div class="mb-5">
        <h1 class="text-info">PROFILE DE L'UTILISATEUR</h1>
    </div>
    <div>
        <?php foreach($data['users'] as $user) : ?>
        <h1>Profil de <?php echo $user->name; ?></h1>
        <p>Email: <?php echo htmlspecialchars($user->email); ?></p>

        <?php endforeach; ?>
    </div>
</div>

</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>