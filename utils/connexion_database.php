<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=qcm', 'root', '');
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}


