CREATE DATABASE IF NOT EXISTS `id18200856_vbsms`;

USE `id18200856_vbsms`;

DROP TABLE IF EXISTS `assign_subjects`;

CREATE TABLE `assign_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` text NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_name` text NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `assign_subjects` VALUES("1","ENGLISH","1","BASIC 1","1");
INSERT INTO `assign_subjects` VALUES("2","BASIC SCIENCE","3","BASIC 1","1");
INSERT INTO `assign_subjects` VALUES("3","ENGLISH","5","BASIC 2","1");
INSERT INTO `assign_subjects` VALUES("4","MATHEMATICS","6","BASIC 2","1");
INSERT INTO `assign_subjects` VALUES("5","FRENCH","7","BASIC 2","1");
INSERT INTO `assign_subjects` VALUES("6","MATHEMATICS","2","BASIC 1","1");



DROP TABLE IF EXISTS `assignment_category`;

CREATE TABLE `assignment_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `assignment_category` VALUES("1","Basic Science");



DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

INSERT INTO `attendance` VALUES("1","1","Present","","","10/01/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("2","8","Present","","","10/01/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("3","1","Absent","","","10/02/2019","10","BASIC 1","0");
INSERT INTO `attendance` VALUES("4","8","Absent","","","10/02/2019","10","BASIC 1","0");
INSERT INTO `attendance` VALUES("5","1","Present","","","10/03/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("6","8","Present","","","10/03/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("7","1","Present","","","10/04/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("8","8","Present","","","10/04/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("9","1","Present","","","10/07/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("10","8","Present","","","10/07/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("11","1","Present","","","10/08/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("12","8","Absent","","","10/08/2019","10","BASIC 1","0");
INSERT INTO `attendance` VALUES("13","1","Present","","","10/09/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("14","8","Present","","","10/09/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("15","1","Present","","","10/23/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("16","8","Present","","","10/23/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("17","1","Present","","First Term","10/15/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("18","8","Present","","First Term","10/15/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("19","1","Present","","First Term","10/22/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("20","8","Present","","First Term","10/22/2019","10","BASIC 1","4.35");
INSERT INTO `attendance` VALUES("21","1","Absent","","","10/24/2019","10","BASIC 1","0");
INSERT INTO `attendance` VALUES("22","8","Absent","","","10/24/2019","10","BASIC 1","0");
INSERT INTO `attendance` VALUES("23","1","Absent","","","10/18/2021","10","BASIC 1","0");
INSERT INTO `attendance` VALUES("24","8","Present","","First Term","10/18/2021","10","BASIC 1","4.76");
INSERT INTO `attendance` VALUES("25","1","Present","","First Term","10/20/2021","10","BASIC 1","4.76");
INSERT INTO `attendance` VALUES("26","8","Absent","","","10/20/2021","10","BASIC 1","0");



DROP TABLE IF EXISTS `class_session`;

CREATE TABLE `class_session` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `start_year` year(4) NOT NULL,
  `end_year` year(4) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `class_session` VALUES("1","BASIC 1","1","2019","2020");
INSERT INTO `class_session` VALUES("2","BASIC 2","2","2019","2020");
INSERT INTO `class_session` VALUES("6","BASIC 1","8","2019","2020");
INSERT INTO `class_session` VALUES("7","BASIC 1","1","2020","2021");



DROP TABLE IF EXISTS `classes`;

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `class_name` text NOT NULL,
  `term_status` int(10) unsigned NOT NULL,
  `teacher_id` text NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `classes` VALUES("1","Basic Science","Basic 1","0","1");
INSERT INTO `classes` VALUES("2","French","Basic 1","0","1");
INSERT INTO `classes` VALUES("3","English","Basic 2","0","1");
INSERT INTO `classes` VALUES("4","Mathematics","Basic 2","0","1");
INSERT INTO `classes` VALUES("5","spanish","Basic 2","0","1");



DROP TABLE IF EXISTS `first_term`;

CREATE TABLE `first_term` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `first_term` VALUES("1","ENGLISH","10","30","40","80","A","EXCELLENT","1","BASIC 1 ","2019","2020");
INSERT INTO `first_term` VALUES("2","MATHEMATICS","10","20","40","70","B","VERY GOOD","1","BASIC 1 ","2019","2020");
INSERT INTO `first_term` VALUES("3","BASIC SCIENCE","10","20","30","60","B","VERY GOOD","1","BASIC 1 ","2019","2020");
INSERT INTO `first_term` VALUES("4","RELIGIOUS STUDIES","0","20","30","50","C","GOOD","1","BASIC 1 ","2019","2020");



DROP TABLE IF EXISTS `grading_percent`;

CREATE TABLE `grading_percent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percentage` int(11) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `grading_percent` VALUES("1","50","OFF");



DROP TABLE IF EXISTS `observation_conduct`;

CREATE TABLE `observation_conduct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `params` text NOT NULL,
  `grade` text NOT NULL,
  `student_id` text NOT NULL,
  `class_name` text NOT NULL,
  `term` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO `observation_conduct` VALUES("1","honesty","","","","");
INSERT INTO `observation_conduct` VALUES("2","cleanliness","","","","");
INSERT INTO `observation_conduct` VALUES("3","punctuality","","","","");
INSERT INTO `observation_conduct` VALUES("4","attentiveness","","","","");
INSERT INTO `observation_conduct` VALUES("5","carefulness","","","","");
INSERT INTO `observation_conduct` VALUES("6","considerate","","","","");
INSERT INTO `observation_conduct` VALUES("7","politeness","","","","");
INSERT INTO `observation_conduct` VALUES("8","obedience","","","","");
INSERT INTO `observation_conduct` VALUES("9","promptness at work","","","","");
INSERT INTO `observation_conduct` VALUES("10","works independently","","","","");
INSERT INTO `observation_conduct` VALUES("11","logical reasoning","","","","");
INSERT INTO `observation_conduct` VALUES("12","enjoys company of mates","","","","");
INSERT INTO `observation_conduct` VALUES("13","enjoys drawing & craft","","","","");
INSERT INTO `observation_conduct` VALUES("14","does homework regularly","","","","");
INSERT INTO `observation_conduct` VALUES("15","club & society","","","","");
INSERT INTO `observation_conduct` VALUES("16","team work/co-operation","","","","");
INSERT INTO `observation_conduct` VALUES("17","comprehension","","","","");
INSERT INTO `observation_conduct` VALUES("18","observation & manipulative skills","","","","");
INSERT INTO `observation_conduct` VALUES("19","manual skill(Dexterity)","","","","");
INSERT INTO `observation_conduct` VALUES("20","organising ability","","","","");
INSERT INTO `observation_conduct` VALUES("21","perceptual ability","","","","");
INSERT INTO `observation_conduct` VALUES("22","creativity","","","","");
INSERT INTO `observation_conduct` VALUES("23","participatory behaviour","","","","");
INSERT INTO `observation_conduct` VALUES("24","physical agility","","","","");
INSERT INTO `observation_conduct` VALUES("25","handwriting","","","","");



DROP TABLE IF EXISTS `observation_conduct_grades`;

CREATE TABLE `observation_conduct_grades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `params` text NOT NULL,
  `grade` text NOT NULL,
  `class_name` text NOT NULL,
  `term` text NOT NULL,
  `teachers_comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO `observation_conduct_grades` VALUES("1","1","honesty","A","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("2","1","cleanliness","A","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("3","1","punctuality","A","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("4","1","attentiveness","A","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("5","1","carefulness","A","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("6","1","considerate","A","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("7","1","politeness","A","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("8","1","obedience","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("9","1","promptness at work","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("10","1","works independently","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("11","1","logical reasoning","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("12","1","enjoys company of mates","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("13","1","enjoys drawing & craft","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("14","1","does homework regularly","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("15","1","club & society","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("16","1","team work/co-operation","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("17","1","comprehension","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("18","1","observation & manipulative skills","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("19","1","manual skill(Dexterity)","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("20","1","organising ability","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("21","1","perceptual ability","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("22","1","creativity","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("23","1","participatory behaviour","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("24","1","physical agility","","BASIC 1 ","1st Term","");
INSERT INTO `observation_conduct_grades` VALUES("25","1","handwriting","","BASIC 1 ","1st Term","");



DROP TABLE IF EXISTS `other_params`;

CREATE TABLE `other_params` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `previous_classes`;

CREATE TABLE `previous_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `previous_class` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `question_answers`;

CREATE TABLE `question_answers` (
  `answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `answer` text NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `question_answers` VALUES("1","1960","1");
INSERT INTO `question_answers` VALUES("2","peace","2");
INSERT INTO `question_answers` VALUES("3","1972","1");



DROP TABLE IF EXISTS `question_options`;

CREATE TABLE `question_options` (
  `option_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `options` text NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `question_options` VALUES("1","1960","1");
INSERT INTO `question_options` VALUES("2","1955","1");
INSERT INTO `question_options` VALUES("3","1940","1");
INSERT INTO `question_options` VALUES("4","love","2");
INSERT INTO `question_options` VALUES("5","peace","2");
INSERT INTO `question_options` VALUES("6","strength","2");



DROP TABLE IF EXISTS `questions`;

CREATE TABLE `questions` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `points` int(11) NOT NULL,
  `question_type` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `questions` VALUES("1","In what year did Nigeria gain her independence?","10","Multichoice","1");
INSERT INTO `questions` VALUES("2","what does the white color in Nigeria Flag signify","10","Multichoice","1");
INSERT INTO `questions` VALUES("3","","0","Multichoice","1");
INSERT INTO `questions` VALUES("4","","0","Multichoice","1");



DROP TABLE IF EXISTS `school_classes`;

CREATE TABLE `school_classes` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` text NOT NULL,
  `form_teacher` text NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `school_classes` VALUES("1","BASIC 1","");
INSERT INTO `school_classes` VALUES("2","BASIC 2","");
INSERT INTO `school_classes` VALUES("3","BASIC 3","");
INSERT INTO `school_classes` VALUES("4","BASIC 4","");
INSERT INTO `school_classes` VALUES("5","BASIC 5","");
INSERT INTO `school_classes` VALUES("6","PLAY GROUP","");



DROP TABLE IF EXISTS `second_term`;

CREATE TABLE `second_term` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `second_term` VALUES("1","ENGLISH","10","30","45","85","A","EXCELLENT","1","BASIC 1  ","2019","2020");
INSERT INTO `second_term` VALUES("2","MATHEMATICS","10","30","40","80","A","EXCELLENT","1","BASIC 1  ","2019","2020");
INSERT INTO `second_term` VALUES("3","BASIC SCIENCE","10","30","40","80","A","EXCELLENT","1","BASIC 1  ","2019","2020");
INSERT INTO `second_term` VALUES("4","RELIGIOUS STUDIES","10","30","40","80","A","EXCELLENT","1","BASIC 1  ","2019","2020");



DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `students` VALUES("1","adeyemi temidayo","M","04/23/1984","BASIC 1","mr & mrs adeyemi","no 11bodija","07051215220","doctor2.jpg","","2019-04-04 13:58:24");
INSERT INTO `students` VALUES("2","ADEWOLE FUNMI","F","01/29/2002","BASIC 2","MR&MRS ADEWOLE","NO12 ASHI BODIJA","07051215220","doctor1.jpg","","2019-04-05 13:23:13");
INSERT INTO `students` VALUES("8","Anjola","F","01/01/2014","BASIC 1","Mr&Mrs Olatunde","Ashi-Bodija","07051215220","style.jpg","Anjol_8","2019-10-18 11:21:18");



DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `class_name` text NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `subjects` VALUES("1","ENGLISH","BASIC 1");
INSERT INTO `subjects` VALUES("2","MATHEMATICS","BASIC 1");
INSERT INTO `subjects` VALUES("3","BASIC SCIENCE","BASIC 1");
INSERT INTO `subjects` VALUES("4","RELIGIOUS STUDIES","BASIC 1");
INSERT INTO `subjects` VALUES("5","ENGLISH","BASIC 2");
INSERT INTO `subjects` VALUES("6","MATHEMATICS","BASIC 2");
INSERT INTO `subjects` VALUES("7","FRENCH","BASIC 2");



DROP TABLE IF EXISTS `teachers`;

CREATE TABLE `teachers` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `teachers` VALUES("1","Mr bakare","M","01/25/1989","no14 ashi-bodija","07051215220","engr_temilewa@yahoo.com","doctor2.jpg","2019-04-04 15:40:23");



DROP TABLE IF EXISTS `third_term`;

CREATE TABLE `third_term` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `third_term` VALUES("1","BASIC SCIENCE","10","30","40","80","B","","60","80","73.333333333333","1","BASIC 1","2019","2020");
INSERT INTO `third_term` VALUES("2","ENGLISH","10","30","40","80","A","","80","85","81.666666666667","1","BASIC 1","2019","2020");
INSERT INTO `third_term` VALUES("3","MATHEMATICS","10","25","45","80","B","","70","80","76.666666666667","1","BASIC 1","2019","2020");
INSERT INTO `third_term` VALUES("4","RELIGIOUS STUDIES","10","30","40","80","B","","50","80","70","1","BASIC 1","2019","2020");



DROP TABLE IF EXISTS `time_table`;

CREATE TABLE `time_table` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `time_table` VALUES("1","Mr bakare","1","BASIC 1","3","ENGLISH","monday","10am","10:30am");
INSERT INTO `time_table` VALUES("2","Mr bakare","1","BASIC 1","3","ENGLISH","tuesday","10am","10:30am");
INSERT INTO `time_table` VALUES("3","Mr bakare","1","BASIC 1","3","BASIC SCIENCE","monday","10:30am","11am");
INSERT INTO `time_table` VALUES("4","Mr bakare","1","BASIC 1","3","BASIC SCIENCE","wednessday","10am","10:30am");



DROP TABLE IF EXISTS `totalscore`;

CREATE TABLE `totalscore` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `totalscore` int(10) unsigned NOT NULL,
  `class_name` text NOT NULL,
  `term` text NOT NULL,
  `start_year` year(4) NOT NULL,
  `end_year` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `totalscore` VALUES("1","1","260","BASIC 1 ","1st Term","2019","2020");
INSERT INTO `totalscore` VALUES("2","1","300","BASIC 1 ","2nd Term","2019","2020");
INSERT INTO `totalscore` VALUES("3","1","0","BASIC 1   ","2nd Term","2019","2020");
INSERT INTO `totalscore` VALUES("4","1","0","BASIC 1  ","2nd Term","2019","2020");
INSERT INTO `totalscore` VALUES("5","1","0","BASIC 1  ","2nd Term","2019","2020");
INSERT INTO `totalscore` VALUES("6","1","325","BASIC 1  ","2nd Term","2019","2020");
INSERT INTO `totalscore` VALUES("9","1","302","BASIC 1","3rd Term","2019","2020");



DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `tel_num` varchar(14) NOT NULL DEFAULT '0',
  `user_token` text NOT NULL,
  `default_password` text NOT NULL,
  `role` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `users` VALUES("7","admin","admin@vbsms.com","","36e516b7cdc5297b3efcad11f70852b1","5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8","admin","2022-01-01 09:48:55");
INSERT INTO `users` VALUES("8","omoba","engr_temilewa@yahoo.com","","50134c86c1f95dbaac56f62ecd5adcc6","5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8","teacher","2021-12-31 10:34:24");
INSERT INTO `users` VALUES("10","Mr Olatunde","olatunde@gmail.com","","4cf8d641fa40242a030d7190db592547","5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8","parent","2021-12-31 12:42:58");
