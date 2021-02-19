<?php

require_once('connection.php');

if(isset($_POST)){
    if(isset($_POST['lien_name']) && !empty($_POST['lien_name'])
        && isset($_POST['lien_url']) && !empty($_POST['lien_url'])
        && isset($_POST['lien_logo']) && !empty($_POST['lien_logo'])){
            
            $lien_name = strip_tags($_POST['lien_name']);
            $lien_url = strip_tags($_POST['lien_url']);
            $lien_logo = strip_tags($_POST['lien_logo']);

            $sql = "INSERT INTO `liens` (`lien_name`, `lien_url`, `lien_logo`) VALUES (:lien_name, :lien_url, :lien_logo);";

            $query = $db->prepare($sql);

            $query->bindValue(':lien_name', $lien_name, PDO::PARAM_STR);
            $query->bindValue(':lien_url', $lien_url, PDO::PARAM_STR);
            $query->bindValue(':lien_logo', $lien_logo, PDO::PARAM_STR);

            $query->execute();

            $_SESSION['message'] = "lien ajouté avec succès !";
            header('Location: manip.php');
        }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter</title>
</head>
<body>
    <h2>Ajouter un lien<h2>
    <form method="post">
 <p>   
     <label for="lien_name">Nom du lien </label>
    <input type="text" name="lien_name" id="name">
</p>
<p> 
    <label for="lien_url">URL du lien</label>
    <input type="text" name="lien_url" id="url">
</p>
<p> 
    <label for="lien_logo">URL du logo</label>
    <input type="text" name="lien_logo" id="logo">
</p>

<button type="submit">Enregistrer</button>
<button><a href="manip.php">Retour</a></button>
   
</form>

</body>
</html>