<?php
/**
 * 1. Le dossier SQL contient l'export de ma table user.
 * 2. Trouvez comment importer cette table dans une des bases de données que vous avez créées, si vous le souhaitez vous pouvez en créer une nouvelle pour cet exercice.
 * 3. Assurez vous que les données soient bien présentes dans la table.
 * 4. Créez votre objet de connexion à la base de données comme nous l'avons vu
 * 5. Insérez un nouvel utilisateur dans la base de données user
 * 6. Modifiez cet utilisateur directement après avoir envoyé les données ( on imagine que vous vous êtes trompé )
 */

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'table_test_php';

// TODO Votre code ici.
try {
    $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
        INSERT INTO user (nom, prenom, rue, numero, code_postal, ville, pays, mail)
        VALUES ('Marle', 'Sylvie', 'rue de la fontaine', 20, 59610, 'Fourmies', 'France', 'helio@live.fr')
        ";

    $bdd->exec($sql);

}
catch (PDOException $e) {
    echo "Une erreur est survenue : ".$e->getMessage()."<br>";
    $bdd->rollBack();
}

$id = $bdd->lastInsertId();

$stm = $bdd->prepare("
    UPDATE user SET nom='Bataille' WHERE id = $id
");

$stm->bindParam('nom', $nom);
$stm->bindParam('id', $id);

$stm->execute();

echo "user update";

/**
 * Théorie
 * --------
 * Pour obtenir l'ID du dernier élément inséré en base de données, vous pouvez utiliser la méthode: $bdd->lastInsertId()
 *
 * $result = $bdd->execute();
 * if($result) {
 *     $id = $bdd->lastInsertId();
 * }
 */