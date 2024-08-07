-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 09:15 AM
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
-- Database: `allocate`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` int(11) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `role` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `username`, `password`, `department`, `email`, `role`) VALUES
(1, 'admin', 'password', NULL, NULL, NULL),
(2, 'demo', 'password', NULL, NULL, 'supervisor'),
(3, 'stephen', '11tomtom', NULL, NULL, 'supervisor'),
(4, 'daniel', '1234', 0, 'e@g.vom', 'supervisor'),
(5, 'bobobo', '1234', 0, '', ''),
(6, 'ewww', '1234', 0, '@.com', 'admin'),
(7, 'spryker', '1234', 0, '@.com', 'admin'),
(8, 'daniel88', 'sdssssss', 510, '@ttu.edu.com', 'user'),
(9, 'daniel.mensah', 'Daniel024419', 511, 'daniel.mensah@ttu.edu.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`) VALUES
(510, 'kuk'),
(511, 'lolo'),
(512, ''),
(513, ''),
(514, 'Art');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_case` varchar(255) NOT NULL,
  `project_level` varchar(50) NOT NULL,
  `allocation` bigint(20) NOT NULL DEFAULT 0,
  `project_department` int(11) DEFAULT NULL,
  `project_start_date` date DEFAULT NULL,
  `project_end_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `project_name`, `project_case`, `project_level`, `allocation`, `project_department`, `project_start_date`, `project_end_date`) VALUES
(1, 'Design and Implementation of Loan disbursement system', 'A case study of GT Bank Plc', 'HND', 1, NULL, '2024-08-07', '2024-08-12'),
(5, 'Loan saving system', 'Guiness Nigeria', 'HND', 1, NULL, '2024-08-13', '2024-08-05'),
(7, 'Bank ATM System', 'Diamond Bank', 'HND', 2, NULL, '2024-06-03', '2024-07-01'),
(6, 'Login Registration System', 'Guiness Nigeria', 'ND', 1, NULL, '2024-08-05', '2024-08-05'),
(8, 'Student Project Allocation and Management System', 'A case study of The Polytechnic,Ibadan', 'HND', 1, NULL, '2024-08-05', '2024-08-05'),
(9, 'Inventory System', 'XYZ limited', 'ND', 1, NULL, '2024-08-05', '2024-08-05'),
(14, 'toko', '\r\n				vy', '3', 0, 510, '2024-08-05', '2024-08-05'),
(11, 'Test1', 'test 1', '510', 1, NULL, '2024-08-05', '2024-08-05'),
(12, 'toko', 'toko', '3', 1, NULL, '2024-08-06', '2024-08-13'),
(15, 'pop', 'ww	', '3', 0, 511, '2024-08-13', '2024-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `matric` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `department`, `level`, `matric`, `date`, `email`, `password`) VALUES
(8549, 'mumu', '511', '3', '02024000641865', '2024-08-05', '02024000641865@ttu.edu.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Ayub Lekan', 'Computer Studies', 'HND 2', '2014235020036', '2017-09-21', NULL, NULL),
(4, 'Ade', 'Mechanical Eng', 'HND 1', '2014235020050', '2017-09-23', NULL, NULL),
(5, 'Demo', 'Civil Engineering', 'ND', '2014235020039', '2017-09-23', NULL, NULL),
(6, 'Ayobami', 'Slt', 'ND 3', '2014235020031', '2017-09-23', NULL, NULL),
(7, 'Omolewa ', 'Slt', 'ND 2', '2014235020033', '2017-09-23', NULL, NULL),
(8, 'weed', '111', 'ND', '11111', '2024-08-05', NULL, NULL),
(9, 'weed', '1117', 'ND', '11111', '2024-08-05', NULL, NULL),
(7945, 'weed', '111', 'ND 2', '11111', '2024-08-05', '11111@ttu.edu.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2509, 'mosu wee', 'wrr', 'HND 1', '23232323', '2024-08-05', '23232323@ttu.edu.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(5912, 'miiu', '511', '2', '11111', '2024-08-05', '11111@ttu.edu.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(1478, 'qwwww', '510', '3', '202421177669', '2024-08-05', '202421177669@ttu.edu.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `students_project_files`
--

CREATE TABLE `students_project_files` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL DEFAULT current_timestamp(),
  `student_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `document_type` text NOT NULL,
  `status` text NOT NULL DEFAULT 'pending',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_project_files`
--

INSERT INTO `students_project_files` (`id`, `name`, `project_id`, `assignment_id`, `student_id`, `note`, `document_type`, `status`, `created_at`) VALUES
(6, 'Proposal-8549.pdf', 12, 5, 8549, 'guzu', 'Proposal', 'accepted', '2024-08-06'),
(7, 'Chapter Two-8549.pdf', 7, 2, 8549, 'todo', 'Chapter Two', 'pending', '2024-08-06'),
(8, 'Proposal-1478.pdf', 11, 4, 1478, 'see', 'Proposal', 'pending', '2024-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `student_levels`
--

CREATE TABLE `student_levels` (
  `id` int(11) NOT NULL,
  `level_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_levels`
--

INSERT INTO `student_levels` (`id`, `level_name`) VALUES
(1, 'nooo'),
(2, 'nii'),
(3, 'HNd');

-- --------------------------------------------------------

--
-- Table structure for table `student_projects`
--

CREATE TABLE `student_projects` (
  `id` int(11) NOT NULL,
  `student_id` int(255) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `project_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_projects`
--

INSERT INTO `student_projects` (`id`, `student_id`, `supervisor_id`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 8549, 1, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 8549, 1, 7, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(3, 5912, 1, 12, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(4, 1478, 1, 11, '2024-08-05 00:00:00', '2024-08-05 00:00:00'),
(5, 8549, 6, 12, '2024-08-05 00:00:00', '2024-08-05 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_project_files`
--
ALTER TABLE `students_project_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_levels`
--
ALTER TABLE `student_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_projects`
--
ALTER TABLE `student_projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=515;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8550;

--
-- AUTO_INCREMENT for table `students_project_files`
--
ALTER TABLE `students_project_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_levels`
--
ALTER TABLE `student_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_projects`
--
ALTER TABLE `student_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
