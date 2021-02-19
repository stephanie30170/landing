
<?php


// On inclut la connexion à la base
require_once 'connection.php';

if (isset($_POST)) {
    if (isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['lien_name']) && !empty($_POST['lien_name'])
        && isset($_POST['lien_url']) && !empty($_POST['lien_url'])
        && isset($_POST['lien_logo']) && !empty($_POST['lien_logo'])) {

        $id = strip_tags($_POST['id']);
        $name = strip_tags($_POST['lien_name']);
        $url = strip_tags($_POST['lien_url']);
        $logo = strip_tags($_POST['lien_logo']);

        $sql = 'UPDATE`liens`SET `lien_name`=:lien_name, `lien_url`=:lien_url, `lien_logo`=:lien_logo WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':lien_name', $name, PDO::PARAM_STR);
        $query->bindValue(':lien_url', $url, PDO::PARAM_STR);
        $query->bindValue(':lien_logo', $logo, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = " modifié !";

    }
}
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `liens` WHERE `id`=:id;';
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $liens = $query->fetch();
    if (!$liens) {
        header('Location: admin.php');
    }
} else {
    header('Location: admin.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier</title>
</head>
<body>
    <h1>Modifier un lien<h1>
    <form method="post">
<p>
    <label for="lien_name">Nom du lien</label>
    <input type="text" name="lien_name" id="lien_name" value="<?=$liens['lien_name']?>">
</p>
<p>
    <label for="lien_url">URL du lien</label>
    <input type="text" name="lien_url" id="lien_url" value="<?=$liens['lien_url']?>">
</p>
<p>
    <label for="lien_logo">URL du logo</label>
    <input type="text" name="lien_logo" id="lien_logo"value="<?=$liens['lien_logo']?>">
</p>

<input type="hidden" name="id" value="<?=$liens['id']?>">
<input type="submit" name="info_ok" value="Enregistrer">
    <button><a href="manip.php">Retour</a></button>


</form>

</body>
</html>

