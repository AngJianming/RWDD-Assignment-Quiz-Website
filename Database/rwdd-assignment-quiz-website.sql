-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 12, 2024 at 11:50 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

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

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL,
  `admin_username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_DOJ` date DEFAULT NULL,
  `admin_email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_email` (`admin_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_DOJ`, `admin_email`) VALUES
(1, 'Elvan', '1234', '2024-08-30', 'elvan@gmail.com'),
(2, 'AngJ', '1234', '2024-12-07', 'ang@gmail.com'),
(3, 'Jayden', '1234', '2024-12-14', 'jayden@email.com'),
(4, 'Genni', '1234', '2024-10-30', 'genni@email.com'),
(5, 'Aurora', '1234', '2024-12-01', 'aurora@gmail.com'),
(6, 'Zhi Heng', '1234', '2024-11-14', 'xhiheng@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `custom_quiz`
--

DROP TABLE IF EXISTS `custom_quiz`;
CREATE TABLE IF NOT EXISTS `custom_quiz` (
  `quiz_id` int NOT NULL,
  `quiz_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `quiz_description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `custom_quiz_time_of_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation timestamp',
  `custom_quiz_time_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record last update timestamp',
  `quiz_code` int(4) UNSIGNED ZEROFILL NOT NULL,
  `custom_quiz_score` int DEFAULT NULL,
  `educator_id` int NOT NULL COMMENT 'The educator who created it',
  PRIMARY KEY (`quiz_id`),
  KEY `Creation of custom_quiz` (`educator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_quiz`
--

INSERT INTO `custom_quiz` (`quiz_id`, `quiz_name`, `quiz_description`, `custom_quiz_time_of_creation`, `custom_quiz_time_updated`, `quiz_code`, `custom_quiz_score`, `educator_id`) VALUES
(1, 'Function Python', 'Function Python code identification', '2024-11-12 10:41:10', '2024-11-12 10:41:10', 0001, 100, 2),
(2, 'GIL Python', 'Which of the following statements about Python\'s Global Interpreter Lock (GIL) is true?', '2024-11-12 10:41:10', '2024-11-12 10:41:10', 0002, 100, 2),
(3, 'Generator in Python', 'What is a generator in Python?', '2024-11-12 10:41:10', '2024-11-12 10:41:10', 0003, 100, 2);

-- --------------------------------------------------------

--
-- Table structure for table `educator`
--

DROP TABLE IF EXISTS `educator`;
CREATE TABLE IF NOT EXISTS `educator` (
  `educator_id` int NOT NULL,
  `educator_username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `educator_password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `educator_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `educator_institution` text COLLATE utf8mb4_general_ci NOT NULL,
  `educator_contacts` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `educator_DOJ` date DEFAULT NULL,
  PRIMARY KEY (`educator_id`) USING BTREE,
  UNIQUE KEY `educator_email` (`educator_email`)
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

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `question_no` int NOT NULL,
  `question_text` text COLLATE utf8mb4_general_ci NOT NULL,
  `option_A` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `option_B` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `option_C` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `option_D` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `correct_option` enum('A','B','C','D') COLLATE utf8mb4_general_ci NOT NULL,
  `ranked_quiz_id` int DEFAULT NULL,
  `quiz_id` int DEFAULT NULL,
  PRIMARY KEY (`question_id`),
  KEY `custom writing question` (`quiz_id`),
  KEY `rank writing questions` (`ranked_quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question_no`, `question_text`, `option_A`, `option_B`, `option_C`, `option_D`, `correct_option`, `ranked_quiz_id`, `quiz_id`) VALUES
('C1Q1', 1, 'What is Python Function code called?', 'A) func', 'B) def', 'C) function', 'D) define', 'B', NULL, 1),
('L1Q1', 1, 'What is the correct file extension for Python files?', 'A) .pyth', 'B) .pt', 'C) .py', 'D) .pyt', 'C', 1, NULL),
('L1Q2', 2, 'Which keyword is used to define a function in Python?', 'A) func\r\n\r\n', 'B) def', 'C) function', 'D) define', 'B', 1, NULL),
('L1Q3', 3, 'How do you insert COMMENTS in Python code?', 'A) /* This is a comment */\r\n\r\n', 'B) // This is a comment', 'C) # This is a comment', 'D) <!-- This is a comment -->', 'C', 1, NULL),
('L1Q4', 4, 'Which data type is used to store text in Python?', 'A) int\r\n', 'B) float', 'C) str', 'D) bool', 'C', 1, NULL),
('L1Q5', 5, 'What is the output of \r\n```\r\nprint(2 + 3)\r\n```\r\nin Python?', 'A) 23\r\n\r\n', 'B) 5', 'C) Error', 'D) None', 'B', 1, NULL),
('L2Q1', 1, 'Which of the following is a mutable data type in Python?', 'A) tuple\r\n\r\n', 'B) str', 'C) list', 'D) int', 'C', 2, NULL),
('L2Q2', 2, 'What will len([1, 2, 3, 4]) return?', 'A) 3\r\n\r\n', 'B) 4\r\n', 'C) Error', 'D) None', 'B', 2, NULL),
('L2Q3', 3, 'How do you create a variable with the floating number 2.5?', 'A) x = 2.5\r\n', 'B) x = float(2)', 'C) x = \"2.5\"', 'D) x = 2,5', 'A', 2, NULL),
('L2Q4', 4, 'Which operator is used for exponentiation in Python?', 'A) ^\r\n\r\n', 'B) **', 'C) ^^', 'D) *', 'B', 2, NULL),
('L2Q5', 5, 'What is the correct way to start a for loop in Python?', 'A) for i = 1 to 5\r\n\r\n', 'B) for (i = 0; i < 5; i++)', 'C) for i in range(5):', 'D) foreach i in range(5)', 'C', 2, NULL),
('L3Q1', 1, 'What is the output of the following code?\r\n```\r\nprint(\"Hello\" * 3)\r\n```', 'A) HelloHelloHello\r\n\r\n\r\n', 'B) Hello 3', 'C) Hello*3', 'D) Error', 'A', 3, NULL),
('L3Q2', 2, 'Which method can be used to remove whitespace from both ends of a string?', 'A) strip()\r\n\r\n', 'B) trim()', 'C) remove()', 'D) cut()', 'A', 3, NULL),
('L3Q3', 3, 'What will the following code return?\r\n```\r\nlist = [1, 2, 3]\r\nlist.append([4, 5])\r\nprint(list)\r\n```', 'A) [1, 2, 3, 4, 5]\r\n\r\n', 'B) [1, 2, 3, [4, 5]]', 'C) [1, 2, 3, 4, [5]]', 'D) Error', 'B', 3, NULL),
('L3Q4', 4, 'Which of the following is used to create an empty dictionary in Python?', 'A) {}\r\n\r\n\r\n\r\n', 'B) []\r\n\r\n', 'C) ()', 'D) <>', 'A', 3, NULL),
('L3Q5', 5, 'What is the correct way to handle exceptions in Python?', 'A) try-except\r\n\r\n', 'B) catch-finally\r\n', 'C) begin-rescue', 'D) do-handle', 'A', 3, NULL),
('L4Q1', 1, 'What does the `*args` parameter do in a Python function?', 'A) It allows the function to accept a variable number of keyword arguments.\r\n\r\n', 'B) It enforces a fixed number of positional arguments.', 'C) It allows the function to accept a variable number of positional arguments.', 'D) It unpacks a list into separate arguments.', 'C', 4, NULL),
('L4Q2', 2, 'Which of the following statements is true about Python decorators?', 'A) They can only be applied to classes.\r\n\r\n', 'B) They modify the behavior of functions or methods.', 'C) They are executed at compile time.', 'D) They replace the original function with a new one permanently.', 'B', 4, NULL),
('L4Q3', 3, 'What is the output of the following code?\r\n```\r\ndef func(a, b=[]):\r\n    b.append(a)\r\n    return b\r\n\r\nprint(func(1))\r\nprint(func(2))\r\n```', 'A) [1] followed by [2]\r\n\r\n\r\n\r\n', 'B) [1, 2] followed by [1, 2]', 'C) [1] followed by [1, 2]', 'D) Error', 'C', 4, NULL),
('L4Q4', 4, 'Which of the following is a built-in Python module for working with regular expressions?', 'A) re\r\n\r\n', 'B) regex', 'C) regexp', 'D) pattern', 'A', 4, NULL),
('L4Q5', 5, 'What is the purpose of the `__init__.py` file in Python packages?', 'A) It indicates that the directory should be treated as a Python package.\r\n\r\n\r\n', 'B) It initializes all variables in the package.', 'C) It automatically imports all modules in the package.', 'D) It is used to store package metadata.', 'A', 4, NULL),
('L5Q1', 1, 'What is a generator in Python?', 'A) A function that returns a list.\r\n', 'B) A function that returns an iterator using yield.', 'C) A class that generates random numbers.', 'D) A built-in Python module for generating data.', 'B', 5, NULL),
('L5Q2', 2, 'Which of the following statements about Python\'s Global Interpreter Lock (GIL) is true?', 'A) It allows multiple threads to execute Python bytecodes simultaneously.\r\n\r\n', 'B) It prevents multiple native threads from executing Python bytecodes at once.', 'C) It is a feature that enhances multi-threading performance.', 'D) It is only present in Python versions below 3.0.', 'B', 5, NULL),
('L5Q3', 3, 'What will be the output of the following code snippet?\r\n```\r\nclass MyClass:\r\n    def __init__(self, value):\r\n        self.value = value\r\n\r\n    def __eq__(self, other):\r\n        return self.value == other.value\r\n\r\na = MyClass(5)\r\nb = MyClass(5)\r\nprint(a == b)\r\nprint(a is b)\r\n```', 'A) True followed by True\r\n\r\n', 'B) True followed by False', 'C) False followed by True', 'D) False followed by False', 'B', 5, NULL),
('L5Q4', 4, 'In Python, what is the difference between `@staticmethod` and `@classmethod` decorators?', 'A) @staticmethod can modify class state, @classmethod cannot.', 'B) @classmethod receives the class as the first argument, @staticmethod does not.', 'C) @staticmethod can access instance variables, @classmethod cannot.', 'D) There is no difference; they are interchangeable.', 'B', 5, NULL),
('L5Q5', 5, 'Which of the following methods is used to serialize an object in Python?', 'A) pickle.dumps()\r\n\r\n', 'B) json.loads()', 'C) serialize()', 'D) marshal.dump()', 'A', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_submission`
--

DROP TABLE IF EXISTS `quiz_submission`;
CREATE TABLE IF NOT EXISTS `quiz_submission` (
  `quiz_id` int NOT NULL,
  `student_id` int NOT NULL,
  `time_taken` int NOT NULL COMMENT 'time taken in minutes',
  `date&time_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'time submitted in custom quiz',
  PRIMARY KEY (`quiz_id`,`student_id`) USING BTREE,
  KEY `Student info` (`student_id`,`quiz_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_submission`
--

INSERT INTO `quiz_submission` (`quiz_id`, `student_id`, `time_taken`, `date&time_submitted`) VALUES
(1, 1, 24, '2024-12-12 08:50:56'),
(1, 2, 25, '2024-12-12 08:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `ranked_quiz_levels`
--

DROP TABLE IF EXISTS `ranked_quiz_levels`;
CREATE TABLE IF NOT EXISTS `ranked_quiz_levels` (
  `ranked_quiz_id` int NOT NULL,
  `ranked_quiz_level` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `ranked_quiz_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ranked_quiz_duration` int NOT NULL COMMENT '	Duration in minutes',
  `ranked_score` int DEFAULT NULL,
  `admin_time_of_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation timestamp',
  `admin_time_of_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record last update timestamp',
  `admin_id` int NOT NULL COMMENT 'The admin who created it',
  PRIMARY KEY (`ranked_quiz_id`),
  UNIQUE KEY `ranked_quiz_level` (`ranked_quiz_level`),
  KEY `Creation of ranked_quiz_levels` (`admin_id`)
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
-- Table structure for table `ranked_quiz_submission`
--

DROP TABLE IF EXISTS `ranked_quiz_submission`;
CREATE TABLE IF NOT EXISTS `ranked_quiz_submission` (
  `ranked_quiz_id` int NOT NULL,
  `student_id` int NOT NULL,
  `time_taken_ranked` int NOT NULL COMMENT 'time taken in minutes',
  `date&time_submitted_ranked` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'time submitted in ranked quiz',
  PRIMARY KEY (`ranked_quiz_id`,`student_id`),
  KEY `student` (`student_id`,`ranked_quiz_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ranked_quiz_submission`
--

INSERT INTO `ranked_quiz_submission` (`ranked_quiz_id`, `student_id`, `time_taken_ranked`, `date&time_submitted_ranked`) VALUES
(1, 1, 29, '2024-12-12 08:58:25'),
(1, 2, 20, '2024-12-12 08:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int NOT NULL,
  `student_username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `student_password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `student_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `student_contacts` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `student_DOJ` date DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `student_email` (`student_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_username`, `student_password`, `student_email`, `student_contacts`, `student_DOJ`) VALUES
(1, 'Elvan', '1234', 'elvin@apu.edu.my', NULL, '2024-11-12'),
(2, 'Ang', '1234', 'ang@burh.edu.my', NULL, '2024-11-12');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `custom_quiz`
--
ALTER TABLE `custom_quiz`
  ADD CONSTRAINT `custom_quiz_ibfk_1` FOREIGN KEY (`educator_id`) REFERENCES `educator` (`educator_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `quiz_id` FOREIGN KEY (`quiz_id`) REFERENCES `custom_quiz` (`quiz_id`),
  ADD CONSTRAINT `ranked_quiz_id` FOREIGN KEY (`ranked_quiz_id`) REFERENCES `ranked_quiz_levels` (`ranked_quiz_id`);

--
-- Constraints for table `quiz_submission`
--
ALTER TABLE `quiz_submission`
  ADD CONSTRAINT `quiz_submission_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `custom_quiz` (`quiz_id`),
  ADD CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `ranked_quiz_levels`
--
ALTER TABLE `ranked_quiz_levels`
  ADD CONSTRAINT `admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `ranked_quiz_submission`
--
ALTER TABLE `ranked_quiz_submission`
  ADD CONSTRAINT `rankedQuiz` FOREIGN KEY (`ranked_quiz_id`) REFERENCES `ranked_quiz_levels` (`ranked_quiz_id`),
  ADD CONSTRAINT `student` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
