-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2017 at 11:02 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `churchreport`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitydescription`
--

CREATE TABLE `activitydescription` (
  `Activity_ID` int(11) NOT NULL,
  `Activity` varchar(100) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activitydescription`
--

INSERT INTO `activitydescription` (`Activity_ID`, `Activity`, `Code`, `id`, `date`) VALUES
(1, 'Designing', 'DE', 0, '2016-10-15 22:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `activitystate`
--

CREATE TABLE `activitystate` (
  `ActivationStateID` int(11) NOT NULL,
  `ActivityUpdate_ID` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activitytime`
--

CREATE TABLE `activitytime` (
  `Time_ID` int(11) NOT NULL,
  `ActivityUpdate_ID` int(11) NOT NULL,
  `Start_Hour` int(11) NOT NULL,
  `Start_Minute` int(11) NOT NULL,
  `End_Hour` int(11) NOT NULL,
  `End_Minute` int(11) NOT NULL,
  `Start_Time` int(11) NOT NULL,
  `End_Time` int(11) NOT NULL,
  `Total_Hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activityupdate`
--

CREATE TABLE `activityupdate` (
  `ActivityUpdate_ID` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `Activity_Description` text NOT NULL,
  `Department_ID` int(11) NOT NULL,
  `SectionID` int(11) NOT NULL,
  `Designation_ID` int(11) NOT NULL,
  `Date_Worked` date NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Hours_Worked` time NOT NULL,
  `Activity_ID` int(11) NOT NULL,
  `Remarks` text NOT NULL,
  `Activity_State` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `Date_Recieved` datetime NOT NULL,
  `id` int(11) NOT NULL,
  `ReviewerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activityupdate`
--

INSERT INTO `activityupdate` (`ActivityUpdate_ID`, `ProjectID`, `Activity_Description`, `Department_ID`, `SectionID`, `Designation_ID`, `Date_Worked`, `Start_Time`, `End_Time`, `Hours_Worked`, `Activity_ID`, `Remarks`, `Activity_State`, `Date`, `Date_Recieved`, `id`, `ReviewerID`) VALUES
(24, 0, 'Engineering Supervised', 2, 2, 3, '2017-03-07', '15:17:00', '12:14:00', '20:57:00', 1, 'work completed', 4, '2017-04-04 12:58:27', '2017-04-04 12:58:44', 5, 1),
(25, 0, 'Glass Frame Supervising', 2, 2, 3, '2017-04-19', '13:07:00', '12:15:00', '23:08:00', 1, '50%  work done.', 5, '2017-04-06 10:41:53', '2017-04-06 10:42:12', 5, 1),
(26, 0, 'Digging Projects', 2, 2, 3, '2017-04-18', '06:07:00', '10:14:00', '23:07:00', 1, 'Digging is done', 4, '2017-04-07 10:06:17', '2017-04-07 10:07:05', 5, 1),
(27, 1, 'Drilling Project', 2, 2, 3, '2017-04-16', '15:12:00', '14:13:00', '23:01:00', 1, 'wwwwww', 4, '2017-04-12 14:56:48', '2017-04-18 11:27:16', 5, 1),
(28, 1, 'Glass Framing', 2, 2, 3, '2017-04-05', '16:13:00', '13:09:00', '20:56:00', 1, 'Done', 2, '2017-04-18 13:23:53', '2017-04-20 10:45:08', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `AreaID` int(11) NOT NULL,
  `AreaName` varchar(100) NOT NULL,
  `AreaCode` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`AreaID`, `AreaName`, `AreaCode`, `id`, `created_at`, `updated_at`) VALUES
(1, 'LA Area', '00001', 19, '2017-05-09 16:36:40', '2017-05-09 16:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `assembly`
--

CREATE TABLE `assembly` (
  `AssemblyID` int(11) NOT NULL,
  `AssemblyName` varchar(100) NOT NULL,
  `AssemblyCode` varchar(100) NOT NULL,
  `DistrictID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assembly`
--

INSERT INTO `assembly` (`AssemblyID`, `AssemblyName`, `AssemblyCode`, `DistrictID`, `id`, `created_at`, `updated_at`) VALUES
(1, 'Pentecost Redemption', '001', 1, 19, '2017-05-09 16:37:07', '0000-00-00 00:00:00'),
(2, 'Central Police Station', '002', 1, 19, '2017-05-09 16:37:16', '0000-00-00 00:00:00'),
(3, 'Abuja Assembly', '003', 1, 19, '2017-05-10 13:32:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `id` int(11) NOT NULL,
  `FinanceID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `Comment`, `id`, `FinanceID`, `created_at`, `updated_at`) VALUES
(1, 'This Duration worked is unacceptable.', 1, 4, '2017-05-10 10:47:14', '2017-04-06 10:38:12'),
(2, 'the district worked in is wrong kindly make changes to that', 1, 25, '2017-04-06 10:41:01', '2017-04-06 10:41:01'),
(3, 'The the locality is not in the region selected.kIndly review and correct mistake.', 1, 26, '2017-04-06 11:22:02', '2017-04-06 11:22:02'),
(4, 'Approved', 1, 26, '2017-04-07 10:07:05', '2017-04-07 10:07:05'),
(5, 'Approved', 1, 27, '2017-04-18 11:27:16', '2017-04-18 11:27:16'),
(6, 'Approved', 1, 28, '2017-04-20 10:45:08', '2017-04-20 10:45:08'),
(7, 'Approved', 1, 4, '2017-05-10 11:01:46', '2017-05-10 11:01:46'),
(8, 'dddd', 1, 1, '2017-05-10 11:02:36', '2017-05-10 11:02:36'),
(9, 'Approved', 1, 4, '2017-05-10 12:22:27', '2017-05-10 12:22:27'),
(10, 'IIII', 1, 4, '2017-05-11 11:13:00', '2017-05-11 11:13:00'),
(11, 'KKKK', 1, 3, '2017-05-11 11:15:34', '2017-05-11 11:15:34'),
(12, 'Approved', 1, 1, '2017-05-12 11:04:59', '2017-05-12 11:04:59'),
(13, 'ggggg', 1, 3, '2017-05-12 11:10:32', '2017-05-12 11:10:32'),
(14, 'sdrreeeree', 1, 3, '2017-05-12 11:12:48', '2017-05-12 11:12:48'),
(15, 'Approved', 1, 3, '2017-05-12 11:13:09', '2017-05-12 11:13:09'),
(16, 'wrong tithe amount', 1, 2, '2017-05-22 09:03:56', '2017-05-22 09:03:56'),
(17, 'Approved', 1, 2, '2017-05-22 09:05:45', '2017-05-22 09:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `DistrictID` int(11) NOT NULL,
  `DistrictName` varchar(100) NOT NULL,
  `DistrictCode` varchar(100) NOT NULL,
  `AreaID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`DistrictID`, `DistrictName`, `DistrictCode`, `AreaID`, `id`, `created_at`, `updated_at`) VALUES
(1, 'Mckeon Temple', '0001', 1, 19, '2017-05-09 16:36:52', '2017-05-09 16:36:52'),
(2, 'Newtown', '0002', 1, 1, '2017-05-11 09:55:10', '2017-05-11 09:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `FinanceID` int(11) NOT NULL,
  `AssemblyID` varchar(100) NOT NULL,
  `Indicators` varchar(300) NOT NULL,
  `IndValues` varchar(300) NOT NULL,
  `id` int(11) NOT NULL,
  `ReviewerID` int(11) NOT NULL,
  `Activity_State` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`FinanceID`, `AssemblyID`, `Indicators`, `IndValues`, `id`, `ReviewerID`, `Activity_State`, `created_at`, `updated_at`, `date`) VALUES
(1, '001', 'Councilors', '2000', 1, 1, 2, '2017-05-31 08:33:25', '2017-05-12 11:06:12', '2017-05-01'),
(2, '001', 'Councilors', '2900', 1, 1, 2, '2017-05-31 08:33:41', '2017-05-22 09:07:17', '2017-05-15'),
(3, '002', 'Convert', '48484448', 1, 1, 2, '2017-05-31 08:36:36', '2017-05-22 09:07:40', '2017-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pentecoastdivision`
--

CREATE TABLE `pentecoastdivision` (
  `DivisionID` int(11) NOT NULL,
  `AreaID` int(11) NOT NULL,
  `DistrictID` int(11) NOT NULL,
  `AssemblyID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pentecoastdivision`
--

INSERT INTO `pentecoastdivision` (`DivisionID`, `AreaID`, `DistrictID`, `AssemblyID`, `id`, `created_at`, `updated_at`) VALUES
(2, 4, 3, 4, 0, '2017-05-09 13:24:06', '0000-00-00 00:00:00'),
(3, 4, 3, 3, 0, '2017-05-09 13:24:15', '0000-00-00 00:00:00'),
(4, 4, 3, 2, 0, '2017-05-09 13:24:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `userlevels`
--

CREATE TABLE `userlevels` (
  `UserLevelID` int(11) NOT NULL,
  `UserLevel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlevels`
--

INSERT INTO `userlevels` (`UserLevelID`, `UserLevel`) VALUES
(1, 'Area'),
(2, 'District');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `AreaID` int(11) NOT NULL,
  `DistrictID` int(11) NOT NULL,
  `PhoneNo` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `UserLevelID` int(11) NOT NULL,
  `Userstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `AreaID`, `DistrictID`, `PhoneNo`, `UserLevelID`, `Userstatus`) VALUES
(1, 'samuel', 'super@abc.com', '$2y$10$xkItq8qa6h1Nvct/I4gdBemcFZ06l5U7ndLyzUtp9rcCdrkqvK.KS', 'hua3ac3R19cUyvZYMHUhOPqGQHQmIFLkxyOsiuYIcnQ9gAD1zoZZur1RyV9B', '2016-07-27 11:07:44', '2017-05-22 09:06:49', 1, 1, '0245711809', 1, 1),
(2, 'samba', 'ntow_samuel@yahoo.com', '$2y$10$PyHZnwhcZk18uTxIpEYr.uXOrLnMQvFlv/2GtJ.jwt.dNRTYkYuEW', '1ZfQOfoVH9PlI718LW85xnYFPZMBiRzsHYtIYslwjbPhVWrQPWXGTPYrbIMa', '2016-08-03 12:54:51', '2017-04-24 10:40:05', 0, 0, '0245711809', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_state`
--

CREATE TABLE `user_state` (
  `id` int(11) NOT NULL,
  `Userstatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_state`
--

INSERT INTO `user_state` (`id`, `Userstatus`) VALUES
(1, 'Active'),
(2, 'Disabled'),
(3, 'Suspended');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`AreaID`);

--
-- Indexes for table `assembly`
--
ALTER TABLE `assembly`
  ADD PRIMARY KEY (`AssemblyID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`DistrictID`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`FinanceID`);

--
-- Indexes for table `pentecoastdivision`
--
ALTER TABLE `pentecoastdivision`
  ADD PRIMARY KEY (`DivisionID`);

--
-- Indexes for table `userlevels`
--
ALTER TABLE `userlevels`
  ADD PRIMARY KEY (`UserLevelID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_state`
--
ALTER TABLE `user_state`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `AreaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `assembly`
--
ALTER TABLE `assembly`
  MODIFY `AssemblyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `DistrictID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `FinanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pentecoastdivision`
--
ALTER TABLE `pentecoastdivision`
  MODIFY `DivisionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `userlevels`
--
ALTER TABLE `userlevels`
  MODIFY `UserLevelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_state`
--
ALTER TABLE `user_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
