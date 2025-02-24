-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 03:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barangay_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin1`
--

CREATE TABLE `admin1` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin1`
--

INSERT INTO `admin1` (`UserID`, `Username`, `Password`) VALUES
(31, 'admin30', 'admin30');

-- --------------------------------------------------------

--
-- Table structure for table `admin2`
--

CREATE TABLE `admin2` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin2`
--

INSERT INTO `admin2` (`UserID`, `Username`, `Password`) VALUES
(1, 'wew', 'wew'),
(2, 'jane_smith', 'janes_password'),
(3, 'bob_jackson', 'bobs_password');

-- --------------------------------------------------------

--
-- Table structure for table `admin3`
--

CREATE TABLE `admin3` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blotter`
--

CREATE TABLE `blotter` (
  `id` int(11) NOT NULL,
  `respondent_name` varchar(255) DEFAULT NULL,
  `complainant_name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `date_filed` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotter`
--

INSERT INTO `blotter` (`id`, `respondent_name`, `complainant_name`, `subject`, `date_filed`, `status`) VALUES
(20, 'Denzel Bringquezs', 'Jolo Loyolas', 'Scam', '2024-02-20 20:36:00', 'Active'),
(28, 'test', 'test', 'test', '2024-02-20 23:57:00', 'Active');

--
-- Triggers `blotter`
--
DELIMITER $$
CREATE TRIGGER `delete_case_number` AFTER DELETE ON `blotter` FOR EACH ROW BEGIN
    DELETE FROM case_numbers WHERE blotter_id = OLD.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `generate_case_number` AFTER INSERT ON `blotter` FOR EACH ROW BEGIN
    DECLARE new_case_number VARCHAR(50);
    SET new_case_number = CONCAT('CASE-', LPAD(NEW.id, 5, '0'));
    INSERT INTO case_numbers (blotter_id, case_number) VALUES (NEW.id, new_case_number);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blotter_2`
--

CREATE TABLE `blotter_2` (
  `id` int(11) NOT NULL,
  `respondent_name` varchar(255) DEFAULT NULL,
  `complainant_name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `date_filed` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotter_2`
--

INSERT INTO `blotter_2` (`id`, `respondent_name`, `complainant_name`, `subject`, `date_filed`, `status`) VALUES
(1, 'John Doe', 'Jane Smith', 'Complaint about Product', '2024-02-19 00:00:00', 'Pending');

--
-- Triggers `blotter_2`
--
DELIMITER $$
CREATE TRIGGER `delete_case_number_blotter_2` AFTER DELETE ON `blotter_2` FOR EACH ROW BEGIN
    DELETE FROM case_numbers_2 WHERE blotter_id = OLD.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `generate_case_number_blotter_2` AFTER INSERT ON `blotter_2` FOR EACH ROW BEGIN
    DECLARE new_case_number VARCHAR(50);
    SET new_case_number = CONCAT('CASE-', LPAD(NEW.id, 5, '0'));
    INSERT INTO case_numbers_2 (blotter_id, case_number) VALUES (NEW.id, new_case_number);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `blotter_3`
--

CREATE TABLE `blotter_3` (
  `id` int(11) NOT NULL,
  `respondent_name` varchar(255) DEFAULT NULL,
  `complainant_name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `date_filed` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotter_3`
--

INSERT INTO `blotter_3` (`id`, `respondent_name`, `complainant_name`, `subject`, `date_filed`, `status`) VALUES
(1, 'John Doe', 'Jane Smith', 'Complaint about Product', '2024-02-19 00:00:00', 'Pending');

--
-- Triggers `blotter_3`
--
DELIMITER $$
CREATE TRIGGER `delete_case_number_blotter_3` AFTER DELETE ON `blotter_3` FOR EACH ROW BEGIN
    DELETE FROM case_numbers_3 WHERE blotter_id = OLD.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `generate_case_number_blotter_3` AFTER INSERT ON `blotter_3` FOR EACH ROW BEGIN
    DECLARE new_case_number VARCHAR(50);
    SET new_case_number = CONCAT('CASE-', LPAD(NEW.id, 5, '0'));
    INSERT INTO case_numbers_3 (blotter_id, case_number) VALUES (NEW.id, new_case_number);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `brgy_clearance`
--

CREATE TABLE `brgy_clearance` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `civil_status` enum('Single','Married','Divorced','Separated','Widowed') NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `ctc_no` varchar(255) NOT NULL,
  `date_filed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy_clearance`
--

INSERT INTO `brgy_clearance` (`id`, `full_name`, `address`, `date_of_birth`, `sex`, `civil_status`, `nationality`, `purpose`, `ctc_no`, `date_filed`) VALUES
(13, 'test', 'test', '2024-02-19', 'Female', 'Married', 'Filipino', 'test', '1234', '2024-02-19 20:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_clearance1`
--

CREATE TABLE `brgy_clearance1` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `civil_status` enum('Single','Married','Divorced','Separated','Widowed') NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `ctc_no` varchar(255) NOT NULL,
  `date_filed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy_clearance1`
--

INSERT INTO `brgy_clearance1` (`id`, `full_name`, `address`, `date_of_birth`, `sex`, `civil_status`, `nationality`, `purpose`, `ctc_no`, `date_filed`) VALUES
(13, 'test', 'test', '2024-02-19', 'Female', 'Married', 'Filipino', 'test', '1234', '2024-02-19 20:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_clearance2`
--

CREATE TABLE `brgy_clearance2` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `civil_status` enum('Single','Married','Divorced','Separated','Widowed') NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `ctc_no` varchar(255) NOT NULL,
  `date_filed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy_clearance2`
--

INSERT INTO `brgy_clearance2` (`id`, `full_name`, `address`, `date_of_birth`, `sex`, `civil_status`, `nationality`, `purpose`, `ctc_no`, `date_filed`) VALUES
(13, 'test', 'test', '2024-02-19', 'Female', 'Married', 'Filipino', 'test', '1234', '2024-02-19 20:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `building_clearance`
--

CREATE TABLE `building_clearance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date_filed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building_clearance`
--

INSERT INTO `building_clearance` (`id`, `name`, `purpose`, `location`, `date_filed`) VALUES
(1, 'asd', 'School', 'asd', '2024-02-23 23:12:00'),
(2, 'asd', 'School', 'asd', '2024-02-23 23:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `building_clearance1`
--

CREATE TABLE `building_clearance1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date_filed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building_clearance1`
--

INSERT INTO `building_clearance1` (`id`, `name`, `purpose`, `location`, `date_filed`) VALUES
(1, 'asd', 'School', 'asd', '2024-02-23 23:12:00'),
(2, 'asd', 'School', 'asd', '2024-02-23 23:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `building_clearance2`
--

CREATE TABLE `building_clearance2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date_filed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building_clearance2`
--

INSERT INTO `building_clearance2` (`id`, `name`, `purpose`, `location`, `date_filed`) VALUES
(1, 'asd', 'School', 'asd', '2024-02-23 23:12:00'),
(2, 'asd', 'School', 'asd', '2024-02-23 23:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_clearance`
--

CREATE TABLE `business_clearance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_filed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_clearance`
--

INSERT INTO `business_clearance` (`id`, `name`, `location`, `owner`, `address`, `date_filed`) VALUES
(2, 'Sisigan ni otit', 'asdsa', 'asdasd', 'asd', '2024-02-23 16:10:00'),
(3, 'asd', 'asd', 'asd', 'asd', '2024-02-16 21:43:00'),
(5, 'wew', 'wew', 'akosss', '123 blk123sss', '2024-02-24 21:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_clearance1`
--

CREATE TABLE `business_clearance1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_filed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_clearance1`
--

INSERT INTO `business_clearance1` (`id`, `name`, `location`, `owner`, `address`, `date_filed`) VALUES
(2, 'Sisigan ni otit', 'asdsa', 'asdasd', 'asd', '2024-02-23 16:10:00'),
(3, 'asd', 'asd', 'asd', 'asd', '2024-02-16 21:43:00'),
(5, 'wew', 'wew', 'akosss', '123 blk123sss', '2024-02-24 21:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `business_clearance2`
--

CREATE TABLE `business_clearance2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_filed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_clearance2`
--

INSERT INTO `business_clearance2` (`id`, `name`, `location`, `owner`, `address`, `date_filed`) VALUES
(2, 'Sisigan ni otit', 'asdsa', 'asdasd', 'asd', '2024-02-23 16:10:00'),
(3, 'asd', 'asd', 'asd', 'asd', '2024-02-16 21:43:00'),
(5, 'wew', 'wew', 'akosss', '123 blk123sss', '2024-02-24 21:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `case_numbers`
--

CREATE TABLE `case_numbers` (
  `id` int(11) NOT NULL,
  `blotter_id` int(11) DEFAULT NULL,
  `case_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case_numbers`
--

INSERT INTO `case_numbers` (`id`, `blotter_id`, `case_number`) VALUES
(20, 20, 'CASE-00020'),
(28, 28, 'CASE-00028');

-- --------------------------------------------------------

--
-- Table structure for table `case_numbers_2`
--

CREATE TABLE `case_numbers_2` (
  `id` int(11) NOT NULL,
  `blotter_id` int(11) DEFAULT NULL,
  `case_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case_numbers_2`
--

INSERT INTO `case_numbers_2` (`id`, `blotter_id`, `case_number`) VALUES
(1, 1, 'CASE-00001');

-- --------------------------------------------------------

--
-- Table structure for table `case_numbers_3`
--

CREATE TABLE `case_numbers_3` (
  `id` int(11) NOT NULL,
  `blotter_id` int(11) DEFAULT NULL,
  `case_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case_numbers_3`
--

INSERT INTO `case_numbers_3` (`id`, `blotter_id`, `case_number`) VALUES
(1, 1, 'CASE-00001');

-- --------------------------------------------------------

--
-- Table structure for table `certindigency`
--

CREATE TABLE `certindigency` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` enum('Single','Married','Divorced','Separated','Widowed') NOT NULL,
  `purpose` text NOT NULL,
  `date_filed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certindigency`
--

INSERT INTO `certindigency` (`id`, `full_name`, `age`, `civil_status`, `purpose`, `date_filed`) VALUES
(11, 'sad', 0, 'Single', 'asd', '2024-02-17 15:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `certindigency1`
--

CREATE TABLE `certindigency1` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` enum('Single','Married','Divorced','Separated','Widowed') NOT NULL,
  `purpose` text NOT NULL,
  `date_filed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certindigency1`
--

INSERT INTO `certindigency1` (`id`, `full_name`, `age`, `civil_status`, `purpose`, `date_filed`) VALUES
(11, 'sad', 0, 'Single', 'asd', '2024-02-17 15:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `certindigency2`
--

CREATE TABLE `certindigency2` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `civil_status` enum('Single','Married','Divorced','Separated','Widowed') NOT NULL,
  `purpose` text NOT NULL,
  `date_filed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certindigency2`
--

INSERT INTO `certindigency2` (`id`, `full_name`, `age`, `civil_status`, `purpose`, `date_filed`) VALUES
(11, 'sad', 0, 'Single', 'asd', '2024-02-17 15:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `certresidency`
--

CREATE TABLE `certresidency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_filed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certresidency`
--

INSERT INTO `certresidency` (`id`, `name`, `date_filed`) VALUES
(5, 'Jolo Loyola', '2024-02-21 19:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `certresidency1`
--

CREATE TABLE `certresidency1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_filed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certresidency1`
--

INSERT INTO `certresidency1` (`id`, `name`, `date_filed`) VALUES
(5, 'Jolo Loyola', '2024-02-21 19:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `certresidency2`
--

CREATE TABLE `certresidency2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_filed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certresidency2`
--

INSERT INTO `certresidency2` (`id`, `name`, `date_filed`) VALUES
(5, 'Jolo Loyola', '2024-02-21 19:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `discussion_posts`
--

CREATE TABLE `discussion_posts` (
  `post_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_posts1`
--

CREATE TABLE `discussion_posts1` (
  `post_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_posts2`
--

CREATE TABLE `discussion_posts2` (
  `post_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_posts_admin`
--

CREATE TABLE `discussion_posts_admin` (
  `post_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discussion_posts_admin`
--

INSERT INTO `discussion_posts_admin` (`post_id`, `post_content`, `post_date`) VALUES
(1, 'asdasdasdadsasd', '2024-02-24 15:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `discussion_posts_admin1`
--

CREATE TABLE `discussion_posts_admin1` (
  `post_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discussion_posts_admin1`
--

INSERT INTO `discussion_posts_admin1` (`post_id`, `post_content`, `post_date`) VALUES
(1, 'asdasdasdadsasd', '2024-02-24 15:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `discussion_posts_admin2`
--

CREATE TABLE `discussion_posts_admin2` (
  `post_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discussion_posts_admin2`
--

INSERT INTO `discussion_posts_admin2` (`post_id`, `post_content`, `post_date`) VALUES
(1, 'asdasdasdadsasd', '2024-02-24 15:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `created_at`) VALUES
(14, 133, '3213213123', '2024-02-24 02:51:44'),
(15, 133, '3213213123', '2024-02-24 02:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `budget` varchar(50) DEFAULT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`user_id`, `image`, `title`, `details`, `budget`, `date`) VALUES
(33, 'upload/1708224858.jpg', 'Feeding Program', 'Wala lang', '10,000', '2024-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `projects1`
--

CREATE TABLE `projects1` (
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `budget` varchar(50) DEFAULT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects1`
--

INSERT INTO `projects1` (`user_id`, `image`, `title`, `details`, `budget`, `date`) VALUES
(33, 'upload/1708224858.jpg', 'Feeding Program', 'Wala lang', '10,000', '2024-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `projects2`
--

CREATE TABLE `projects2` (
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `budget` varchar(50) DEFAULT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sabutan`
--

CREATE TABLE `sabutan` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix_name` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female','Others') NOT NULL,
  `date_of_birth` date NOT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `voter_status` enum('Yes','No') NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `family_head` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sabutan`
--

INSERT INTO `sabutan` (`id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `gender`, `date_of_birth`, `birth_place`, `occupation`, `voter_status`, `barangay`, `email`, `password`, `family_head`) VALUES
(132, 'Jose Angelo ', 'Reyes', 'Loyola', 'Junior', 'Male', '2024-02-20', 'Silang', 'Tambay', 'Yes', 'Sabutan', 'jolo@gmail.com', '12345', 'Yes'),
(221, '111111', '111', '111', '111', 'Male', '1111-11-11', '1111', '1111', 'Yes', 'Sabutan', 'denzeldelacruz31@gmail.com', '111', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(34, '23', '231', '2024-02-24 11:07:00', '2024-02-24 11:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list1`
--

CREATE TABLE `schedule_list1` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list1`
--

INSERT INTO `schedule_list1` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(34, '23', '231', '2024-02-24 11:07:00', '2024-02-24 11:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list2`
--

CREATE TABLE `schedule_list2` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list2`
--

INSERT INTO `schedule_list2` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(34, '23', '231', '2024-02-24 11:07:00', '2024-02-24 11:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `senior`
--

CREATE TABLE `senior` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_filed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `senior`
--

INSERT INTO `senior` (`id`, `name`, `age`, `date_of_birth`, `date_filed`) VALUES
(4, 'Jose Angelo R. Loyola', 23, '1998-02-23', '2024-02-21 17:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `senior1`
--

CREATE TABLE `senior1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_filed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `senior1`
--

INSERT INTO `senior1` (`id`, `name`, `age`, `date_of_birth`, `date_filed`) VALUES
(4, 'Jose Angelo R. Loyola', 23, '1998-02-23', '2024-02-21 17:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `senior2`
--

CREATE TABLE `senior2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_filed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `senior2`
--

INSERT INTO `senior2` (`id`, `name`, `age`, `date_of_birth`, `date_filed`) VALUES
(4, 'Jose Angelo R. Loyola', 23, '1998-02-23', '2024-02-21 17:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `tubuan1`
--

CREATE TABLE `tubuan1` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix_name` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female','Others') NOT NULL,
  `date_of_birth` date NOT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `voter_status` enum('Yes','No') NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `family_head` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tubuan1`
--

INSERT INTO `tubuan1` (`id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `gender`, `date_of_birth`, `birth_place`, `occupation`, `voter_status`, `barangay`, `email`, `password`, `family_head`) VALUES
(14, 'James', 'Penaloza', 'Bringquez', 'Jr.', 'Male', '2002-02-07', 'Imus', 'Student', 'Yes', 'Tubuan I', 'james@gmail.com', '123456', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tubuan2`
--

CREATE TABLE `tubuan2` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix_name` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female','Others') NOT NULL,
  `date_of_birth` date NOT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `voter_status` enum('Yes','No') NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `family_head` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin1`
--
ALTER TABLE `admin1`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `admin2`
--
ALTER TABLE `admin2`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `admin3`
--
ALTER TABLE `admin3`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `blotter`
--
ALTER TABLE `blotter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blotter_2`
--
ALTER TABLE `blotter_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blotter_3`
--
ALTER TABLE `blotter_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brgy_clearance`
--
ALTER TABLE `brgy_clearance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brgy_clearance1`
--
ALTER TABLE `brgy_clearance1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brgy_clearance2`
--
ALTER TABLE `brgy_clearance2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_clearance`
--
ALTER TABLE `building_clearance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_clearance1`
--
ALTER TABLE `building_clearance1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_clearance2`
--
ALTER TABLE `building_clearance2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_clearance`
--
ALTER TABLE `business_clearance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_clearance1`
--
ALTER TABLE `business_clearance1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_clearance2`
--
ALTER TABLE `business_clearance2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case_numbers`
--
ALTER TABLE `case_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case_numbers_2`
--
ALTER TABLE `case_numbers_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `case_numbers_3`
--
ALTER TABLE `case_numbers_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certindigency`
--
ALTER TABLE `certindigency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certindigency1`
--
ALTER TABLE `certindigency1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certindigency2`
--
ALTER TABLE `certindigency2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certresidency`
--
ALTER TABLE `certresidency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certresidency1`
--
ALTER TABLE `certresidency1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certresidency2`
--
ALTER TABLE `certresidency2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discussion_posts`
--
ALTER TABLE `discussion_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `discussion_posts1`
--
ALTER TABLE `discussion_posts1`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `discussion_posts2`
--
ALTER TABLE `discussion_posts2`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `discussion_posts_admin`
--
ALTER TABLE `discussion_posts_admin`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `discussion_posts_admin1`
--
ALTER TABLE `discussion_posts_admin1`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `discussion_posts_admin2`
--
ALTER TABLE `discussion_posts_admin2`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `projects1`
--
ALTER TABLE `projects1`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `projects2`
--
ALTER TABLE `projects2`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `sabutan`
--
ALTER TABLE `sabutan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_list1`
--
ALTER TABLE `schedule_list1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_list2`
--
ALTER TABLE `schedule_list2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senior`
--
ALTER TABLE `senior`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senior1`
--
ALTER TABLE `senior1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senior2`
--
ALTER TABLE `senior2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tubuan1`
--
ALTER TABLE `tubuan1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tubuan2`
--
ALTER TABLE `tubuan2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin1`
--
ALTER TABLE `admin1`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `admin2`
--
ALTER TABLE `admin2`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin3`
--
ALTER TABLE `admin3`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blotter`
--
ALTER TABLE `blotter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `blotter_2`
--
ALTER TABLE `blotter_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blotter_3`
--
ALTER TABLE `blotter_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brgy_clearance`
--
ALTER TABLE `brgy_clearance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brgy_clearance1`
--
ALTER TABLE `brgy_clearance1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brgy_clearance2`
--
ALTER TABLE `brgy_clearance2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `building_clearance`
--
ALTER TABLE `building_clearance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `building_clearance1`
--
ALTER TABLE `building_clearance1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `building_clearance2`
--
ALTER TABLE `building_clearance2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_clearance`
--
ALTER TABLE `business_clearance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `business_clearance1`
--
ALTER TABLE `business_clearance1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `business_clearance2`
--
ALTER TABLE `business_clearance2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `case_numbers`
--
ALTER TABLE `case_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `case_numbers_2`
--
ALTER TABLE `case_numbers_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `case_numbers_3`
--
ALTER TABLE `case_numbers_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certindigency`
--
ALTER TABLE `certindigency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `certindigency1`
--
ALTER TABLE `certindigency1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `certindigency2`
--
ALTER TABLE `certindigency2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `certresidency`
--
ALTER TABLE `certresidency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `certresidency1`
--
ALTER TABLE `certresidency1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `certresidency2`
--
ALTER TABLE `certresidency2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discussion_posts`
--
ALTER TABLE `discussion_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discussion_posts1`
--
ALTER TABLE `discussion_posts1`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discussion_posts2`
--
ALTER TABLE `discussion_posts2`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discussion_posts_admin`
--
ALTER TABLE `discussion_posts_admin`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discussion_posts_admin1`
--
ALTER TABLE `discussion_posts_admin1`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discussion_posts_admin2`
--
ALTER TABLE `discussion_posts_admin2`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `projects1`
--
ALTER TABLE `projects1`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `projects2`
--
ALTER TABLE `projects2`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sabutan`
--
ALTER TABLE `sabutan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `schedule_list1`
--
ALTER TABLE `schedule_list1`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `schedule_list2`
--
ALTER TABLE `schedule_list2`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `senior`
--
ALTER TABLE `senior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `senior1`
--
ALTER TABLE `senior1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `senior2`
--
ALTER TABLE `senior2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tubuan1`
--
ALTER TABLE `tubuan1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tubuan2`
--
ALTER TABLE `tubuan2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
