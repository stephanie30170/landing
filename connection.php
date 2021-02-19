 
        <?php
            $servername = 'localhost';
            $username = 'stephanie';
            $password = 'fif30170simplon!!!';
            $bdname = 'landing';


try{
    // Connexion à la bdd
    $db = new PDO("mysql:host=$servername;dbname=$bdname", $username, $password);
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e){
    echo 'Erreur : '. $e->getMessage();
    die();
}

?>