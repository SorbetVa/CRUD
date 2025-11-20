<?php
require_once 'functions.php';

if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $food_id = (int) $_GET['id'];
    if (delete_food($food_id)) {
        header('Location: index.php?deleted=1');
        exit;
    } else {
        echo "Erreur";
    }
} else {
    echo "ID pas bon";
}