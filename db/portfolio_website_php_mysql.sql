-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 22 mars 2025 à 19:22
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `portfolio_website_php_mysql`
--

-- --------------------------------------------------------

--
-- Structure de la table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cv_link` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `about`
--

INSERT INTO `about` (`id`, `user_id`, `full_name`, `title`, `description`, `cv_link`, `date`) VALUES
(1, 1, 'Toscani Tenekeu', 'Développeur Full-Stack', 'Passionné par le développement web, je conçois et réalise des applications robustes et évolutives en utilisant PHP, JavaScript, MySQL et d\'autres technologies modernes. Mon expertise me permet d\'accompagner les entreprises dans leur transformation digitale.', 'https://toscani-tenekeu.onrender.com/CV.pdf', '2025-03-22 17:19:55');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `email`, `message`) VALUES
(1, 1, 'client@example.com', 'Bonjour, je suis intéressé par vos services de développement web. Merci de me contacter pour discuter de mon projet.');

-- --------------------------------------------------------

--
-- Structure de la table `experiences`
--

CREATE TABLE `experiences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `title_icon` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `company_icon` varchar(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `tasks_description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `experiences`
--

INSERT INTO `experiences` (`id`, `user_id`, `title`, `title_icon`, `company`, `company_icon`, `start_date`, `end_date`, `tasks_description`, `date`) VALUES
(1, 1, 'Développeur Full-Stack', 'fa-code', 'Tech Company', 'fa-buildin', '2018-01-01', '2020-12-31', 'Développement d\'applications web, gestion de bases de données et intégration d\'API.', '2025-03-22 17:19:55'),
(2, 1, 'Chef de Projet IT', 'fa-project-diagram', 'Innovative Solutions', 'fa-briefca', '2021-01-01', NULL, 'Coordination d\'équipes de développement, gestion de projets agiles et optimisation des processus.', '2025-03-22 17:19:55');

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `tech_stack` text NOT NULL,
  `soucre_code_link` text NOT NULL,
  `live_demo_link` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `title`, `description`, `tech_stack`, `soucre_code_link`, `live_demo_link`, `date`) VALUES
(1, 1, 'Portfolio Web', 'Site web personnel présentant mes projets, compétences et mon parcours professionnel.', 'PHP, MySQL, JavaScript, CSS', 'https://github.com/toscani-tenekeu/portfolio', 'https://toscani-tenekeu.onrender.com', '2025-03-22 17:19:55'),
(2, 1, 'Application de Gestion', 'Application de gestion des tâches et suivi de projets pour optimiser les process d’entreprise.', 'Laravel, Vue.js, MySQL', 'https://github.com/toscani-tenekeu/gestion-app', 'https://toscani-tenekeu.onrender.com/gestion', '2025-03-22 17:19:55'),
(3, 1, 'Portfolio Web', 'Site web personnel présentant mes projets, compétences et mon parcours professionnel.', 'PHP, MySQL, JavaScript, CSS', 'https://github.com/toscani-tenekeu/portfolio', 'https://toscani-tenekeu.onrender.com', '2025-03-22 17:26:08'),
(4, 1, 'Application de Gestion', 'Application de gestion des tâches et suivi de projets pour optimiser les process d’entreprise.', 'Laravel, Vue.js, MySQL', 'https://github.com/toscani-tenekeu/gestion-app', 'https://toscani-tenekeu.onrender.com/gestion', '2025-03-22 17:26:08'),
(5, 1, 'Plateforme E-commerce', 'Développement d’une plateforme e-commerce complète avec gestion des produits, panier et paiement en ligne.', 'Symfony, React, PostgreSQL, Stripe API', 'https://github.com/toscani-tenekeu/ecommerce-platform', 'https://toscani-tenekeu.onrender.com/ecommerce', '2025-03-22 17:26:08'),
(6, 1, 'Application Chat en Temps Réel', 'Réalisation d’une application de chat instantané intégrant WebSocket pour une communication en temps réel.', 'Node.js, Socket.IO, Angular, MongoDB', 'https://github.com/toscani-tenekeu/chat-app', 'https://toscani-tenekeu.onrender.com/chat', '2025-03-22 17:26:08'),
(7, 1, 'API RESTful pour Mobile', 'Création d’une API REST sécurisée pour alimenter une application mobile de gestion de tâches.', 'Python, Django REST Framework, MySQL', 'https://github.com/toscani-tenekeu/mobile-api', 'https://toscani-tenekeu.onrender.com/api', '2025-03-22 17:26:08');

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `skill_name` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `skills`
--

INSERT INTO `skills` (`id`, `user_id`, `category_id`, `skill_name`, `icon`, `date`) VALUES
(1, 1, 1, 'PHP', 'fab fa-php', '2025-03-22 17:19:56'),
(2, 1, 1, 'JavaScript', 'fab fa-js', '2025-03-22 17:19:56'),
(6, 1, 2, 'Vue.js', 'fab fa-vuejs', '2025-03-22 17:19:56'),
(7, 1, 3, 'MySQL', 'fas fa-database', '2025-03-22 17:19:56'),
(9, 1, 4, 'Git', 'fab fa-git-alt', '2025-03-22 17:19:56'),
(10, 1, 4, 'Docker', 'fab fa-docker', '2025-03-22 17:19:56'),
(13, 1, 1, 'TypeScript', 'fab fa-js', '2025-03-22 17:28:14'),
(14, 1, 1, 'HTML5', 'fab fa-html5', '2025-03-22 17:28:14'),
(15, 1, 1, 'CSS3', 'fab fa-css3-alt', '2025-03-22 17:28:14'),
(16, 1, 1, 'Python', 'fab fa-python', '2025-03-22 17:28:14'),
(17, 1, 2, 'Laravel', 'fab fa-laravel', '2025-03-22 17:38:22'),
(19, 1, 2, 'React.js', 'fab fa-react', '2025-03-22 17:39:29'),
(22, 1, 2, 'jQuery', 'fab fa-js', '2025-03-22 17:28:15'),
(25, 1, 3, 'PostgreSQL', 'fas fa-database', '2025-03-22 17:28:15'),
(26, 1, 3, 'MongoDB', 'fas fa-database', '2025-03-22 17:28:15'),
(27, 1, 3, 'MariaDB', 'fas fa-database', '2025-03-22 17:28:15'),
(28, 1, 3, 'SQLite', 'fas fa-database', '2025-03-22 17:28:15'),
(33, 1, 5, 'CI/CD', 'fas fa-cogs', '2025-03-22 17:28:15'),
(34, 1, 5, 'Kubernetes', 'fas fa-server', '2025-03-22 17:28:15'),
(35, 1, 5, 'Jenkins', 'fas fa-tools', '2025-03-22 17:28:15'),
(36, 1, 6, 'Swift', 'fab fa-swift', '2025-03-22 17:28:15'),
(37, 1, 6, 'Kotlin', 'fab fa-android', '2025-03-22 17:28:15'),
(38, 1, 6, 'Flutter', 'fas fa-mobile-alt', '2025-03-22 17:28:15'),
(39, 1, 6, 'React Native', 'fab fa-react', '2025-03-22 17:28:15'),
(40, 1, 7, 'AWS', 'fab fa-aws', '2025-03-22 17:28:15'),
(41, 1, 7, 'Google Cloud', 'fab fa-google', '2025-03-22 17:28:15'),
(42, 1, 7, 'Azure', 'fab fa-microsoft', '2025-03-22 17:28:15'),
(43, 1, 8, 'OWASP', 'fas fa-shield-alt', '2025-03-22 17:28:15'),
(44, 1, 8, 'Penetration Testing', 'fas fa-lock', '2025-03-22 17:28:15'),
(45, 1, 8, 'SSL/TLS', 'fas fa-key', '2025-03-22 17:28:15'),
(46, 1, 9, 'Pandas', 'fas fa-chart-line', '2025-03-22 17:28:15'),
(47, 1, 9, 'NumPy', 'fas fa-square-root-alt', '2025-03-22 17:28:15'),
(48, 1, 9, 'TensorFlow', 'fas fa-brain', '2025-03-22 17:28:15'),
(49, 1, 9, 'Scikit-learn', 'fas fa-brain', '2025-03-22 17:28:15'),
(50, 1, 10, 'Slack', 'fab fa-slack', '2025-03-22 17:28:15'),
(51, 1, 10, 'Trello', 'fab fa-trello', '2025-03-22 17:28:15'),
(52, 1, 10, 'Microsoft Teams', 'fab fa-microsoft', '2025-03-22 17:28:15'),
(53, 1, 3, 'Firebase', 'fab fa-fire', '2025-03-22 17:40:41');

-- --------------------------------------------------------

--
-- Structure de la table `skills_categories`
--

CREATE TABLE `skills_categories` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `skills_categories`
--

INSERT INTO `skills_categories` (`id`, `date`, `category_name`) VALUES
(1, '2025-03-22 17:28:14', 'Langages de programmation'),
(2, '2025-03-22 17:28:14', 'Frameworks & Bibliothèques'),
(3, '2025-03-22 17:28:14', 'Bases de données'),
(4, '2025-03-22 17:28:14', 'Outils & Environnements'),
(5, '2025-03-22 17:28:14', 'DevOps'),
(6, '2025-03-22 17:28:14', 'Développement Mobile'),
(7, '2025-03-22 17:28:14', 'Cloud & Hébergement'),
(8, '2025-03-22 17:28:14', 'Sécurité'),
(9, '2025-03-22 17:28:14', 'Data Science & Big Data'),
(10, '2025-03-22 17:28:14', 'Communication & Collaboration');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `full_name`, `tel`, `age`, `password`) VALUES
(1, 'toscanisoft@gmail.com', 'Toscani Tenekeu', '0123456789', 30, '$2y$10$l3LaupQkNnwWZCFI1OjfiOVvWG1GRkKuubBzax2SBPh.vcbLmvVpO');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `skills_categories`
--
ALTER TABLE `skills_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `skills_categories`
--
ALTER TABLE `skills_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `about`
--
ALTER TABLE `about`
  ADD CONSTRAINT `about_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `skills_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skills_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
