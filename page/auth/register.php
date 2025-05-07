<?php
session_start();

if (isset($_SESSION['email'])) {
    header('Location: /');
}

require_once '../../partials/header.php'; ?>

<?php require_once '../../core/dbconnect.php'; ?>

<link rel="stylesheet" href="/assets/vendor/css/pages/page-auth.css" />


<?php


if (isset($_POST['register'])) {

    $errors = [];

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($name)) {
        $errors["name"] = "Le nom est obligatoire";
    }

    if (empty($email)) {
        $errors["email"] = "L'email est obligatoire";
    }

    if (empty($password)) {
        $errors["password"] = "Le mot de passe est obligatoire";
    }

    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (name, email, password ) VALUES (?, ?, ?)";
        $stmt = $dbconnexion->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        $stmt->close();
        echo "<script>
        Swal.fire('Bienvenue sur notre plateforme', 'Votre compte a été créé avec succès', 'success')
        .then(() => {
            window.location.href = 'login.php';
        });
        </script>";
    }
}

?>


<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register Card -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-text demo text-body fw-bolder">S'inscrire</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Bienvenue sur notre plateforme</h4>
                    <p class="mb-4">Créez votre compte pour accéder à la plateforme</p>

                    <?php if (isset($errors) && !empty($errors)) : ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error) : ?>
                                <?php echo $error; ?> <br>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form id="formAuthentication" class="mb-3" action="/register" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input
                                type="text"
                                class="form-control <?php echo isset($errors["name"]) ? "is-invalid" : ""; ?>"
                                id="name"
                                name="name"
                                placeholder="Entrez votre nom"
                                value="<?php echo isset($name) ? $name : ""; ?>"
                                autofocus />
                            <?php if (isset($errors["name"])) : ?>
                                <div class="invalid-feedback">
                                    <?php echo $errors["name"]; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" value="<?php echo isset($email) ? $email : ""; ?>" class="form-control <?php echo isset($errors["email"]) ? "is-invalid" : ""; ?>" id="email" name="email" placeholder="Entrez votre email" />
                            <?php if (isset($errors["email"])) : ?>
                                <div class="invalid-feedback">
                                    <?php echo $errors["email"]; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Mot de passe</label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control <?php echo isset($errors["password"]) ? "is-invalid" : ""; ?>"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                <?php if (isset($errors["password"])) : ?>
                                    <div class="invalid-feedback">
                                        <?php echo $errors["password"]; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <input name="register" type="submit" class="btn btn-primary d-grid w-100" />

                    </form>

                    <p class="text-center">
                        <span>Vous avez déjà un compte?</span>
                        <a href="/login">
                            <span>Se connecter</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- Register Card -->
        </div>
    </div>
</div>

<!-- / Content -->


<?php require_once '../../partials/footer.php'; ?>