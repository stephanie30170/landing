<?php

  // initialisation d'un cookie de session sécurisé
  @ini_set("session.cookie_httponly", 1); // preventing some XSS
  @ini_set("session.cookie_samesite", "Strict"); // preventing some CSRF
  session_name("sessionsteph-" . sha1($_SERVER["HTTP_USER_AGENT"])); // nonce
  session_start(); // création d'une session
  session_regenerate_id(); // preventing some session hijack

?>