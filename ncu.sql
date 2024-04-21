-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 11:05 PM
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
-- Database: `ncu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tb`
--

CREATE TABLE `admin_tb` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tb`
--

INSERT INTO `admin_tb` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'csehod', 'csehod', 'csehod'),
(3, 'ithod', 'ithod', 'ithod');

-- --------------------------------------------------------

--
-- Table structure for table `s1`
--

CREATE TABLE `s1` (
  `id` int(11) NOT NULL,
  `Register_Number` varchar(20) NOT NULL,
  `paper_title` varchar(255) NOT NULL,
  `journal_name` varchar(255) NOT NULL,
  `indexing_information` varchar(50) NOT NULL,
  `impact_factor` enum('yes','no') NOT NULL,
  `impact_factor_value` decimal(10,2) DEFAULT NULL,
  `impact_factor_source` varchar(255) DEFAULT NULL,
  `publication_date` date NOT NULL,
  `doi` varchar(255) NOT NULL,
  `page_numbers` varchar(50) NOT NULL,
  `issn` varchar(50) NOT NULL,
  `author_position` varchar(50) NOT NULL,
  `coauthors` varchar(255) DEFAULT NULL,
  `college_name_in_paper` enum('yes','no') NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `certificate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s1`
--

INSERT INTO `s1` (`id`, `Register_Number`, `paper_title`, `journal_name`, `indexing_information`, `impact_factor`, `impact_factor_value`, `impact_factor_source`, `publication_date`, `doi`, `page_numbers`, `issn`, `author_position`, `coauthors`, `college_name_in_paper`, `submission_date`, `certificate`) VALUES
(1, '20B91A05P5', 'Machine Learning Techniques for Image Recognition', 'IEEE Transactions on Pattern Analysis and Machine Intelligence', 'SCI, SCIE', 'yes', 10.23, 'Journal Citation Reports', '2023-01-15', '10.1109/TPAMI.2023.1234567', '123-134', '1234-5678', 'First Author', 'Dr. John Doe, Prof. Jane Smith', '', '2022-12-09 18:30:00', NULL),
(2, '20B91A01J8', 'Advancements in Renewable Energy Technologies', 'Energy & Environmental Science', 'SCI, SCIE', 'yes', 15.67, 'Journal Citation Reports', '2023-03-25', '10.1039/C3EE25689G', '56-68', '9876-5432', 'Corresponding Author', 'Dr. David Johnson', '', '2023-02-04 18:30:00', NULL),
(3, '20B91A03K2', 'Blockchain Technology: Applications and Challenges', 'IEEE Internet of Things Journal', 'SCI, SCIE', 'yes', 8.91, 'Journal Citation Reports', '2023-04-30', '10.1109/JIOT.2023.1234567', '200-215', '6543-2109', 'Second Author', 'Prof. Alice Brown, Dr. Emily Wilson', '', '2023-03-14 18:30:00', NULL),
(4, '20B91A07M3', 'Artificial Intelligence in Healthcare: Opportunities and Challenges', 'Nature Reviews Drug Discovery', 'SCI, SCIE', 'yes', 12.45, 'Journal Citation Reports', '2023-06-10', '10.1038/nrd.2023.12345', '500-515', '2345-6789', 'Third Author', 'Prof. Michael Garcia, Dr. Sarah Lee', '', '2023-04-19 18:30:00', NULL),
(5, '20B91A02L1', 'Smart City Solutions: A Comprehensive Review', 'IEEE Transactions on Smart Grid', 'SCI, SCIE', 'yes', 9.87, 'Journal Citation Reports', '2023-07-20', '10.1109/TSG.2023.1234567', '100-115', '8765-4321', 'First Author', 'Prof. Robert Taylor', '', '2023-04-30 18:30:00', NULL),
(6, '20B91A04N7', 'Applications of Internet of Things in Agriculture', 'Journal of Agricultural and Food Chemistry', 'SCI, SCIE', 'yes', 7.89, 'Journal Citation Reports', '2023-09-05', '10.1021/jf200001a', '300-315', '5432-1098', 'Second Author', 'Dr. Emily Wilson, Prof. Alice Brown', '', '2023-07-14 18:30:00', NULL),
(7, '20B91A09P2', 'Cybersecurity Threats and Countermeasures', 'Communications of the ACM', 'SCI, SCIE', 'yes', 8.76, 'Journal Citation Reports', '2023-10-15', '10.1145/1234567.1234567', '150-165', '7890-3210', 'Corresponding Author', 'Prof. Susan Miller', '', '2023-08-24 18:30:00', NULL),
(8, '20B91A06N1', 'Renewable Energy Integration into Power Grids', 'IEEE Power & Energy Magazine', 'SCI, SCIE', 'yes', 6.54, 'Journal Citation Reports', '2023-12-01', '10.1109/MPE.2023.1234567', '80-95', '2109-8765', 'Third Author', 'Dr. Michael Brown, Prof. Lisa Johnson', '', '2023-10-09 18:30:00', NULL),
(9, '20B91A08L9', 'Challenges and Opportunities in Big Data Analytics', 'IEEE Transactions on Big Data', 'SCI, SCIE', 'yes', 9.34, 'Journal Citation Reports', '2024-02-20', '10.1109/TBDATA.2024.1234567', '250-265', '6789-5432', 'First Author', 'Dr. Emily Wilson', '', '2023-12-29 18:30:00', NULL),
(10, '20B91A10J4', 'Future Trends in Artificial Intelligence', 'Artificial Intelligence Journal', 'SCI, SCIE', 'yes', 11.76, 'Journal Citation Reports', '2024-03-15', '10.1016/j.artint.2024.1234567', '400-415', '3210-9876', 'Corresponding Author', 'Prof. John Smith', '', '2024-01-24 18:30:00', NULL),
(11, '', 'abc', 'abc', 'Scopus', 'no', 0.00, '', '2024-12-12', 'abc', '20', 'abc', 'abc', 'abc', 'no', '2024-03-12 20:07:20', NULL),
(12, '20B91A05P8', 'paper title 1', 'journal name 1', 'SCI/SCIE', 'yes', 20.00, 'source', '2040-12-12', 'NA', '1', 'NA', 'NA', 'NA', 'yes', '2024-04-19 21:33:30', 'uploads/S1/CSE/2024/CampX Developer Program.pdf'),
(13, '20B91A05P8', 'paper 2', 'journal name 2', 'ESCI', 'yes', 0.00, 'aswd', '2040-12-12', 'aswd', '3', 'aswd', 'aswd', 'aswd', 'yes', '2024-04-19 21:43:07', 'uploads/S1/CSE/2024/document.png');

-- --------------------------------------------------------

--
-- Table structure for table `s2`
--

CREATE TABLE `s2` (
  `id` int(11) NOT NULL,
  `paper_title` varchar(255) NOT NULL,
  `conference_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `date_of_conference` date NOT NULL,
  `date_of_publication` date NOT NULL,
  `issn` varchar(20) NOT NULL,
  `page_numbers` varchar(100) DEFAULT NULL,
  `scopus` enum('yes','no') NOT NULL,
  `doi` varchar(255) NOT NULL,
  `authors_count` int(11) NOT NULL,
  `author_position` int(11) NOT NULL,
  `faculty_coauthor` enum('yes','no') NOT NULL,
  `faculty_names` varchar(255) DEFAULT NULL,
  `paper_presented` enum('yes','no') NOT NULL,
  `presentation_mode` enum('offline','online') NOT NULL,
  `coauthors_details` text DEFAULT NULL,
  `financial_support` enum('yes','no') NOT NULL,
  `amount_claimed` decimal(10,2) DEFAULT NULL,
  `indexing_information` varchar(255) NOT NULL,
  `Register_Number` varchar(10) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s3`
--

CREATE TABLE `s3` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Register_Number` varchar(20) NOT NULL,
  `organisationname` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `Stipend` decimal(10,2) DEFAULT NULL,
  `offline_location` varchar(255) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s3`
--

INSERT INTO `s3` (`id`, `Name`, `Register_Number`, `organisationname`, `duration`, `startdate`, `enddate`, `Stipend`, `offline_location`, `certificate`) VALUES
(1, 'Internship 1', '20B91A05P8', 'ABC Company', 3, '2024-01-01', '2024-03-31', 0.00, 'New York', 'Yes'),
(2, 'Internship 2', '20B91A05P8', 'XYZ Corporation', 2, '2024-02-15', '2024-04-15', 0.00, 'Los Angeles', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `s4`
--

CREATE TABLE `s4` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_provider` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `enrollment_type` varchar(50) NOT NULL,
  `faculty_name` varchar(255) DEFAULT NULL,
  `Register_Number` varchar(10) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s4`
--

INSERT INTO `s4` (`id`, `course_name`, `course_provider`, `start_date`, `end_date`, `enrollment_type`, `faculty_name`, `Register_Number`, `certificate`) VALUES
(1, 'course', 'provider', '2022-04-06', '2022-06-10', 'nothing', 'NA', '20B91A05P8', 'uploads/S4/CSE/2024/resumenew.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `s5`
--

CREATE TABLE `s5` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(50) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `event_title` varchar(100) NOT NULL,
  `number_of_days` int(11) NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date NOT NULL,
  `organized_by` varchar(100) NOT NULL,
  `event_level` varchar(50) NOT NULL,
  `event_fees` decimal(10,2) NOT NULL,
  `participation_certificate` varchar(255) NOT NULL,
  `Register_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s6`
--

CREATE TABLE `s6` (
  `id` int(11) NOT NULL,
  `academic_year` int(11) DEFAULT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_type` varchar(255) DEFAULT NULL,
  `organized_by` varchar(255) DEFAULT NULL,
  `event_coordinator` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `participants_count` int(11) DEFAULT NULL,
  `fees_per_student` decimal(10,2) DEFAULT NULL,
  `faculty_in_charge` enum('yes','no') DEFAULT NULL,
  `faculty_name` varchar(255) DEFAULT NULL,
  `report_pdf` varchar(255) DEFAULT NULL,
  `Register_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s7`
--

CREATE TABLE `s7` (
  `id` int(11) NOT NULL,
  `academic_year` int(11) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `offered_by` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `score` decimal(5,2) DEFAULT NULL,
  `pass_category` varchar(50) DEFAULT NULL,
  `mentor_name` varchar(255) DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `Register_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s8`
--

CREATE TABLE `s8` (
  `id` int(11) NOT NULL,
  `professional_body_name` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `membership_number` varchar(50) NOT NULL,
  `membership_card` varchar(255) NOT NULL,
  `Register_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s9`
--

CREATE TABLE `s9` (
  `id` int(11) NOT NULL,
  `academic_year` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `event_level` varchar(255) NOT NULL,
  `organized_by` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `individual_or_team` varchar(50) NOT NULL,
  `team_members` text DEFAULT NULL,
  `position_won` varchar(255) NOT NULL,
  `proof_of_participation` varchar(255) NOT NULL,
  `photo_while_receiving_prize` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Register_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s10`
--

CREATE TABLE `s10` (
  `id` int(6) UNSIGNED NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `exam_date` date NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `level` varchar(255) NOT NULL,
  `score_card_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Register_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s11`
--

CREATE TABLE `s11` (
  `id` int(6) UNSIGNED NOT NULL,
  `date_of_visit` date NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `purpose_of_visit` varchar(255) NOT NULL,
  `proof_attachment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Register_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s12`
--

CREATE TABLE `s12` (
  `id` int(6) UNSIGNED NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `program_date` date NOT NULL,
  `individual_or_team` varchar(50) NOT NULL,
  `team_members` text DEFAULT NULL,
  `faculty_incharge` varchar(255) NOT NULL,
  `organized_by` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `proofs_path` text NOT NULL,
  `Register_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s13`
--

CREATE TABLE `s13` (
  `id` int(6) UNSIGNED NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `university_college` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `admission_date` date NOT NULL,
  `proof_path` varchar(255) NOT NULL,
  `Register_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s14`
--

CREATE TABLE `s14` (
  `id` int(6) UNSIGNED NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `faculty_mentor` varchar(255) NOT NULL,
  `project_domain` varchar(255) NOT NULL,
  `tools_used` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `github_link` varchar(255) NOT NULL,
  `Register_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_tb`
--

CREATE TABLE `student_tb` (
  `Name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `Register_Number` varchar(10) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone_Number` varchar(255) DEFAULT NULL,
  `Mother_Name` varchar(255) DEFAULT NULL,
  `Father_Name` varchar(255) DEFAULT NULL,
  `Branch` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Date_of_Birth` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Section` varchar(1) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `count` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tb`
--

INSERT INTO `student_tb` (`Name`, `location`, `Register_Number`, `Year`, `Email`, `Phone_Number`, `Mother_Name`, `Father_Name`, `Branch`, `Gender`, `Address`, `Date_of_Birth`, `is_verified`, `Password`, `Section`, `id`, `count`) VALUES
('Satya ', NULL, '20B91A05P6', 2024, 'b.ml.l.satya.vathi5@gmail.com', NULL, NULL, NULL, 'CSE', NULL, NULL, NULL, 1, '123456789', 'A', 23, NULL),
('Ramana', NULL, '20B91A05P7', 2024, 'p.srinivasnani705@gmail.com', NULL, NULL, NULL, 'CSE', NULL, NULL, NULL, 0, '123456789', 'A', 24, NULL),
('Srinivas P', NULL, '20B91A05P5', 2024, 'srinivasnani055@gmail.com', NULL, NULL, NULL, 'CSE', NULL, NULL, NULL, 1, '123', 'A', 25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tb`
--

CREATE TABLE `teacher_tb` (
  `teacher_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `joining_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tb`
--
ALTER TABLE `admin_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s1`
--
ALTER TABLE `s1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s2`
--
ALTER TABLE `s2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s3`
--
ALTER TABLE `s3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s4`
--
ALTER TABLE `s4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s5`
--
ALTER TABLE `s5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s6`
--
ALTER TABLE `s6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s7`
--
ALTER TABLE `s7`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s8`
--
ALTER TABLE `s8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s9`
--
ALTER TABLE `s9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s10`
--
ALTER TABLE `s10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s11`
--
ALTER TABLE `s11`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s12`
--
ALTER TABLE `s12`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s13`
--
ALTER TABLE `s13`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `s14`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `student_tb`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `teacher_tb`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);

ALTER TABLE `admin_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `s1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `s2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `s3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `s4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `s5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `s6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `s7`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `s8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `s9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `s10`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `s11`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `s12`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `s13`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `s14`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `student_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `teacher_tb`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE student_tb
ADD COLUMN `10th_gpa` DECIMAL(4, 2),
ADD COLUMN `10th_school_name` VARCHAR(255),
ADD COLUMN `inter_gpa` DECIMAL(4, 2),
ADD COLUMN `inter_college_name` VARCHAR(255),
ADD COLUMN `btech_cgpa` DECIMAL(4, 2);
  