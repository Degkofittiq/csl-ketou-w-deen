-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 09:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csl-ketou`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'A propos de nous', 'Problems trying to resolve the conflict between the two major realms of Classical physics: <br>\r\nNewtonian mechanics Problems trying to resolve the conflict between the two major realms of Classical physics: <br>\r\nNewtonian mechanics Problems trying to resolve the conflict', 'A propos de nous-67406dcf66f6e.png', '2024-11-22 11:41:03', '2024-11-22 13:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `little_title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `description`, `little_title`, `image`, `created_at`, `updated_at`) VALUES
(5, 'Peter Meadows', 'Esse lorem magnam arEsse lorem magnam arEsse lorem magnam arEsse lorem magnam arEsse lorem magnam arEsse lorem magnam arEsse lorem magnam ar', 'Esse lorem magnam ', '1732282029_Screenshot (1).png', '2024-11-22 13:27:09', '2024-11-22 13:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `contact_email`
--

CREATE TABLE `contact_email` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_email`
--

INSERT INTO `contact_email` (`id`, `name`, `email`, `subject`, `phone`) VALUES
(2, 'May Cote', 'myqufymazu@example.com', 'No subject', '+1 (927) 781-9232'),
(3, 'Stephanie Owens', 'pugygozi@example.com', 'No subject', '+1 (967) 978-1418'),
(4, 'Arthur Garrison', 'decakuruf@example.com', 'No subject', '+1 (724) 944-1631'),
(5, 'Tad Pollard', 'bijy@example.com', 'No subject', '+1 (585) 531-4602'),
(6, 'Kelly Small', 'zifapo@example.com', 'No subject', '+1 (349) 526-5051'),
(7, 'Raven Osborn', 'moropef@example.com', 'No subject', '+1 (974) 593-6887'),
(8, 'Allistair Hurst', 'rymu@example.com', 'No subject', '+1 (117) 614-4194'),
(9, 'Roary Dillon', 'gakuryqu@example.com', 'No subject', '+1 (654) 275-5287'),
(10, 'Kylan Harding', 'gevikeho@example.com', 'No subject', '+1 (386) 783-2047');

-- --------------------------------------------------------

--
-- Table structure for table `content_image_management`
--

CREATE TABLE `content_image_management` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_image_management`
--

INSERT INTO `content_image_management` (`id`, `name`, `path`, `type`) VALUES
(3, 'site_logo', 'csl_ketou_logo.png', 'image/png'),
(4, 'home_banner_image', 'woman-working-with-personal-trainer.jpg', 'image/png'),
(5, 'facilities_banner_image', 'man.jpg', 'image/png'),
(6, 'contact_banner_image', '[freepicdownloader.com]-men-with-battle-rope-battle-ropes-exercise-fitness-gym-crossfit-concept-gym-sport-rope-training-athlete-workout-normal.jpg', 'image/png');

-- --------------------------------------------------------

--
-- Table structure for table `content_text_management`
--

CREATE TABLE `content_text_management` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content_fr` text DEFAULT NULL,
  `content_en` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_text_management`
--

INSERT INTO `content_text_management` (`id`, `name`, `content_fr`, `content_en`) VALUES
(1, 'nav_link_1', 'Accueil', 'Home'),
(2, 'nav_link_2', 'A propos', 'A propos'),
(3, 'nav_link_3', 'Facilities', 'Facilities'),
(4, 'nav_link_4', 'Programmes', 'Programmes'),
(5, 'nav_link_5', 'Nous rejoindre', 'Nous rejoindre'),
(6, 'premier_titre_de_home', 'Vivez l\'Émotion du Sport et le Plaisir des Loisirs', 'Vivez l\'Émotion du Sport et le Plaisir des Loisirs'),
(7, 'premier_sous_titre_de_home', 'Plongez dans un univers où performance, détente et passion se rencontrent pour répondre à toutes vos envies sportives et récréatives.', 'Plongez dans un univers où performance, détente et passion se rencontrent pour répondre à toutes vos envies sportives et récréatives.'),
(8, 'bouton_nous_rejoindre', 'Nous rejoindre', 'Nous rejoindre'),
(9, 'clients_content_nombre', '15K', '15K'),
(10, 'clients_content_texte', 'Happy Customers', 'Happy Customers'),
(11, 'nombre_visiteurs', '150K', '150K'),
(12, 'texte_nombre_visiteurs', 'Monthly Visitors', 'Monthly Visitors'),
(13, 'nombre_de_pays', '15', '15'),
(14, 'nombre_de_pays_texte', 'Countries Worldwide', 'Countries Worldwide'),
(15, 'nombre_de_partenaires', '100 +', '100 +'),
(16, 'texte_de_nombre_de_partenaire', 'Top Partners', 'Top Partners'),
(17, 'titre_section_activites', 'Decouvrez nos activites', 'Decouvrez nos activites'),
(18, 'sous_titre_section_activites', 'Problems trying to resolve the conflict between\r\nthe two major realms of Classical physics: Newtonian mechanics', 'Problems trying to resolve the conflict between\r\nthe two major realms of Classical physics: Newtonian mechanics'),
(19, 'text_pour_le_bouton_de_bio', 'Cliquez pour voir la bio du fondateur', 'Cliquez pour voir la bio du fondateur'),
(20, 'titre_pour_la_section_evenement', 'Programmes et Evenements', 'Programmes et Evenements'),
(21, 'description_titre_pour_la_section_evenement', 'Problems trying to resolve the conflict between the two major realms of Classical physics:\r\n\r\n', 'Problems trying to resolve the conflict between the two major realms of Classical physics:\r\n\r\n'),
(22, 'souscrire_a_un_event_bouton_texte', 'SOUSCRIRE', 'SOUSCRIRE'),
(23, 'horaire_section_titre_jour', 'Jours', 'Jours'),
(24, 'horaire_section_titre_ouverture', 'Ouverture', 'Ouverture'),
(25, 'horaire_section_titre_fermeture', 'Fermeture', 'Fermeture'),
(26, 'footer_first_menu_title', 'Pages', 'Pages'),
(27, 'footer_second_menu_title', 'Facilities', 'Facilities'),
(28, 'facilities_premier_titre', 'Decouvrez nos activites', 'Decouvrez nos activites'),
(29, 'facilities_space_renting_titre', 'Space renting', 'Space renting'),
(30, 'contactez_nous_titre', 'Contactez-nous\r\n', 'Contactez-nous\r\n'),
(31, 'contactez_nous_description', 'Problems trying to resolve the conflict between the two major realms of Classical physics:\r\nNewtonian mechanics Problems trying to resolve the conflict between the two major realms of Classical physics:\r\nNewtonian mechanics Problems trying to resolve the conflict', 'Problems trying to resolve the conflict between the two major realms of Classical physics:\r\nNewtonian mechanics Problems trying to resolve the conflict between the two major realms of Classical physics:\r\nNewtonian mechanics Problems trying to resolve the conflict'),
(32, 'adresse_titre', 'Address', 'Address'),
(33, 'adresse_description', 'COTONOU BENIN', 'COTONOU BENIN'),
(34, 'phone_titre', 'Phone', 'Phone'),
(35, 'phone_content', '+229 99 99 99 99', '+229 99 99 99 99'),
(36, 'email_titre', 'Email', 'Email'),
(37, 'email_description', 'itti@gmail.com', 'itti@gmail.com'),
(38, 'soupscription_titre', 'Souscrivez pour recevoir\r\nnos informations', 'Souscrivez pour recevoir\r\nnos informations'),
(39, 'footer_third_menu_title', 'Contacts', 'Contacts');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `date`, `description`, `created_at`, `updated_at`) VALUES
(5, 'Ayoman', '2024-11-22', 'fowyrufwrcksgkhdsvkhyfvs', '2024-11-22 14:57:33', '2024-11-22 14:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `event_reservations`
--

CREATE TABLE `event_reservations` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_num` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_reservations`
--

INSERT INTO `event_reservations` (`id`, `client_name`, `client_num`, `event_id`, `created_at`, `updated_at`) VALUES
(4, 'hajapupeha@example.com', '222222222222222', 5, '2024-11-22 15:19:31', '2024-11-22 15:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `founder_bio`
--

CREATE TABLE `founder_bio` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `founder_bio`
--

INSERT INTO `founder_bio` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Jean ASSESSI', 'Jean ASSESSI est un entrepreneur passionné qui a fondé ce centre avec pour mission de créer une communauté dynamique. Avec plus de 10 ans d\'expérience dans le domaine, il est connu pour son engagement envers l\'excellence.', 'Jean ASSESSI-6740bad3d9459.png', '2024-11-22 17:09:39', '2024-11-22 17:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `hourlies`
--

CREATE TABLE `hourlies` (
  `id` int(11) NOT NULL,
  `days` varchar(50) NOT NULL,
  `h_open` time NOT NULL,
  `h_close` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--

CREATE TABLE `spaces` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spaces`
--

INSERT INTO `spaces` (`id`, `name`, `images`, `amount`, `created_at`, `updated_at`) VALUES
(3, 'Espace 1', 'Espace 1-674090377ee2e.png', 4000000.00, '2024-11-22 14:07:51', '2024-11-22 14:07:51'),
(11, 'Espace 13', 'Espace 1-674090377ee2e.png', 7760000.00, '2024-11-22 13:07:51', '2024-11-22 13:07:51'),
(14, 'Espace 111', 'Espace 1-674090377ee2e.png', 900000.00, '2024-11-22 13:07:51', '2024-11-22 13:07:51'),
(123, 'Espace 1988', 'Espace 1-674090377ee2e.png', 3400000.00, '2024-11-22 13:07:51', '2024-11-22 13:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `space_locations`
--

CREATE TABLE `space_locations` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_number` varchar(20) NOT NULL,
  `space_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `space_locations`
--

INSERT INTO `space_locations` (`id`, `client_name`, `client_email`, `client_number`, `space_id`, `created_at`, `updated_at`) VALUES
(2, 'vcdvc', 'ugds@kdlsd.com', '2345678987654', 11, '2024-11-22 16:25:18', '2024-11-22 16:25:18'),
(3, 'vcdvc', 'ugds@kdlsd.com', '2345678987654', 11, '2024-11-22 16:31:34', '2024-11-22 16:31:34'),
(4, 'vcdvc', 'ugds@kdlsd.com', '2345678987654', 11, '2024-11-22 16:32:22', '2024-11-22 16:32:22'),
(5, 'ayoman', 'soja@gmail.com', '52003929', 11, '2024-11-22 16:54:55', '2024-11-22 16:54:55'),
(6, 'Indira Cardenas', 'jumylonus@example.com', '931', 14, '2024-11-25 08:13:06', '2024-11-25 08:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(1, 'admincsl@gmail.com', 'Pa$$w0rd!', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_email`
--
ALTER TABLE `contact_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_image_management`
--
ALTER TABLE `content_image_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_text_management`
--
ALTER TABLE `content_text_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_reservations`
--
ALTER TABLE `event_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `founder_bio`
--
ALTER TABLE `founder_bio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hourlies`
--
ALTER TABLE `hourlies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spaces`
--
ALTER TABLE `spaces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `space_locations`
--
ALTER TABLE `space_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `space_id` (`space_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_email`
--
ALTER TABLE `contact_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `content_image_management`
--
ALTER TABLE `content_image_management`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `content_text_management`
--
ALTER TABLE `content_text_management`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_reservations`
--
ALTER TABLE `event_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `founder_bio`
--
ALTER TABLE `founder_bio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hourlies`
--
ALTER TABLE `hourlies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spaces`
--
ALTER TABLE `spaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `space_locations`
--
ALTER TABLE `space_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_reservations`
--
ALTER TABLE `event_reservations`
  ADD CONSTRAINT `event_reservations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `space_locations`
--
ALTER TABLE `space_locations`
  ADD CONSTRAINT `space_locations_ibfk_1` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
