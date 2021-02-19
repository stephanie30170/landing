
<?php

require_once 'connection.php';

$sql = 'SELECT * FROM `infos`';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $infos) {
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description = <?php echo $infos['info_meta'] ?>>
    <link rel="stylesheet" href="style.css">
    <title><?php echo $infos['info_titre'] ?></title>
</head>
<style>
    body {
        background-color:<?php echo $infos['info_fond'] ?>;
        color: <?php echo $infos['info_ctexte'] ?>;
    }
</style>
<body class="landing">

    <?php
echo '<div class = intro>' .
        $infos['info_mot'] . '</br>' .
        $infos['info_intro'] . '</br>' .
        $infos['info_metier'] . '</br>' .
        'Retrouvez moi sur : <br></div>';

}

$sql = 'SELECT * FROM `liens`';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $liens) {

    echo '<div class = reseaux><a href="' . $liens['lien_url'] . '">' . $liens['lien_name'] . '</a>' .
        '<img src="' . $liens['lien_logo'] . '"width=100px />';
}
?>

</body>
</html>
