<?php
require_once 'functions.php';
$errors = [];
$success = false;
$id = $_GET['id'];
$food = get_food_by_id($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $expiration_date = $_POST['expiration_date'];
    $comment = $_POST['comment'];
}
?>
<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savory Savers | edit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <h2 class="mb-4 text-center">Modifier un aliment</h2>

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $e): ?>
                                    <li><?= $e ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label id="name" class="form-label">nom de l'aliment</label>
                            <input id="name" type="text" class="form-control" name="name"
                                value="<?= $food['name'] ?>" placeholder="Pomme">
                        </div>

                        <div class="mb-3">
                            <label id="expiration_date" class="form-label">date de peremption</label>
                            <input id="expiration_date" type="date" class="form-control" name="expiration_date"
                                value="<?= $food['expiration_date'] ?>">
                        </div>

                        <div class="mb-3">
                            <label id="comment" class="form-label">Commentaires</label>
                            <textarea id="comment" class="form-control" name="comment"><?= $food['comment'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <input class="btn btn-lg btn-warning" type="submit" value="Modifier">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer id="site-footer" class="shadow">
        <div class="container py-2">
            <p>&copy; 2023 La Manu</p>
        </div>
    </footer>
</body>

</html>
