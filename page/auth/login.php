<?php
session_start();

if (isset($_SESSION['email'])) {
    header('Location: /');
}

require_once '../../partials/header.php'; ?>
<?php require_once '../../core/dbconnect.php'; ?>
<link rel="stylesheet" href="/assets/vendor/css/pages/page-auth.css" />
<!-- Content -->

<?php


if (isset($_POST['submit'])) {
    $errors = [];
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $dbconnexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            header("Location: /");
        } else {
            $errors['password'] = "Mot de passe incorrect";
        }
    } else {
        $errors['email'] = "Email incorrect";
    }
}

?>

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="index.html" class="app-brand-link gap-2">

                            <span class="app-brand-text demo text-body fw-bolder">Se connecter</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Bienvenue sur notre plateforme</h4>
                    <p class="mb-4">Veuillez vous connecter à votre compte pour accéder à la plateforme</p>

                    <?php if (isset($errors) && !empty($errors)) : ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error) : ?>
                                <?php echo $error; ?> <br>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form id="formAuthentication" class="mb-3" action="/login" method="POST">
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
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Mot de passe</label>
                                <a href="forgot-password.php">
                                    <small>Mot de passe oublié?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit" name="submit">Se connecter</button>
                        </div>
                    </form>

                    <p class="text-center">
                        <span>Nouveau sur notre plateforme?</span>
                        <a href="/register">
                            <span>Créer un compte</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<!-- / Content -->

<?php require_once '../../partials/footer.php'; ?>