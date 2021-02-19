<?php
include_once "session-init.php";
require_once 'connection.php';

$goodUser = false;

$postedLogin = htmlspecialchars($_POST["user_name"] ?? false);
$postedPassword = htmlspecialchars($_POST["user_mp"] ?? false);

$sql = 'SELECT * FROM `users`';
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $users) {
    if ($users["user_name"] === $postedLogin and $users["user_mp"] === $postedPassword) {
        $goodUser = $users;
        break;
    }
}
if (isset($_POST["ok"])) {
    if ($goodUser) {
        $_SESSION["user_name"] = $goodUser;
        header("Location: manip.php");
        exit;
    } else {
        echo "Mot de passe ou login erronés !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>espace cosy de l'admin</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="admin">
  <main>
      <h2> Bienvenue du coté obscur </h2>
      <p> Merci de rentrer votre identifiant et mot de passe </p>
    <form action="admin.php" method="post">
      <label for="user_name">Login</label>
      <input type="text" name="user_name" id="login" required>
      <label for="user_mp">Mot de passe</label>
      <input type="password" name="user_mp" id="password" required>
      <input type="submit" name="ok" id="valider" value="valider">
    </form>
  </main>
</body>

</html>