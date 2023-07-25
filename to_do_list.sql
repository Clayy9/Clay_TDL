-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 02:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to_do_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_categories`
--

CREATE TABLE `tb_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_categories`
--

INSERT INTO `tb_categories` (`id`, `category_name`, `category_img`) VALUES
(0, 'Default', 'Category=Default.png'),
(1, 'medic', 'Category=Medic.png'),
(2, 'meeting', 'Category=Meeting.png'),
(3, 'sport', 'Category=Sport.png'),
(4, 'study', 'Category=Study.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_collaborators`
--

CREATE TABLE `tb_collaborators` (
  `id` int(11) NOT NULL,
  `collaborator_username` varchar(250) DEFAULT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `added_date` date DEFAULT NULL,
  `added_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_collaborators`
--

INSERT INTO `tb_collaborators` (`id`, `collaborator_username`, `task_id`, `user_id`, `added_date`, `added_time`) VALUES
(33, 'Calvintai10', 180, 8, NULL, NULL),
(47, 'Hazel100', 183, 12, NULL, NULL),
(50, 'Esteryuricha123', 132, 14, NULL, NULL),
(51, 'Clay99', 182, 1, NULL, NULL),
(52, 'Calvintai10', 182, 8, NULL, NULL),
(54, 'Hazel100', 184, 12, '2023-07-25', '18:07:00'),
(55, 'Fredella3', 184, 13, '2023-07-25', '18:07:00'),
(58, 'Hazel100', 178, 12, '2023-07-25', '18:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pets`
--

CREATE TABLE `tb_pets` (
  `id` int(11) NOT NULL,
  `pet_name` varchar(50) NOT NULL,
  `pet_level` int(11) NOT NULL,
  `pet_score` int(11) NOT NULL,
  `pet_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pets`
--

INSERT INTO `tb_pets` (`id`, `pet_name`, `pet_level`, `pet_score`, `pet_img`) VALUES
(1, 'Golem', 20, 20, 'Golem.png'),
(2, 'Axo', 0, 0, 'Axo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pet_phases`
--

CREATE TABLE `tb_pet_phases` (
  `id` int(11) NOT NULL,
  `min_xp` int(11) NOT NULL,
  `max_xp` int(11) NOT NULL,
  `phase_img` varchar(100) NOT NULL,
  `pet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_pet_phases`
--

INSERT INTO `tb_pet_phases` (`id`, `min_xp`, `max_xp`, `phase_img`, `pet_id`) VALUES
(1, 0, 10, 'Golem=Egg.png', 1),
(2, 11, 20, 'Golem=Baby.png', 1),
(3, 21, 30, 'Golem=Kid.png', 1),
(4, 31, 50, 'Golem=Mature.png', 1),
(5, 51, 100, 'Golem=Legend.png', 1),
(6, 0, 10, 'Axo=Egg.png', 2),
(7, 11, 20, 'Axo=Baby.png', 2),
(8, 21, 30, 'Axo=Kid.png', 2),
(9, 31, 50, 'Axo=Mature.png', 2),
(10, 51, 100, 'Axo=Legend.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_priorities`
--

CREATE TABLE `tb_priorities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `priority_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_priorities`
--

INSERT INTO `tb_priorities` (`id`, `title`, `priority_score`) VALUES
(1, 'Low', 1),
(2, 'Medium', 2),
(3, 'High', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reminders`
--

CREATE TABLE `tb_reminders` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `reminder_time` time NOT NULL,
  `reminder_date` date DEFAULT NULL,
  `reminder_number` int(11) NOT NULL,
  `reminder_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_reminders`
--

INSERT INTO `tb_reminders` (`id`, `task_id`, `reminder_time`, `reminder_date`, `reminder_number`, `reminder_type`) VALUES
(54, 180, '23:35:00', '2023-07-23', 25, 'minutes'),
(63, 183, '00:35:00', '2023-07-24', 25, 'minutes'),
(64, 183, '00:16:00', '2023-07-24', 44, 'minutes'),
(71, 178, '09:45:00', '2023-07-25', 15, 'minutes'),
(72, 178, '09:00:00', '2023-07-25', 1, 'hours');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ringtones`
--

CREATE TABLE `tb_ringtones` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sound` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_ringtones`
--

INSERT INTO `tb_ringtones` (`id`, `name`, `sound`) VALUES
(1, 'Default', 'default.mp3'),
(2, 'Finally', 'finally.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `status` enum('done','active','expired') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id`, `status`) VALUES
(1, 'active'),
(2, 'done'),
(3, 'expired');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tasks`
--

CREATE TABLE `tb_tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_date` date DEFAULT NULL,
  `task_time` time DEFAULT NULL,
  `task_desc` varchar(255) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tasks`
--

INSERT INTO `tb_tasks` (`id`, `task_name`, `task_date`, `task_time`, `task_desc`, `priority_id`, `user_id`, `category_id`, `status_id`) VALUES
(132, 'Expired', '2023-07-08', '00:00:00', 'contoh jika task sudah melewati batas waktunya', 1, 1, 0, 1),
(133, 'Agustus', '2023-08-10', '00:00:00', 'Tidak ada deskripsi', 1, 1, 0, 1),
(178, 'yok bisa yok', '2023-07-25', '10:00:00', 'Tidak ada deskripsi', 1, 1, 0, 1),
(179, '123', '2023-07-22', '00:00:00', 'Tidak ada deskripsi', 1, 1, 0, 1),
(180, 'Plis Bisa', '2023-07-24', '00:00:00', 'Tidak ada deskripsi', 1, 1, 0, 2),
(182, 'Task Hazel', '2023-07-24', '00:00:00', 'Tidak ada deskripsi', 1, 12, 0, 1),
(183, 'Cek Alarm dari Task Clay', '2023-07-24', '01:00:00', 'Tidak ada deskripsi', 1, 1, 0, 2),
(184, 'Tes Collab tanggal jam', '2023-07-25', '00:00:00', 'Tidak ada deskripsi', 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('User','Admin') NOT NULL DEFAULT 'User',
  `password` varchar(255) NOT NULL,
  `xp` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `pet_phases_id` int(11) NOT NULL,
  `ringtone_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `profile_img`, `username`, `fullname`, `email`, `status`, `password`, `xp`, `pet_id`, `pet_phases_id`, `ringtone_id`) VALUES
(1, 'e1bd0456c7f68878430e13acf66bf93d_23-07-24.png', 'Clay99', 'Clay Aiken', 'clay.aiken@itbss.ac.id', 'User', '202cb962ac59075b964b07152d234b70', 68, 2, 10, 2),
(8, '04669fdc5ffc192d1a0b2d2564e314b7_23-07-22.png', 'Calvintai10', 'Calvin Tai', 'calvin.tai@itbss.ac.id', 'User', '202cb962ac59075b964b07152d234b70', 0, 1, 1, 1),
(12, '5bbfb4a7a7a88a51e84a921778510a65_23-07-22.jpg', 'Hazel100', 'Hazel Dixon', 'Hazel.dixon@itbss.ac.id', 'User', '202cb962ac59075b964b07152d234b70', 1, 2, 6, 1),
(13, '19a1be96d35c44c5103bf00b0c0bfb01_23-07-22.png', 'Fredella3', 'Fredella Cornelia Chok', 'fredellacornelia.chok@itbss.ac.id', 'User', '202cb962ac59075b964b07152d234b70', 0, 1, 1, 1),
(14, 'c2e78f5cce52fcd885fe29686da142a8_23-07-22.jpg', 'Esteryuricha123', 'Ester Yuricha', 'Ester.yuricha@itbss.ac.id', 'User', '202cb962ac59075b964b07152d234b70', 0, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_categories`
--
ALTER TABLE `tb_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_collaborators`
--
ALTER TABLE `tb_collaborators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_pets`
--
ALTER TABLE `tb_pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pet_phases`
--
ALTER TABLE `tb_pet_phases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `tb_priorities`
--
ALTER TABLE `tb_priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_reminders`
--
ALTER TABLE `tb_reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `tb_ringtones`
--
ALTER TABLE `tb_ringtones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tasks`
--
ALTER TABLE `tb_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_id` (`pet_id`),
  ADD KEY `ringtone_id` (`ringtone_id`),
  ADD KEY `pet_phases_id` (`pet_phases_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_categories`
--
ALTER TABLE `tb_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_collaborators`
--
ALTER TABLE `tb_collaborators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tb_pets`
--
ALTER TABLE `tb_pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pet_phases`
--
ALTER TABLE `tb_pet_phases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_priorities`
--
ALTER TABLE `tb_priorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_reminders`
--
ALTER TABLE `tb_reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tb_ringtones`
--
ALTER TABLE `tb_ringtones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_tasks`
--
ALTER TABLE `tb_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_collaborators`
--
ALTER TABLE `tb_collaborators`
  ADD CONSTRAINT `tb_collaborators_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tb_tasks` (`id`),
  ADD CONSTRAINT `tb_collaborators_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`);

--
-- Constraints for table `tb_pet_phases`
--
ALTER TABLE `tb_pet_phases`
  ADD CONSTRAINT `tb_pet_phases_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tb_pets` (`id`);

--
-- Constraints for table `tb_reminders`
--
ALTER TABLE `tb_reminders`
  ADD CONSTRAINT `tb_reminders_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tb_tasks` (`id`);

--
-- Constraints for table `tb_tasks`
--
ALTER TABLE `tb_tasks`
  ADD CONSTRAINT `tb_tasks_ibfk_1` FOREIGN KEY (`priority_id`) REFERENCES `tb_priorities` (`id`),
  ADD CONSTRAINT `tb_tasks_ibfk_2` FOREIGN KEY (`priority_id`) REFERENCES `tb_priorities` (`id`),
  ADD CONSTRAINT `tb_tasks_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`),
  ADD CONSTRAINT `tb_tasks_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `tb_categories` (`id`),
  ADD CONSTRAINT `tb_tasks_ibfk_6` FOREIGN KEY (`status_id`) REFERENCES `tb_status` (`id`),
  ADD CONSTRAINT `tb_tasks_ibfk_7` FOREIGN KEY (`status_id`) REFERENCES `tb_status` (`id`);

--
-- Constraints for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `tb_users_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tb_pets` (`id`),
  ADD CONSTRAINT `tb_users_ibfk_2` FOREIGN KEY (`pet_phases_id`) REFERENCES `tb_pet_phases` (`id`),
  ADD CONSTRAINT `tb_users_ibfk_3` FOREIGN KEY (`ringtone_id`) REFERENCES `tb_ringtones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
