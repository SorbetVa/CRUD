<?php
require_once 'functions.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $expiration_date = trim($_POST['expiration_date'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    if (empty($name)) {
        $errors[] = "Le nom de l'aliment est obligatoire.";
    }

    if (empty($expiration_date)) {
        $errors[] = "La date de péremption est obligatoire.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $expiration_date)) {
        $errors[] = "La date de péremption n'est pas valide (format YYYY-MM-DD).";
    }
    if (empty($errors)) {
        $data = [
            'name' => $name,
            'expiration_date' => $expiration_date,
            'comment' => $comment
        ];

        if (create_food($data)) {
            $success = true;
            $name = $expiration_date = $comment = '';
        } else {
            $errors[] = "Une erreur est survenue lors de l'enregistrement.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savory Savers | Ajouter un aliment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header class="text-center mb-4 mt-3">
        <h1><i class="fa-solid fa-seedling"></i> Savory Savers</h1>
        <p>Préservez votre pouvoir d'achat et faites un geste pour l'environnement </p>
    </header>

    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 shadow p-3">
                    <h2 class="mb-4 text-center">Ajouter un aliment</h2>

                    <?php if ($success): ?>
                        <div class="alert alert-success">Aliment ajouter</div>
                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom de laliment</label>
                            <input id="name" type="text" class="form-control" name="name" placeholder="Pomme" value="<?= htmlspecialchars($name ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="expiration_date" class="form-label">date de peremption</label>
                            <input id="expiration_date" type="date" class="form-control" name="expiration_date" value="<?= htmlspecialchars($expiration_date ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">commentaire</label>
                            <textarea id="comment" class="form-control" name="comment" placeholder="Un commentaire..."><?= htmlspecialchars($comment ?? '') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <input class="btn btn-lg btn-warning" type="submit" value="Ajouter">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer id="site-footer" class="shadow mt-5">
        <div class="container py-2">
            <p>&copy; 2023 La Manu</p>
        </div>
    </footer>
</body>
</html>
