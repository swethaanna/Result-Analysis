-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 02, 2018 at 05:31 AM
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
  `course_type` varchar(50) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Table structure for table `tbl_institution`
--

DROP TABLE IF EXISTS `tbl_institution`;
CREATE TABLE IF NOT EXISTS `tbl_institution` (
  `institution_id` int(11) NOT NULL AUTO_INCREMENT,
  `institution_name` varchar(100) NOT NULL,
  `institution_address` varchar(250) NOT NULL,
  `institution_district` varchar(100) NOT NULL,
  `institution_code` varchar(100) NOT NULL,
  PRIMARY KEY (`institution_id`)
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
  `password` varchar(50) DEFAULT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `remember_me` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_index` (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
