<?php

include_once "session-init.php";
if (!isset($_SESSION["user_name"])) {
    // bye
    header("Location: index.php");
    exit; // exit après une redirection
}

require_once 'connection.php';
if (isset($_POST['info_ok']) && !empty($_POST['info_ok'])) {
    $infoid = $_POST['info_id'];
    $infomot = $_POST['info_mot'];
    $infointro = $_POST['info_intro'];
    $infometier = $_POST['info_metier'];
    $infofond = $_POST['info_fond'];
    $infoctexte = $_POST['info_ctexte'];
    $infotitre = $_POST['info_titre'];
    $infometa = $_POST['info_meta'];

    $sql = 'UPDATE`infos`SET `info_mot`=:info_mot, `info_intro`=:info_intro, `info_metier`=:info_metier,
            `info_fond`=:info_fond, `info_ctexte`=:info_ctexte, `info_titre`=:info_titre, `info_meta`=:info_meta WHERE `info_id`=:info_id;';

    $query = $db->prepare($sql);

    $query->bindValue(':info_id', $infoid, PDO::PARAM_INT);
    $query->bindValue(':info_mot', $infomot, PDO::PARAM_STR);
    $query->bindValue(':info_intro', $infointro, PDO::PARAM_STR);
    $query->bindValue(':info_metier', $infometier, PDO::PARAM_STR);
    $query->bindValue(':info_fond', $infofond, PDO::PARAM_STR);
    $query->bindValue(':info_ctexte', $infoctexte, PDO::PARAM_STR);
    $query->bindValue(':info_titre', $infotitre, PDO::PARAM_STR);
    $query->bindValue(':info_meta', $infometa, PDO::PARAM_STR);

    $query->execute();

    $_SESSION['message'] = "ok c'est modifié !";

}
$sql = 'SELECT * FROM `infos`;';
$query = $db->prepare($sql);
$query->execute();
$infos = $query->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier pour l'admin</title>
</head>
<body>
    <form action="" method="post">
<p>
    <label for="info_mot">Mot d'accueil</label>
    <input type="text" name="info_mot" id="infomot" value="<?=$infos['info_mot']?>">
</p>
<p>
    <label for="info_intro">Intro de présentation</label>
    <input type="text" name="info_intro" id="intro" value="<?=$infos['info_intro']?>">
</p>
<p>
    <label for="info_metier">Métier</label>
    <input type="text" name="info_metier" id="metier "value="<?=$infos['info_metier']?>">
</p>
<p>
    <label for="info_fond">Couleur de fond de la page</label>
    <input type="color" name="info_fond" id="fond" value="<?=$infos['info_fond']?>">
</p>
<p>
    <label for="info_ctexte">Couleur du texte</label>
    <input type="color" name="info_ctexte" id="texte" value="<?=$infos['info_ctexte']?>">
</p>
<p>
    <label for="info_titre">Titre de la page</label>
    <input type="text" name="info_titre" id="titre" value="<?=$infos['info_titre']?>">
</p>
<p>
    <label for="info_meta">Méta description ici</label>
    <input type="text" name="info_meta" id="meta" value="<?=$infos['info_meta']?>">

</p>
<input type="hidden" name="info_id" value="<?=$infos['info_id']?>">
    <input type="submit" name="info_ok" value="Enregistrer">
    <button><a href="index.php">Retour</a></button>
</form>
<?php
$sql = 'SELECT * FROM `liens`;';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<body class="manip">


    <table>
    <thead>
        <th>id</th>
        <th>Nom</th>
        <th>URL du réseaux</th>
        <th>lien image logo</th>
        <th>image logo</th>
    </thead>
    <tbody>
    <?php
foreach ($result as $liens) {
    ?>

            <tr>
                <td style ="border : 2px solid silver"><?=$liens['id']?> </td>
                <td style ="border : 2px solid silver"><?=$liens['lien_name']?></td>
                <td style ="border : 2px solid silver"><?=$liens['lien_url']?></td>
                <td style ="border : 2px solid silver"><?=$liens['lien_logo']?></td>
                <td style ="border : 2px solid silver"><img src="<?=$liens['lien_logo']?>"width=100px/></td>
                <td style ="border : 2px solid silver"><a href="modifierlien.php?id= <?=$liens['id']?>">Modifier</a>
                <a href="supprimerlien.php?id=<?=$liens['id']?>">Supprimer</a></td>
            </tr>

    <?php
}
?>
    </tbody>
    </table>
    <button><a href="ajouterlien.php">Ajouter</a></button>
<a href="fermer.php">deconnexion</a>
</body>
</html>

