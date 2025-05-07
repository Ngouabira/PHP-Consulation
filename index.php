<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: /login');
}



require_once './partials/header.php'; ?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php require_once './partials/sidebar.php'; ?>
        <div class="layout-page">
            <?php require_once './partials/navbar.php'; ?>
        </div>
    </div>
</div>


<h1 class="text-danger">Page d'accueil</h1>

<?php require_once './partials/footer.php'; ?>