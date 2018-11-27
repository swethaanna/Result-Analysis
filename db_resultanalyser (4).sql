-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 21, 2018 at 08:34 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_resultanalyser`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_courses`
--

DROP TABLE IF EXISTS `tbl_courses`;
CREATE TABLE IF NOT EXISTS `tbl_courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `course_type` varchar(50) NOT NULL,
  `course_semesters` int(11) NOT NULL,
  `course_years` int(11) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_courses`
--

INSERT INTO `tbl_courses` (`course_id`, `course_name`, `course_code`, `course_type`, `course_semesters`, `course_years`) VALUES
(2, 'Master of Technology', 'M.Tech', 'PG', 4, 2),
(3, 'Bachelor of Technology', 'B.Tech', 'UG', 8, 4),
(4, 'Bachelor of Architecture', 'B.Arch', 'UG', 10, 4),
(5, 'Bachelor of Computer Application', 'BCA', 'UG', 6, 3),
(6, 'Master of Computer Application', 'MCA', 'UG', 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
CREATE TABLE IF NOT EXISTS `tbl_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL,
  `department_course` int(11) NOT NULL,
  `department_information` varchar(250) NOT NULL,
  `department_code` varchar(50) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_name`, `department_course`, `department_information`, `department_code`) VALUES
(4, 'Electronics and Communication', 3, 'Electronics Department', 'ECE'),
(3, 'Computer Science and Engineering', 3, 'Computer Science', 'CSE'),
(5, 'Computer Networks', 2, 'Master Division of networks', 'MCN'),
(6, 'Digital Signal Processing', 2, 'DSP', 'DSP'),
(7, 'Control Systems', 2, 'Control System Branch', 'MCS'),
(8, 'Electronics and Communication', 2, 'Electronics Department', 'MEC'),
(9, 'Computer Application', 5, 'Computer Application', 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exams`
--

DROP TABLE IF EXISTS `tbl_exams`;
CREATE TABLE IF NOT EXISTS `tbl_exams` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(100) NOT NULL,
  `exam_course_id` int(11) NOT NULL,
  `exam_semester` varchar(50) NOT NULL,
  `exam_scheme` varchar(50) NOT NULL,
  `exam_batch` varchar(50) NOT NULL,
  `updated_date` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`exam_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instdata`
--

DROP TABLE IF EXISTS `tbl_instdata`;
CREATE TABLE IF NOT EXISTS `tbl_instdata` (
  `instdata_id` int(11) NOT NULL AUTO_INCREMENT,
  `institution_code` varchar(50) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  PRIMARY KEY (`instdata_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_instdata`
--

INSERT INTO `tbl_instdata` (`instdata_id`, `institution_code`, `course_code`) VALUES
(19, '1-539347233', 'MCN'),
(18, '1-004628924', 'CSE'),
(17, '1-004628924', 'ECE'),
(16, '1-004628924', 'DSP'),
(15, '1-004628924', 'MCN'),
(11, '1-002348494', 'DSP'),
(12, '1-002348494', 'MEC'),
(13, '1-002348494', 'ECE'),
(14, '1-002348494', 'CSE'),
(20, '1-539347233', 'DSP'),
(21, '1-539347233', 'MCS'),
(22, '1-539347233', 'MEC'),
(23, '1-539347233', 'ECE'),
(24, '1-539347233', 'CSE'),
(25, '1-539347233', 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_institution`
--

DROP TABLE IF EXISTS `tbl_institution`;
CREATE TABLE IF NOT EXISTS `tbl_institution` (
  `institution_id` int(11) NOT NULL AUTO_INCREMENT,
  `institution_name` varchar(100) NOT NULL,
  `institution_address` varchar(250) NOT NULL,
  `institution_district` varchar(100) NOT NULL,
  `institution_code` varchar(100) NOT NULL,
  `institution_url` varchar(100) NOT NULL,
  PRIMARY KEY (`institution_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_institution`
--

INSERT INTO `tbl_institution` (`institution_id`, `institution_name`, `institution_address`, `institution_district`, `institution_code`, `institution_url`) VALUES
(31, 'Saintgits Group of Institution', 'Kottukulam Hills, Pathamuttom P.O. Kottayam, Pin - 686532', 'Kottayam', '1-539347233', 'http://saintgits.org'),
(29, 'College of Engineering, Kidangoor', 'Kidangoor PO Kottayam', 'Kottayam', '1-002348494', 'http://www.cekidangoor.com'),
(30, 'College of Engineering, Attingal', 'Attingal Medical Centre Road, Attingal, Kerala 695101', 'Kollam', '1-004628924', 'http://www.ceattingal.ac.in'),
(28, 'College of Engineering, Chengannur', 'Chengannur, Alappuzha PO', 'Alappuzha', '1-004364034', 'http://www.cechengannur.ac.in'),
(7, 'College of Engineering, Cherthala', 'Cherthala,Alappuzha', 'Alappuzha', '1-006479290', 'http://www.ceconline.edu/');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_result`
--

DROP TABLE IF EXISTS `tbl_result`;
CREATE TABLE IF NOT EXISTS `tbl_result` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `mark_scored` varchar(50) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studdata`
--

DROP TABLE IF EXISTS `tbl_studdata`;
CREATE TABLE IF NOT EXISTS `tbl_studdata` (
  `studdata_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `scored_mark` int(11) NOT NULL,
  PRIMARY KEY (`studdata_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

DROP TABLE IF EXISTS `tbl_student`;
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(100) NOT NULL,
  `student_regno` varchar(100) NOT NULL,
  `student_course` int(11) NOT NULL,
  `student_department` int(11) NOT NULL,
  `student_institution` int(11) NOT NULL,
  `student_batch` varchar(100) NOT NULL,
  `student_status` varchar(100) NOT NULL,
  `current_semster` varchar(50) NOT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `student_regno` (`student_regno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

DROP TABLE IF EXISTS `tbl_subject`;
CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(150) DEFAULT NULL,
  `subject_course` int(11) DEFAULT NULL,
  `subject_department` int(11) DEFAULT NULL,
  `subject_code` varchar(100) DEFAULT NULL,
  `semester` varchar(100) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `password` varchar(600) DEFAULT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `department_id` varchar(50) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `remember_me` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_index` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `password`, `institution_id`, `department_id`, `role_id`, `remember_me`, `created_date`, `email`) VALUES
(1, 'admin', 'admin', 1, '0', 1, 1, '2018-10-05 09:10:25', 'admin@resultanalyser.com'),
(2, 'ebinchandy', '$2y$10$7RkRmi2N67Orj2zji9cNoeUF9/3Erx10KtTxZmlJq4G', 2, '0', 2, 0, '2018-10-07 18:49:55', 'ebin.chandy@enginef.com'),
(3, 'ebinchandy123', '$2y$10$o5pwIWyTqspPwFmRVCX5oekZobfZ6e/fX1R/nsUMkQ3', 3, '0', 2, 0, '2018-10-07 19:06:27', 'ebinchandy@gmail.com'),
(4, 'ebincha', '$2y$10$wV97jAuVla3eGwgXR3PiD./AhDsgWvOFTTgfWKrF5Xv7O3c/n4DMW', 1, 'BCA', 0, 0, '2018-10-07 19:11:08', 'ebinchandy123@gmail.com'),
(5, 'ebinchandy2', '$2y$10$zquEfm3MHK.tp0SXr3tVmuaWEocPH3dIh0ZC9lporwJBBLWg1/VGq', 1, '0', 2, 0, '2018-11-21 03:09:43', 'ebinchandy@gmail2.com'),
(6, 'ebinchandy21', '$2y$10$6Wflv4eagOOtqTMYqXJWROHB/gCacO69adpeIme3hAJkxHaGt9oua', 1, '0', 2, 0, '2018-11-21 03:11:12', 'ebinchandy12@gmail.com'),
(7, 'ebinchandyenginef', '$2y$10$oEkeTIVZGTB40Tkgiuur1.FwD4iWIFum66MfxOGujkJSrwYRnR4q6', 1, 'BCA', 2, 0, '2018-11-21 03:14:59', 'ebin.chandy123@enginef.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
