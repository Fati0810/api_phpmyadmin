<?php
include 'config.php';

// Récupération des données POST
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$email = $_POST['email'] ?? '';
$email_confirm = $_POST['email_confirm'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$address = $_POST['address'] ?? '';
$postal_code = $_POST['postal_code'] ?? '';
$city = $_POST['city'] ?? '';
$country = $_POST['country'] ?? '';

// Vérification des paramètres requis
if ($first_name && $last_name && $email && $email_confirm && $birthdate && $address && $postal_code && $city && $country) {
    // Vérification que les emails correspondent
    if ($email !== $email_confirm) {
        echo json_encode(["status" => "error", "message" => "Les adresses e-mail ne correspondent pas."]);
        exit;
    }

    // Préparation de la requête SQL
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, birthdate, address, postal_code, city, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $birthdate, $address, $postal_code, $city, $country);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Utilisateur ajouté"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }

    // Fermeture de la déclaration
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Paramètres manquants"]);
}

// Fermeture de la connexion
$conn->close();
?>
