<?php
include 'config.php';

// Préparation de la requête pour récupérer tous les utilisateurs
$query = "SELECT first_name, last_name, email, birthdate, address, postal_code, city, country FROM users";
$result = $conn->query($query);

if ($result === false) {
    // Erreur dans la requête SQL
    echo json_encode(["status" => "error", "message" => $conn->error]);
    $conn->close();
    exit;
}

// Récupération des données dans un tableau
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

// Fermeture du résultat et de la connexion
$result->free();
$conn->close();

// Renvoi des données au format JSON
echo json_encode(["status" => "success", "users" => $users]);
?>

