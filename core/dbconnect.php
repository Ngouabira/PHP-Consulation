<?php

//Utilisation de mysqli pour la connexion à la base de données

$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cours_php";

$dbconnexion = new mysqli($host, $username, $password, $dbname);

if ($dbconnexion->connect_error) {
    die("Connection failed: " . $dbconnexion->connect_error);
}
