<?php

// Paramètres de connexion à la base de données (à adapter en fonction de votre environnement);

define('HOST', 'localhost');
define('USER', 'root');
define('DBNAME', 'savory_savers_dev');
define('PASSWORD', ''); // windows (Mamp le mot de passe c'est 'root')

/**
 * Fonction de connexion à la base de données
 *
 * @return \PDO
 */
function db_connect(): PDO
{
    try {
        /**
         * Data Source Name : chaine de connexion à la base de données
         * Elle permet de renseigner le domaine du serveur de la base de données, le nom de la base de données cible et l'encodage de données pendant leur transport
         * @var string
         */
        $dsn =  'mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8';

        return new PDO($dsn, USER, PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (\PDOException $ex) {
        echo sprintf('La demande de connexion à la base de donnée a échouée avec le message %s', $ex->getMessage());
        exit(0);
    }
}


/**
 * Fonction qui permet de récupérer le tableau des enregistrements de la table des liens
 * @return array
 */
function get_all_foods(): array
{
    $db = db_connect();
    $sql = "SELECT * FROM foods ORDER BY expiration_date LIMIT 5";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}



/**
 * Fonction qui permet de récupérer un enregistrement à partir de son identifiant dans la table foods
 * @param integer $food_id
 * @return array
 */
function get_food_by_id($food_id)
{
    $db = db_connect();
    $sql = "SELECT * FROM foods WHERE food_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$food_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}


/**
 * Fonction qui permet de modifier un enregistrement dans la table foods
 * @param array $data: ['food_id' => 1, 'name' => 'Fromage', 'expiration_date' => '2023-12-05', 'comment' => '']
 * @return bool
 */
function update_food($data)
{
$db = db_connect();
$sql = "UPDATE foods SET name = ?, expiration_date = ?, comment = ? WHERE food_id = ?";
$stmt = $db->prepare($sql);
return $stmt->execute([
    $data['name'],
    $data['expiration_date'],
    $data['comment'],
    $data['id']
    ]);
}


/**
 * Fonction qui permet de d'enregistrer un nouvel aliment dans la table foods
 * @param array $data: ['name' => 'Fromage', 'expiration_date' => '2023-12-05', 'comment' => '']
 * @return bool
 */
function create_food($data)
{
    $db = db_connect();
    $sql = "INSERT INTO foods (name, expiration_date, comment) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);

    return $stmt->execute([
        $data['name'],
        $data['expiration_date'],
        $data['comment']
    ]);
}
/**
 * Fonction qui permet de supprimer l'enregistrement dont l'identifiant est $food_id dans la table food
 *@param integer $food_id
 * @return bool
 */
function delete_food($food_id)
{
    $db = db_connect();
    $sql = "DELETE FROM foods WHERE food_id = ?";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$food_id]);
}





