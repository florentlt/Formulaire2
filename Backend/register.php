<?php
require_once 'db.php'; // Connexion à la base de données
require_once 'password_hash.php'; // Inclusion du fichier de gestion des mots de passe

header('Content-Type: application/json');

// Vérifier si la méthode est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données JSON envoyées
    $data = json_decode(file_get_contents("php://input"), true);

    // Retire tous les caractères invalides d'un email.
    $email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($data['password']);

    // Vérifier si l'email existe déjà dans la base de données
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        http_response_code(400); // Mauvaise requête
        echo json_encode(['error' => 'Cet email est déjà utilisé.']);
        exit;
    }

    // Validation du mot de passe
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        http_response_code(400); 
        echo json_encode(['error' => 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un symbole.']);
        exit;
    }

    // Générer un sel unique pour l'utilisateur
    $salt = generateDynamicSalt();

    // Hacher le mot de passe et le sel généré
    $hashedPassword = hashPasswordWithBlake2($password, $salt);

    // Insertion de l'utilisateur dans la base de données
    $stmt = $pdo->prepare("INSERT INTO users (email, password, salt) VALUES (?, ?, ?)");
    if ($stmt->execute([$email, $hashedPassword, $salt])) {
        echo json_encode(['success' => 'Inscription réussie !']);
    } else {
        http_response_code(500); 
        echo json_encode(['error' => 'Erreur lors de l\'inscription.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée.']);
}
?>
