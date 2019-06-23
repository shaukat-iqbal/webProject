-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2019 at 06:53 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignedsubjects`
--

CREATE TABLE IF NOT EXISTS `assignedsubjects` (
  `subject_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`subject_id`,`author_id`),
  KEY `fk_assignedSubjects_subjects1_idx` (`subject_id`),
  KEY `fk_assignedSubjects_authors1_idx` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignedsubjects`
--

INSERT INTO `assignedsubjects` (`subject_id`, `author_id`) VALUES
(2, 18),
(3, 18);

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cnic` varchar(13) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `name`, `email`, `cnic`, `password`) VALUES
(18, 'Shaukat Iqbal', 'shaukat.iqbal3001@gmail.com', '1234', 'ec6a6536ca304edf844d1d248a4f08dc');

-- --------------------------------------------------------

--
-- Table structure for table `enrolledstudents`
--

CREATE TABLE IF NOT EXISTS `enrolledstudents` (
  `test_id` int(11) NOT NULL,
  `students_cnic` varchar(13) NOT NULL,
  PRIMARY KEY (`test_id`,`students_cnic`),
  KEY `fk_enrolledStudents_tests1_idx` (`test_id`),
  KEY `fk_enrolledStudents_students1_idx` (`students_cnic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrolledstudents`
--

INSERT INTO `enrolledstudents` (`test_id`, `students_cnic`) VALUES
(8, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE IF NOT EXISTS `papers` (
  `question_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`,`test_id`),
  KEY `fk_papers_questions1_idx` (`question_id`),
  KEY `fk_papers_tests1_idx` (`test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`question_id`, `test_id`) VALUES
(3, 8),
(4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `fk_questions_subjects_idx` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `description`, `option1`, `option2`, `option3`, `answer`, `subject_id`) VALUES
(1, 'Hello world', 'shau', 'ashdba', 'jhwsah', 'jhwsah', 1),
(2, 'What is your name', 'shaukat', 'ali', 'hamza', 'shaukat', 1),
(3, 'who is pm of pak', 'ik', 'ns', 'hamza', 'ik', 1),
(4, 'What is formula of water', 'h2SO4', 'H2O', 'Co2', 'H2O', 3),
(5, 'Hell means', 'jannat', 'Asmaan', 'Jahannum', 'Jahannum', 3);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `student_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `status` varchar(256) NOT NULL,
  PRIMARY KEY (`student_id`,`test_id`),
  KEY `student_id` (`student_id`,`test_id`),
  KEY `test_id` (`test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`student_id`, `test_id`, `marks`, `status`) VALUES
(14, 8, 1, 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `studentanswers`
--

CREATE TABLE IF NOT EXISTS `studentanswers` (
  `student_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`student_id`,`test_id`,`question_id`),
  KEY `test_id` (`test_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentanswers`
--

INSERT INTO `studentanswers` (`student_id`, `test_id`, `question_id`, `answer`) VALUES
(14, 8, 3, 'ik'),
(14, 8, 4, 'H2O');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cnic` varchar(13) NOT NULL,
  `inter` int(4) NOT NULL,
  `matric` int(4) NOT NULL,
  `password` varchar(45) NOT NULL,
  `createdOrModifiedOn` date NOT NULL,
  PRIMARY KEY (`cnic`),
  UNIQUE KEY `student_id_UNIQUE` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `email`, `address`, `cnic`, `inter`, `matric`, `password`, `createdOrModifiedOn`) VALUES
(10, '', '', '', '', 0, 0, 'd41d8cd98f00b204e9800998ecf8427e', '0000-00-00'),
(16, 'Daniyal Latif', 'jalal.afridi300@gmail.com', 'dsdlsjlsd', '1234478784', 800, 990, '81dc9bdb52d04dc20036dbd8313ed055', '2019-06-15'),
(13, 'Abdul Basit', 'jalal.afridi300@gmail.com', 'fdfgf', '12345', 900, 900, '827ccb0eea8a706c4c34a16891f84e7b', '0000-00-00'),
(14, 'Abdul Basit', 'jalal.afridi300@gmail.com', '14245', '123456', 110, 110, 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00'),
(15, 'sasd', 'sfddsgfs@gmail.com', 'dgjhgh', '1234567', 123, 222, 'fcea920f7412b5da7be0cf42b8c93759', '0000-00-00'),
(6, 'Abdul Basit', 'shaukat.iqbal3001@gmail.com', 'gjhkjlkkj', '3320336165483', 112, 123, '343432432423', '0000-00-00'),
(1, 'gfhghj', 'wewetrjhjhj', 'ljlkkghfhgjkh', '3720', 342, 636, 'gasjdusja', '0000-00-00'),
(2, 'Abdul Basit', 'jalal.afridi300@gmail.com', 'gjhkjlkkj', '3720336165480', 112, 123, 'sdfsdfsdg', '0000-00-00'),
(3, 'Abdul Basit', 'shaukat.iqbal3001@gmail.com', 'gjhkjlkkj', '3720336165481', 112, 123, 'weqeewr', '0000-00-00'),
(11, 'Abdul Basit', 'shaukat.iqbal3001@gmail.com', 'jksjfjdfn', '3720336165482', 800, 800, 'a43fa5fa513cb0aa3cabbb4c1679abbc', '0000-00-00'),
(5, 'Abdul Basit', 'jalal.afridi300@gmail.com', 'gjhkjlkkj', '3720336165483', 112, 123, 'asdasfsdf', '0000-00-00'),
(8, 'Shaukat Iqbal', 'jalal.afridi300@gmail.com', 'v&po Akwal', '3720396087251', 800, 770, '827ccb0eea8a706c4c34a16891f84e7b', '0000-00-00'),
(9, 'Abdul Basit', 'shaukat.iqbal3001@gmail.com', 'sdklfjk', '3720396087252', 122, 644, '827ccb0eea8a706c4c34a16891f84e7b', '0000-00-00'),
(12, 'sasd', 'malik.khubaib3001@gmail.com', 'sdfd', '3720396087253', 800, 700, '827ccb0eea8a706c4c34a16891f84e7b', '0000-00-00'),
(7, 'jalal.afridi300@gmail.com', 'v&po Akwal', '3720396087251', '800', 770, 0, '', '0000-00-00'),
(17, 'Madina Medical Store', 'sfddsgfs@gmail.com', 'sdkslk', '928374938', 300, 283, '558082c6a6ac4caeaf7e23968549482f', '2019-06-15'),
(18, 'Madina Medical Store', 'sfddsgfs@gmail.com', 'sdkslk', '928374938323', 300, 283, '61fe94c46e74d7e657a8da5a1c99ea03', '2019-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(45) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(1, 'Physics'),
(2, 'Math'),
(3, 'Chemistry');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_date` datetime NOT NULL,
  `totalQuestions` int(11) DEFAULT NULL,
  `passingPercentage` int(11) DEFAULT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `test_date`, `totalQuestions`, `passingPercentage`) VALUES
(8, '2019-06-21 13:59:00', 2, 50);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignedsubjects`
--
ALTER TABLE `assignedsubjects`
  ADD CONSTRAINT `fk_assignedSubjects_authors1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_assignedSubjects_subjects1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrolledstudents`
--
ALTER TABLE `enrolledstudents`
  ADD CONSTRAINT `fk_enrolledStudents_students1` FOREIGN KEY (`students_cnic`) REFERENCES `students` (`cnic`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_enrolledStudents_tests1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `papers`
--
ALTER TABLE `papers`
  ADD CONSTRAINT `fk_papers_test_id` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_papers_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_subjects` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentanswers`
--
ALTER TABLE `studentanswers`
  ADD CONSTRAINT `studentanswers_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studentanswers_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studentanswers_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
