<?php require_once '../../partials/header.php'; ?>
<link rel="stylesheet" href="/assets/vendor/css/pages/page-auth.css" />


<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Forgot Password -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="index.php" class="app-brand-link gap-2">
                            <span class="app-brand-text demo text-body fw-bolder">Mot de passe oublié</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Mot de passe oublié? 🔒</h4>
                    <p class="mb-4">Entrez votre email et nous vous enverrons les instructions pour réinitialiser votre mot de passe</p>
                    <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Entrez votre email"
                                autofocus />
                        </div>
                        <button class="btn btn-primary d-grid w-100">Envoyer le lien de réinitialisation</button>
                    </form>
                    <div class="text-center">
                        <a href="login.php" class="d-flex align-items-center justify-content-center">
                            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                            Retour à la connexion
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
</div>

<!-- / Content -->


<?php require_once '../../partials/footer.php'; ?>