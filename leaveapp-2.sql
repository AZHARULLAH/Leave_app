-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2016 at 10:30 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leaveapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_status`
--

CREATE TABLE `app_status` (
  `app_no` bigint(20) NOT NULL,
  `sent_to_fa` tinyint(4) NOT NULL,
  `set_to_hod` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_status`
--

INSERT INTO `app_status` (`app_no`, `sent_to_fa`, `set_to_hod`, `status`) VALUES
(27, 1, 0, 0),
(29, 1, 0, 0),
(30, 1, 0, 0),
(31, 1, 0, 0),
(32, 1, 0, 0),
(33, 1, 0, 0),
(34, 1, 0, 0),
(35, 1, 0, 0),
(36, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_details`
--

CREATE TABLE `faculty_details` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(50) NOT NULL,
  `faculty_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_details`
--

INSERT INTO `faculty_details` (`faculty_id`, `faculty_name`, `faculty_email`) VALUES
(1, 'Faculty 1', 'shariffazharullah@gmail.com'),
(2, 'Faculty 2', 'shariff7azharullah@gmail.com'),
(3, 'Faculty 3', 'azhar.nitc@gmail.com'),
(4, 'Faculty 4', 'chvsaketh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `fa_details`
--

CREATE TABLE `fa_details` (
  `from_rollno` varchar(10) NOT NULL,
  `to_rollno` varchar(10) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fa_details`
--

INSERT INTO `fa_details` (`from_rollno`, `to_rollno`, `faculty_id`) VALUES
('b130100ee', 'b130200ee', 1),
('b130201ee', 'b130300ee', 2),
('b130301ee', 'b130400ee', 3),
('b130600ee', 'b130700ee', 4);

-- --------------------------------------------------------

--
-- Table structure for table `hod_details`
--

CREATE TABLE `hod_details` (
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hod_details`
--

INSERT INTO `hod_details` (`name`, `email`) VALUES
('Hod 1', 'shariffazharullah@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `leaves_availed`
--

CREATE TABLE `leaves_availed` (
  `reg_no` varchar(10) NOT NULL,
  `no_of_leaves` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves_availed`
--

INSERT INTO `leaves_availed` (`reg_no`, `no_of_leaves`) VALUES
('b130629ee', 5),
('b130659ee', 10);

-- --------------------------------------------------------

--
-- Table structure for table `max_leaves_allowed`
--

CREATE TABLE `max_leaves_allowed` (
  `programme` varchar(7) NOT NULL,
  `no_of_leaves` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `max_leaves_allowed`
--

INSERT INTO `max_leaves_allowed` (`programme`, `no_of_leaves`) VALUES
('1', 20),
('2', 17),
('3', 22);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `app_no` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `reg_no` varchar(10) NOT NULL,
  `programme` tinyint(4) NOT NULL,
  `semester` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `nature_of_leave` tinyint(4) NOT NULL,
  `document_path` varchar(200) DEFAULT NULL,
  `reason_of_leave` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`app_no`, `name`, `reg_no`, `programme`, `semester`, `email`, `from_date`, `to_date`, `no_of_days`, `nature_of_leave`, `document_path`, `reason_of_leave`) VALUES
(26, 'Azharullah', 'b130623ee', 1, 7, 'a@a.com', '2016-07-13', '2016-07-19', 6, 1, 'Null', 'Personal reasons.'),
(27, 'Qwerty', 'b130644ee', 1, 6, '1@a.com', '2016-07-24', '2016-07-31', 7, 2, 'File27', '1234567890'),
(28, 'Qwerty', 'b130644ee', 1, 6, '1@a.com', '2016-07-24', '2016-07-31', 7, 3, 'File28', '1234567890'),
(29, 'Saketh', 'b130629ee', 1, 7, 's@gmail.com', '2016-07-24', '2016-07-29', 5, 2, 'File29', 'Personal .'),
(30, 'Saketh', 'b130629ee', 1, 7, 's@gmail.com', '2016-07-24', '2016-07-29', 5, 2, 'File30', 'Personal .'),
(31, 'New', 'b130623ee', 1, 9, 'a@a.com', '2016-07-10', '2016-07-22', 12, 2, 'File31', '............dcsd'),
(32, 'New', 'b130623ee', 1, 9, 'a@a.com', '2016-07-10', '2016-07-22', 12, 2, 'File32.vcf', '............dcsd'),
(33, 'Ganesh Allampalli', 'b130651ee', 1, 7, 'a@a.com', '2016-07-03', '2016-07-30', 27, 2, 'File33.jpg', 'Qwerttyuhgfdbgfd'),
(34, 'Azharullah', 'b130623ee', 2, 1, 'shariffazharullah@gmail.com', '2016-07-28', '2016-07-30', 2, 2, 'File34.pdf', 'Sick leave.'),
(35, 'Azharullah', 'b130623ee', 2, 1, 'shariffazharullah@gmail.com', '2016-07-28', '2016-07-30', 2, 2, 'File35.pdf', 'Sick leave.'),
(36, 'Azharullah', 'b130623ee', 2, 1, 'shariffazharullah@gmail.com', '2016-07-28', '2016-07-30', 2, 2, 'File36.pdf', 'Sick leave.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_status`
--
ALTER TABLE `app_status`
  ADD PRIMARY KEY (`app_no`);

--
-- Indexes for table `faculty_details`
--
ALTER TABLE `faculty_details`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `leaves_availed`
--
ALTER TABLE `leaves_availed`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`app_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `app_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_status`
--
ALTER TABLE `app_status`
  ADD CONSTRAINT `app_status_ibfk_1` FOREIGN KEY (`app_no`) REFERENCES `student` (`app_no`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
