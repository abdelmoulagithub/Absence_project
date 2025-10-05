<?php
$host = 'localhost'; //le serveur de la B.d.D
$dbname = 'sms_db'; // Mettre ici le nom de votre BD
$username = 'root'; 
$password = 'WJ28@krhps'; // Mettre ici le bon mot de passe
// PDO : Php Data Object 
try {
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
// echo "<button class='btn btn-success p-1' >connexion with success</button>";
} 
catch (PDOException $e) // $e est une variable de type Objet, qui recupere l'erreur 
{
die("Impossible de se connecter à la base de donnée $dbname :" . $e->getMessage());
}
// getMessage() est une methode (fonction) qui retourne le message d'erreur
?>