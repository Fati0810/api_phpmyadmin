<?php
$host = "localhost";
$dbname = "test_app";
$user = "root";
$password = "";
try {
    $conn = new mysqli($host, $user, $password, $dbname);
    // Vérifiez si la connexion a échoué
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    // Vous pouvez ajouter d'autres opérations ici
} catch (Exception $e) {
    // Affichez un message d'erreur détaillé
    echo "Une erreur est survenue : " . $e->getMessage();
}
?>