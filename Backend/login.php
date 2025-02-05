<?php
session_start();
require_once 'db.php';
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et décoder le JSON envoyé
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'];
    $password = $data['password'];

    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Stocke l'ID en session

        // Retourne une réponse JSON
        echo json_encode(["message" => "Connexion réussie", "redirect" => "../Frontend/page1.php"]);
    } else {
        echo json_encode(["error" => "Identifiants incorrects"]);
    }
    exit();
}
?>
