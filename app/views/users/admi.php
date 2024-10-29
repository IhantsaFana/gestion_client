<header>
<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('facture_message'); ?>

<main>
    <div class="container d-flex justify-content-center">
        <div class="profil-detail p-5" style="min-height: 80vh; background: linear-gradient(50deg, var(--bs-indigo), var(--bs-cyan) 72%); border-radius: 25px;">
            <div class="pdp row d-flex flex-column align-items-center">
                <img style="border-radius: 50%; width: 10rem; height: 10rem; background: linear-gradient(to left, #7b4397, #dc2430)" src="<?= URLROOT ?>/assets/img/bg-pattern.png" alt="Profile Picture">
                <h1 class="fs-4 fw-bold name text-center text-uppercase">our Team</h1>
            </div>
            <hr>
            <div class="container-fluid mt-1 bg-image d-flex flex-column justify-content-center align-items-center">
                <div class="row">
                    <h1 class="text-center title mb-5" style="font-size: 1.7em;" style="text-decoration: underline;">Members : </h1>
                    <ol>
                        <li class="mb-3"><span class="fw-bold">Ihantsa RAKOTONDRANAIVO - SE20230141</span><br>(Full-stack developer)</li>
                        <li><span class="fw-bold">James RAZAFINOELY - SE20230005</span><br>(back-end developer)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>
