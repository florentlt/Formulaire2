-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 05 fév. 2025 à 18:48
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `entreprise`
--

-- --------------------------------------------------------

--
-- Structure de la table `privileges`
--

CREATE TABLE `privileges` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `privileges`
--

INSERT INTO `privileges` (`id`, `name`, `created_at`) VALUES
(1, 'Réglages', '2025-02-02 10:42:24'),
(2, 'Intervenants', '2025-02-02 10:42:24'),
(3, 'Stagiaire', '2025-02-02 10:42:24'),
(4, 'Financeurs', '2025-02-02 10:42:24'),
(5, 'Contrats', '2025-02-02 10:42:24'),
(6, 'Candidats', '2025-02-02 10:42:24'),
(7, 'Utilitaires', '2025-02-02 10:42:24');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'LOUET', 'Florent', 'florent.louet@mail.com', '$2y$10$KPIrZqhmsIo54dPMBdJk4eyvS67covy4ezFjDHk5MCD55Ts7/T7dW', '2025-02-02 10:51:43', '2025-02-02 10:51:43');

-- --------------------------------------------------------

--
-- Structure de la table `user_privileges`
--

CREATE TABLE `user_privileges` (
  `user_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_privileges`
--

INSERT INTO `user_privileges` (`user_id`, `privilege_id`) VALUES
(1, 2),
(1, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD PRIMARY KEY (`user_id`,`privilege_id`),
  ADD KEY `privilege_id` (`privilege_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user_privileges`
--
ALTER TABLE `user_privileges`
  ADD CONSTRAINT `user_privileges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_privileges_ibfk_2` FOREIGN KEY (`privilege_id`) REFERENCES `privileges` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
