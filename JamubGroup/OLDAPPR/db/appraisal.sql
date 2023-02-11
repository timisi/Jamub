-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2022 at 10:36 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aci_leave`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'admin123', '2022-11-01 05:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_type`
--

DROP TABLE IF EXISTS `evaluation_type`;
CREATE TABLE IF NOT EXISTS `evaluation_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Evaluation_Type` varchar(200) NOT NULL,
  `Description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_type`
--

INSERT INTO `evaluation_type` (`id`, `Evaluation_Type`, `Description`) VALUES
(1, 'MONTHLY', 'monthly description'),
(2, 'QUARTERLY', 'quaterly appraisal'),
(3, 'BI-ANNUAL', 'bi-annual appraisal'),
(4, 'ANNUAL', 'annual appraisal');

-- --------------------------------------------------------

--
-- Table structure for table `tbappraisal`
--

DROP TABLE IF EXISTS `tbappraisal`;
CREATE TABLE IF NOT EXISTS `tbappraisal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Evaluation_Type` varchar(200) NOT NULL,
  `Review_Period` varchar(200) NOT NULL,
  `Date_of_Last_Review` date NOT NULL,
  `Task_Done` varchar(350) NOT NULL,
  `Expected_Task` varchar(350) NOT NULL,
  `Archieved_Task` int(20) NOT NULL,
  `Challenges` varchar(500) NOT NULL,
  `Partner_Signature` varchar(120) DEFAULT NULL,
  `HODSign` varchar(120) NOT NULL,
  `HODDate` varchar(120) NOT NULL,
  `HODRemark` varchar(120) NOT NULL,
  `HRSign` varchar(120) NOT NULL,
  `HRRemark` varchar(120) NOT NULL,
  `HRDate` varchar(120) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `Empid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Empid` (`Empid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

DROP TABLE IF EXISTS `tbldepartments`;
CREATE TABLE IF NOT EXISTS `tbldepartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `CreationDate`) VALUES
(2, 'Information Technologies', 'ICT', '2017-11-01 07:19:37'),
(3, 'Library', 'LIb', '2021-05-21 08:27:45'),
(4, 'Account and Finance', 'acct', '2022-10-25 10:08:39'),
(5, 'Procurement', 'logistics', '2022-10-25 10:09:26'),
(6, 'Engineering', 'aec', '2022-10-25 10:09:49'),
(7, 'Security', 'SOS', '2022-11-19 15:35:06'),
(8, 'Administration', 'ADM', '2022-12-06 16:31:18');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

DROP TABLE IF EXISTS `tblemployees`;
CREATE TABLE IF NOT EXISTS `tblemployees` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `Staff_ID` varchar(50) NOT NULL,
  `Position_Staff` varchar(100) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(30) NOT NULL,
  `location` varchar(200) NOT NULL,
  `signature` varchar(200) NOT NULL,
  `Responsibilities` varchar(800) NOT NULL,
  `Grade` varchar(600) NOT NULL,
  `Subsidiary` varchar(600) NOT NULL,
  `Line_Manager` varchar(600) NOT NULL,
  `Supervisor` varchar(600) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`emp_id`, `FirstName`, `LastName`, `Staff_ID`, `Position_Staff`, `EmailId`, `Password`, `Gender`, `Dob`, `Department`, `Address`, `Phonenumber`, `Status`, `RegDate`, `role`, `location`, `signature`, `Responsibilities`, `Grade`, `Subsidiary`, `Line_Manager`, `Supervisor`) VALUES
(2, 'Edem', 'Mcwilliams', '124', 'Registra', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'Male', '3 February, 1990', 'ICT', 'N NEPO', '07222288890', 'Online', '2017-11-10 13:40:02', 'Admin', 'photo2.jpg', 'reg_de_07222288890_2.png', '', '', '', '', ''),
(4, 'Nathaniel', 'Nkrumah', '125', 'ICT Director', 'rk@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '3 February, 1990', 'ICT', 'N NEPO', '1110088165', 'Offline', '2017-11-10 13:40:02', 'Admin', 'NO-IMAGE-AVAILABLE.jpg', '', '', '', '', '', ''),
(9, 'Richard', 'Awuni', 'TK-324', 'Senior Web Developer', 'knath@gmail.com', '6ae199a93c381bf6d5de27491139d3f9', 'male', '10 April 1981', 'ICT', 'Abas Station', '0211988637', 'Offline', '2022-08-04 18:06:27', 'HOD', 'photo8.jpg', 'hod_ic_0211988637_9.png', '', '', '', '', ''),
(10, 'Bridget', 'Gafa', 'TK-222', 'Accountant', 'gafa3@gmail.com', 'f5c0c4da1f91f20f9bb3a0e0fe376d4f', 'female', '24 November 1998', 'acct', 'Abas Road', '0102222928', 'Online', '2022-08-04 18:18:50', 'HOD', 'photo4.jpg', 'hod_ri_0102222928_10.png', '', '', '', '', ''),
(17, 'Tolulope', 'Afolayan', 'JG/001', 'Web Developer', 'afolayantoluwalope@gmail.com', 'da54851150fe6cff474d5e8b31b7f619', 'male', '08 November 2022', 'ICT', 'back of ajuba', '08067223967', 'Offline', '2022-11-19 20:57:51', 'Staff', '', '', '																																		- To design websites\r\n- To design banners\r\n- To design flyers\r\n- To makes contents\r\n																', 'Entry Level', 'Espermoh', 'Richard Awuni', 'Christine Abel'),
(18, 'Tunmise', 'Obalolola', 'JG/002', 'UI/UX Designer', 'tunmiseobalola@gmail.com', '28bab71dbc220ffb06f1465384f25d21', 'male', '22 November 2022', 'ICT', 'back of Lagos', '09067223963', 'Offline', '2022-11-19 21:00:17', 'Staff', 'NO-IMAGE-AVAILABLE.jpg', '', '- To create design for UI/UX\r\n- To create contents for websites', 'Entry Level', 'StagebyStage', 'Richard Awuni', 'Christine Abel'),
(19, 'Akinwale ', 'John', 'JG/ACCT/001', 'Taxation Officer', 'akinwale@gmail.com', 'dbfdbe0809f3c603cb1ad9aecf4af0c7', 'male', '13 November 2022', 'acct', 'back of me eko', '08089234563', 'Offline', '2022-11-19 21:06:25', 'Staff', 'NO-IMAGE-AVAILABLE.jpg', '', '- To Pay salaries\r\n- To pay taxes', 'Entry Level 1', 'MenzorLimited', 'Adebayo Amos', 'Christine Abel'),
(20, 'Amos', 'Abel', 'JG/ACCT/002', 'Account officer', 'amosabel@gmail.com', 'f7f6f8dc79daea2e0bdfdb757b78424b', 'male', '12 July 2022', 'acct', 'back of me eko', '09065737362', 'Offline', '2022-11-19 21:08:56', 'Staff', 'NO-IMAGE-AVAILABLE.jpg', '', 'To Pay taxes\r\nTo Deduct charges\r\nTo pay allawances', 'Entry Level 1', 'JamubITLounge', 'Adebayo Amos', 'Christine Abel'),
(21, 'Eko', 'Paul', 'JG/ADM/009', 'Admin Officer', 'ekoeko@gmail.com', '8e1a070e9b0340da2b0ea4f193c172f0', 'female', '13 December 2022', 'ADM', 'back of me eko', '08026773399', 'Online', '2022-12-06 16:30:14', 'Staff', 'NO-IMAGE-AVAILABLE.jpg', '', 'To eat, To sleep, To dance, To Mekwe with ETID\r\n											', 'Senior Partner', 'JamubAcademy', 'Tolulope Segun', 'Tolulope Afolayan'),
(22, 'Friday', 'John', 'JG/ADM/001', 'Senior Admin Officer', 'friday@gmail.com', '15f08dcdb4f42a8a3e4e2a50de1486f8', 'male', '13 December 2022', 'ADM', 'back of me eko', '09067338987', 'Online', '2022-12-06 16:44:00', 'HOD', 'NO-IMAGE-AVAILABLE.jpg', '', 'Eat, drink, and sleep', 'Manager', 'JamubAcademy', 'Jude Akon', 'Seyi Hassan');

-- --------------------------------------------------------

--
-- Table structure for table `tblleave`
--

DROP TABLE IF EXISTS `tblleave`;
CREATE TABLE IF NOT EXISTS `tblleave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EvaluationType` varchar(110) NOT NULL,
  `ReviewPeriod` varchar(20) NOT NULL,
  `DateofLastReview` varchar(120) NOT NULL,
  `Sign` varchar(120) DEFAULT NULL,
  `PostingDate` date DEFAULT NULL,
  `TaskDone` varchar(600) NOT NULL,
  `ExpectedNumberofTask` varchar(20) NOT NULL,
  `TotalTaskAchieved` varchar(20) NOT NULL,
  `Challenges` varchar(500) NOT NULL,
  `HodRemarks` int(11) NOT NULL DEFAULT '0',
  `HodSign` varchar(200) NOT NULL,
  `HodDate` varchar(120) NOT NULL,
  `RegRemarks` int(1) NOT NULL DEFAULT '0',
  `RegSign` varchar(200) NOT NULL,
  `RegDate` varchar(120) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `total_arch_perc_average` int(20) NOT NULL,
  `total_overall_score` int(20) NOT NULL,
  `taskpercentage` varchar(200) NOT NULL,
  `part_b_totalscore_percentage` int(20) NOT NULL,
  `personalityscore` int(20) NOT NULL,
  `qowscore` int(20) NOT NULL,
  `communicationsore` int(20) NOT NULL,
  `attendancescore` int(20) NOT NULL,
  `creativityscore` int(20) NOT NULL,
  `jobknowledgescore` int(20) NOT NULL,
  `teamworkscore` int(20) NOT NULL,
  `professionalismscore` int(20) NOT NULL,
  `leadershipscore` int(20) NOT NULL,
  `integrityscore` int(20) NOT NULL,
  `acceptconstructive` int(20) NOT NULL,
  `demonstratesapleasant` int(20) NOT NULL,
  `meetsestablished` int(20) NOT NULL,
  `carefullyfollows` int(20) NOT NULL,
  `expressselfclearly` int(20) NOT NULL,
  `providesfeedbacks` int(20) NOT NULL,
  `regularlypresent` int(20) NOT NULL,
  `schedulesandusesleave` int(20) NOT NULL,
  `performsassignedduties` int(20) NOT NULL,
  `identifiesandproffers` int(20) NOT NULL,
  `comesupwithnewideas` int(20) NOT NULL,
  `demonstratestheknowledge` int(20) NOT NULL,
  `hasproperunderdtanding` int(20) NOT NULL,
  `workswellwith` int(20) NOT NULL,
  `willinglyacceptswork` int(20) NOT NULL,
  `maintainsconfidentiality` int(20) NOT NULL,
  `interestedinaswellasparticipates` int(20) NOT NULL,
  `motivatesandbrings` int(20) NOT NULL,
  `stablishesclear` int(20) NOT NULL,
  `delegatesclearly` int(20) NOT NULL,
  `adheresto` int(20) NOT NULL,
  `personalactions` int(20) NOT NULL,
  `cummunicateshigh` int(20) NOT NULL,
  `justifications` varchar(500) NOT NULL,
  `hrmapprovalcomment` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `UserEmail` (`empid`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleave`
--

INSERT INTO `tblleave` (`id`, `EvaluationType`, `ReviewPeriod`, `DateofLastReview`, `Sign`, `PostingDate`, `TaskDone`, `ExpectedNumberofTask`, `TotalTaskAchieved`, `Challenges`, `HodRemarks`, `HodSign`, `HodDate`, `RegRemarks`, `RegSign`, `RegDate`, `IsRead`, `empid`, `total_arch_perc_average`, `total_overall_score`, `taskpercentage`, `part_b_totalscore_percentage`, `personalityscore`, `qowscore`, `communicationsore`, `attendancescore`, `creativityscore`, `jobknowledgescore`, `teamworkscore`, `professionalismscore`, `leadershipscore`, `integrityscore`, `acceptconstructive`, `demonstratesapleasant`, `meetsestablished`, `carefullyfollows`, `expressselfclearly`, `providesfeedbacks`, `regularlypresent`, `schedulesandusesleave`, `performsassignedduties`, `identifiesandproffers`, `comesupwithnewideas`, `demonstratestheknowledge`, `hasproperunderdtanding`, `workswellwith`, `willinglyacceptswork`, `maintainsconfidentiality`, `interestedinaswellasparticipates`, `motivatesandbrings`, `stablishesclear`, `delegatesclearly`, `adheresto`, `personalactions`, `cummunicateshigh`, `justifications`, `hrmapprovalcomment`) VALUES
(172, 'MONTHLY', 'August, 2022', '2022-12-06', 'sig_ol_08067223967_17.png', '2022-12-05', 'I design workflow|I check website|I follow pages', '12|11|12', '10|10|8', 'I did it ooooo', 1, 'hod_ic_0211988637_9.png', '2022-12-05 ', 1, 'reg_de_07222288890_2.png', '2022-12-05 ', 1, 17, 80, 82, '083.33|90.91|66.67', 88, 90, 90, 90, 80, 93, 90, 70, 90, 93, 87, 4, 5, 4, 5, 4, 5, 4, 4, 4, 5, 5, 4, 5, 3, 4, 4, 5, 5, 4, 5, 4, 5, 4, 'Very well', 'Just very well'),
(173, 'QUARTERLY', 'Kunle, 2023', '2022-12-13', 'sig_ol_08067223967_17.png', '2022-12-05', 'I design workflow|I check website|I follow pages|Chopping', '12|11|12|23', '10|10|8|22', 'well well', 1, 'hod_ic_0211988637_9.png', '2022-12-05 ', 1, 'reg_de_07222288890_2.png', '2022-12-05 ', 1, 17, 84, 86, '083.33|90.91|66.67|95.65', 89, 90, 90, 90, 90, 93, 90, 80, 100, 73, 93, 5, 4, 5, 4, 5, 4, 5, 4, 5, 4, 5, 5, 4, 4, 4, 5, 5, 4, 4, 3, 5, 4, 5, 'well well', 'well tolu'),
(174, 'MONTHLY', 'December', '2022-12-09', 'sig_ko_08026773399_21.png', '2022-12-06', 'I design workflow|I check website|I follow pages|Chopping', '12|11|12|23', '10|10|8|22', 'I chop although', 1, '', '2022-12-06 ', 0, '', '', 1, 21, 84, 0, '083.33|90.91|66.67|95.65', 97, 90, 90, 90, 100, 100, 100, 100, 100, 100, 100, 4, 5, 4, 5, 5, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 'He did very well', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

DROP TABLE IF EXISTS `tblleavetype`;
CREATE TABLE IF NOT EXISTS `tblleavetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext,
  `date_from` varchar(200) NOT NULL,
  `date_to` varchar(200) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `date_from`, `date_to`, `CreationDate`) VALUES
(5, 'Casual Leave', 'Casual Leave', '2021-05-23', '2021-06-20', '2021-05-19 14:32:03'),
(6, 'Medical Leave', 'Medical Leave', '2021-05-05', '2021-05-28', '2021-05-19 15:29:05'),
(8, 'Other', 'Leave all staff', '31-05-2021', '04-06-2021', '2021-05-20 17:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

DROP TABLE IF EXISTS `tbl_message`;
CREATE TABLE IF NOT EXISTS `tbl_message` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` text NOT NULL,
  `outgoing_msg_id` text NOT NULL,
  `text_message` text NOT NULL,
  `curr_date` text NOT NULL,
  `curr_time` text NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `text_message`, `curr_date`, `curr_time`) VALUES
(1, '10', '9', 'Hi\n', 'October 24, 2022 ', '6:21 pm'),
(2, '10', '9', 'Hi', 'October 24, 2022 ', '6:33 pm'),
(3, '10', '9', 'Hi\n', 'October 24, 2022 ', '6:33 pm'),
(4, '2', '12', 'Hi Boss', 'November 3, 2022 ', '4:37 pm'),
(5, '2', '12', 'How is the work going', 'November 3, 2022 ', '4:37 pm'),
(6, '12', '2', 'Very well Tolu, Trust youre good', 'November 3, 2022 ', '4:38 pm'),
(7, '9', '17', 'Have u seen my appraisal application', 'November 23, 2022 ', '4:43 pm'),
(8, '9', '17', 'It was sent last night', 'November 23, 2022 ', '4:44 pm'),
(9, '9', '17', 'Hi boss\nhow is you today', 'November 26, 2022 ', '10:48 pm'),
(10, '17', '9', 'Very well Tolu', 'November 26, 2022 ', '10:56 pm'),
(11, '18', '17', 'Hi good morning sir', 'November 28, 2022 ', '7:14 am'),
(12, '21', '22', 'Hey boss! how is the work nah', 'December 6, 2022 ', '4:54 pm'),
(13, '22', '21', 'Work is going on fine', 'December 6, 2022 ', '4:54 pm');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
