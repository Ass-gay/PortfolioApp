-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 14 juil. 2026 à 00:27
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
-- Base de données : `mafolio_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `niveau` int(11) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id`, `nom`, `description`, `niveau`, `etat`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(7, 'Développement Backend', 'Création de la logique serveur et gestion des fonctionnalités d une application web', 47, 1, '2026-04-10 11:26:54', '2026-04-10 11:32:39', NULL, 1, 1, NULL),
(8, 'Responsive Design', 'Adaptation des sites web pour tous les écrans téléphone tablette ordinateur', 75, 1, '2026-04-10 11:35:04', NULL, NULL, 1, NULL, NULL),
(9, 'Maintenance Web', 'Correction des bugs mise à jour et amélioration des sites existants', 80, 1, '2026-04-10 11:35:45', NULL, NULL, 1, NULL, NULL),
(10, 'Gestion de Base de Données', 'Organisation et manipulation des données avec MySQL pour les applications web', 50, 1, '2026-04-10 11:36:30', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `nom` varchar(500) NOT NULL,
  `email` varchar(900) NOT NULL,
  `sujet` varchar(899) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `nom`, `email`, `sujet`, `message`, `created_at`) VALUES
(1, 'ass gaye', 'elzogaye234@gmail.com', 'rien pour instant', 'merci beaucoup', '2026-04-11 00:03:26');

-- --------------------------------------------------------

--
-- Structure de la table `projetservices`
--

CREATE TABLE `projetservices` (
  `id` int(11) NOT NULL,
  `titre` varchar(900) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(700) DEFAULT NULL,
  `type` varchar(200) NOT NULL DEFAULT 'Projet',
  `etat` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projetservices`
--

INSERT INTO `projetservices` (`id`, `titre`, `description`, `photo`, `type`, `etat`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(4, 'Développement Web', 'Création de sites web modernes rapides et responsives adaptés à tous les écrans mobile tablette ordinateur', '69d7b1a70dcf1_software-development.png', 'Service', 1, '2026-04-09 14:03:19', NULL, NULL, 1, NULL, NULL),
(5, 'Design Graphique', 'Conception de visuels professionnels  logos affiches cartes de visite et contenus pour réseaux sociaux', '69d7b1d430c05_outils-de-conception.png', 'Service', 1, '2026-04-09 14:04:04', NULL, NULL, 1, NULL, NULL),
(6, 'Photographie Professionnelle', 'Prise de photos de haute qualité pour événements portraits produits et projets personnels ou professionnels', '69d7b2051cc8f_appareil-photo-professionnel.png', 'Service', 1, '2026-04-09 14:04:53', NULL, NULL, 1, NULL, NULL),
(7, 'Maintenance de Sites Web', 'Mise à jour correction de bugs et amélioration des performances des sites déjà existants', '69d7b22e342a1_reparation-de-site-web.png', 'Service', 1, '2026-04-09 14:05:34', NULL, NULL, 1, NULL, NULL),
(8, 'Développement Applications Web PHP', 'Création applications web dynamiques avec PHP et base de données gestion utilisateurs portfolio etc', '69d7b26ad76ad_langage-de-programmation-php.png', 'Service', 1, '2026-04-09 14:06:34', NULL, NULL, 1, NULL, NULL),
(9, 'Marketing Digital', 'Aide à la visibilité en ligne gestion des réseaux sociaux publicité digitale et optimisation de présence web', '69d7b29630cd2_digital-marketing.png', 'Service', 1, '2026-04-09 14:07:18', NULL, NULL, 1, NULL, NULL),
(10, 'Affiche Événement Religieux', 'Foi et inspiration', '69d7c40d5101b_C.El.H.Mor.jpg', 'Projet', 1, '2026-04-09 15:21:49', NULL, NULL, 1, NULL, NULL),
(11, 'Affiche Service de Livraison', 'Rapide et fiable', '69d7c44001a65_affiche Moto.jpg', 'Projet', 1, '2026-04-09 15:22:40', NULL, NULL, 1, NULL, NULL),
(12, 'Affiche Vente de Poulet', 'Saveur irrésistible', '69d7cd3c8c7e2_poulai.jpg', 'Projet', 1, '2026-04-09 15:24:15', '2026-04-09 16:01:00', NULL, 1, 1, NULL),
(13, 'Affiche Invitation Mariage', 'Élégance unique', '69d7cd6f9c459_tak.jpg', 'Projet', 1, '2026-04-09 15:25:33', '2026-04-09 16:01:51', NULL, 1, 1, NULL),
(14, 'Affiche Salon de Maquillage', 'Beauté sublimée', '69d7c53d29b94_makeup.jpg', 'Projet', 1, '2026-04-09 15:26:53', NULL, NULL, 1, NULL, NULL),
(15, 'Affiche Restaurant Gastronomique', 'Délices raffinés', '69d7c5829f172_pizaa.jpg', 'Projet', 1, '2026-04-09 15:28:02', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `adresse` varchar(900) NOT NULL,
  `telephone` varchar(700) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `email` varchar(600) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'Admin',
  `etat` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `adresse`, `telephone`, `photo`, `email`, `password`, `role`, `etat`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Ass gaye', 'Nayobe', '787183527', 'default.jpg', 'ag@gmail.com', '@ag12345', 'Admin', 1, '2026-04-08 13:21:59', NULL, NULL, NULL, NULL, NULL),
(2, 'Abdou', 'Louga', '786785645', '69d918f67f686_IMG-20260126-WA0132.jpg', 'abdou@gmail.com', '$2y$10$LXHwssx0h6cJYXOMakuvUOKN4aiaU755F6sa5AJ.DDK8yJeiOKB32', 'User', 1, '2026-04-10 15:32:07', '2026-04-10 15:57:14', '2026-04-10 15:57:05', 1, 1, 1),
(3, 'ameth', 'dakar', '765434566', '69d91e342d826_ass.jpg', 'gaye@gmail.com', '$2y$10$eglQ9Ri1CQvxi3zWKDe48.4Nx7z3UpPmLGvgMOnhQ2YIC7U/9VGAS', 'Admin', 1, '2026-04-10 15:58:44', NULL, NULL, 1, NULL, NULL),
(4, 'dada fall', 'niomre', '788999887', '69d91ea71aa76_Ag.jpg', 'fall@gmail.com', '$2y$10$8kwNtB2ILqPPvbZfORGM8OqbbkQ2sHRzPyEVbXeZnbARbKma8XqXq', 'Admin', 1, '2026-04-10 16:00:39', NULL, NULL, 1, NULL, NULL),
(5, 'fatou gaye', 'Nayobe', '786543455', '69d920ba32faa_Ag.jpg', 'fatou@gmail.com', '$2y$10$2T0ctLnV3DqlbDU1moPwbuJ6.4OSQQAKQLK9nlqL/RE4nQqKVBbEi', 'Admin', 1, '2026-04-10 16:09:30', '2026-04-10 16:14:11', NULL, 1, 5, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projetservices`
--
ALTER TABLE `projetservices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted_by` (`deleted_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `competences`
--
ALTER TABLE `competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `projetservices`
--
ALTER TABLE `projetservices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `competences`
--
ALTER TABLE `competences`
  ADD CONSTRAINT `competences_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `competences_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `competences_ibfk_3` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `projetservices`
--
ALTER TABLE `projetservices`
  ADD CONSTRAINT `projetservices_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `projetservices_ibfk_2` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
