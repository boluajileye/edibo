-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2022 at 01:28 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edibo`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `candidate_id` int(11) NOT NULL,
  `candidate_image` varchar(250) NOT NULL,
  `candidate_name` varchar(250) NOT NULL,
  `candidate_slogan` varchar(250) NOT NULL,
  `candidate_position` int(11) NOT NULL,
  `candidate_status` int(1) NOT NULL DEFAULT 0,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`candidate_id`, `candidate_image`, `candidate_name`, `candidate_slogan`, `candidate_position`, `candidate_status`, `created`) VALUES
(1, 'james.jpg', 'Regina Stuart', 'Irure debitis dolore', 1, 1, '2022-07-17'),
(2, 'james.jpg', 'Warren Trevino', 'Sapiente consequatur', 2, 0, '2022-07-17'),
(3, 'IMG_20201008_190042.jpg', 'Ava Russell', 'Eaque voluptates dis', 2, 0, '2022-07-17'),
(4, 'IMG_20201008_190055.jpg', 'Zephania Gentry', 'Esse voluptatem cil', 1, 1, '2022-07-17'),
(5, 'IMG_20201008_190055.jpg', 'Ainsley Forbes', 'Et iure in occaecat ', 3, 1, '2022-07-17'),
(6, 'IMG_20201008_190244.jpg', 'Linda Woodward', 'Non velit blanditiis', 3, 1, '2022-07-19'),
(7, 'IMG_20201008_190042.jpg', 'Constance Hays', 'In omnis nulla in el', 1, 1, '2022-07-19'),
(8, 'james.jpg', 'Casey Gordon', 'Saepe earum cum haru', 4, 1, '2022-07-19'),
(9, 'james.jpg', 'Jocelyn Meyers', 'Sit praesentium nis', 2, 1, '2022-07-19'),
(10, 'IMG_20201008_190042.jpg', 'Harper Monroe', 'Alias non culpa nobi', 2, 1, '2022-07-19'),
(11, 'IMG_20201008_190042.jpg', 'Gay Macias', 'Saepe laborum magnam', 2, 1, '2022-07-19'),
(12, 'IMG_20201008_190244.jpg', 'Sybill Anderson', 'Ratione autem explic', 3, 1, '2022-07-19'),
(13, 'IMG_20201008_190055.jpg', 'Brielle Mcdaniel', 'Ea nostrud odio beat', 1, 1, '2022-07-19'),
(14, 'IMG_20201008_190042.jpg', 'Cameron Riddle', 'Eveniet pariatur N', 2, 1, '2022-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `election_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`election_id`, `position_id`, `candidate_id`, `user_id`, `created`) VALUES
(41, 1, 7, 1, '2022-07-19'),
(42, 2, 14, 1, '2022-07-19'),
(43, 3, 6, 1, '2022-07-19'),
(44, 4, 8, 1, '2022-07-19'),
(45, 1, 1, 1, '2022-07-19'),
(46, 2, 9, 1, '2022-07-19'),
(47, 3, 12, 1, '2022-07-19'),
(48, 4, 8, 1, '2022-07-19'),
(49, 1, 1, 3, '2022-07-19'),
(50, 2, 10, 3, '2022-07-19'),
(51, 3, 12, 3, '2022-07-19'),
(52, 4, 8, 3, '2022-07-19'),
(53, 1, 1, 3, '2022-07-19'),
(54, 2, 10, 3, '2022-07-19'),
(55, 3, 12, 3, '2022-07-19'),
(56, 4, 8, 3, '2022-07-19'),
(57, 1, 4, 3, '2022-07-19'),
(58, 2, 10, 3, '2022-07-19'),
(59, 3, 12, 3, '2022-07-19'),
(60, 4, 8, 3, '2022-07-19'),
(61, 1, 13, 1, '2022-07-19'),
(62, 2, 11, 1, '2022-07-19'),
(63, 1, 4, 1, '2022-08-02'),
(64, 2, 3, 1, '2022-08-02'),
(65, 3, 6, 1, '2022-08-02'),
(66, 4, 8, 1, '2022-08-02'),
(67, 1, 4, 23, '2022-08-09'),
(68, 2, 9, 23, '2022-08-09'),
(69, 3, 12, 23, '2022-08-09');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(250) NOT NULL,
  `position_status` int(1) NOT NULL DEFAULT 0,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`, `position_status`, `created`) VALUES
(1, 'Governor', 1, '2022-07-17'),
(2, 'House of Assembly', 1, '2022-07-17'),
(3, 'President', 1, '2022-07-17'),
(4, 'Director', 1, '2022-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_image` varchar(250) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(300) NOT NULL,
  `agreement` int(3) NOT NULL DEFAULT 0,
  `user_role` varchar(10) NOT NULL DEFAULT 'user',
  `user_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_image`, `firstname`, `lastname`, `email`, `password`, `agreement`, `user_role`, `user_created`) VALUES
(1, '', 'admin', 'startor', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin', '2022-07-16 19:54:38'),
(2, '', 'Ruby', 'Caldwell', 'zukimuwa@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-16 20:18:30'),
(3, '', 'Ava', 'Barlow', 'ricur@mailinator.com', 'd27ec11744595fe95b966847ab01395e', 1, 'user', '2022-07-16 20:19:11'),
(4, '', 'Cullen', 'Slater', 'lijoku@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:16:08'),
(5, '', 'Dean', 'Ortega', 'tefyci@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:16:15'),
(6, '', 'Keith', 'Bradshaw', 'vavov@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:16:18'),
(7, '', 'Phyllis', 'Welch', 'rerez@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:16:22'),
(8, '', 'Walter', 'Reynolds', 'mijibohux@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:16:30'),
(9, '', 'Nayda', 'Fuller', 'cenuhotyde@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:16:33'),
(10, '', 'Halla', 'Myers', 'nisodibic@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:16:40'),
(11, '', 'Lana', 'Leonard', 'lewosuli@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:16:45'),
(12, '', 'Porter', 'Flores', 'tybo@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:16:51'),
(15, '', 'Kristen', 'Clemons', 'rokyni@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:17:09'),
(16, '', 'Sandra', 'Pate', 'kyjolywo@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:17:13'),
(17, '', 'Leonard', 'Rasmussen', 'tuxejexew@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:17:21'),
(18, '', 'Whitney', 'Perez', 'qaha@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:17:25'),
(19, '', 'Griffith', 'Hays', 'gojeket@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1, 'user', '2022-07-17 20:17:29'),
(20, '', 'bolu', 'watife', 'bolu@watife.com', '8c243a101312001c11dc5597752e095f', 1, 'user', '2022-08-09 11:49:46'),
(21, '', '.lkjbnm', '.kbnm', 'lkjhjkm@g.co', '83a70e48a97137199559db75a893e5c5', 1, 'user', '2022-08-09 11:51:04'),
(22, '', 'mkjhjn', ',kjhjk', 'subscriber@gmail.com', 'ffc25865a943d9fea58a3fa5364e8f52', 1, 'user', '2022-08-09 11:54:14'),
(23, '', 'user', 'user', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 1, 'user', '2022-08-09 12:05:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`election_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `election_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
