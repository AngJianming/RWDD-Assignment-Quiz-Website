-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 09:19 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rwdd-assignment-quiz-website`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `admin_username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_DOJ` date DEFAULT NULL,
  `admin_email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_DOJ`, `admin_email`, `remember_token`) VALUES
(1, 'Elvan', '1234', '2024-08-30', 'elvan@email.com', ''),
(2, 'AngJ', '1234', '2024-12-07', 'ang@email.com', ''),
(3, 'Jayden', '1234', '2024-12-14', 'jayden@email.com', ''),
(4, 'Genni', '1234', '2024-10-30', 'genni@email.com', ''),
(5, 'Aurora', '1234', '2024-12-01', 'aurora@email.com', ''),
(6, 'Zhi Heng', '1234', '2024-11-14', 'xhiheng@email.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `educator`
--

CREATE TABLE `educator` (
  `educator_id` int NOT NULL,
  `educator_username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `educator_password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `educator_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `educator_institution` text COLLATE utf8mb4_general_ci NOT NULL,
  `educator_contacts` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `educator_DOJ` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educator`
--

INSERT INTO `educator` (`educator_id`, `educator_username`, `educator_password`, `educator_email`, `educator_institution`, `educator_contacts`, `educator_DOJ`) VALUES
(1, 'Elvin', '1234', 'elvin@gmail.com', 'Asia Pacific University (APU)', '+60123456789', '2024-12-02'),
(2, 'AngJ', '1234', 'ang@gmail.com', 'Burh Community College (BCC)', '+60172538620', '2024-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `question_no` int NOT NULL,
  `question_text` text COLLATE utf8mb4_general_ci NOT NULL,
  `option_A` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `option_B` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `option_C` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `option_D` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `correct_option` enum('A','B','C','D') COLLATE utf8mb4_general_ci NOT NULL,
  `ranked_quiz_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_submission`
--

CREATE TABLE `quiz_submission` (
  `student_id` int NOT NULL,
  `time_taken` int NOT NULL COMMENT 'time taken in minutes',
  `date&time_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'time submitted in custom quiz'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ranked_quiz_levels`
--

CREATE TABLE `ranked_quiz_levels` (
  `ranked_quiz_id` int NOT NULL,
  `ranked_quiz_level` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `ranked_quiz_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ranked_quiz_duration` int NOT NULL COMMENT '	Duration in minutes',
  `ranked_score` int DEFAULT NULL,
  `admin_time_of_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation timestamp',
  `admin_time_of_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record last update timestamp',
  `admin_id` int NOT NULL COMMENT 'The admin who created it'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ranked_quiz_levels`
--

INSERT INTO `ranked_quiz_levels` (`ranked_quiz_id`, `ranked_quiz_level`, `ranked_quiz_name`, `ranked_quiz_duration`, `ranked_score`, `admin_time_of_creation`, `admin_time_of_update`, `admin_id`) VALUES
(1, 'LEVEL 1', 'Superb Basic Python', 30, 100, '2024-11-11 16:00:00', '2024-12-12 07:52:29', 2),
(2, 'LEVEL 2', 'Middle Basic ', 30, 100, '2024-12-12 07:47:23', '2024-12-12 07:52:23', 2),
(3, 'LEVEL 3', 'Intermediate Mid', 30, 100, '2024-12-12 07:47:23', '2024-12-12 07:48:59', 2),
(4, 'LEVEL 4', 'Advanced Supahigh', 30, 100, '2024-12-12 07:47:23', '2024-12-12 07:48:59', 2),
(5, 'LEVEL 5', 'Demi-God Python', 30, 100, '2024-12-12 07:47:23', '2024-12-12 07:48:59', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int NOT NULL,
  `student_username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `student_password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `student_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `student_contacts` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `student_DOJ` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_username`, `student_password`, `student_email`, `student_contacts`, `student_DOJ`) VALUES
(1, 'Elvan', '1234', 'elvin@apu.edu.my', NULL, '2024-11-12'),
(2, 'Ang', '1234', 'ang@burh.edu.my', NULL, '2024-11-12'),
(3, 'angjm', '1234567890', 'angjianming@email.com', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `educator`
--
ALTER TABLE `educator`
  ADD PRIMARY KEY (`educator_id`) USING BTREE,
  ADD UNIQUE KEY `educator_email` (`educator_email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `rank writing questions` (`ranked_quiz_id`);

--
-- Indexes for table `quiz_submission`
--
ALTER TABLE `quiz_submission`
  ADD PRIMARY KEY (`student_id`) USING BTREE,
  ADD KEY `Student info` (`student_id`) USING BTREE;

--
-- Indexes for table `ranked_quiz_levels`
--
ALTER TABLE `ranked_quiz_levels`
  ADD PRIMARY KEY (`ranked_quiz_id`),
  ADD UNIQUE KEY `ranked_quiz_level` (`ranked_quiz_level`),
  ADD KEY `Creation of ranked_quiz_levels` (`admin_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_email` (`student_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `educator`
--
ALTER TABLE `educator`
  MODIFY `educator_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ranked_quiz_levels`
--
ALTER TABLE `ranked_quiz_levels`
  MODIFY `ranked_quiz_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `ranked_quiz_id` FOREIGN KEY (`ranked_quiz_id`) REFERENCES `ranked_quiz_levels` (`ranked_quiz_id`);

--
-- Constraints for table `quiz_submission`
--
ALTER TABLE `quiz_submission`
  ADD CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `ranked_quiz_levels`
--
ALTER TABLE `ranked_quiz_levels`
  ADD CONSTRAINT `admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
