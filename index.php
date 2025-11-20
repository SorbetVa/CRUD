<?php 
require_once 'functions.php';
$foods = get_all_foods();
?>
<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savory Savers | Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<header class="text-center mb-4 mt-3">
    <h1><i class="fa-solid fa-seedling"></i> Savory Savers</h1>
    <p>Préservez votre pouvoir d'achat et faites un geste <br /> pour l'environnement </p>
</header>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-5">

            <ul class="list-group">

                <?php if (empty($foods)): ?>
                    <li class="list-group-item text-center text-muted">
                        aucun aliments enregistrer.
                    </li>
                <?php else: ?>
                    <?php foreach ($foods as $food): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center gap-3">
                            <span class="pt-1">
                                <a href="edit.php?id=<?= $food['food_id'] ?>"><strong ><?= htmlspecialchars($food['name']) ?> </strong></a>
                                <small class="d-block text-muted">
                                    <i class="fa-regular fa-clock"></i>
                                    <?= htmlspecialchars(date('d/m/Y', strtotime($food['expiration_date']))) ?>
                                </small>
                            </span>

                            <a class="text-danger" 
                            href="delete.php?id=<?= $food['food_id'] ?>"
                            onclick="return confirm('Supprimer cet aliment ?');">
                            <i class="fa-solid fa-trash"></i>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>

            </ul>

        </div>
    </div>

    <a class="btn btn-lg btn-warning rounded-circle shadow position-absolute bottom-0 end-0 me-5 mb-5" href="create.php">
        <i class="fa-solid fa-plus"></i>
    </a>

</div>

<footer id="site-footer" class="shadow mt-5">
    <div class="container py-2">
        <p>&copy; 2023 La Manu</p>
    </div>
</footer>

</body>
</html>
