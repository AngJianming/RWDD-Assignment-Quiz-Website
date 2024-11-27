-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 10:17 AM
-- Server version: 11.5.2-MariaDB
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
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_DOJ` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_DOJ`) VALUES
(1, 'Elvan', 'asdfghjkl', NULL),
(2, 'AngJ', '@W3e', NULL),
(3, 'Jayden', '1234', NULL),
(4, 'Genni', '1010', NULL),
(5, 'Aurora', 'lol', NULL),
(6, 'Zhi Heng', 'ezz', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `custom_quiz`
--

CREATE TABLE `custom_quiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `public_visibility` tinyint(1) DEFAULT NULL,
  `custom_quiz_time_of_creation` datetime DEFAULT NULL,
  `custom_quiz_last_updated_at` datetime DEFAULT NULL,
  `quiz_code` int(4) UNSIGNED ZEROFILL NOT NULL,
  `educator_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_quiz`
--

INSERT INTO `custom_quiz` (`quiz_id`, `quiz_name`, `description`, `public_visibility`, `custom_quiz_time_of_creation`, `custom_quiz_last_updated_at`, `quiz_code`, `educator_id`) VALUES
(1, 'Function Python', 'Function Python code identification', 1, '2024-11-12 18:41:10', '2024-11-12 18:41:10', 0001, 2);

-- --------------------------------------------------------

--
-- Table structure for table `educator`
--

CREATE TABLE `educator` (
  `educator_id` int(11) NOT NULL,
  `educator_username` varchar(50) NOT NULL,
  `educator_password` varchar(100) NOT NULL,
  `educator_email` varchar(100) NOT NULL,
  `educator_institution` text NOT NULL,
  `educator_contacts` varchar(30) DEFAULT NULL,
  `educator_DOJ` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educator`
--

INSERT INTO `educator` (`educator_id`, `educator_username`, `educator_password`, `educator_email`, `educator_institution`, `educator_contacts`, `educator_DOJ`) VALUES
(1, 'Elvin', 'asdfghjkl', 'elvin@gmail.com', 'Asia Pacific University (APU)', '+60123456789', NULL),
(2, 'AngJ', '0', 'ang@gmail.com', 'Burh Community College (BCC)', '+60172538620', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_no` int(2) NOT NULL,
  `question_text` text NOT NULL,
  `correct_answer` varchar(50) NOT NULL,
  `ranked_quiz_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question_no`, `question_text`, `correct_answer`, `ranked_quiz_id`, `quiz_id`) VALUES
(1, 1, 'What is Python Function code called?', 'def', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_submission`
--

CREATE TABLE `quiz_submission` (
  `ranked_quiz_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `time_started` timestamp NOT NULL,
  `date&duration_submitted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_submission`
--

INSERT INTO `quiz_submission` (`ranked_quiz_id`, `quiz_id`, `student_id`, `time_started`, `date&duration_submitted`) VALUES
(1, 1, 2, '2024-11-12 10:44:54', '2024-11-12 10:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `ranked_quiz_levels`
--

CREATE TABLE `ranked_quiz_levels` (
  `ranked_quiz_id` int(11) NOT NULL,
  `ranked_quiz_name` varchar(255) NOT NULL,
  `ranked_quiz_duration` int(11) NOT NULL,
  `ranked_score` int(20) DEFAULT NULL,
  `admin_time_of_creation` date DEFAULT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ranked_quiz_levels`
--

INSERT INTO `ranked_quiz_levels` (`ranked_quiz_id`, `ranked_quiz_name`, `ranked_quiz_duration`, `ranked_score`, `admin_time_of_creation`, `admin_id`) VALUES
(1, 'Superb Python', 30, 100, '2024-11-12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_username` varchar(50) NOT NULL,
  `student_password` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `student_contacts` varchar(30) DEFAULT NULL,
  `student_DOJ` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_username`, `student_password`, `student_email`,`student_contacts`, `student_DOJ`) VALUES
(1, NULL, 'Elvan', 'elvin@apu.edu.my', NULL,'2024-11-12'),
(2, NULL, 'Ang', 'ang@burh.edu.my', NULL,'2024-11-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `custom_quiz`
--
ALTER TABLE `custom_quiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `Creation of custom_quiz` (`educator_id`);

--
-- Indexes for table `educator`
--
ALTER TABLE `educator`
  ADD PRIMARY KEY (`educator_id`,`educator_username`,`educator_password`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `custom writing question` (`quiz_id`),
  ADD KEY `rank writing questions` (`ranked_quiz_id`);

--
-- Indexes for table `quiz_submission`
--
ALTER TABLE `quiz_submission`
  ADD PRIMARY KEY (`quiz_id`,`student_id`,`ranked_quiz_id`),
  ADD KEY `Rank Quiz` (`ranked_quiz_id`),
  ADD KEY `Student info` (`student_id`);

--
-- Indexes for table `ranked_quiz_levels`
--
ALTER TABLE `ranked_quiz_levels`
  ADD PRIMARY KEY (`ranked_quiz_id`),
  ADD KEY `Creation of ranked_quiz_levels` (`admin_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `custom_quiz`
--
ALTER TABLE `custom_quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `educator`
--
ALTER TABLE `educator`
  MODIFY `educator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ranked_quiz_levels`
--
ALTER TABLE `ranked_quiz_levels`
  MODIFY `ranked_quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `custom_quiz`
--
ALTER TABLE `custom_quiz`
  ADD CONSTRAINT `Creation of custom_quiz` FOREIGN KEY (`educator_id`) REFERENCES `educator` (`educator_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `custom writing question` FOREIGN KEY (`quiz_id`) REFERENCES `custom_quiz` (`quiz_id`),
  ADD CONSTRAINT `rank writing questions` FOREIGN KEY (`ranked_quiz_id`) REFERENCES `ranked_quiz_levels` (`ranked_quiz_id`);

--
-- Constraints for table `quiz_submission`
--
ALTER TABLE `quiz_submission`
  ADD CONSTRAINT `Custom Quiz` FOREIGN KEY (`quiz_id`) REFERENCES `custom_quiz` (`quiz_id`),
  ADD CONSTRAINT `Rank Quiz` FOREIGN KEY (`ranked_quiz_id`) REFERENCES `ranked_quiz_levels` (`ranked_quiz_id`),
  ADD CONSTRAINT `Student info` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `ranked_quiz_levels`
--
ALTER TABLE `ranked_quiz_levels`
  ADD CONSTRAINT `Creation of ranked_quiz_levels` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
