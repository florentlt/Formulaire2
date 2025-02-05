<?php
session_start(); 
require_once 'db.php';

// Vérifie si la session est active et si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); 
    exit();
}

// Récupère les privilèges de l'utilisateur depuis la base de données
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT p.name FROM privileges p 
                        JOIN user_privileges up ON up.privilege_id = p.id
                        WHERE up.user_id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$privileges = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Convertit les privilèges en JSON pour l'utiliser dans le JavaScript
$privilegesJson = json_encode($privileges);
?>
