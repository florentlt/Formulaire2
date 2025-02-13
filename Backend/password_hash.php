<?php

// Fonction pour générer un sel dynamique
function generateDynamicSalt($length = 64) {
    $uuid = bin2hex(random_bytes(16));
    $allCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
    
    // Crée un sel aléatoire de longueur fixe
    $salt = '';
    for ($i = 0; $i < $length - 16; $i++) {
        $salt .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
    }

   // Ajout d'un UUID au sel pour améliorer l'unicité 
    $salt .= $uuid;
    
    return $salt;
}


// Fonction de hachage avec libsodium et itérations ajustables
function hashPasswordWithBlake2($password, $salt, $iterations = 100) {
    // Combiner le mot de passe et le sel
    $passwordSalted = $salt . $password;

    // Hachage du mdp
    $hashedPassword = sodium_crypto_generichash($passwordSalted, '', 64); // 64 bytes = 512 bits

    // Appliquer des itérations pour augmenter la sécurité
    for ($i = 0; $i < $iterations; $i++) { 
        $hashedPassword = sodium_crypto_generichash($hashedPassword, '', 64);
    }

    return base64_encode($hashedPassword);
}

?>
