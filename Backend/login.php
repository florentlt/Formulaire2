<?php
session_start();
require_once 'db.php'; // Connexion à la base de données
require_once 'password_hash.php'; // Inclusion du fichier de gestion des mots de passe

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data['email'], $data['password'])) {
        echo json_encode(['error' => 'Tous les champs sont obligatoires.']);
        exit;
    }

    $email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($data['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['error' => 'Email invalide.']);
        exit;
    }

    // Vérifier si l'email existe
    $stmt = $pdo->prepare("SELECT id, password, salt FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        echo json_encode(['error' => 'Utilisateur non trouvé.']);
        exit;
    }

    // Extraire le sel et le mot de passe haché
    $salt = $user['salt'];
    $hashedPasswordInDb = $user['password'];

    // Hacher le mot de passe soumis avec le sel stocké
    $hashedPassword = hashPasswordWithBlake2($password, $salt); // Changement ici

    // Vérifier si le mot de passe haché correspond à celui stocké
    if ($hashedPassword === $hashedPasswordInDb) {
        $_SESSION['user_id'] = $user['id']; // Stocke l'ID en session

        // Retourne une réponse JSON
        echo json_encode(["message" => "Connexion réussie", "redirect" => "../Frontend/page1.php"]);
    } else {
        echo json_encode(["error" => "Identifiants incorrects"]);
    }
    exit();
}
?>
