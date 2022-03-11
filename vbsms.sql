-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 05:42 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vbsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_category`
--

CREATE TABLE IF NOT EXISTS `assignment_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `assignment_category`
--

INSERT INTO `assignment_category` (`category_id`, `category_name`) VALUES
(1, 'Basic Science');

-- --------------------------------------------------------

--
-- Table structure for table `assign_subjects`
--

CREATE TABLE IF NOT EXISTS `assign_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` text NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_name` text NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `assign_subjects`
--

INSERT INTO `assign_subjects` (`id`, `subject_name`, `subject_id`, `class_name`, `teacher_id`) VALUES
(12, 'MATHEMATICS', 19, 'BASIC 6', 6),
(13, 'ENGLISH', 20, 'BASIC 6', 6);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `attendance_status` text NOT NULL,
  `note` text NOT NULL,
  `term` text NOT NULL,
  `attendance_date` text NOT NULL,
  `month` int(11) NOT NULL,
  `class_name` text NOT NULL,
  `attendance_rating` text NOT NULL,
  PRIMARY KEY (`attendance_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `attendance_status`, `note`, `term`, `attendance_date`, `month`, `class_name`, `attendance_rating`) VALUES
(35, 16, 'Present', '', 'First Term', '01/27/2022', 1, 'BASIC 6', '4.76'),
(36, 17, 'Present', '', 'First Term', '01/27/2022', 1, 'BASIC 6', '4.76');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `class_name` text NOT NULL,
  `term_status` int(10) unsigned NOT NULL,
  `teacher_id` text NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `class_session`
--

CREATE TABLE IF NOT EXISTS `class_session` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `start_year` year(4) NOT NULL,
  `end_year` year(4) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `class_session`
--

INSERT INTO `class_session` (`session_id`, `class_name`, `student_id`, `start_year`, `end_year`) VALUES
(15, 'BASIC 6', 16, 2022, 2023),
(16, 'BASIC 6', 17, 2022, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `first_term`
--

CREATE TABLE IF NOT EXISTS `first_term` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subjects` text NOT NULL,
  `other_CA` text NOT NULL,
  `CA` text NOT NULL,
  `exams` text NOT NULL,
  `total_score` text NOT NULL,
  `grade` text NOT NULL,
  `remark` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_name` text NOT NULL,
  `start_year` year(4) NOT NULL,
  `end_year` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `first_term`
--

INSERT INTO `first_term` (`id`, `subjects`, `other_CA`, `CA`, `exams`, `total_score`, `grade`, `remark`, `student_id`, `class_name`, `start_year`, `end_year`) VALUES
(9, 'MATHEMATICS', '9', '22', '40', '71', 'B', 'VERY GOOD', 16, 'BASIC 6   ', 2022, 2023),
(10, 'ENGLISH', '9', '30', '50', '89', 'A', 'EXCELLENT', 16, 'BASIC 6   ', 2022, 2023),
(11, 'BASIC SCIENCE', '7', '19', '39', '65', 'B', 'VERY GOOD', 16, 'BASIC 6   ', 2022, 2023),
(12, 'C.R.S', '9', '20', '49', '78', 'B', 'VERY GOOD', 16, 'BASIC 6   ', 2022, 2023),
(13, 'MATHEMATICS', '10', '29', '57', '96', 'A', 'EXCELLENT', 17, 'BASIC 6   ', 2022, 2023),
(14, 'ENGLISH', '10', '25', '49', '84', 'A', 'EXCELLENT', 17, 'BASIC 6   ', 2022, 2023),
(15, 'BASIC SCIENCE', '8', '19', '38', '65', 'B', 'VERY GOOD', 17, 'BASIC 6   ', 2022, 2023),
(16, 'C.R.S', '10', '28', '40', '78', 'B', 'VERY GOOD', 17, 'BASIC 6   ', 2022, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `grading_percent`
--

CREATE TABLE IF NOT EXISTS `grading_percent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percentage` int(11) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `grading_percent`
--

INSERT INTO `grading_percent` (`id`, `percentage`, `status`) VALUES
(1, 50, 'OFF');

-- --------------------------------------------------------

--
-- Table structure for table `observation_conduct`
--

CREATE TABLE IF NOT EXISTS `observation_conduct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `params` text NOT NULL,
  `grade` text NOT NULL,
  `student_id` text NOT NULL,
  `class_name` text NOT NULL,
  `term` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `observation_conduct`
--

INSERT INTO `observation_conduct` (`id`, `params`, `grade`, `student_id`, `class_name`, `term`) VALUES
(1, 'honesty', '', '', '', ''),
(2, 'cleanliness', '', '', '', ''),
(3, 'punctuality', '', '', '', ''),
(4, 'attentiveness', '', '', '', ''),
(5, 'carefulness', '', '', '', ''),
(6, 'considerate', '', '', '', ''),
(7, 'politeness', '', '', '', ''),
(8, 'obedience', '', '', '', ''),
(9, 'promptness at work', '', '', '', ''),
(10, 'works independently', '', '', '', ''),
(11, 'logical reasoning', '', '', '', ''),
(12, 'enjoys company of mates', '', '', '', ''),
(13, 'enjoys drawing & craft', '', '', '', ''),
(14, 'does homework regularly', '', '', '', ''),
(15, 'club & society', '', '', '', ''),
(16, 'team work/co-operation', '', '', '', ''),
(17, 'comprehension', '', '', '', ''),
(18, 'observation & manipulative skills', '', '', '', ''),
(19, 'manual skill(Dexterity)', '', '', '', ''),
(20, 'organising ability', '', '', '', ''),
(21, 'perceptual ability', '', '', '', ''),
(22, 'creativity', '', '', '', ''),
(23, 'participatory behaviour', '', '', '', ''),
(24, 'physical agility', '', '', '', ''),
(25, 'handwriting', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `observation_conduct_grades`
--

CREATE TABLE IF NOT EXISTS `observation_conduct_grades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `params` text NOT NULL,
  `grade` text NOT NULL,
  `class_name` text NOT NULL,
  `term` text NOT NULL,
  `teachers_comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

--
-- Dumping data for table `observation_conduct_grades`
--

INSERT INTO `observation_conduct_grades` (`id`, `student_id`, `params`, `grade`, `class_name`, `term`, `teachers_comment`) VALUES
(51, 16, 'honesty', 'A', 'BASIC 6     ', '1st Term', ''),
(52, 16, 'cleanliness', 'A', 'BASIC 6     ', '1st Term', ''),
(53, 16, 'punctuality', 'B', 'BASIC 6     ', '1st Term', ''),
(54, 16, 'attentiveness', 'C', 'BASIC 6     ', '1st Term', ''),
(55, 16, 'carefulness', 'B', 'BASIC 6     ', '1st Term', ''),
(56, 16, 'considerate', 'C', 'BASIC 6     ', '1st Term', ''),
(57, 16, 'politeness', 'B', 'BASIC 6     ', '1st Term', ''),
(58, 16, 'obedience', 'C', 'BASIC 6     ', '1st Term', ''),
(59, 16, 'promptness at work', 'A', 'BASIC 6     ', '1st Term', ''),
(60, 16, 'works independently', 'A', 'BASIC 6     ', '1st Term', ''),
(61, 16, 'logical reasoning', 'A', 'BASIC 6     ', '1st Term', ''),
(62, 16, 'enjoys company of mates', 'A', 'BASIC 6     ', '1st Term', ''),
(63, 16, 'enjoys drawing & craft', 'B', 'BASIC 6     ', '1st Term', ''),
(64, 16, 'does homework regularly', 'A', 'BASIC 6     ', '1st Term', ''),
(65, 16, 'club & society', 'A', 'BASIC 6     ', '1st Term', ''),
(66, 16, 'team work/co-operation', 'A', 'BASIC 6     ', '1st Term', ''),
(67, 16, 'comprehension', 'A', 'BASIC 6     ', '1st Term', ''),
(68, 16, 'observation & manipulative skills', 'B', 'BASIC 6     ', '1st Term', ''),
(69, 16, 'manual skill(Dexterity)', 'C', 'BASIC 6     ', '1st Term', ''),
(70, 16, 'organising ability', 'A', 'BASIC 6     ', '1st Term', ''),
(71, 16, 'perceptual ability', 'B', 'BASIC 6     ', '1st Term', ''),
(72, 16, 'creativity', 'A', 'BASIC 6     ', '1st Term', ''),
(73, 16, 'participatory behaviour', 'B', 'BASIC 6     ', '1st Term', ''),
(74, 16, 'physical agility', 'B', 'BASIC 6     ', '1st Term', ''),
(75, 16, 'handwriting', 'B', 'BASIC 6     ', '1st Term', ''),
(76, 17, 'honesty', 'A', 'BASIC 6     ', '1st Term', ''),
(77, 17, 'cleanliness', 'A', 'BASIC 6     ', '1st Term', ''),
(78, 17, 'punctuality', 'A', 'BASIC 6     ', '1st Term', ''),
(79, 17, 'attentiveness', 'A', 'BASIC 6     ', '1st Term', ''),
(80, 17, 'carefulness', 'A', 'BASIC 6     ', '1st Term', ''),
(81, 17, 'considerate', 'A', 'BASIC 6     ', '1st Term', ''),
(82, 17, 'politeness', 'A', 'BASIC 6     ', '1st Term', ''),
(83, 17, 'obedience', 'A', 'BASIC 6     ', '1st Term', ''),
(84, 17, 'promptness at work', 'A', 'BASIC 6     ', '1st Term', ''),
(85, 17, 'works independently', 'A', 'BASIC 6     ', '1st Term', ''),
(86, 17, 'logical reasoning', 'B', 'BASIC 6     ', '1st Term', ''),
(87, 17, 'enjoys company of mates', 'B', 'BASIC 6     ', '1st Term', ''),
(88, 17, 'enjoys drawing & craft', 'B', 'BASIC 6     ', '1st Term', ''),
(89, 17, 'does homework regularly', 'C', 'BASIC 6     ', '1st Term', ''),
(90, 17, 'club & society', 'C', 'BASIC 6     ', '1st Term', ''),
(91, 17, 'team work/co-operation', 'B', 'BASIC 6     ', '1st Term', ''),
(92, 17, 'comprehension', 'A', 'BASIC 6     ', '1st Term', ''),
(93, 17, 'observation & manipulative skills', 'A', 'BASIC 6     ', '1st Term', ''),
(94, 17, 'manual skill(Dexterity)', 'A', 'BASIC 6     ', '1st Term', ''),
(95, 17, 'organising ability', 'A', 'BASIC 6     ', '1st Term', ''),
(96, 17, 'perceptual ability', 'A', 'BASIC 6     ', '1st Term', ''),
(97, 17, 'creativity', 'A', 'BASIC 6     ', '1st Term', ''),
(98, 17, 'participatory behaviour', 'A', 'BASIC 6     ', '1st Term', ''),
(99, 17, 'physical agility', 'C', 'BASIC 6     ', '1st Term', ''),
(100, 17, 'handwriting', 'C', 'BASIC 6     ', '1st Term', ''),
(101, 17, 'honesty', 'A', 'BASIC 6     ', '2nd Term', ''),
(102, 17, 'cleanliness', 'A', 'BASIC 6     ', '2nd Term', ''),
(103, 17, 'punctuality', 'B', 'BASIC 6     ', '2nd Term', ''),
(104, 17, 'attentiveness', 'B', 'BASIC 6     ', '2nd Term', ''),
(105, 17, 'carefulness', 'B', 'BASIC 6     ', '2nd Term', ''),
(106, 17, 'considerate', 'B', 'BASIC 6     ', '2nd Term', ''),
(107, 17, 'politeness', 'A', 'BASIC 6     ', '2nd Term', ''),
(108, 17, 'obedience', 'A', 'BASIC 6     ', '2nd Term', ''),
(109, 17, 'promptness at work', 'B', 'BASIC 6     ', '2nd Term', ''),
(110, 17, 'works independently', 'B', 'BASIC 6     ', '2nd Term', ''),
(111, 17, 'logical reasoning', 'A', 'BASIC 6     ', '2nd Term', ''),
(112, 17, 'enjoys company of mates', '', 'BASIC 6     ', '2nd Term', ''),
(113, 17, 'enjoys drawing & craft', '', 'BASIC 6     ', '2nd Term', ''),
(114, 17, 'does homework regularly', '', 'BASIC 6     ', '2nd Term', ''),
(115, 17, 'club & society', '', 'BASIC 6     ', '2nd Term', ''),
(116, 17, 'team work/co-operation', '', 'BASIC 6     ', '2nd Term', ''),
(117, 17, 'comprehension', '', 'BASIC 6     ', '2nd Term', ''),
(118, 17, 'observation & manipulative skills', '', 'BASIC 6     ', '2nd Term', ''),
(119, 17, 'manual skill(Dexterity)', '', 'BASIC 6     ', '2nd Term', ''),
(120, 17, 'organising ability', '', 'BASIC 6     ', '2nd Term', ''),
(121, 17, 'perceptual ability', '', 'BASIC 6     ', '2nd Term', ''),
(122, 17, 'creativity', '', 'BASIC 6     ', '2nd Term', ''),
(123, 17, 'participatory behaviour', '', 'BASIC 6     ', '2nd Term', ''),
(124, 17, 'physical agility', '', 'BASIC 6     ', '2nd Term', ''),
(125, 17, 'handwriting', '', 'BASIC 6     ', '2nd Term', ''),
(126, 17, 'honesty', 'A', 'BASIC 6  ', '3rd Term', ''),
(127, 17, 'cleanliness', 'A', 'BASIC 6  ', '3rd Term', ''),
(128, 17, 'punctuality', 'A', 'BASIC 6  ', '3rd Term', ''),
(129, 17, 'attentiveness', 'A', 'BASIC 6  ', '3rd Term', ''),
(130, 17, 'carefulness', 'A', 'BASIC 6  ', '3rd Term', ''),
(131, 17, 'considerate', 'B', 'BASIC 6  ', '3rd Term', ''),
(132, 17, 'politeness', 'B', 'BASIC 6  ', '3rd Term', ''),
(133, 17, 'obedience', 'B', 'BASIC 6  ', '3rd Term', ''),
(134, 17, 'promptness at work', 'B', 'BASIC 6  ', '3rd Term', ''),
(135, 17, 'works independently', 'B', 'BASIC 6  ', '3rd Term', ''),
(136, 17, 'logical reasoning', 'B', 'BASIC 6  ', '3rd Term', ''),
(137, 17, 'enjoys company of mates', 'B', 'BASIC 6  ', '3rd Term', ''),
(138, 17, 'enjoys drawing & craft', 'B', 'BASIC 6  ', '3rd Term', ''),
(139, 17, 'does homework regularly', 'B', 'BASIC 6  ', '3rd Term', ''),
(140, 17, 'club & society', 'B', 'BASIC 6  ', '3rd Term', ''),
(141, 17, 'team work/co-operation', 'B', 'BASIC 6  ', '3rd Term', ''),
(142, 17, 'comprehension', 'B', 'BASIC 6  ', '3rd Term', ''),
(143, 17, 'observation & manipulative skills', 'B', 'BASIC 6  ', '3rd Term', ''),
(144, 17, 'manual skill(Dexterity)', 'B', 'BASIC 6  ', '3rd Term', ''),
(145, 17, 'organising ability', '', 'BASIC 6  ', '3rd Term', ''),
(146, 17, 'perceptual ability', '', 'BASIC 6  ', '3rd Term', ''),
(147, 17, 'creativity', '', 'BASIC 6  ', '3rd Term', ''),
(148, 17, 'participatory behaviour', '', 'BASIC 6  ', '3rd Term', ''),
(149, 17, 'physical agility', '', 'BASIC 6  ', '3rd Term', ''),
(150, 17, 'handwriting', '', 'BASIC 6  ', '3rd Term', '');

-- --------------------------------------------------------

--
-- Table structure for table `other_params`
--

CREATE TABLE IF NOT EXISTS `other_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `times_schOpen` int(11) NOT NULL,
  `times_present` int(11) NOT NULL,
  `times_absent` int(11) NOT NULL,
  `term_begins` text NOT NULL,
  `term_ends` text NOT NULL,
  `teachers_comment` text NOT NULL,
  `height_start` float NOT NULL,
  `weight_start` float NOT NULL,
  `height_end` float NOT NULL,
  `weight_end` float NOT NULL,
  `student_id` int(11) NOT NULL,
  `term` text NOT NULL,
  `class_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `other_params`
--

INSERT INTO `other_params` (`id`, `times_schOpen`, `times_present`, `times_absent`, `term_begins`, `term_ends`, `teachers_comment`, `height_start`, `weight_start`, `height_end`, `weight_end`, `student_id`, `term`, `class_name`) VALUES
(3, 30, 23, 7, '23/01/2022', '14/02/2022', 'He is very attentive and loyal.', 8, 40, 8.5, 42, 16, '1st Term', 'BASIC 6 '),
(4, 30, 23, 7, '23/01/2022', '14/02/2022', 'She is very attentive and loyal.', 8, 40, 8.54, 41, 17, '1st Term', 'BASIC 6 '),
(5, 30, 23, 7, '23/04/2022', '14/06/2022', 'She is very attentive and loyal.', 7, 38, 7, 39, 17, '2nd Term', 'BASIC 6 '),
(6, 30, 23, 8, '23/04/2022', '14/06/2022', '', 8, 38, 7, 39, 17, '3rd Term', 'BASIC 6');

-- --------------------------------------------------------

--
-- Table structure for table `previous_classes`
--

CREATE TABLE IF NOT EXISTS `previous_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `previous_class` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `points` int(11) NOT NULL,
  `question_type` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question`, `points`, `question_type`, `cat_id`) VALUES
(1, 'In what year did Nigeria gain her independence?', 10, 'Multichoice', 1),
(2, 'what does the white color in Nigeria Flag signify', 10, 'Multichoice', 1),
(3, '', 0, 'Multichoice', 1),
(4, '', 0, 'Multichoice', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE IF NOT EXISTS `question_answers` (
  `answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `answer` text NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `question_answers`
--

INSERT INTO `question_answers` (`answer_id`, `answer`, `question_id`) VALUES
(1, '1960', 1),
(2, 'peace', 2),
(3, '1972', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE IF NOT EXISTS `question_options` (
  `option_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `options` text NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`option_id`, `options`, `question_id`) VALUES
(1, '1960', 1),
(2, '1955', 1),
(3, '1940', 1),
(4, 'love', 2),
(5, 'peace', 2),
(6, 'strength', 2);

-- --------------------------------------------------------

--
-- Table structure for table `school_classes`
--

CREATE TABLE IF NOT EXISTS `school_classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` text NOT NULL,
  `form_teacher` text NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `school_classes`
--

INSERT INTO `school_classes` (`class_id`, `class_name`, `form_teacher`) VALUES
(9, 'BASIC 1', ''),
(10, 'BASIC 2', ''),
(11, 'BASIC 3', ''),
(12, 'BASIC 4', ''),
(13, 'BASIC 5', ''),
(14, 'BASIC 6', '');

-- --------------------------------------------------------

--
-- Table structure for table `second_term`
--

CREATE TABLE IF NOT EXISTS `second_term` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subjects` text NOT NULL,
  `other_CA` text NOT NULL,
  `CA` text NOT NULL,
  `exams` text NOT NULL,
  `total_score` text NOT NULL,
  `grade` text NOT NULL,
  `remark` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_name` text NOT NULL,
  `start_year` year(4) NOT NULL,
  `end_year` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `second_term`
--

INSERT INTO `second_term` (`id`, `subjects`, `other_CA`, `CA`, `exams`, `total_score`, `grade`, `remark`, `student_id`, `class_name`, `start_year`, `end_year`) VALUES
(5, 'MATHEMATICS', '10', '29', '50', '89', 'A', 'EXCELLENT', 17, 'BASIC 6   ', 2022, 2023),
(6, 'ENGLISH', '9', '22', '50', '81', 'A', 'EXCELLENT', 17, 'BASIC 6   ', 2022, 2023),
(7, 'BASIC SCIENCE', '9', '27', '49', '85', 'A', 'EXCELLENT', 17, 'BASIC 6   ', 2022, 2023),
(8, 'C.R.S', '10', '30', '54', '94', 'A', 'EXCELLENT', 17, 'BASIC 6   ', 2022, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_name` text NOT NULL,
  `sex` text NOT NULL,
  `date_birth` text NOT NULL,
  `class_name` text NOT NULL,
  `parent_name` text NOT NULL,
  `home_address` text NOT NULL,
  `telephone_no` text NOT NULL,
  `student_img` text NOT NULL,
  `student_token` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `sex`, `date_birth`, `class_name`, `parent_name`, `home_address`, `telephone_no`, `student_img`, `student_token`, `date`) VALUES
(16, 'Ademola Stephen', 'M', '11/28/2012', 'BASIC 6', 'Mr Ademola Joshua', 'Plot 2 Ayobello memorial hospital, Ilorin, Kwara State', '09087876766', 'avatarMale.png', 'Ademo_16', '2022-01-30 13:50:35'),
(17, 'Adetoyi Esther', 'M', '10/29/2013', 'BASIC 6', 'Mr & Mrs Adetoyi Adekunle', 'Adeyemi street, adigun alapomeji', '08034323432', 'avatarFemale.jpg', 'Adeto_17', '2022-01-30 13:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `class_name` text NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject`, `class_name`) VALUES
(19, 'MATHEMATICS', 'BASIC 6'),
(20, 'ENGLISH', 'BASIC 6'),
(21, 'BASIC SCIENCE', 'BASIC 6'),
(22, 'C.R.S', 'BASIC 6');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` text NOT NULL,
  `sex` text NOT NULL,
  `date_birth` text NOT NULL,
  `home_address` text NOT NULL,
  `telephone` text NOT NULL,
  `email` text NOT NULL,
  `teacher_img` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `teacher_name`, `sex`, `date_birth`, `home_address`, `telephone`, `email`, `teacher_img`, `date`) VALUES
(6, 'Fashanu Kolawole', 'M', '06/20/1989', 'plot 34 ademola johnson, Ibadan, Oyo.', '0807654345', 'fashanukolawole@gmail.com', 'avatarMale.png', '2022-01-30 13:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `third_term`
--

CREATE TABLE IF NOT EXISTS `third_term` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subjects` text NOT NULL,
  `other_CA` text NOT NULL,
  `CA` text NOT NULL,
  `exams` text NOT NULL,
  `total_score` text NOT NULL,
  `grade` text NOT NULL,
  `remark` text NOT NULL,
  `first_term` text NOT NULL,
  `second_term` text NOT NULL,
  `sum_avg` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_name` text NOT NULL,
  `start_year` year(4) NOT NULL,
  `end_year` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `third_term`
--

INSERT INTO `third_term` (`id`, `subjects`, `other_CA`, `CA`, `exams`, `total_score`, `grade`, `remark`, `first_term`, `second_term`, `sum_avg`, `student_id`, `class_name`, `start_year`, `end_year`) VALUES
(5, 'BASIC SCIENCE', '9', '29', '59', '97', 'A', 'EXCELLENT', '65', '85', '82.333333333333', 17, 'BASIC 6  ', 2022, 2023),
(6, 'C.R.S', '10', '22', '60', '92', 'A', 'EXCELLENT', '78', '94', '88', 17, 'BASIC 6  ', 2022, 2023),
(7, 'ENGLISH', '10', '29', '50', '89', 'A', 'EXCELLENT', '84', '81', '84.666666666667', 17, 'BASIC 6  ', 2022, 2023),
(8, 'MATHEMATICS', '10', '22', '58', '90', 'A', 'EXCELLENT', '96', '89', '91.666666666667', 17, 'BASIC 6  ', 2022, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

CREATE TABLE IF NOT EXISTS `time_table` (
  `day_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` text NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_name` text NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject_name` text NOT NULL,
  `week_day` text NOT NULL,
  `start_time` text NOT NULL,
  `end_time` text NOT NULL,
  PRIMARY KEY (`day_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `time_table`
--

INSERT INTO `time_table` (`day_id`, `teacher_name`, `teacher_id`, `class_name`, `subject_id`, `subject_name`, `week_day`, `start_time`, `end_time`) VALUES
(15, 'Fashanu Kolawole', 6, 'BASIC 6', 20, 'MATHEMATICS', 'monday', '8:00am', '8:30am'),
(16, 'Fashanu Kolawole', 6, 'BASIC 6', 20, 'MATHEMATICS', 'wednessday', '8:00am', '8:30am'),
(17, 'Fashanu Kolawole', 6, 'BASIC 6', 20, 'ENGLISH', 'monday', '7:00pm', '7:30pm'),
(18, 'Fashanu Kolawole', 6, 'BASIC 6', 20, 'ENGLISH', 'wednessday', '12:00pm', '12:30pm');

-- --------------------------------------------------------

--
-- Table structure for table `totalscore`
--

CREATE TABLE IF NOT EXISTS `totalscore` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `totalscore` int(10) unsigned NOT NULL,
  `class_name` text NOT NULL,
  `term` text NOT NULL,
  `start_year` year(4) NOT NULL,
  `end_year` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `totalscore`
--

INSERT INTO `totalscore` (`id`, `student_id`, `totalscore`, `class_name`, `term`, `start_year`, `end_year`) VALUES
(11, 16, 303, 'BASIC 6   ', '1st Term', 2022, 2023),
(12, 17, 323, 'BASIC 6   ', '1st Term', 2022, 2023),
(13, 17, 349, 'BASIC 6   ', '2nd Term', 2022, 2023),
(14, 17, 347, 'BASIC 6  ', '3rd Term', 2022, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_admindata`
--

CREATE TABLE IF NOT EXISTS `transaction_admindata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) unsigned NOT NULL,
  `transaction_reference` text NOT NULL,
  `amount` int(11) NOT NULL,
  `paid_by` text NOT NULL,
  `phone_number` int(11) NOT NULL,
  `channel` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_data`
--

CREATE TABLE IF NOT EXISTS `transaction_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(10) unsigned NOT NULL,
  `transaction_reference` text NOT NULL,
  `amount` int(11) NOT NULL,
  `paid_by` text NOT NULL,
  `phone_number` int(11) NOT NULL,
  `channel` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `tel_num` varchar(14) NOT NULL DEFAULT '0',
  `user_token` text NOT NULL,
  `default_password` text NOT NULL,
  `role` text NOT NULL,
  `date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `tel_num`, `user_token`, `default_password`, `role`, `date`) VALUES
(7, 'admin', 'admin@vbsms.com', '', '5a0bf194b1d811b365faab1bb42864ef', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'admin', '2022-01-28 12:15:16'),
(11, 'Mr Malik', 'malikBuhari@gmail.com', 'tel_num', '5ab618df462521e506618a3b78bc3c95', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'teacher', '2022-01-28 12:14:06'),
(12, 'admin2', 'admin2@sms.com', '0', '82e9ae33b14634209d4e7f860c12f45d', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'admin', '2022-01-31 02:22:49'),
(13, 'Fashanu Isaac', 'fashanuisaac@gmail.com', 'tel_num', '9ffd6a1d77a89923d00f6f28b12211ea', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'teacher', '2022-01-30 11:34:25'),
(14, 'Ayodeji Adetunji', 'ayodeji@gmail.com', 'tel_num', 'cf7e83db7e9dc59519dcacf0cd09772f', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'teacher', '2022-01-30 11:29:35'),
(15, 'Adamu Sambo', 'adamusambo@gmail.com', 'tel_num', '133c2f4d14219fa902f139ba27b94902', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'teacher', '2022-01-30 13:04:54'),
(16, 'Fashanu Kolawole', 'fashanukolawole@gmail.com', 'tel_num', 'a39f0096fc0b7afde6f6682000509a92', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'teacher', '2022-01-30 13:58:53'),
(17, 'Mr Adetoyi', 'adetoyi@gmail.com', 'tel_num', '16f640be9785145344b635cde8cf7d83', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'parent', '2022-01-30 14:17:14');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
