
<?php
require_once('connection.php');

if(isset($_GET['lien_id']) && !empty($_GET['lien_id'])){
    $id = strip_tags($_GET['lien_id']);
    $sql = "DELETE FROM `liens` WHERE `lien_id`=:lien_id;";

    $query = $db->prepare($sql);

    $query->bindValue(':lien_id', $id, PDO::PARAM_INT);
    $query->execute();

    header('Location: manip.php');
}

