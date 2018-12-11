-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2017 at 06:06 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cellmeeting`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountheadings`
--

CREATE TABLE `accountheadings` (
  `ID` int(11) NOT NULL,
  `AccountLabel` varchar(255) NOT NULL,
  `AccountType` varchar(255) NOT NULL,
  `AccountCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accountheadings`
--

INSERT INTO `accountheadings` (`ID`, `AccountLabel`, `AccountType`, `AccountCode`) VALUES
(1, ' Cash and Cash Equivalent', 'ASSETS', '1100'),
(2, 'Account Receivables', 'ASSETS', '1200'),
(3, 'Inventory', 'ASSETS', '1300'),
(4, 'Long-Term Investments & Endowment Investments', 'ASSETS', '1400'),
(5, 'Property, Plant, and Equipment (Fixed Assets- Use for Accrual Accounting Only)', 'ASSETS', '1500'),
(6, 'Depreciation', 'ASSETS', '1580'),
(7, 'Account Payable', 'LIABILITIES', '2100'),
(8, 'Accrued Expenses', 'LIABILITIES', '2200'),
(9, 'Payroll Liabilities', 'LIABILITIES', '2300'),
(10, 'Contributions Payable', 'LIABILITIES', '2400'),
(11, 'Offertory', 'INCOME', '4100'),
(12, 'Tithe Offering', 'INCOME', '4200'),
(13, 'Harvest Income', 'INCOME', '4300'),
(14, 'Other Operating Income', 'INCOME', '4400'),
(15, 'Other Incomes - Remittance', 'INCOME', '4500'),
(16, 'Investment Income', 'INCOME', '4700'),
(17, 'Other Non - Operating Income', 'INCOME', '4800'),
(18, 'Other Income - Ecumenical Bodies', 'INCOME', '4900'),
(19, 'Utility Expenses', 'EXPENDITURE', '5100'),
(20, 'Sunday Expenses', 'EXPENDITURE', '5200'),
(21, 'Repairs and Maintenance', 'EXPENDITURE', '5300'),
(22, 'Administration', 'EXPENDITURE', '5400'),
(23, 'Specific Operating Area Expenses', 'EXPENDITURE', '5500'),
(24, 'Gross Salary - Lay Employees', 'EXPENDITURE', '5700'),
(25, 'School and Diocesan Support', 'EXPENDITURE', '5900'),
(26, 'Other Non-Operating Expense', 'EXPENDITURE', '5600'),
(27, 'Indicator', 'Account Type', 'Account Code');

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
  `NationalID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`AreaID`, `AreaName`, `AreaCode`, `NationalID`, `id`, `created_at`, `updated_at`) VALUES
(1, 'La Area', '1', 1, 4, '2017-08-04 10:02:34', '2017-08-04 10:02:34'),
(2, 'Some Area', '98', 1, 1, '2017-07-31 16:11:01', '2017-07-31 15:44:44'),
(4, 'Ga mashie', '352', 2, 8, '2017-08-02 12:07:32', '2017-08-02 12:07:32'),
(5, 'the ', '', 2, 1, '2017-11-14 16:17:12', '2017-11-14 16:17:12'),
(6, 'Area A', '', 1, 1, '2017-11-15 15:15:18', '2017-11-15 15:15:18');

-- --------------------------------------------------------

--
-- Table structure for table `assembly`
--

CREATE TABLE `assembly` (
  `AssemblyID` int(11) NOT NULL,
  `AssemblyName` varchar(100) NOT NULL,
  `AssemblyCode` varchar(100) NOT NULL,
  `DistrictID` int(11) NOT NULL,
  `Locality` varchar(255) NOT NULL,
  `Meeting_time` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Location` text,
  `ParentID` varchar(255) NOT NULL DEFAULT '0',
  `TagCode` varchar(255) NOT NULL,
  `Owner` varchar(255) NOT NULL,
  `Owner_contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assembly`
--

INSERT INTO `assembly` (`AssemblyID`, `AssemblyName`, `AssemblyCode`, `DistrictID`, `Locality`, `Meeting_time`, `id`, `created_at`, `updated_at`, `Location`, `ParentID`, `TagCode`, `Owner`, `Owner_contact`) VALUES
(1, 'Pentecost Redemption', '2001', 1, 'ghana', '8 - 12', 1, '2017-11-08 13:54:01', '0000-00-00 00:00:00', 'Nshornaa', '0', 'Pent1A#', 'owb', '55'),
(2, 'Central Police Station', '2002', 1, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(3, 'Abuja Assembly', '2003', 1, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(4, 'Calvary', '5001', 76, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(5, 'PAMT', '101', 76, '', '', 1, '2017-11-14 15:43:10', '0000-00-00 00:00:00', '', '0', '', '', ''),
(6, 'English', '5003', 76, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(7, 'PIWC', '5004', 77, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(8, 'Evangel', '5005', 7, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(9, 'D.K Arnan', '5006', 8, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(10, 'Baatsona W/C', '5007', 9, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(11, 'Elim', '5008', 10, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(12, 'Jordan', '5009', 11, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(13, 'Hebron', '5010', 12, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(14, 'Central', '5011', 13, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(15, 'SAKK Memorial', '5012', 14, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(16, 'Vanderpujie', '5013', 15, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(17, 'Grace English', '5014', 16, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(18, 'Zion', '5015', 17, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(19, 'Shalom', '5016', 18, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(20, 'Mt Horeb', '5017', 19, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(21, 'Upper Room', '5018', 20, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(22, 'Gilgal', '5019', 21, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(23, 'E.K Kyei', '5020', 22, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(24, 'S.K Ayinor', '5021', 23, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(25, 'Good Shepherd', '5022', 24, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(26, 'Central', '5023', 25, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(27, 'Bethel', '5024', 26, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(28, 'Berea', '5025', 27, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(29, 'Hebron', '5026', 28, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(30, 'Shalom', '5027', 29, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(31, 'Central', '5028', 30, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(32, 'Mt Olives', '5029', 31, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(33, 'Comm 20', '5030', 32, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(34, 'New Kotobabi', '5031', 33, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(35, 'Upper Room', '5032', 34, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(36, 'Promise Land', '5033', 35, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(37, 'Glory Temple', '5034', 36, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(38, 'F.E Antwi', '5035', 37, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(39, 'J.K Ocran', '5036', 38, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(40, 'Praise', '5037', 39, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(41, 'Central', '5038', 40, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(42, 'New Jerusalem', '5039', 41, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(43, 'Mt of Olives', '5040', 42, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(44, 'Nazareth', '5041', 43, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(45, 'Amazing Grace', '5042', 44, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(46, 'Mt Zion', '5043', 45, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(47, 'Living Water', '5044', 46, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(48, 'New Jerusalem', '5045', 47, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(49, 'Salem 1', '5046', 48, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(51, 'Divine', '5047', 49, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(52, 'Liberty', '5048', 50, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(53, 'Hosanna', '5049', 51, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(54, 'Salem 2', '5050', 52, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(55, 'Mt Olivet', '5051', 53, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(56, 'Ebenezer', '5052', 54, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(57, 'Beula', '5053', 55, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(58, 'A. T Nartey', '5054', 56, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(59, 'Ebenezer', '5055', 57, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(60, 'L.A Nyarko', '5056', 58, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(61, 'Emmanuel', '5057', 59, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(62, 'Dromo Soo', '5058', 60, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(63, 'J.B. Archer', '5059', 61, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(64, 'Bethel', '5060', 62, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(65, 'Buabasah', '5061', 63, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(66, 'Overcomers', '5062', 64, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(67, 'Morning Star', '5063', 65, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(68, 'J. W. Asare', '5064', 66, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(69, 'Emmanuel', '5065', 67, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(70, 'Faith', '5066', 68, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(71, 'Praise Temple', '5067', 69, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(72, 'Estate', '5068', 70, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(73, 'Yayra', '5069', 71, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(74, 'Rapture', '5070', 72, '', '', 1, '2017-10-06 15:11:11', '0000-00-00 00:00:00', '', '0', '', '', ''),
(75, 'New Jerusalem', '5071', 73, '', '', 1, '2017-10-06 15:34:19', '0000-00-00 00:00:00', '', '2', '', '', ''),
(76, 'Maranatha', '5072', 74, '', '', 1, '2017-10-06 15:34:16', '0000-00-00 00:00:00', '', '2', '', '', ''),
(77, 'Barrier', '5073', 75, '', '', 1, '2017-10-06 15:34:12', '0000-00-00 00:00:00', '', '2', '', '', ''),
(78, 'Bethel', '5074', 97, '', '', 1, '2017-10-06 15:33:01', '0000-00-00 00:00:00', '', '82', '', '', ''),
(79, 'Nazareth', '5075', 97, '', '', 1, '2017-10-06 15:32:57', '0000-00-00 00:00:00', '', '90', '', '', ''),
(80, 'some assembly', '9900', 98, '', '', 4, '2017-10-06 15:32:51', '0000-00-00 00:00:00', '', '1', '', '', ''),
(81, 'some assembly', 's001', 98, '', '', 4, '2017-10-06 15:32:17', '0000-00-00 00:00:00', '', '1', '', '', ''),
(82, 'some assembly', '26652', 98, '', '', 4, '2017-10-06 15:32:12', '0000-00-00 00:00:00', '', '1', '', '', ''),
(90, 'aaaa', '2004', 1, 'local', '8 - 123', 1, '2017-11-07 16:16:24', '0000-00-00 00:00:00', 'My location here', '1', 'Pent1A#1', 'owner112', '12345678'),
(91, 'some assembly', '9900', 84, 'polob', '90-23', 1, '2017-10-31 10:11:33', '0000-00-00 00:00:00', '  vjdkjkid ijdi dijdijs', '0', 'Pent1B#', '', ''),
(92, 'vcj kj vj ', 'kj j', 80, 'kjkc k', '90-23', 1, '2017-10-31 10:11:58', '0000-00-00 00:00:00', 'jhjj  djhj d', '0', ' k', '', ''),
(93, 'fgff', 'aa', 83, 'aa', 'aa', 1, '2017-10-31 10:12:58', '0000-00-00 00:00:00', 'aaa', '0', 'aaaa', '', ''),
(94, 'jhjhjs', 'dfdfdf', 83, '', '', 1, '2017-10-31 10:13:48', '0000-00-00 00:00:00', 'jgh hgh g', '4', '1', '', ''),
(95, 'asd', 'asdsd', 78, 'sdsa', 'aaaaa', 1, '2017-10-31 10:16:48', '0000-00-00 00:00:00', 'sd ssd', '0', 'asds', '', ''),
(96, 'as', 'as', 78, '434v4', '3v 43', 1, '2017-10-31 10:17:45', '0000-00-00 00:00:00', 'v3434', '0', 'a34', '', ''),
(97, 'as', 'as', 1, '434v4', '3v 43', 1, '2017-10-31 10:20:48', '0000-00-00 00:00:00', 'v3434', '0', 'a34', '', ''),
(98, 'cell name', '1', 84, 'local', '5pm', 1, '2017-11-14 15:30:24', '0000-00-00 00:00:00', 'dsf f fdf df', '0', 'tag', 'owner', '23456767876'),
(99, 'dsfdsf', '99', 1, 'fdsaf', '43', 1, '2017-11-14 15:32:06', '0000-00-00 00:00:00', 'dsfdfdf', '0', 'dfsdf', 'ghghg', '4454545454545'),
(100, 'my name', '100', 84, 'home', '45', 1, '2017-11-14 15:42:34', '0000-00-00 00:00:00', 'dfdjfhdjhfsdjkfd', '0', 'tag', 'owner', '9384934893849'),
(101, 'gshadgh ', '101101', 1, ' hgsh dhsg h', '7', 1, '2017-11-14 15:43:35', '0000-00-00 00:00:00', 'ghgfhgghg', '0', 'h ghgd hasghg', 'owner', '76763778'),
(102, 'cell a', '102', 102, 'cella', '4', 20, '2017-11-15 15:20:22', '0000-00-00 00:00:00', ' dfd sf  ', '0', 'cella', 'cella', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `cell`
--

CREATE TABLE `cell` (
  `CellID` int(11) NOT NULL,
  `CellName` varchar(100) NOT NULL,
  `CellCode` varchar(100) NOT NULL,
  `AssemblyCode` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cell`
--

INSERT INTO `cell` (`CellID`, `CellName`, `CellCode`, `AssemblyCode`, `id`, `created_at`, `updated_at`) VALUES
(1, 'Pentecost Redemption', '2001', 1, 1, '2017-06-05 19:02:36', '0000-00-00 00:00:00'),
(2, 'Central Police Station', '2002', 1, 1, '2017-06-07 16:00:56', '0000-00-00 00:00:00'),
(3, 'Abuja Assembly', '2003', 1, 1, '2017-06-07 16:01:06', '0000-00-00 00:00:00'),
(4, 'Calvary', '5001', 76, 1, '2017-06-07 15:48:19', '0000-00-00 00:00:00'),
(5, 'PAMT', '5002', 76, 1, '2017-06-07 15:48:41', '0000-00-00 00:00:00'),
(6, 'English', '5003', 76, 1, '2017-06-07 15:49:06', '0000-00-00 00:00:00'),
(7, 'PIWC', '5004', 77, 1, '2017-06-07 15:49:39', '0000-00-00 00:00:00'),
(8, 'Evangel', '5005', 7, 1, '2017-06-07 10:17:02', '0000-00-00 00:00:00'),
(9, 'D.K Arnan', '5006', 8, 1, '2017-06-07 10:17:38', '0000-00-00 00:00:00'),
(10, 'Baatsona W/C', '5007', 9, 1, '2017-06-07 10:18:18', '0000-00-00 00:00:00'),
(11, 'Elim', '5008', 10, 1, '2017-06-07 10:18:47', '0000-00-00 00:00:00'),
(12, 'Jordan', '5009', 11, 1, '2017-06-07 10:19:16', '0000-00-00 00:00:00'),
(13, 'Hebron', '5010', 12, 1, '2017-06-07 10:19:45', '0000-00-00 00:00:00'),
(14, 'Central', '5011', 13, 1, '2017-06-07 10:20:16', '0000-00-00 00:00:00'),
(15, 'SAKK Memorial', '5012', 14, 1, '2017-06-07 10:21:09', '0000-00-00 00:00:00'),
(16, 'Vanderpujie', '5013', 15, 1, '2017-06-07 10:21:48', '0000-00-00 00:00:00'),
(17, 'Grace English', '5014', 16, 1, '2017-06-07 10:22:24', '0000-00-00 00:00:00'),
(18, 'Zion', '5015', 17, 1, '2017-06-07 10:22:46', '0000-00-00 00:00:00'),
(19, 'Shalom', '5016', 18, 1, '2017-06-07 10:23:18', '0000-00-00 00:00:00'),
(20, 'Mt Horeb', '5017', 19, 1, '2017-06-07 10:23:59', '0000-00-00 00:00:00'),
(21, 'Upper Room', '5018', 20, 1, '2017-06-07 10:24:45', '0000-00-00 00:00:00'),
(22, 'Gilgal', '5019', 21, 1, '2017-06-07 10:25:12', '0000-00-00 00:00:00'),
(23, 'E.K Kyei', '5020', 22, 1, '2017-06-07 10:58:25', '0000-00-00 00:00:00'),
(24, 'S.K Ayinor', '5021', 23, 1, '2017-06-07 10:58:54', '0000-00-00 00:00:00'),
(25, 'Good Shepherd', '5022', 24, 1, '2017-06-07 10:59:33', '0000-00-00 00:00:00'),
(26, 'Central', '5023', 25, 1, '2017-06-07 11:01:32', '0000-00-00 00:00:00'),
(27, 'Bethel', '5024', 26, 1, '2017-06-07 11:02:24', '0000-00-00 00:00:00'),
(28, 'Berea', '5025', 27, 1, '2017-06-07 11:02:48', '0000-00-00 00:00:00'),
(29, 'Hebron', '5026', 28, 1, '2017-06-07 11:03:36', '0000-00-00 00:00:00'),
(30, 'Shalom', '5027', 29, 1, '2017-06-07 11:04:24', '0000-00-00 00:00:00'),
(31, 'Central', '5028', 30, 1, '2017-06-07 11:05:46', '0000-00-00 00:00:00'),
(32, 'Mt Olives', '5029', 31, 1, '2017-06-07 11:06:36', '0000-00-00 00:00:00'),
(33, 'Comm 20', '5030', 32, 1, '2017-06-07 11:07:09', '0000-00-00 00:00:00'),
(34, 'New Kotobabi', '5031', 33, 1, '2017-06-07 11:07:41', '0000-00-00 00:00:00'),
(35, 'Upper Room', '5032', 34, 1, '2017-06-07 11:08:15', '0000-00-00 00:00:00'),
(36, 'Promise Land', '5033', 35, 1, '2017-06-07 11:08:57', '0000-00-00 00:00:00'),
(37, 'Glory Temple', '5034', 36, 1, '2017-06-07 11:09:27', '0000-00-00 00:00:00'),
(38, 'F.E Antwi', '5035', 37, 1, '2017-06-07 11:09:45', '0000-00-00 00:00:00'),
(39, 'J.K Ocran', '5036', 38, 1, '2017-06-07 11:10:18', '0000-00-00 00:00:00'),
(40, 'Praise', '5037', 39, 1, '2017-06-07 11:10:51', '0000-00-00 00:00:00'),
(41, 'Central', '5038', 40, 1, '2017-06-07 11:11:24', '0000-00-00 00:00:00'),
(42, 'New Jerusalem', '5039', 41, 1, '2017-06-07 11:12:00', '0000-00-00 00:00:00'),
(43, 'Mt of Olives', '5040', 42, 1, '2017-06-07 11:12:49', '0000-00-00 00:00:00'),
(44, 'Nazareth', '5041', 43, 1, '2017-06-07 11:13:21', '0000-00-00 00:00:00'),
(45, 'Amazing Grace', '5042', 44, 1, '2017-06-07 11:14:00', '0000-00-00 00:00:00'),
(46, 'Mt Zion', '5043', 45, 1, '2017-06-07 11:14:29', '0000-00-00 00:00:00'),
(47, 'Living Water', '5044', 46, 1, '2017-06-07 11:14:56', '0000-00-00 00:00:00'),
(48, 'New Jerusalem', '5045', 47, 1, '2017-06-07 11:15:25', '0000-00-00 00:00:00'),
(49, 'Salem 1', '5046', 48, 1, '2017-06-07 11:16:06', '0000-00-00 00:00:00'),
(51, 'Divine', '5047', 49, 1, '2017-06-07 11:32:48', '0000-00-00 00:00:00'),
(52, 'Liberty', '5048', 50, 1, '2017-06-07 11:34:29', '0000-00-00 00:00:00'),
(53, 'Hosanna', '5049', 51, 1, '2017-06-07 11:35:07', '0000-00-00 00:00:00'),
(54, 'Salem 2', '5050', 52, 1, '2017-06-07 11:35:40', '0000-00-00 00:00:00'),
(55, 'Mt Olivet', '5051', 53, 1, '2017-06-07 11:37:41', '0000-00-00 00:00:00'),
(56, 'Ebenezer', '5052', 54, 1, '2017-06-07 11:38:10', '0000-00-00 00:00:00'),
(57, 'Beula', '5053', 55, 1, '2017-06-07 11:38:34', '0000-00-00 00:00:00'),
(58, 'A. T Nartey', '5054', 56, 1, '2017-06-07 11:39:11', '0000-00-00 00:00:00'),
(59, 'Ebenezer', '5055', 57, 1, '2017-06-07 11:39:38', '0000-00-00 00:00:00'),
(60, 'L.A Nyarko', '5056', 58, 1, '2017-06-07 11:40:13', '0000-00-00 00:00:00'),
(61, 'Emmanuel', '5057', 59, 1, '2017-06-07 11:40:38', '0000-00-00 00:00:00'),
(62, 'Dromo Soo', '5058', 60, 1, '2017-06-07 11:41:01', '0000-00-00 00:00:00'),
(63, 'J.B. Archer', '5059', 61, 1, '2017-06-07 11:41:39', '0000-00-00 00:00:00'),
(64, 'Bethel', '5060', 62, 1, '2017-06-07 11:42:06', '0000-00-00 00:00:00'),
(65, 'Buabasah', '5061', 63, 1, '2017-06-07 11:42:28', '0000-00-00 00:00:00'),
(66, 'Overcomers', '5062', 64, 1, '2017-06-07 11:42:52', '0000-00-00 00:00:00'),
(67, 'Morning Star', '5063', 65, 1, '2017-06-07 11:43:27', '0000-00-00 00:00:00'),
(68, 'J. W. Asare', '5064', 66, 1, '2017-06-07 11:44:20', '0000-00-00 00:00:00'),
(69, 'Emmanuel', '5065', 67, 1, '2017-06-07 11:44:46', '0000-00-00 00:00:00'),
(70, 'Faith', '5066', 68, 1, '2017-06-07 11:45:15', '0000-00-00 00:00:00'),
(71, 'Praise Temple', '5067', 69, 1, '2017-06-07 11:46:01', '0000-00-00 00:00:00'),
(72, 'Estate', '5068', 70, 1, '2017-06-07 11:46:31', '0000-00-00 00:00:00'),
(73, 'Yayra', '5069', 71, 1, '2017-06-07 11:46:53', '0000-00-00 00:00:00'),
(74, 'Rapture', '5070', 72, 1, '2017-06-07 11:49:55', '0000-00-00 00:00:00'),
(75, 'New Jerusalem', '5071', 73, 1, '2017-06-07 11:51:01', '0000-00-00 00:00:00'),
(76, 'Maranatha', '5072', 74, 1, '2017-06-07 11:51:34', '0000-00-00 00:00:00'),
(77, 'Barrier', '5073', 75, 1, '2017-06-07 11:51:57', '0000-00-00 00:00:00'),
(78, 'Bethel', '5074', 97, 1, '2017-06-07 16:00:49', '0000-00-00 00:00:00'),
(79, 'Nazareth', '5075', 97, 1, '2017-06-07 16:01:26', '0000-00-00 00:00:00'),
(80, 'some assembly', '9900', 98, 4, '2017-06-19 13:45:46', '0000-00-00 00:00:00'),
(81, 'some assembly', 's001', 98, 4, '2017-06-20 10:58:39', '0000-00-00 00:00:00'),
(82, 'some assembly', '26652', 98, 4, '2017-06-20 10:59:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cellattendances`
--

CREATE TABLE `cellattendances` (
  `id` int(11) NOT NULL,
  `assembly` varchar(255) NOT NULL,
  `members` int(11) NOT NULL,
  `newmembers` double NOT NULL,
  `newconverts` double NOT NULL,
  `visitors` int(11) NOT NULL,
  `converts` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `total` float NOT NULL,
  `previous` float NOT NULL,
  `variance` float NOT NULL,
  `comments` text NOT NULL,
  `topic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cellattendances`
--

INSERT INTO `cellattendances` (`id`, `assembly`, `members`, `newmembers`, `newconverts`, `visitors`, `converts`, `children`, `total`, `previous`, `variance`, `comments`, `topic`) VALUES
(1, 'Pentecost Redemption', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'No comments', '');

-- --------------------------------------------------------

--
-- Table structure for table `cellmeetingattendances`
--

CREATE TABLE `cellmeetingattendances` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `comments` text,
  `date` date NOT NULL,
  `CellCode` int(11) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `meetingtype` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cellmeetingattendances`
--

INSERT INTO `cellmeetingattendances` (`id`, `member_id`, `comments`, `date`, `CellCode`, `flag`, `meetingtype`, `created_at`, `updated_at`) VALUES
(15, 9, '', '2017-11-20', 5025, 'Absent', 'normal meeting', '2017-11-20 12:23:57', '2017-11-20 13:40:12'),
(24, 10, '', '2017-11-20', 5025, 'Present', 'normal meeting', '2017-11-20 13:38:30', '2017-11-20 13:40:12'),
(25, 11, '', '2017-11-20', 5025, 'Absent', 'normal meeting', '2017-11-20 13:38:30', '2017-11-20 13:39:12'),
(26, 14, 'thgghf', '2017-11-23', 2001, 'Present', 'First meeting', '2017-11-23 10:08:27', '2017-11-23 10:08:27'),
(27, 12, '', '2017-11-23', 2001, 'Absent', 'First meeting', '2017-11-23 10:08:27', '2017-11-23 10:08:27'),
(28, 13, '', '2017-11-23', 2001, 'Absent', 'First meeting', '2017-11-23 10:08:27', '2017-11-23 10:08:27'),
(29, 16, '', '2017-11-23', 2001, 'Absent', 'First meeting', '2017-11-23 10:08:27', '2017-11-23 10:08:27'),
(30, 15, 'gfgfdgdfgdf', '2017-11-23', 2001, 'Absent', 'First meeting', '2017-11-23 10:08:27', '2017-11-23 10:08:27'),
(31, 12, '', '2017-11-28', 2001, 'Present', 'First meeting', '2017-11-28 10:34:41', '2017-11-28 10:34:41'),
(32, 15, '', '2017-11-28', 2001, 'Absent', 'First meeting', '2017-11-28 10:34:41', '2017-11-28 10:34:41'),
(33, 16, '', '2017-11-28', 2001, 'Absent', 'First meeting', '2017-11-28 10:34:41', '2017-11-28 10:34:41'),
(34, 13, '', '2017-11-28', 2001, 'Present', 'First meeting', '2017-11-28 10:34:41', '2017-11-28 10:34:41'),
(35, 14, '', '2017-11-28', 2001, 'Present', 'First meeting', '2017-11-28 10:34:41', '2017-11-28 10:34:41'),
(36, 12, '', '2017-11-18', 2001, 'Present', 'First meeting', '2017-11-28 11:18:12', '2017-11-28 11:18:12'),
(37, 14, '', '2017-11-18', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:13', '2017-11-28 11:18:13'),
(38, 15, '', '2017-11-18', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:13', '2017-11-28 11:18:13'),
(39, 16, '', '2017-11-18', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:13', '2017-11-28 11:18:13'),
(40, 17, '', '2017-11-18', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:13', '2017-11-28 11:18:13'),
(41, 13, '', '2017-11-18', 2001, 'Present', 'First meeting', '2017-11-28 11:18:13', '2017-11-28 11:18:13'),
(42, 13, '', '2017-11-17', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:43', '2017-11-28 11:18:43'),
(43, 14, '', '2017-11-17', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:43', '2017-11-28 11:18:43'),
(44, 16, '', '2017-11-17', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:43', '2017-11-28 11:18:43'),
(45, 17, '', '2017-11-17', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:43', '2017-11-28 11:18:43'),
(46, 12, '', '2017-11-17', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:43', '2017-11-28 11:18:43'),
(47, 15, '', '2017-11-17', 2001, 'Present', 'First meeting', '2017-11-28 11:18:43', '2017-11-28 11:18:43'),
(48, 15, '', '2017-11-16', 2001, 'Present', 'First meeting', '2017-11-28 11:18:59', '2017-11-28 11:18:59'),
(49, 12, '', '2017-11-16', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:59', '2017-11-28 11:19:00'),
(50, 13, '', '2017-11-16', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:59', '2017-11-28 11:19:00'),
(51, 14, '', '2017-11-16', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:59', '2017-11-28 11:19:00'),
(52, 17, '', '2017-11-16', 2001, 'Absent', 'First meeting', '2017-11-28 11:18:59', '2017-11-28 11:19:00'),
(53, 16, '', '2017-11-16', 2001, 'Present', 'First meeting', '2017-11-28 11:19:00', '2017-11-28 11:19:00'),
(54, 17, '', '2017-11-12', 2001, 'Absent', 'First meeting', '2017-11-28 11:20:11', '2017-11-28 11:20:23'),
(55, 12, '', '2017-11-12', 2001, 'Present', 'First meeting', '2017-11-28 11:20:11', '2017-11-28 11:20:38'),
(56, 13, '', '2017-11-12', 2001, 'Absent', 'First meeting', '2017-11-28 11:20:11', '2017-11-28 11:20:11'),
(57, 14, '', '2017-11-12', 2001, 'Absent', 'First meeting', '2017-11-28 11:20:11', '2017-11-28 11:20:38'),
(58, 15, '', '2017-11-12', 2001, 'Absent', 'First meeting', '2017-11-28 11:20:11', '2017-11-28 11:20:11'),
(59, 16, '', '2017-11-12', 2001, 'Present', 'First meeting', '2017-11-28 11:20:11', '2017-11-28 11:20:11'),
(60, 14, '', '2017-11-09', 2001, 'Absent', 'First meeting', '2017-11-28 11:21:27', '2017-12-18 14:55:09'),
(61, 12, '', '2017-11-09', 2001, 'Absent', 'First meeting', '2017-11-28 11:21:27', '2017-11-28 11:21:27'),
(62, 13, '', '2017-11-09', 2001, 'Absent', 'First meeting', '2017-11-28 11:21:27', '2017-11-28 11:21:27'),
(63, 16, '', '2017-11-09', 2001, 'Absent', 'First meeting', '2017-11-28 11:21:27', '2017-11-28 11:21:27'),
(64, 17, '', '2017-11-09', 2001, 'Absent', 'First meeting', '2017-11-28 11:21:27', '2017-11-28 11:21:27'),
(65, 15, '', '2017-11-09', 2001, 'Absent', 'First meeting', '2017-11-28 11:21:27', '2017-12-18 14:53:48'),
(66, 9, 'hgh', '2017-11-29', 2001, 'Present', 'Cell Meeting', '2017-11-29 11:31:40', '2017-11-29 11:31:40'),
(67, 13, '', '2017-11-29', 2001, 'Absents', 'Cell Meeting', '2017-11-29 11:31:40', '2017-11-29 11:31:40'),
(68, 15, '', '2017-11-29', 2001, 'Absents', 'Cell Meeting', '2017-11-29 11:31:40', '2017-11-29 11:31:40'),
(69, 16, '', '2017-11-29', 2001, 'Absents', 'Cell Meeting', '2017-11-29 11:31:40', '2017-11-29 11:31:40'),
(70, 9, 'cc', '2017-12-18', 2001, 'Present', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 16:43:56'),
(71, 15, '', '2017-12-18', 2001, 'Absent', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 16:39:26'),
(72, 16, '', '2017-12-18', 2001, 'Absent', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 10:25:21'),
(73, 18, '', '2017-12-18', 2001, 'Absent', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 10:25:21'),
(74, 22, '', '2017-12-18', 2001, 'Present', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 16:44:19'),
(75, 23, '', '2017-12-18', 2001, 'Absent', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 10:25:21'),
(76, 24, '', '2017-12-18', 2001, 'Absent', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 10:25:21'),
(77, 25, '', '2017-12-18', 2001, 'Absent', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 10:25:21'),
(78, 26, '', '2017-12-18', 2001, 'Absent', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 10:25:21'),
(79, 27, '', '2017-12-18', 2001, 'Absent', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 10:25:22'),
(80, 29, '', '2017-12-18', 2001, 'Absent', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 10:25:22'),
(81, 13, 'cc', '2017-12-18', 2001, 'Present', 'Cell Meeting', '2017-12-18 10:25:21', '2017-12-18 16:46:01'),
(82, 9, '', '2017-12-19', 2001, 'Present', 'Cell Meeting', '2017-12-18 16:48:24', '2017-12-18 16:48:24'),
(83, 13, '', '2017-12-19', 2001, 'Present', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:48:52'),
(84, 15, '', '2017-12-19', 2001, 'Present', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:49:33'),
(85, 16, '', '2017-12-19', 2001, 'Absents', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:48:25'),
(86, 18, '', '2017-12-19', 2001, 'Absents', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:48:25'),
(87, 22, '', '2017-12-19', 2001, 'Absents', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:48:25'),
(88, 23, '', '2017-12-19', 2001, 'Absents', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:48:25'),
(89, 24, '', '2017-12-19', 2001, 'Absents', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:48:25'),
(90, 25, '', '2017-12-19', 2001, 'Absents', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:48:25'),
(91, 26, '', '2017-12-19', 2001, 'Absents', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:48:25'),
(92, 27, '', '2017-12-19', 2001, 'Absents', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:48:25'),
(93, 29, '', '2017-12-19', 2001, 'Absents', 'Cell Meeting', '2017-12-18 16:48:25', '2017-12-18 16:48:25'),
(94, 9, '', '2017-12-20', 2001, 'Present', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(95, 13, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(96, 15, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(97, 16, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(98, 18, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(99, 22, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(100, 23, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(101, 24, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(102, 25, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(103, 26, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(104, 27, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54'),
(105, 29, '', '2017-12-20', 2001, 'Absent', 'Cell Meeting', '2017-12-18 16:50:54', '2017-12-18 16:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `chartofaccounts`
--

CREATE TABLE `chartofaccounts` (
  `id` int(11) NOT NULL,
  `AccountLabel` varchar(255) DEFAULT NULL,
  `AccountCode` int(11) DEFAULT NULL,
  `AccountsubCode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chartofaccounts`
--

INSERT INTO `chartofaccounts` (`id`, `AccountLabel`, `AccountCode`, `AccountsubCode`) VALUES
(1, ' Cash and Cash Equivalent', 1100, 0),
(2, 'Operating Current Account', 1100, 1110),
(3, 'Organization''s Current  / Savings Accounts', 1100, 1120),
(4, 'Project Current Account', 1100, 1130),
(5, 'Savings / Fixed Deposit', 1100, 1140),
(6, 'Petty Cash Account', 1100, 1150),
(7, 'Restricted Bank Account', 1100, 1160),
(9, 'Account Receivables', 1200, 0),
(10, 'Loans Receivables', 1200, 1210),
(11, 'Accounts/ Pledge Receivables', 1200, 1220),
(12, 'Prepaid Assets', 1200, 1230),
(13, 'Deposits', 1200, 1240),
(15, 'Inventory', 1300, 0),
(16, 'Stationary Stocks', 1300, 1310),
(17, 'Others', 1300, 1320),
(19, 'Long-Term Investments & Endowment Investments', 1400, 0),
(20, 'Long-Term Investment-Equity Capital', 1400, 1410),
(21, 'Long-Term Investment-School', 1400, 1420),
(22, 'Long-Term Investment-Other', 1400, 1430),
(23, 'Methodist Education Endowment ', 1400, 1440),
(24, 'Endowments-Other', 1400, 1450),
(26, 'Property, Plant, and Equipment (Fixed Assets- Use for Accrual Accounting Only)', 1500, 0),
(27, 'Land and Building', 1500, 1510),
(28, 'Computers and Related Equipment', 1500, 1520),
(29, 'Office Furniture and Fittings', 1500, 1530),
(30, 'Musical Equipment', 1500, 1540),
(31, 'Office Equipment', 1500, 1550),
(32, 'Plant and Machinery', 1500, 1560),
(33, 'Motor Vehicle', 1500, 1570),
(34, 'Others', 1500, 1570),
(36, 'Depreciation', 1580, 0),
(37, 'Accumulated Depreciation-Land Building', 1580, 1581),
(38, 'Accumulated Depreciation- Computers and Related Equipment', 1580, 1582),
(39, 'Accumulated Depreciation - Office Furniture and Fittings', 1580, 1583),
(40, 'Accumulated Depreciation -Musical Equipment', 1580, 1584),
(41, 'Accumulated Depreciation - Office Equipment', 1580, 1585),
(42, 'Accumulated Depreciation -Plant and Machinery', 1580, 1586),
(43, 'Accumulated Depreciation -Motor Vehicle', 1580, 1586),
(44, 'Accumulated Depreciation -Others', 1580, 1567),
(47, 'Account Payable', 2100, 0),
(48, 'MDF', 2100, 2110),
(49, 'Contribution to Circuit', 2100, 2120),
(50, 'Contribution to Diocese', 2100, 2130),
(51, 'Contribution to Connexion', 2100, 2140),
(52, 'Accrued Expenses', 2200, 0),
(53, 'Electricity and Water', 2210, 2210),
(54, 'Telephone', 2220, 2220),
(55, 'Sundry Expenses', 2230, 2230),
(57, 'Payroll Liabilities', 2300, 0),
(58, 'Payroll Suspense', 2300, 2310),
(59, 'Payroll Withholdings-Social Security Deductions', 2300, 2320),
(60, 'Payroll Withholdings-2nd Tier Pensions', 2300, 2330),
(61, 'Payroll Withholdings -Income Tax', 2300, 2340),
(62, 'Accrued Salaries', 2300, 2350),
(63, 'Accrued Leave Pay (Accrual Accounting Only)', 2300, 2360),
(64, 'Superannuation', 2300, 2370),
(66, 'Contributions Payable', 2400, 2400),
(67, 'Connexional Contribution', 2400, 2410),
(68, 'Diocesan Contributions Payable', 2400, 2420),
(69, 'Circuit Contributs Payable', 2400, 2430),
(70, 'circuit contributions', 2400, 2500),
(71, 'notes and loans payable', 2400, 2510),
(72, 'Notes Payable-Loans From Diocese', 2400, 2520),
(73, 'Note Payable to Bank', 2400, 2530),
(74, 'Other Debt Payable to Diocese', 2400, 2540),
(78, 'Offertory', 4100, 0),
(79, 'Sunday Offertory (Adult & Children)', 4100, 4110),
(80, 'Weekdays Offertory (Other  than Sunday)', 4100, 4120),
(81, 'Kofi & Ama', 4100, 4130),
(82, 'Special Offering/ Sombi', 4100, 4140),
(83, 'Thank Offering', 4100, 4150),
(85, 'Tithe Offering', 4200, 0),
(86, 'Tithes', 4200, 4210),
(88, 'Harvest Income', 4300, 0),
(89, 'Harvest Proceeds', 4300, 4310),
(90, 'Harvest Pledges', 4300, 4320),
(92, 'Other Operating Income', 4400, 0),
(93, 'Evangelism Week', 4400, 4410),
(94, 'Youth Division Income', 4400, 4420),
(95, 'Other Programs Income', 4400, 4430),
(96, 'Welfare Contributions', 4400, 4420),
(97, 'Donations/ Gifts', 4400, 4430),
(98, 'MPRP', 4400, 4440),
(99, 'Women''s / Men''s Day', 4400, 4450),
(100, 'Children?s Week', 4400, 4460),
(101, 'Sale of Lesson Books', 4400, 4470),
(102, 'Sale of Times/ Sentinel /Constitution /etc.', 4400, 4480),
(104, 'Other Incomes - Remittance', 4500, 0),
(106, 'Watch Night Service Offering', 4500, 4510),
(107, 'Circuit Seed Fund', 4500, 4520),
(108, 'Methodist Development Fund', 4500, 4530),
(109, 'Synod Sunday Proceeds', 4500, 4540),
(110, 'Bible Week Proceeds', 4500, 4550),
(111, 'Lay Movement Day Offertory', 4500, 4560),
(112, 'Diocesan / Circuit Collections', 4500, 4570),
(114, 'Income from Specific Activities', 4500, 4600),
(115, 'Rental Property Income', 4500, 4610),
(116, 'Net Income from Vehicle Running', 4500, 4620),
(117, 'Net Income from Any Profitable Activity', 4500, 4630),
(118, 'Net Income from Day Care / School', 4500, 4640),
(119, 'Special Collection for Charitable Purposes', 4500, 4650),
(120, 'Other Income from Specific Activities', 4500, 4660),
(122, 'Investment Income', 4700, 0),
(123, 'Interest Income - Treasury Bills', 4700, 4710),
(124, 'Interest Income - Bonds', 4700, 4720),
(125, 'Interest Income - Fixed Deposits', 4700, 4730),
(126, 'Realized Gain/ (Loss) on Investments', 4700, 4740),
(127, 'Unrealized Gain / (Loss) on Investments', 4700, 7450),
(129, 'Other Non - Operating Income', 4800, 0),
(130, 'Endowment Donations - Society', 4800, 4810),
(131, 'Endowment Donations - Education', 4800, 4820),
(132, 'Proceeds / Gains from Sale of Assets', 4800, 4830),
(134, 'Other Income - Ecumenical Bodies', 4900, 0),
(135, 'Trinity', 4900, 4911),
(136, 'Aldersgate', 4900, 4912),
(137, 'All Africa Conference of Churches', 4900, 4913),
(138, 'world Day of Prayer', 4900, 4914),
(139, 'Christian Home Book (Family Week)', 4900, 4915),
(140, 'Bible Week', 4900, 4916),
(143, 'Utility Expenses', 5100, 0),
(144, 'Electricity', 5100, 5110),
(145, 'Petrol / Diesel for Generator', 5100, 5120),
(146, 'Water', 5100, 5130),
(147, 'Communication (Telephone etc.)', 5100, 5140),
(148, 'Other', 5100, 5150),
(150, 'Sunday Expenses', 5200, 0),
(151, 'Insurance Expense', 5200, 5210),
(152, 'Vehicle Running Expenses (Maintenance and Fuel )', 5200, 5220),
(153, 'Manse Expense', 5200, 5230),
(154, 'Facility Rental Expense', 5200, 5240),
(156, 'Repairs and Maintenance', 5300, 0),
(157, 'Land & Building (Excluding Manse)', 5300, 5310),
(158, 'Furniture & Fittings ', 5300, 5320),
(159, 'Musical Equipments', 5300, 5330),
(160, 'Plants & Machinery', 5300, 5340),
(161, 'Office Machinery', 5300, 5350),
(162, 'Manse', 5300, 5360),
(164, 'Administration', 5400, 0),
(165, 'Office Supplies', 5400, 5410),
(166, 'Postage and Courier', 5400, 5411),
(167, 'Computer Expenses', 5400, 5412),
(168, 'Bank Charges', 5400, 5413),
(169, 'Equipment / Furniture Rentals', 5400, 5414),
(170, 'Honorarium - Visiting Preachers', 5400, 5415),
(171, 'Travelling Expenses', 5400, 5416),
(172, 'Poor Fund', 5400, 5417),
(173, 'Entertainment', 5400, 5418),
(174, 'Cleaning & Sanitation', 5400, 5419),
(175, 'Assistance to Organizations', 5400, 5420),
(176, 'Medical Expenses', 5400, 5421),
(177, 'Welfare', 5400, 5422),
(178, 'Printing & Stationery', 5400, 5423),
(179, 'Lord''s Supper Expenses (communication)', 5400, 5424),
(180, 'Finance Cost', 5400, 5425),
(181, 'Donation', 5400, 5426),
(182, 'Security Expenses', 5400, 5427),
(184, 'Specific Operating Area Expenses', 5500, 0),
(185, 'Rental Property Expenses', 5500, 5510),
(186, 'Lesson Books (to be resold)', 5500, 5520),
(187, 'Benefit Expense - End of Service, Best Worker, etc.', 5500, 5530),
(188, 'Diocesan Collections Remitted', 5500, 5540),
(189, 'Special Charitable Funds Expended', 5500, 5550),
(190, 'Daycare / Pre-School Expense', 5500, 5560),
(191, 'Property Rates / Ground Rent', 5500, 5570),
(194, 'Ministerial', 5500, 5600),
(196, 'Gross Salary -Ministers', 5500, 5610),
(198, 'Gross Salary - Lay Employees', 5700, 0),
(199, 'Gross Salary - Administration', 5700, 5710),
(200, 'Gross Salary - Manse Support', 5700, 5720),
(201, 'Gross Salary - Programs', 5700, 5730),
(202, 'Gross Salary - Day Care / Pre-School & Schools', 5700, 5740),
(203, 'Gross Salary - Rental Property', 5700, 5750),
(204, 'Gross Salary Security Staff', 5700, 5760),
(205, 'Ministerial Allowances', 5700, 5780),
(206, 'Church Officers Allowances', 5700, 5800),
(208, 'Evangelization and Other Program Expenses', 5800, 0),
(209, 'Religious Education Administration Expense', 5800, 5810),
(210, 'Religious Education Programs', 5800, 5820),
(211, 'Youth Religious Education Programs (Seminars)', 5800, 5830),
(212, 'Children''s Religious Education Programs (Seminars)', 5800, 5840),
(213, 'Other Education and Training Expense', 5800, 5850),
(214, 'Youth Ministry Expense', 5800, 5860),
(215, 'Man / Woman Division', 5800, 5870),
(216, 'Social Ministry Expense', 5800, 5880),
(217, 'Other Program Expense', 5800, 5890),
(219, 'School and Diocesan Support', 5900, 0),
(220, 'Tuition Assistance Expense (Scholarship)', 5900, 5910),
(221, 'Diocesan Assessments', 5900, 5920),
(222, 'Other Operating Expense', 5900, 5930),
(224, 'Other Non-Operating Expense', 5600, 0),
(225, 'School Subsidy', 5600, 5610),
(226, 'Interest on Debt', 5600, 5611),
(227, 'Watchnights Offertory', 5600, 5612),
(228, 'Lay Movement Expenses', 5600, 5613),
(229, 'Methodist Development Fund', 5600, 5614),
(230, 'Circuit Seed Fund', 5600, 5615),
(231, 'Depreciation - Building & Land', 5600, 5616),
(232, 'Depreciation - Computers', 5600, 5617),
(233, 'Depreciation - Furniture and Equipment', 5600, 5618),
(234, 'Depreciation - Vehicles', 5600, 5619),
(235, 'Depreciation - Musical Instruments', 5600, 5620),
(236, 'Depreciation - Plants & Machinery', 5600, 5621);

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
(16, 'Approved', 1, 5, '2017-05-19 15:58:12', '2017-05-19 15:58:12'),
(17, 'Approved', 1, 8, '2017-05-19 16:18:16', '2017-05-19 16:18:16'),
(18, 'Approved', 2, 3, '2017-07-19 14:13:49', '2017-07-19 14:13:49'),
(19, 'some error here', 2, 4, '2017-07-19 14:15:27', '2017-07-19 14:15:27'),
(20, 'Approved', 2, 5, '2017-07-19 15:08:05', '2017-07-19 15:08:05'),
(21, 'error', 2, 7, '2017-07-19 15:08:39', '2017-07-19 15:08:39');

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
(1, 'Mckeon Temple', '0001', 1, 19, '2017-12-14 15:00:00', '2017-05-09 16:36:52'),
(2, 'Newtown', '0002', 1, 1, '2017-05-11 09:55:10', '2017-05-11 09:55:10'),
(76, 'Greda Estate', '6001', 1, 1, '2017-06-07 15:47:49', '2017-06-07 14:47:49'),
(77, 'PIWC', '6002', 1, 1, '2017-06-07 15:50:03', '2017-06-07 14:50:03'),
(78, 'Evangel', '6003', 1, 1, '2017-06-07 15:51:18', '2017-06-07 14:51:18'),
(79, 'D.K Arnan', '6004', 1, 1, '2017-06-07 15:51:56', '2017-06-07 14:51:56'),
(80, 'Baatsona W/C', '6005', 2, 1, '2017-12-12 15:05:30', '2017-06-07 14:52:18'),
(81, 'Water Works', '6006', 1, 1, '2017-06-07 15:52:57', '2017-06-07 14:52:57'),
(82, 'Nshorna', '6007', 1, 1, '2017-06-07 15:53:20', '2017-06-07 14:53:20'),
(83, 'Coco Beach', '6008', 1, 1, '2017-06-07 15:53:39', '2017-06-07 14:53:39'),
(84, 'Baatsona', '6009', 1, 1, '2017-06-07 15:54:08', '2017-06-07 14:54:08'),
(85, 'Nungua', '6010', 1, 1, '2017-06-07 15:54:24', '2017-06-07 14:54:24'),
(86, 'Comm 20', '6011', 1, 1, '2017-06-07 15:55:00', '2017-06-07 14:55:00'),
(87, 'Sakumono', '6012', 1, 1, '2017-06-07 15:55:15', '2017-06-07 14:55:15'),
(88, 'Teshie', '6013', 1, 1, '2017-06-07 15:55:37', '2017-06-07 14:55:37'),
(89, 'Comm 16', '6014', 1, 1, '2017-06-07 15:56:00', '2017-06-07 14:56:00'),
(90, 'Spintex Road', '6015', 1, 1, '2017-06-07 15:56:19', '2017-06-07 14:56:19'),
(91, 'Buade', '6016', 1, 1, '2017-06-07 15:56:39', '2017-06-07 14:56:39'),
(92, 'Teshie Demonstration', '6017', 1, 1, '2017-06-07 15:57:11', '2017-06-07 14:57:11'),
(93, 'Manet', '6018', 1, 1, '2017-06-07 15:57:38', '2017-06-07 14:57:38'),
(94, 'Okpoi gonno', '6019', 1, 1, '2017-06-07 15:58:09', '2017-06-07 14:58:09'),
(95, 'Teshie Nungua Estate', '6020', 1, 1, '2017-06-07 15:58:32', '2017-06-07 14:58:32'),
(96, 'Odikoman', '6021', 1, 1, '2017-06-07 15:58:52', '2017-06-07 14:58:52'),
(97, 'Tabibiano', '6022', 1, 1, '2017-06-07 14:59:55', '2017-06-07 14:59:55'),
(98, 'some distrcit', '9909', 2, 4, '2017-06-19 13:45:04', '2017-06-19 13:45:04'),
(99, 'Some  District 2', '9931', 2, 4, '2017-06-19 16:22:49', '2017-06-19 16:22:49'),
(100, 'qwetr', '', 1, 1, '2017-11-14 15:54:18', '2017-11-14 15:54:18'),
(101, 'ga mashie zone', '', 4, 1, '2017-11-14 16:08:46', '2017-11-14 16:08:46'),
(102, 'Zone a', '', 6, 20, '2017-11-15 15:19:36', '2017-11-15 15:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `FinanceID` int(11) NOT NULL,
  `AssemblyID` varchar(100) NOT NULL,
  `Indicators` varchar(100) NOT NULL,
  `IndicatorType` varchar(1) NOT NULL,
  `IndValues` varchar(100) NOT NULL,
  `UserName` varchar(300) NOT NULL,
  `ReviewerID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `Activity_State` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date` date DEFAULT NULL,
  `flag` varchar(2) DEFAULT NULL,
  `accountcode` int(11) NOT NULL,
  `accountsubcode` int(11) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`FinanceID`, `AssemblyID`, `Indicators`, `IndicatorType`, `IndValues`, `UserName`, `ReviewerID`, `id`, `Activity_State`, `created_at`, `updated_at`, `date`, `flag`, `accountcode`, `accountsubcode`, `comments`) VALUES
(3, '2001', 'Teenagers (Males)', 'F', '67', '1', 2, 2147483647, 2, '2017-11-10 15:32:29', '2017-11-10 15:32:29', '2017-08-01', 'E', 4200, 0, ''),
(4, '2001', 'THANKSGIVING', 'F', '90.04', '1', 2, 2147483647, 1, '2017-09-15 15:55:19', '2017-09-15 15:55:19', '2017-06-05', 'I', 4200, 4140, ''),
(6, '2001', 'KOFI & AMA', 'S', '890', '1', 0, 2147483647, 1, '2017-06-05 11:04:48', '2017-07-20 15:39:57', '2017-06-05', 'I', 4100, 4120, ''),
(7, '2001', 'WEEKDAYS OFFERTORY', 'F', '100', '1', 2, 2147483647, 1, '2017-06-07 11:04:51', '2017-07-21 14:51:09', '2017-06-07', 'I', 4100, 4110, ''),
(8, '2001', 'Overall Membership', 'S', '200', '1', 0, 2147483647, 1, '2017-06-07 11:04:53', '2017-07-24 16:41:39', '2017-06-07', 'I', 4200, 4150, ''),
(9, '2001', ' Membership', 'S', '300', '1', 0, 2147483647, 1, '2017-06-07 11:04:55', '0000-00-00 00:00:00', '2017-06-07', 'I', 5000, 5100, ''),
(10, '2001', 'SUNDAY OFFERTORY', 'F', '2000', '1', 0, 2147483647, 1, '2017-06-07 11:04:56', '0000-00-00 00:00:00', '2017-06-07', 'I', 4100, 4100, ''),
(11, '2001', 'Overall Membership', 'S', '43299', '1', 0, 2147483647, 1, '2017-06-08 11:04:58', '2017-07-20 15:29:59', '2017-06-08', 'I', 4100, 78, ''),
(26, '2001', 'OFFERTORY', 'F', '256', '4', 0, 0, 1, '2017-08-04 13:19:38', '2017-07-24 12:09:59', '2017-08-01', 'I', 33, 33, ''),
(27, '2001', 'KOFI & AMA', 'S', '3645', '4', 0, 0, 1, '2017-07-27 16:11:46', '2017-07-24 12:10:16', '2017-07-24', NULL, 33, 33, ''),
(28, '2001', 'Overall Membership', 'S', '900', '4', 0, 0, 1, '2017-07-27 16:12:55', '2017-07-24 12:47:06', '2017-07-24', NULL, 33, 33, ''),
(29, '2001', 'SUNDAY OFFERTORY', 'F', '500', '4', 0, 0, 1, '2017-08-04 13:52:39', '2017-07-24 12:47:43', '2017-07-24', 'I', 4100, 33, ''),
(30, '2001', 'OFFERTORY', 'F', '100', '4', 0, 0, 0, '2017-07-24 12:48:35', '2017-07-24 12:48:35', '2017-07-24', 'E', 33, 33, ''),
(31, '2001', 'OFFERTORY', 'F', '123', '4', 0, 0, 0, '2017-07-24 13:01:02', '2017-07-24 13:01:02', '2017-07-24', 'E', 33, 33, ''),
(32, '2001', 'Overall Membership', 'S', '1234', '4', 0, 0, 1, '2017-07-27 16:13:13', '2017-07-24 13:02:21', '2017-07-24', 'E', 33, 33, ''),
(33, '2002', 'WEEKDAYS OFFERTORY', 'F', '585', '4', 0, 0, 0, '2017-07-24 13:04:46', '2017-07-24 13:04:46', '2017-07-24', 'E', 33, 33, ''),
(34, '2001', 'Leader Name', 'D', '2', '8', 0, 0, 1, '2017-08-10 11:28:47', '2017-08-02 13:19:20', '2017-08-02', NULL, 33, 33, ''),
(35, '2001', 'No of Ministers'' wives', 'F', '12', '1', 2, 2147483647, 1, '2017-06-05 11:04:47', '2017-07-20 15:28:48', '2017-06-05', 'I', 4100, 4130, ''),
(36, '2001', 'No Of Ministers', 'S', '43299', '1', 0, 2147483647, 1, '2017-06-08 11:04:58', '2017-07-20 15:29:59', '2017-06-08', 'I', 4100, 78, ''),
(37, '2001', 'No of Children', 'S', '900', '4', 0, 0, 1, '2017-09-14 17:03:05', '2017-07-24 12:47:06', '2017-07-24', NULL, 33, 33, ''),
(38, '2001', 'No of Members', 'F', '56123', '9', 0, 0, 0, '2017-09-15 16:34:37', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(39, '2001', 'No of Converts', 'S', '321', '9', 0, 0, 0, '2017-09-14 16:54:39', '2017-09-14 14:02:25', '2017-09-01', NULL, 33, 33, ''),
(40, '2001', 'No of Visitors', 'F', '13', '9', 0, 0, 0, '2017-09-14 16:53:20', '2017-09-14 14:04:08', '2017-09-01', 'I', 33, 33, ''),
(41, '2001', 'Leader Name', 'D', 'mensah', '9', 0, 0, 0, '2017-09-14 14:04:24', '2017-09-14 14:04:24', '2017-09-01', NULL, 33, 33, ''),
(42, '2001', 'No of Members', 'F', '13', '9', 0, 0, 0, '2017-09-14 16:53:20', '2017-09-14 14:04:08', '2017-09-01', 'I', 33, 33, ''),
(43, '2001', 'No of Children', 'F', '24', '9', 0, 0, 0, '2017-09-14 16:53:20', '2017-09-14 14:04:08', '2017-09-01', 'I', 33, 33, ''),
(44, '2001', 'No of Visitors', 'F', '327', '9', 0, 0, 0, '2017-09-18 11:33:06', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(45, '2001', 'No of Converts', 'F', '325', '9', 0, 0, 0, '2017-09-15 16:34:37', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(46, '2001', 'No of Children', 'F', '543', '9', 0, 0, 0, '2017-09-18 11:31:59', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(47, '2003', 'No of Members', 'F', '56123', '9', 0, 0, 0, '2017-09-15 16:34:37', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(48, '2003', 'No of Converts', 'F', '021', '9', 0, 0, 0, '2017-09-19 12:11:09', '2017-09-19 12:11:09', '2017-09-14', 'I', 33, 33, ''),
(49, '2003', 'No of Children', 'F', '5434', '9', 0, 0, 0, '2017-09-18 11:31:59', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(50, '2003', 'No of Visitors', 'F', '3277', '9', 0, 0, 0, '2017-09-18 11:33:06', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(51, '2001', 'Leader Name', 'D', 'd', '8', 0, 0, 1, '2017-09-19 13:26:29', '2017-09-19 13:26:29', '2017-09-19', NULL, 33, 33, ''),
(52, '2001', 'Leader Name', 'D', '123', '9', 0, 0, 1, '2017-09-20 10:21:17', '2017-09-20 10:21:17', '2017-09-13', NULL, 33, 33, ''),
(53, '2001', 'Leader Name', 'D', '14', '9', 0, 0, 1, '2017-09-20 13:25:58', '2017-09-20 13:25:58', '2017-09-01', NULL, 33, 33, ''),
(54, '2001', 'Leader Name', 'D', '14', '9', 0, 0, 1, '2017-09-20 13:29:10', '2017-09-20 13:29:10', '2017-09-01', NULL, 33, 33, ''),
(55, '2001', 'Leader Name', 'D', '14', '9', 0, 0, 1, '2017-09-20 13:35:08', '2017-09-20 13:35:08', '2017-09-01', NULL, 33, 33, ''),
(56, '2001', 'Leader Name', 'D', '14', '9', 0, 0, 1, '2017-09-20 13:37:22', '2017-09-20 13:37:22', '2017-09-01', NULL, 33, 33, ''),
(57, '2001', 'Leader Name', 'D', '14', '9', 0, 0, 1, '2017-09-20 13:40:47', '2017-09-20 13:40:47', '2017-09-01', NULL, 33, 33, ''),
(58, '2001', 'Leader Name', 'D', '14', '9', 0, 0, 1, '2017-09-20 13:42:33', '2017-09-20 13:42:33', '2017-09-01', NULL, 33, 33, ''),
(59, '2001', 'Leader Name', 'D', '9999', '9', 0, 0, 1, '2017-09-20 13:45:01', '2017-09-20 13:45:01', '2017-09-20', NULL, 33, 33, ''),
(60, '2001', 'test', 'D', '2222', '9', 0, 0, 1, '2017-09-20 13:45:54', '2017-09-20 13:45:54', '2017-09-20', NULL, 33, 33, ''),
(61, '2001', 'Leader Name', 'D', '12321', '9', 0, 0, 1, '2017-09-20 13:46:37', '2017-09-20 13:46:37', '2017-09-20', NULL, 33, 33, ''),
(62, '2001', 'Leader Name', 'D', '12321', '9', 0, 0, 1, '2017-09-20 13:47:22', '2017-09-20 13:47:22', '2017-09-20', NULL, 33, 33, ''),
(63, '2001', 'Leader Name', 'D', '222', '9', 0, 0, 1, '2017-09-20 13:47:22', '2017-09-20 13:47:22', '2017-09-20', NULL, 33, 33, ''),
(64, '2001', 'Leader Name', 'D', '444', '9', 0, 0, 1, '2017-09-20 13:47:22', '2017-09-20 13:47:22', '2017-09-20', NULL, 33, 33, ''),
(65, '2001', 'Leader Name', 'D', '12321', '9', 0, 0, 1, '2017-09-20 14:40:17', '2017-09-20 14:40:17', '2017-09-20', NULL, 33, 33, ''),
(66, '2001', 'Leader Name', 'D', '222', '9', 0, 0, 1, '2017-09-20 14:40:17', '2017-09-20 14:40:17', '2017-09-20', NULL, 33, 33, ''),
(67, '2001', 'Leader Name', 'D', '444', '9', 0, 0, 1, '2017-09-20 14:40:17', '2017-09-20 14:40:17', '2017-09-20', NULL, 33, 33, ''),
(68, '2001', 'THANKSGIVING', 'F', '32', '9', 0, 0, 1, '2017-09-20 16:28:42', '2017-09-20 16:28:42', '2017-09-20', 'I', 33, 33, ''),
(69, '2001', 'THANKSGIVING', 'F', '500', '9', 0, 0, 1, '2017-09-20 16:32:12', '2017-09-20 16:32:12', '2017-09-20', 'E', 33, 33, ''),
(70, '2001', 'SPECIAL OFFERING', 'F', '3', '9', 0, 0, 1, '2017-09-20 16:34:14', '2017-09-20 16:34:14', '2017-09-20', 'I', 33, 33, ''),
(71, '2001', 'Overall Membership', 'S', '123', '8', 0, 0, 1, '2017-09-25 11:03:23', '2017-09-25 11:03:23', '2017-09-25', NULL, 33, 33, ''),
(72, '2001', 'Teenagers (Males)', 'S', '1234', '8', 0, 0, 1, '2017-09-25 11:03:23', '2017-09-25 11:03:23', '2017-09-25', NULL, 33, 33, ''),
(73, '2001', 'Overall Membership', 'S', '123', '8', 0, 0, 1, '2017-09-25 11:16:55', '2017-09-25 11:16:55', '2017-09-25', NULL, 33, 33, ''),
(74, '2001', 'Teenagers (Males)', 'S', '1234', '8', 0, 0, 1, '2017-09-25 11:16:55', '2017-09-25 11:16:55', '2017-09-25', NULL, 33, 33, ''),
(75, '2001', 'Overall Membership', 'S', '543118', '8', 0, 0, 1, '2017-09-25 11:16:55', '2017-09-25 11:16:55', '2017-09-01', NULL, 33, 33, ''),
(76, '2001', 'Overall Membership', 'S', '34', '8', 0, 0, 1, '2017-09-25 11:17:40', '2017-09-25 11:17:40', '2017-09-06', NULL, 33, 33, ''),
(77, '2001', 'Teenagers (Males)', 'S', '341', '8', 0, 0, 1, '2017-09-25 11:17:40', '2017-09-25 11:17:40', '2017-09-06', NULL, 33, 33, ''),
(78, '2001', 'Overall Membership', 'S', '34', '8', 0, 0, 1, '2017-09-25 11:18:18', '2017-09-25 11:18:18', '2017-09-06', NULL, 33, 33, ''),
(79, '2001', 'Teenagers (Males)', 'S', '341', '8', 0, 0, 1, '2017-09-25 11:18:18', '2017-09-25 11:18:18', '2017-09-06', NULL, 33, 33, ''),
(80, '2001', 'Teenagers (Males)', 'S', '341', '8', 0, 0, 1, '2017-09-25 11:18:18', '2017-09-25 11:18:18', '2017-09-25', NULL, 33, 33, ''),
(81, '2001', 'Teenagers (Males)', 'S', '45', '8', 0, 0, 1, '2017-09-25 11:27:09', '2017-09-25 11:27:09', '2017-09-26', NULL, 33, 33, ''),
(82, '2001', 'Overall Membership', 'S', '54', '8', 0, 0, 1, '2017-09-25 11:27:09', '2017-09-25 11:27:09', '2017-09-26', NULL, 33, 33, ''),
(83, '2001', 'Overall Membership', 'S', '9', '9', 0, 0, 1, '2017-09-25 11:29:57', '2017-09-25 11:29:57', '2017-09-26', NULL, 33, 33, ''),
(84, '2001', 'Teenagers (Males)', 'S', '90', '9', 0, 0, 1, '2017-09-25 11:29:57', '2017-09-25 11:29:57', '2017-09-26', NULL, 33, 33, ''),
(85, '2001', 'KOFI & AMA', 'F', '99', '9', 0, 0, 1, '2017-09-25 11:32:12', '2017-09-25 11:32:12', '2017-09-25', 'I', 33, 33, ''),
(86, '2001', 'Teenagers', 'F', '990', '9', 0, 0, 1, '2017-09-25 11:32:12', '2017-09-25 11:32:12', '2017-09-25', 'I', 33, 33, ''),
(87, '2001', 'Overall Membership', 'S', '7', '9', 0, 0, 1, '2017-09-25 11:34:56', '2017-09-25 11:34:56', '2017-09-25', NULL, 33, 33, ''),
(88, '2001', 'Overall Membership', 'S', '6', '9', 0, 0, 1, '2017-09-25 11:34:56', '2017-09-25 11:34:56', '2017-09-25', NULL, 33, 33, ''),
(89, '2001', 'Overall Membership', 'S', '2121', '9', 0, 0, 1, '2017-09-25 11:42:07', '2017-09-25 11:42:07', '2017-09-25', NULL, 33, 33, ''),
(90, '2001', 'Overall Membership', 'S', '212111', '9', 0, 0, 1, '2017-09-25 11:42:07', '2017-09-25 11:42:07', '2017-09-25', NULL, 33, 33, ''),
(91, '2001', 'Overall Membership', 'S', '1', '9', 0, 0, 1, '2017-09-14 12:00:15', '2017-09-25 12:00:15', '2017-09-26', NULL, 33, 33, ''),
(92, '2001', 'Teenagers (Males)', 'S', '2', '9', 0, 0, 1, '2017-09-25 12:00:15', '2017-09-25 12:00:15', '2017-09-26', NULL, 33, 33, ''),
(93, '2001', 'KOFI & AMA', 'F', '5666', '8', 0, 0, 1, '2017-09-25 12:06:43', '2017-09-25 12:06:43', '2017-09-13', 'I', 33, 33, ''),
(94, '2001', 'SPECIAL OFFERING', 'F', '123', '8', 0, 0, 1, '2017-09-25 12:06:43', '2017-09-25 12:06:43', '2017-09-13', 'E', 33, 33, ''),
(95, '2001', 'KOFI & AMA', 'F', '32', '8', 0, 0, 1, '2017-09-25 12:11:59', '2017-09-25 12:11:59', '2017-09-27', 'I', 33, 33, ''),
(96, '2001', 'KOFI & AMA', 'F', '321', '8', 0, 0, 1, '2017-09-25 12:11:59', '2017-09-25 12:11:59', '2017-09-27', 'E', 33, 33, ''),
(97, '2001', 'Overall Membership', 'S', '121', '9', 0, 0, 1, '2017-09-25 13:31:12', '2017-09-25 13:31:12', '2017-09-25', NULL, 33, 33, ''),
(98, '2001', 'Overall Membership', 'S', '1214', '9', 0, 0, 1, '2017-09-25 13:32:25', '2017-09-25 13:32:25', '2017-09-25', NULL, 33, 33, ''),
(99, '2001', 'Overall Membership', 'S', '12145', '9', 0, 0, 1, '2017-09-25 13:32:25', '2017-09-25 13:32:25', '2017-09-25', NULL, 33, 33, ''),
(100, '2001', 'Overall Membership', 'S', '123', '9', 0, 0, 1, '2017-09-25 13:38:19', '2017-09-25 13:38:19', '2017-09-01', NULL, 33, 33, ''),
(101, '2001', 'Overall Membership', 'S', '12', '9', 0, 0, 1, '2017-09-25 13:45:15', '2017-09-25 13:45:15', '2017-09-25', NULL, 33, 33, ''),
(102, '2001', 'Leader Name', 'D', '123', '9', 0, 0, 1, '2017-09-25 13:51:53', '2017-09-25 13:51:53', '2017-09-25', NULL, 33, 33, ''),
(103, '2001', 'test', 'D', '1231', '9', 0, 0, 1, '2017-09-25 13:51:53', '2017-09-25 13:51:53', '2017-09-25', NULL, 33, 33, ''),
(104, '2001', 'No of New Converts', 'F', '325', '9', 0, 0, 0, '2017-09-15 16:34:37', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(105, '2001', 'No of New Members', 'F', '327', '9', 0, 0, 0, '2017-09-18 11:33:06', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(106, '2001', 'No of New Converts', 'S', '547', '9', 0, 0, 0, '2017-09-14 16:54:39', '2017-09-14 14:02:25', '2017-09-01', NULL, 33, 33, ''),
(107, '2001', 'No of New Members', 'S', '654', '9', 0, 0, 0, '2017-09-14 16:54:39', '2017-09-14 14:02:25', '2017-09-01', NULL, 33, 33, ''),
(108, '2001', 'No of New Members', 'F', '987', '9', 0, 0, 0, '2017-09-15 16:34:37', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(109, '2001', 'No of New Converts', 'F', '789', '9', 0, 0, 0, '2017-09-15 16:34:37', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(110, '2001', 'comments', 'F', 'say what u like', '9', 0, 0, 0, '2017-09-15 16:34:37', '2017-09-15 16:34:37', '2017-09-14', 'I', 33, 33, ''),
(111, '2001', 'Comments', 'D', 'aa', '1', 0, 0, 1, '2017-10-19 11:16:06', '2017-10-19 11:16:06', '2017-09-12', NULL, 33, 33, ''),
(112, '2001', 'Topic', 'D', 'My Topic', '1', 0, 0, 1, '2017-10-19 11:16:06', '2017-10-19 11:16:06', '2017-09-12', NULL, 33, 33, ''),
(113, '2001', 'Topic', 'D', 'My Topic', '1', 0, 0, 1, '2017-10-19 11:17:16', '2017-10-19 11:17:16', '2017-09-12', NULL, 33, 33, ''),
(114, '2001', 'Topic', 'D', 'My Topic', '1', 0, 0, 1, '2017-10-19 11:18:20', '2017-10-19 11:18:20', '2017-09-12', NULL, 33, 33, ''),
(115, '2001', 'Topic', 'D', 'My Topic', '1', 0, 0, 1, '2017-10-19 11:19:46', '2017-10-19 11:19:46', '2017-09-12', NULL, 33, 33, ''),
(116, '2001', 'Topic', 'D', 'My Topic', '1', 0, 0, 1, '2017-10-19 11:20:17', '2017-10-19 11:20:17', '2017-09-12', NULL, 33, 33, ''),
(117, '2001', 'Leader Name', 'D', 'Jonas Today', '1', 0, 0, 1, '2017-10-19 11:25:49', '2017-10-19 11:25:49', '2017-09-12', NULL, 33, 33, ''),
(118, '2001', 'Overall Membership', 'S', '345', '1', 0, 0, 1, '2017-10-19 15:17:15', '2017-10-19 15:17:15', '2017-10-19', NULL, 33, 33, ''),
(119, '2001', 'Overall Membership', 'S', '345', '1', 0, 0, 1, '2017-10-19 15:17:31', '2017-10-19 15:17:31', '2017-10-19', NULL, 33, 33, ''),
(120, '2001', 'Teenagers (Males)', 'S', '345', '1', 0, 0, 1, '2017-10-19 15:21:58', '2017-10-19 15:21:58', '2017-10-19', NULL, 33, 33, ''),
(121, '2001', 'Overall Membership', 'S', '5666', '1', 0, 0, 1, '2017-10-19 15:25:11', '2017-10-19 15:25:11', '2017-10-14', NULL, 33, 33, ''),
(122, '2001', 'KOFI & AMA', 'F', '32332', '1', 0, 0, 1, '2017-12-04 11:11:09', '2017-12-04 11:11:09', '2017-11-23', 'I', 33, 33, ''),
(123, '2001', 'THANKSGIVING', 'F', '5', '1', 0, 0, 1, '2017-11-14 16:24:04', '2017-11-14 16:24:04', '2017-11-14', 'E', 33, 33, ''),
(124, '5025', 'Overall Membership', 'S', '50', '1', 0, 0, 1, '2017-11-20 12:12:42', '2017-11-20 12:12:42', '2017-11-20', NULL, 33, 33, ''),
(125, '5025', 'Overall Membership', 'S', '50', '1', 0, 0, 1, '2017-11-20 12:20:39', '2017-11-20 12:20:39', '2017-11-20', NULL, 33, 33, ''),
(126, '5025', 'Overall Membership', 'S', '50', '1', 0, 0, 1, '2017-11-20 12:21:14', '2017-11-20 12:21:14', '2017-11-20', NULL, 33, 33, ''),
(127, '9900', 'Overall Membership', 'S', '50', '1', 0, 0, 1, '2017-11-22 12:09:08', '2017-11-20 12:23:07', '2017-11-20', NULL, 33, 33, ''),
(128, '2002', 'Overall Membership', 'S', '258', '1', 0, 0, 1, '2017-10-19 15:25:11', '2017-10-19 15:25:11', '2017-10-14', NULL, 33, 33, ''),
(129, '2002', 'No of Converts', 'S', '321', '9', 0, 0, 0, '2017-09-14 16:54:39', '2017-09-14 14:02:25', '2017-09-01', NULL, 33, 33, ''),
(130, '2001', 'Overall Membership', 'S', '55', '1', 0, 0, 1, '2017-12-04 14:25:25', '2017-12-04 14:25:25', '2017-12-20', NULL, 33, 33, ''),
(131, '2001', 'Teenagers (Males)', 'S', '1', '1', 0, 0, 1, '2017-12-04 14:34:32', '2017-12-04 14:34:32', '2017-12-20', NULL, 33, 33, ''),
(132, '2001', 'Teenagers (Males)', 'S', '5', '1', 0, 0, 1, '2017-12-04 14:35:18', '2017-12-04 14:35:18', '2017-12-20', NULL, 33, 33, ''),
(133, '2001', 'Overall Membership', 'S', '12', '1', 0, 0, 1, '2017-12-04 14:38:54', '2017-12-04 14:38:54', '2017-12-04', NULL, 33, 33, ''),
(134, '2001', 'Overall Membership', 'S', '4', '1', 0, 0, 1, '2017-12-04 14:39:56', '2017-12-04 14:39:56', '2017-12-04', NULL, 33, 33, ''),
(135, '2001', 'Overall Membership', 'S', '123', '1', 0, 0, 1, '2017-12-04 14:40:56', '2017-12-04 14:40:56', '2017-12-04', NULL, 33, 33, ''),
(136, '2001', 'Overall Membership', 'S', '2', '1', 0, 0, 1, '2017-12-04 14:45:43', '2017-12-04 14:45:43', '2017-12-04', NULL, 33, 33, ''),
(137, '2001', 'Overall Membership', 'S', '2', '1', 0, 0, 1, '2017-12-04 14:46:18', '2017-12-04 14:46:18', '2017-12-04', NULL, 33, 33, ''),
(138, '2001', 'Teenagers (Males)', 'S', '32', '1', 0, 0, 1, '2017-12-04 14:51:29', '2017-12-04 14:51:29', '2017-12-04', NULL, 33, 33, ''),
(139, '2001', 'Overall Membership', 'S', '11', '1', 0, 0, 1, '2017-12-04 16:19:13', '2017-12-04 16:19:13', '2017-12-05', NULL, 33, 33, ''),
(140, '2001', 'Overall Membership', 'S', '11', '1', 0, 0, 1, '2017-12-04 16:19:45', '2017-12-04 16:19:45', '2017-12-05', NULL, 33, 33, ''),
(141, '2001', 'Overall Membership', 'S', '50', '1', 0, 0, 1, '2017-12-04 16:19:45', '2017-12-04 16:19:45', '2017-12-05', NULL, 33, 33, ''),
(142, '2001', 'Teenagers (Males)', 'S', '123', '1', 0, 0, 1, '2017-12-04 16:21:40', '2017-12-04 16:21:40', '2017-12-05', NULL, 33, 33, ''),
(143, '2001', 'Teenagers (Males)', 'S', '29', '1', 0, 0, 1, '2017-12-04 16:24:27', '2017-12-04 16:24:27', '2017-12-06', NULL, 33, 33, ''),
(144, '2001', 'Overall Membership', 'S', '23', '1', 0, 0, 1, '2017-12-04 16:26:23', '2017-12-04 16:26:23', '2017-12-06', NULL, 33, 33, ''),
(145, '2001', 'Teenagers (Males)', 'S', '541', '1', 0, 0, 1, '2017-12-04 16:27:24', '2017-12-04 16:27:24', '2017-12-07', NULL, 33, 33, ''),
(146, '2001', 'Teenagers (Males)', 'S', '60', '1', 0, 0, 1, '2017-12-04 16:28:24', '2017-12-04 16:28:24', '2017-12-08', NULL, 33, 33, ''),
(147, '2001', 'Teenagers (Males)', 'S', '30', '1', 0, 0, 1, '2017-12-04 16:28:24', '2017-12-04 16:28:24', '2017-12-20', NULL, 33, 33, ''),
(148, '2001', 'Overall Membership', 'S', '22', '1', 0, 0, 1, '2017-12-05 09:44:29', '2017-12-05 09:44:29', '2017-12-05', NULL, 33, 33, ''),
(149, '2001', 'Overall Membership', 'S', '22', '1', 0, 0, 1, '2017-12-05 09:44:38', '2017-12-05 09:44:38', '2017-12-05', NULL, 33, 33, ''),
(150, '2001', 'Overall Membership', 'S', '32', '1', 0, 0, 1, '2017-12-05 09:44:38', '2017-12-05 09:44:38', '2017-12-05', NULL, 33, 33, ''),
(151, '2001', 'Overall Membership', 'S', '22', '1', 0, 0, 1, '2017-12-05 09:45:11', '2017-12-05 09:45:11', '2017-12-05', NULL, 33, 33, ''),
(152, '2001', 'Overall Membership', 'S', '32', '1', 0, 0, 1, '2017-12-05 09:45:11', '2017-12-05 09:45:11', '2017-12-05', NULL, 33, 33, ''),
(153, '2001', 'Overall Membership', 'S', '32', '1', 0, 0, 1, '2017-12-05 09:45:11', '2017-12-05 09:45:11', '2017-12-05', NULL, 33, 33, ''),
(154, '2001', 'Overall Membership', 'S', '2', '1', 0, 0, 1, '2017-12-05 09:49:56', '2017-12-05 09:49:56', '2017-12-22', NULL, 33, 33, ''),
(155, '2001', 'KOFI & AMA', 'F', '123', '1', 0, 0, 1, '2017-12-11 10:19:13', '2017-12-11 10:19:13', '2017-12-12', 'I', 33, 33, ''),
(156, '2001', 'Overall Membership', 'S', '12', '1', 0, 0, 1, '2017-12-13 11:46:05', '2017-12-13 11:46:05', '2017-12-14', NULL, 33, 33, ''),
(157, '2001', 'Teenagers (Males)', 'S', '45', '1', 0, 0, 1, '2017-12-13 15:22:12', '2017-12-13 15:22:12', '2017-12-14', NULL, 33, 33, ''),
(158, '2001', 'Teenagers (Males)', 'S', '79', '1', 0, 0, 1, '2017-12-13 15:41:11', '2017-12-13 15:41:11', '2017-12-15', NULL, 33, 33, ''),
(159, '2001', 'Overall Membership', 'S', '2525', '1', 0, 0, 1, '2017-12-13 15:48:52', '2017-12-13 15:48:52', '2017-12-15', NULL, 33, 33, ''),
(160, '2001', 'Overall Membership', 'S', '1', '1', 0, 0, 1, '2017-12-13 15:59:51', '2017-12-13 15:59:51', '2017-12-16', NULL, 33, 33, ''),
(161, '2001', 'KOFI & AMA', 'F', '25', '1', 0, 0, 1, '2017-12-14 11:57:13', '2017-12-14 11:57:13', '2017-12-13', 'I', 33, 33, ''),
(162, '2001', 'KOFI & AMA', 'F', '25', '1', 0, 0, 1, '2017-12-14 11:57:13', '2017-12-14 11:57:13', '2017-12-03', 'I', 33, 33, ''),
(163, '2001', 'THANKSGIVING', 'F', '25', '1', 0, 0, 1, '2017-12-14 11:57:13', '2017-12-14 11:57:13', '2017-12-03', 'E', 33, 33, ''),
(164, '2001', 'THANKSGIVING', 'F', '97', '1', 0, 0, 1, '2017-12-14 11:57:13', '2017-12-14 11:57:13', '2017-12-03', 'I', 33, 33, ''),
(165, '2001', 'KOFI & AMA', 'F', '150', '1', 0, 0, 1, '2017-12-19 12:17:50', '2017-12-19 12:17:50', '2017-12-19', 'I', 33, 33, ''),
(166, '2001', 'myincome', 'F', '23', '1', 0, 0, 1, '2017-12-28 10:17:34', '2017-12-28 10:17:34', '2017-12-28', 'I', 33, 33, ''),
(167, '2001', 'Teenagers', 'F', '23', '1', 0, 0, 1, '2017-12-28 10:18:07', '2017-12-28 10:18:07', '2017-12-28', 'E', 33, 33, ''),
(168, '2001', 'KOFI & AMA', 'F', '23', '1', 0, 0, 1, '2017-12-28 10:19:57', '2017-12-28 10:19:57', '2017-12-28', 'I', 33, 33, ''),
(169, '2001', 'Overall Membership', 'S', '34', '1', 0, 0, 1, '2017-12-28 10:20:24', '2017-12-28 10:20:24', '2017-12-28', NULL, 33, 33, ''),
(170, '2001', 'Teenagers (Males)', 'S', '22', '1', 0, 0, 1, '2017-12-28 10:21:16', '2017-12-28 10:21:16', '2017-12-28', NULL, 33, 33, ''),
(171, '2001', 'Overall Membership', 'S', '45', '1', 0, 0, 1, '2017-12-28 10:22:26', '2017-12-28 10:22:26', '2017-12-29', NULL, 33, 33, ''),
(172, '2001', 'KOFI & AMA', 'F', '12', '1', 0, 0, 1, '2017-12-28 10:22:56', '2017-12-28 10:22:56', '2017-12-29', 'I', 33, 33, ''),
(173, '2001', 'KOFI & AMA', 'F', '12', '1', 0, 0, 1, '2017-12-28 10:25:08', '2017-12-28 10:25:08', '2017-12-30', 'I', 33, 33, ''),
(174, '2001', 'Teenagers', 'F', '12', '1', 0, 0, 1, '2017-12-28 10:26:53', '2017-12-28 10:26:53', '2017-12-30', 'E', 33, 33, ''),
(175, '2001', 'myincome', 'F', '12', '1', 0, 0, 1, '2017-12-28 10:28:21', '2017-12-28 10:28:21', '2017-12-30', 'I', 33, 33, ''),
(176, '2001', 'Teenagers', 'F', '12', '1', 0, 0, 1, '2017-12-28 10:29:35', '2017-12-28 10:29:35', '2017-12-03', 'E', 33, 33, ''),
(177, '2001', 'KOFI & AMA', 'F', '12', '1', 0, 0, 1, '2017-12-28 10:30:15', '2017-12-28 10:30:15', '2017-12-04', 'I', 33, 33, ''),
(178, '2001', 'KOFI & AMA', 'F', '23', '1', 0, 0, 1, '2017-12-28 10:32:19', '2017-12-28 10:32:19', '2017-12-05', 'I', 33, 33, ''),
(179, '2001', 'Teenagers', 'F', '23', '1', 0, 0, 1, '2017-12-28 10:33:08', '2017-12-28 10:33:08', '2017-12-06', 'E', 33, 33, ''),
(180, '2001', 'Teenagers', 'F', '12', '1', 0, 0, 1, '2017-12-28 10:34:41', '2017-12-28 10:34:41', '2017-12-07', 'E', 33, 33, ''),
(181, '2001', 'KOFI & AMA', 'F', '12', '1', 0, 0, 1, '2017-12-28 10:36:13', '2017-12-28 10:36:13', '2017-12-08', 'I', 33, 33, ''),
(182, '2001', 'KOFI & AMA', 'F', '13', '1', 0, 0, 1, '2017-12-28 10:37:21', '2017-12-28 10:37:21', '2017-12-11', 'I', 33, 33, ''),
(183, '2001', 'Teenagers', 'F', '13', '1', 0, 0, 1, '2017-12-28 10:39:22', '2017-12-28 10:39:22', '2017-12-13', 'E', 33, 33, ''),
(184, '2001', 'myincome', 'F', '13', '1', 0, 0, 1, '2017-12-28 10:41:23', '2017-12-28 10:41:23', '2017-12-14', 'I', 33, 33, ''),
(185, '2001', 'KOFI & AMA', 'F', '32', '1', 0, 0, 1, '2017-12-28 10:42:16', '2017-12-28 10:42:16', '2017-12-15', 'I', 33, 33, ''),
(186, '2001', 'KOFI & AMA', 'F', '32', '1', 0, 0, 1, '2017-12-28 10:42:54', '2017-12-28 10:42:54', '2017-12-16', 'I', 33, 33, ''),
(187, '2001', 'KOFI & AMA', 'F', '34', '1', 0, 0, 1, '2017-12-28 11:20:25', '2017-12-28 11:20:25', '2017-12-14', 'I', 33, 33, ''),
(188, '2001', 'KOFI & AMA', 'F', '123', '1', 0, 0, 1, '2017-12-28 11:29:03', '2017-12-28 11:29:03', '2017-12-23', 'I', 33, 33, 'comment here'),
(189, '2001', 'myincome', 'F', '34', '1', 0, 0, 1, '2017-12-28 11:39:06', '2017-12-28 11:39:06', '2017-12-20', 'I', 33, 33, ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.	\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.	'),
(190, '2001', 'SPECIAL OFFERING', 'F', '1212', '1', 0, 0, 1, '2017-12-28 12:49:29', '2017-12-28 12:49:29', '2017-12-28', 'E', 33, 33, '5545'),
(191, '2001', 'KOFI & AMA', 'F', '5454545', '1', 0, 0, 1, '2017-12-28 12:49:52', '2017-12-28 12:49:52', '2017-12-28', 'I', 33, 33, '5454545'),
(192, '2001', 'KOFI & AMA', 'F', '1223', '1', 0, 0, 1, '2017-12-28 12:50:32', '2017-12-28 12:50:32', '2017-12-28', 'I', 33, 33, '112322'),
(193, '2001', 'KOFI & AMA', 'F', '11212', '1', 0, 0, 1, '2017-12-28 12:50:32', '2017-12-28 12:50:32', '2017-12-28', 'I', 33, 33, '21212'),
(194, '2001', 'KOFI & AMA', 'F', '1223', '1', 0, 0, 1, '2017-12-28 12:50:32', '2017-12-28 12:50:32', '2017-12-28', 'I', 33, 33, 'wdsd'),
(195, '2001', 'KOFI & AMA', 'F', '1223', '1', 0, 0, 1, '2017-12-28 12:50:43', '2017-12-28 12:50:43', '2017-12-28', 'I', 33, 33, 'sdsd'),
(196, '2003', 'myincome', 'F', '12', '1', 0, 0, 1, '2017-12-28 15:55:58', '2017-12-28 15:55:58', '2017-12-01', 'I', 33, 33, ' dfdff'),
(197, '2003', 'KOFI & AMA', 'F', '134', '1', 0, 0, 1, '2017-12-28 15:55:58', '2017-12-28 15:55:58', '2017-12-01', 'I', 33, 33, 'dfdf'),
(198, '2003', 'THANKSGIVING', 'F', '65656', '1', 0, 0, 1, '2017-12-28 15:55:58', '2017-12-28 15:55:58', '2017-12-01', 'I', 33, 33, ''),
(199, '2003', 'Pledge', 'F', '13', '1', 0, 0, 1, '2017-12-29 10:09:03', '2017-12-29 10:09:03', '2017-12-29', 'I', 33, 33, ' aasd'),
(200, '2003', 'Pledge', 'F', '2', '1', 0, 0, 1, '2017-12-29 10:09:03', '2017-12-29 10:09:03', '2017-12-29', 'I', 33, 33, ''),
(201, '2003', 'SPECIAL OFFERING', 'F', '6', '1', 0, 0, 1, '2017-12-29 10:09:03', '2017-12-29 10:09:03', '2017-12-29', 'E', 33, 33, ''),
(202, '2001', 'Pledge', 'F', '45', '1', 0, 0, 1, '2017-12-29 10:09:51', '2017-12-29 10:09:51', '2017-12-29', 'I', 33, 33, ''),
(203, '2001', 'Teenagers', 'F', '3', '1', 0, 0, 1, '2017-12-29 10:09:52', '2017-12-29 10:09:52', '2017-12-29', 'I', 33, 33, ''),
(204, '2001', 'SPECIAL OFFERING', 'F', '79', '1', 0, 0, 1, '2017-12-29 10:09:52', '2017-12-29 10:09:52', '2017-12-29', 'E', 33, 33, ''),
(205, '2002', 'Pledge', 'F', '79', '1', 0, 0, 1, '2017-12-29 12:35:01', '2017-12-29 12:35:01', '2017-12-29', 'I', 33, 33, ' aaaa'),
(206, '2002', 'SPECIAL OFFERING', 'F', '3', '1', 0, 0, 1, '2017-12-29 12:35:01', '2017-12-29 12:35:01', '2017-12-29', 'E', 33, 33, '');

-- --------------------------------------------------------

--
-- Table structure for table `iesummary`
--

CREATE TABLE `iesummary` (
  `assembly` varchar(255) NOT NULL,
  `totalincome` decimal(18,2) NOT NULL,
  `totalexpenditure` decimal(18,2) NOT NULL,
  `balance` decimal(18,2) NOT NULL,
  `balancebf` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iesummary`
--

INSERT INTO `iesummary` (`assembly`, `totalincome`, `totalexpenditure`, `balance`, `balancebf`, `created_at`, `updated_at`) VALUES
('Mckeon Temple', '5536200.00', '1420.00', '5575943.04', 41163, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Newtown', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Greda Estate', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('PIWC', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Evangel', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('D.K Arnan', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Water Works', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Nshorna', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Coco Beach', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Baatsona', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Nungua', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Comm 20', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Sakumono', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Teshie', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Comm 16', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Spintex Road', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Buade', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Teshie Demonstration', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Manet', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Okpoi gonno', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Teshie Nungua Estate', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Odikoman', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('Tabibiano', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26'),
('qwetr', '0.00', '0.00', '0.00', 0, '2017-12-29 15:44:26', '2017-12-29 15:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `incomeexps`
--

CREATE TABLE `incomeexps` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomeexps`
--

INSERT INTO `incomeexps` (`id`, `type`) VALUES
(1, 'income'),
(2, 'expense');

-- --------------------------------------------------------

--
-- Table structure for table `indicators`
--

CREATE TABLE `indicators` (
  `id` int(11) NOT NULL,
  `Indicators` varchar(255) NOT NULL,
  `IndicatorType` varchar(2) NOT NULL,
  `TypeName` varchar(255) NOT NULL,
  `FinanceType` char(1) DEFAULT NULL,
  `NationalID` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indicators`
--

INSERT INTO `indicators` (`id`, `Indicators`, `IndicatorType`, `TypeName`, `FinanceType`, `NationalID`, `created_at`, `updated_at`) VALUES
(1, 'Teenagers', 'F', 'Finance', 'I', 0, '2017-07-01 00:00:00', '2017-12-28 10:57:18'),
(2, 'Overall Membership', 'S', 'Statistics', NULL, 0, '2017-07-01 00:00:00', '2017-12-28 10:57:47'),
(3, 'Teenagers (Males)', 'S', 'Statistics', NULL, 0, '2017-07-31 16:39:49', '2017-07-31 16:39:49'),
(4, 'SPECIAL OFFERING', 'S', 'Finance', 'E', 1, '2017-07-31 16:40:34', '2017-12-28 10:58:46'),
(5, 'KOFI & AMA', 'F', 'Finance', 'I', 1, '2017-07-31 16:40:55', '2017-12-28 10:58:22'),
(6, 'THANKSGIVING', 'F', 'Finance', 'I', 1, '2017-07-31 16:41:30', '2017-07-31 16:41:30'),
(8, 'Leader Name', 'D', 'Statistical Data', NULL, 0, '2017-08-02 12:46:27', '2017-08-02 12:46:27'),
(9, 'Indicators', 'In', 'TypeName', NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Topic', 'D', 'Statistical Data', NULL, 0, '2017-08-01 00:00:00', '2017-08-01 00:00:00'),
(11, 'Comments', 'D', 'Statistical Data', NULL, 0, '2017-08-01 00:00:00', '2017-08-01 00:00:00'),
(12, 'Topic', 'S', 'Statistics', NULL, 0, '2017-07-01 00:00:00', '2017-07-31 00:00:00'),
(15, 'income', 'F', 'Finance', NULL, 0, '2017-12-27 16:03:10', '2017-12-27 16:03:10'),
(16, 'expense', 'F', 'Finance', NULL, 0, '2017-12-27 16:05:08', '2017-12-27 16:05:08'),
(17, 'myincome', 'F', 'Finance', 'I', 0, '2017-12-27 16:06:23', '2017-12-27 16:06:23'),
(18, 'myexpensesss', 'F', 'Finance', 'E', 0, '2017-12-27 16:06:46', '2017-12-27 16:06:46'),
(19, 'sas', 'D', 'Statistical Data', NULL, 0, '2017-12-27 16:07:14', '2017-12-27 16:07:14'),
(20, 'Electricity', 'F', 'Finance', 'E', 0, '2017-12-28 10:06:12', '2017-12-28 10:06:12'),
(21, 'Pledge', 'F', 'Finance', 'I', 1, '2017-12-29 09:56:47', '2017-12-29 09:56:47'),
(22, 'Qwick cash', 'F', 'Finance', 'E', 1, '2017-12-29 15:59:48', '2017-12-29 15:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `leaders`
--

CREATE TABLE `leaders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `AreaID` int(11) NOT NULL,
  `entry_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaders`
--

INSERT INTO `leaders` (`id`, `name`, `contact`, `email`, `address`, `AreaID`, `entry_user`, `created_at`, `updated_at`) VALUES
(3, 'Brown Sugar', '021452145', 'ask@gmail.com', 'a55/1 ghana', 2, 1, '2017-09-28 16:23:38', '2017-09-28 16:23:38'),
(4, 'GHana', '0228', 'asss@ga.com', 'my address', 1, 1, '2017-09-29 14:59:46', '2017-09-29 14:59:46'),
(5, 'leader xyz', '026482777', 'asdf@gmail.com', 'mihh88', 2, 1, '2017-09-29 15:01:33', '2017-09-29 15:01:33'),
(6, 'Jefferey Ashiety', 'conta', 'sntow@3cprojects.org', '18', 2, 1, '2017-09-29 15:40:43', '2017-09-29 15:40:43'),
(7, 'Jefferey Ashiety', 'conta', 'sntow@3cprojects.org', '18', 2, 1, '2017-09-29 15:40:43', '2017-09-29 15:40:43'),
(8, 'James Konney', '0246545654', 'jja@gmail.com', 'A262662 Ghana', 1, 1, '2017-10-04 14:13:43', '2017-10-04 14:13:43'),
(9, 'Jefferey3 Ashiety3', '0264221717', 'sntow@3cprojects.org', 'A262662 Ghana', 4, 1, '2017-10-09 13:10:05', '2017-10-09 13:10:05'),
(10, 'Jefferey3 Ashiety3', '0264221717', 'sntow@3cprojects.org', 'A262662 Ghana', 4, 1, '2017-10-09 13:10:49', '2017-10-09 13:10:49'),
(11, 'Clement Batie', '024565412', 'asdh@m.com', 'fdghfhghd ', 1, 1, '2017-11-08 09:52:40', '2017-11-08 09:52:40'),
(12, 'Jefferey ashitey 007', '024565412', 'asdh@m.comn', 'fdghfhghd ', 1, 1, '2017-11-08 09:52:40', '2017-11-08 09:52:40'),
(13, 'Jefferey aa', '123456788', 'super@abc.coma', 'aa', 1, 1, '2017-11-15 13:03:01', '2017-11-15 13:03:01'),
(15, 'h', 'ghgh', 'ascendm8600@gmail.comaaa', 'adsd d', 6, 20, '2017-11-15 15:34:07', '2017-11-15 15:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `mainfinance`
--

CREATE TABLE `mainfinance` (
  `MainFinanceID` int(11) NOT NULL,
  `AssemblyID` varchar(100) NOT NULL,
  `Indicators` varchar(200) NOT NULL,
  `IndValues` varchar(200) NOT NULL,
  `UserName` varchar(200) NOT NULL,
  `ReviewerID` int(11) NOT NULL,
  `Activity_State` int(11) NOT NULL,
  `date` date NOT NULL,
  `flag` varchar(2) DEFAULT NULL,
  `accountcode` int(11) NOT NULL,
  `accountsubcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mainfinance`
--

INSERT INTO `mainfinance` (`MainFinanceID`, `AssemblyID`, `Indicators`, `IndValues`, `UserName`, `ReviewerID`, `Activity_State`, `date`, `flag`, `accountcode`, `accountsubcode`) VALUES
(1, '1001', 'COUNSELLORS', '678', '1', 1, 2, '0000-00-00', NULL, 1, 0),
(2, '1001', 'INTERCESSORS', '987', '1', 1, 2, '0000-00-00', NULL, 0, 0),
(3, '2001', 'Teenagers (Males)', '67', '1', 1, 2, '0000-00-00', NULL, 0, 0),
(4, '2001', 'No Of Deaconesses', '90', '1', 1, 2, '0000-00-00', NULL, 0, 0),
(5, '2001', 'Total Adult Membership', '12', '1', 1, 2, '0000-00-00', NULL, 0, 0),
(6, '2001', 'Rallies Held', '890', '1', 1, 2, '0000-00-00', NULL, 0, 0),
(7, '2001', 'Total Adult Membership', '100', '1', 1, 2, '0000-00-00', NULL, 0, 0),
(8, '2002', 'Overall Membership', '200', '1', 1, 2, '0000-00-00', NULL, 0, 0),
(9, '2003', 'Overall Membership', '300', '1', 1, 2, '0000-00-00', NULL, 0, 0),
(10, '2001', 'Overall Membership', '500', '1', 1, 2, '0000-00-00', NULL, 0, 0),
(11, '2001', 'Overall Membership', '45', '1', 1, 2, '0000-00-00', 'I', 0, 0);

--
-- Triggers `mainfinance`
--
DELIMITER $$
CREATE TRIGGER `finance` AFTER INSERT ON `mainfinance` FOR EACH ROW begin                
 insert into finance (AssemblyID,Indicators,IndValues,UserName,date,id,flag,accountcode,accountsubcode) values (new.AssemblyID,new.Indicators,new.IndValues,new.UserName,nOW(),200000000,new.flag,new.accountcode,new.accountsubcode);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `markattendances`
--

CREATE TABLE `markattendances` (
  `id` int(11) NOT NULL,
  `Meeting_id` int(11) NOT NULL,
  `Attended` int(11) NOT NULL DEFAULT '0',
  `Leader_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markattendances`
--

INSERT INTO `markattendances` (`id`, `Meeting_id`, `Attended`, `Leader_id`, `created_at`, `updated_at`) VALUES
(66, 16, 0, 3, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(67, 16, 0, 4, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(68, 16, 0, 5, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(69, 16, 0, 6, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(70, 16, 0, 7, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(71, 16, 0, 8, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(72, 16, 0, 11, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(73, 16, 0, 12, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(74, 16, 0, 13, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(75, 16, 0, 15, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(76, 17, 0, 3, '2017-12-19 14:30:29', '2017-12-19 14:30:29'),
(77, 18, 0, 3, '2017-12-19 14:32:56', '2017-12-19 14:32:56'),
(78, 19, 0, 3, '2017-12-19 14:36:25', '2017-12-19 14:36:25'),
(79, 20, 0, 3, '2017-12-19 14:37:47', '2017-12-19 14:37:47'),
(80, 21, 0, 3, '2017-12-19 14:46:57', '2017-12-19 14:46:57'),
(81, 22, 0, 4, '2017-12-19 14:48:58', '2017-12-19 14:48:58'),
(82, 23, 0, 4, '2017-12-19 14:49:38', '2017-12-19 14:49:38'),
(83, 24, 0, 4, '2017-12-19 14:49:46', '2017-12-19 14:49:46'),
(84, 25, 0, 4, '2017-12-19 14:50:53', '2017-12-19 14:50:53'),
(85, 26, 0, 4, '2017-12-19 14:51:09', '2017-12-19 14:51:09'),
(86, 27, 0, 4, '2017-12-19 14:52:09', '2017-12-19 14:52:09'),
(87, 28, 0, 4, '2017-12-19 14:54:40', '2017-12-19 14:54:40'),
(88, 29, 0, 4, '2017-12-19 14:57:00', '2017-12-19 14:57:00'),
(89, 30, 0, 4, '2017-12-19 14:57:09', '2017-12-19 14:57:09'),
(90, 31, 0, 4, '2017-12-19 14:57:25', '2017-12-19 14:57:25'),
(91, 32, 0, 4, '2017-12-19 14:58:51', '2017-12-19 14:58:51'),
(92, 33, 0, 4, '2017-12-19 14:59:52', '2017-12-19 14:59:52'),
(93, 34, 0, 4, '2017-12-19 15:00:43', '2017-12-19 15:00:43'),
(94, 35, 0, 4, '2017-12-19 15:01:52', '2017-12-19 15:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `Meeting_Name` varchar(255) NOT NULL,
  `Meeting_Time` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `AreaID` varchar(255) NOT NULL,
  `NationalID` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `Meeting_Name`, `Meeting_Time`, `date`, `AreaID`, `NationalID`, `created_at`, `updated_at`) VALUES
(16, 'hghgh', 'kjk j', '2017-12-19', '1', 1, '2017-12-19 13:59:22', '2017-12-19 13:59:22'),
(17, 'aqwert', 'www', '2017-12-19', '1', 1, '2017-12-19 14:30:29', '2017-12-19 14:30:29'),
(18, 'aqwert', 'www', '2017-12-19', '1', 1, '2017-12-19 14:32:56', '2017-12-19 14:32:56'),
(19, 'aqwertrr', 'www', '2017-12-19', '1', 1, '2017-12-19 14:36:25', '2017-12-19 14:36:25'),
(20, 'aqwertrr', 'frfrf', '2017-12-19', '1', 1, '2017-12-19 14:37:47', '2017-12-19 14:37:47'),
(21, 'aqwert', 'www', '2017-12-19', '1', 1, '2017-12-19 14:46:57', '2017-12-19 14:46:57'),
(22, 'sss', 'sss', '2017-12-20', '1', 1, '2017-12-19 14:48:58', '2017-12-19 14:48:58'),
(23, 'sss', 'sss', '2017-12-20', '1', 1, '2017-12-19 14:49:38', '2017-12-19 14:49:38'),
(24, 'sss', '36', '2017-12-20', '1', 1, '2017-12-19 14:49:46', '2017-12-19 14:49:46'),
(25, 'sss', '36', '2017-12-20', '1', 1, '2017-12-19 14:50:53', '2017-12-19 14:50:53'),
(26, 'sss', '36', '2017-12-20', '1', 1, '2017-12-19 14:51:09', '2017-12-19 14:51:09'),
(27, 'aa', 'aaaa', '2017-12-19', '1', 1, '2017-12-19 14:52:09', '2017-12-19 14:52:09'),
(28, 'aa', 'aaaa', '2017-12-19', '1', 1, '2017-12-19 14:54:39', '2017-12-19 14:54:39'),
(29, 'aa', 'aaaa', '2017-12-19', '1', 1, '2017-12-19 14:57:00', '2017-12-19 14:57:00'),
(30, 'aa', 'aaaa', '2017-12-19', '1', 1, '2017-12-19 14:57:09', '2017-12-19 14:57:09'),
(31, 'aa', 'aaaa', '2017-12-19', '1', 1, '2017-12-19 14:57:25', '2017-12-19 14:57:25'),
(32, 'aa', 'aaaa', '2017-12-19', '1', 1, '2017-12-19 14:58:51', '2017-12-19 14:58:51'),
(33, 'aa', 'aaaa', '2017-12-19', '1', 1, '2017-12-19 14:59:51', '2017-12-19 14:59:51'),
(34, 'aa', 'aaaa', '2017-12-19', '1', 1, '2017-12-19 15:00:43', '2017-12-19 15:00:43'),
(35, 'aa', 'aaaa', '2017-12-19', '1', 1, '2017-12-19 15:01:52', '2017-12-19 15:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `meetingtypes`
--

CREATE TABLE `meetingtypes` (
  `id` int(11) NOT NULL,
  `typename` varchar(255) NOT NULL,
  `CellCode` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetingtypes`
--

INSERT INTO `meetingtypes` (`id`, `typename`, `CellCode`, `created_at`, `updated_at`) VALUES
(2, 'normal meeting', 5025, '2017-11-17 17:29:04', '2017-11-17 17:29:04'),
(3, 'First meeting', 2001, '2017-11-21 14:00:27', '2017-11-21 14:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `datejoined` date NOT NULL,
  `CellCode` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membertype` varchar(255) NOT NULL,
  `community` varchar(255) NOT NULL,
  `homeaddress` varchar(255) NOT NULL,
  `confirmed` int(11) NOT NULL DEFAULT '0',
  `dob` date DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `comments` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `contact`, `datejoined`, `CellCode`, `user_id`, `membertype`, `community`, `homeaddress`, `confirmed`, `dob`, `gender`, `comments`, `created_at`, `updated_at`) VALUES
(9, 'Jefferey Ashiety', '1234576789', '2017-11-17', '2001', 1, '11', '', '', 1, NULL, 'Male', NULL, '2017-11-17 17:08:34', '2017-12-12 10:15:05'),
(10, 'Clement Batie', '0207149545', '2017-11-20', '5025', 1, '11', '', '', 0, NULL, 'Female', NULL, '2017-11-20 12:05:38', '2017-11-20 12:05:38'),
(11, 'Eric Amengor', '0207149555', '2017-11-20', '5025', 1, '11', '', '', 0, NULL, '', NULL, '2017-11-20 12:05:38', '2017-11-20 12:05:38'),
(12, 'Jefferey Ashitey', '0264221717', '2017-11-21', '2003', 1, '13', '', '', 0, NULL, '', NULL, '2017-11-21 13:55:54', '2017-11-28 14:49:45'),
(13, 'Ash', '000000', '2017-11-21', '2001', 1, '13', '', '', 1, NULL, '', NULL, '2017-11-21 16:02:42', '2017-11-30 16:54:02'),
(14, 'Emma', '256565645', '2017-11-23', '5004', 1, '13', '', '', 0, NULL, '', NULL, '2017-11-23 10:06:17', '2017-11-28 14:52:12'),
(15, 'Juli', '256565645', '2017-11-23', '2001', 1, '13', '', '', 1, NULL, '', NULL, '2017-11-23 10:06:17', '2017-11-30 16:52:55'),
(16, 'Mensah', '256565645', '2017-11-23', '2001', 1, '13', '', '', 1, NULL, '', NULL, '2017-11-23 10:06:17', '2017-11-30 16:07:32'),
(17, 'Stanley Jnr', '000000', '2017-11-28', '2003', 1, '13', '', '', 0, NULL, '', NULL, '2017-11-28 10:55:19', '2017-11-28 14:56:37'),
(18, 'me', '736767', '2017-11-30', '2001', 1, '13', 'dfdfdfcvcv', 'ddffcvxcvcvxcvcvxc', 1, NULL, 'Female', NULL, '2017-11-30 12:41:46', '2017-11-30 16:07:25'),
(19, 'Jefferey Ashiety', '1234576789', '2017-11-30', '2003', 1, '13', 'dfdfdfcvcv', 'ddffcvxcvcvxcvcvxc', 0, NULL, 'Female', NULL, '2017-11-30 13:28:13', '2017-11-30 13:28:13'),
(20, 'Jefferey dghfdhfd', '1234576789', '2017-11-30', '5001', 1, '13', 'dfdfdfcvcv', 'ddffcvxcvcvxcvcvxc', 0, NULL, '', NULL, '2017-11-30 13:28:27', '2017-11-30 13:28:27'),
(21, 'Jefferey sdds', '1234576789', '2017-11-30', '5001', 1, '13', 'dfdfdfcvcv', 'ddffcvxcvcvxcvcvxc', 0, NULL, '', NULL, '2017-11-30 13:36:24', '2017-11-30 13:36:24'),
(22, 'Jefferey sdds', '1234576789', '2017-11-30', '2001', 1, '13', 'dfdfdfcvcv', 'ddffcvxcvcvxcvcvxc', 1, NULL, '', NULL, '2017-11-30 13:37:15', '2017-11-30 13:37:15'),
(23, 'xsxsxsx', '3434343', '2017-12-06', '2001', 1, '12', 'dsd', 'd dsd', 1, '2017-12-30', '', NULL, '2017-12-11 13:41:13', '2017-12-11 13:41:13'),
(24, 'xsxsxsx', '3434343', '2017-12-06', '2001', 1, '12', 'dsd', 'd dsd', 1, '2017-12-30', '', NULL, '2017-12-11 13:53:44', '2017-12-11 13:53:44'),
(25, 'xsxsxsx', '3434343', '2017-12-06', '2001', 1, '12', 'dsd', 'd dsd', 1, '2017-12-30', '', NULL, '2017-12-11 13:56:01', '2017-12-11 13:56:01'),
(26, 'xsxsxsx', '3434343', '2017-12-06', '2001', 1, '12', 'dsd', 'd dsd', 1, '2017-12-30', '', NULL, '2017-12-11 13:59:31', '2017-12-11 13:59:31'),
(27, 'ccx c x', '0207149491', '2017-12-12', '2001', 1, '12', ' ccc', '    fgfg ', 1, '2017-12-11', '', NULL, '2017-12-11 14:43:13', '2017-12-11 14:43:13'),
(28, 'Jefferey Ashitey', '12345', '2017-12-31', '5075', 1, '13', 'f df', 'three', 0, NULL, '', NULL, '2017-12-12 16:50:49', '2017-12-12 16:50:49'),
(29, 'who ', '82787', '2017-12-20', '2001', 1, '12', 'dfdfdfcvcv', ' 5g g', 1, '2017-12-01', '', NULL, '2017-12-12 17:07:00', '2017-12-12 17:07:00'),
(30, 'gh ghg ffg4', '45 55', '2017-12-20', '9900', 1, '13', ' 4554 ', '  45 ', 0, '2017-12-01', '', NULL, '2017-12-12 17:07:36', '2017-12-12 17:07:36'),
(31, 'dfdfd', '022878', '2017-12-27', '2001', 1, '13', '1234', 'wewewe', 0, '2017-12-27', 'Male', 'wewe', '2017-12-27 10:06:12', '2017-12-27 10:06:12'),
(32, 'jhjhjh', '02125', '2017-12-27', '2001', 1, '12', 'asasa', 'ddfdsf', 0, '2017-12-27', 'Male', 'dfsdfdfsdsd', '2017-12-27 10:09:09', '2017-12-27 10:09:09'),
(33, 'aaa', '33333', '2017-12-27', '2001', 1, '12', '33333', '33333', 0, '2017-12-27', 'Male', '333', '2017-12-27 10:13:51', '2017-12-27 10:13:51'),
(34, 'qqqq', '121212', '2017-12-27', '2001', 1, '12', '12qqqw', 'qqwwwq', 1, '2017-12-27', '', NULL, '2017-12-27 10:14:44', '2017-12-27 10:14:44'),
(35, 'qwetrt', '5655', '2017-12-27', '2001', 1, '12', '54545', '5554554', 1, '2017-12-27', '', NULL, '2017-12-27 10:17:31', '2017-12-27 10:17:31'),
(36, 'Police', '00000000', '2017-12-28', '2001', 1, '13', 'commu', 'Address', 1, '2017-12-28', 'Male', 'dfdfdf', '2017-12-28 10:43:58', '2017-12-28 10:46:43'),
(37, 'Memeber 2', '0000215144', '2017-12-28', '2001', 1, '13', 'comu', 'sdsds', 1, '2017-12-28', 'Female', 'sdsadasdsd', '2017-12-28 10:47:21', '2017-12-28 10:47:21'),
(38, 'Member 3', '1234543', '2017-12-28', '2001', 1, '13', 'asasas', 'asasasasa', 1, '2017-12-28', 'Male', 'asasasasasasa', '2017-12-28 10:52:17', '2017-12-28 10:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `membertypes`
--

CREATE TABLE `membertypes` (
  `id` int(11) NOT NULL,
  `typename` varchar(255) NOT NULL,
  `NationalID` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membertypes`
--

INSERT INTO `membertypes` (`id`, `typename`, `NationalID`, `created_at`, `updated_at`) VALUES
(12, 'Visitor', '1', '2017-11-21 13:31:45', '2017-11-21 13:31:45'),
(13, 'Member', '1', '2017-11-21 13:31:45', '2017-11-21 13:31:45'),
(14, 'ON and OFF', '1', '2017-11-21 13:31:45', '2017-11-21 13:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `nationals`
--

CREATE TABLE `nationals` (
  `NationalID` int(11) NOT NULL,
  `NationalName` varchar(255) NOT NULL,
  `NationalCode` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nationals`
--

INSERT INTO `nationals` (`NationalID`, `NationalName`, `NationalCode`, `created_at`, `updated_at`) VALUES
(1, 'ALL PENTECOST', 12, '2017-07-31 15:21:32', '2017-07-31 15:24:09'),
(2, 'ALL NATIONAL', 2, '2017-07-31 15:45:13', '2017-07-31 15:45:13');

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
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `leader_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `entry_user` int(11) NOT NULL,
  `CellCode` varchar(255) NOT NULL,
  `Zone_Name` varchar(255) NOT NULL,
  `Area_Name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `leader_id`, `title`, `entry_user`, `CellCode`, `Zone_Name`, `Area_Name`, `created_at`, `updated_at`) VALUES
(69, 3, 'Leader Name', 1, '', '', '2', '2017-11-08 13:01:35', '2017-11-09 16:39:36'),
(70, 8, 'Zone Leader', 1, '', '1', '1', '2017-11-08 13:04:38', '2017-11-08 13:04:38'),
(71, 11, 'Cell Leader', 1, '2001', '1', '1', '2017-11-08 13:06:35', '2017-11-08 13:24:22'),
(72, 4, 'Leader Name', 1, '2003', '1', '1', '2017-11-15 14:25:56', '2017-11-15 14:25:56'),
(74, 15, 'Area Leader', 20, '', '', '6', '2017-11-15 15:43:09', '2017-11-15 15:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `positions_log`
--

CREATE TABLE `positions_log` (
  `id` int(11) NOT NULL,
  `leader_id` varchar(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `entry_user` int(11) NOT NULL,
  `CellCode` varchar(255) NOT NULL,
  `Zone_Name` varchar(255) NOT NULL,
  `Area_Name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions_log`
--

INSERT INTO `positions_log` (`id`, `leader_id`, `title`, `entry_user`, `CellCode`, `Zone_Name`, `Area_Name`, `created_at`, `updated_at`) VALUES
(1, 'Brown Sugar', 'My title', 1, 'Abuja Assembly', 'Newtown', 'La Area', '2017-10-25 10:26:23', '2017-10-25 10:26:23'),
(2, 'Brown Sugar', 'My title', 1, '', 'Newtown', 'La Area', '2017-10-25 11:37:18', '2017-10-25 11:37:18'),
(3, 'Brown Sugar', 'Zone Leader', 1, '', '', 'La Area', '2017-10-25 12:40:40', '2017-10-25 12:40:40'),
(4, 'leader xyz', 'Area Leader', 1, 'Pentecost Redemption', 'Mckeon Temple', 'La Area', '2017-10-25 15:26:42', '2017-10-25 15:26:42'),
(5, 'GHana', 'Area Leader', 1, 'Pentecost Redemption', 'Mckeon Temple', 'La Area', '2017-11-02 13:51:46', '2017-11-02 13:51:46'),
(6, 'Brown Sugar', 'Assistant Leader', 1, 'Pentecost Redemption', 'Mckeon Temple', 'La Area', '2017-11-02 13:52:07', '2017-11-02 13:52:07'),
(7, 'GHana', 'Cell Leader', 1, 'Pentecost Redemption', 'Mckeon Temple', 'La Area', '2017-11-08 10:12:51', '2017-11-08 10:12:51'),
(8, 'GHana', 'Cell Leader', 1, 'Central Police Station', 'Mckeon Temple', 'La Area', '2017-11-08 10:12:58', '2017-11-08 10:12:58'),
(9, 'GHana', 'Cell Leader', 1, 'Pentecost Redemption', 'Mckeon Temple', 'La Area', '2017-11-08 10:13:25', '2017-11-08 10:13:25'),
(10, 'GHana', 'Cell Leader', 1, 'Abuja Assembly', 'Mckeon Temple', 'La Area', '2017-11-08 10:13:31', '2017-11-08 10:13:31'),
(11, 'James Konne', 'Cell Leader', 1, '2001', '1', '1', '2017-11-08 10:14:09', '2017-11-08 10:14:09'),
(12, 'Brown Sugar', 'Assistant Leader', 1, '2001', '1', '1', '2017-11-08 10:29:16', '2017-11-08 10:29:16'),
(13, 'leader xyz', 'Area Leader', 1, '2003', '1', '1', '2017-11-08 10:29:31', '2017-11-08 10:29:31'),
(14, 'GHana', 'Cell Leader', 1, '2001', '1', '2', '2017-11-08 10:32:34', '2017-11-08 10:32:34'),
(15, 'Jefferey As', 'Cell Leader', 1, '2001', '76', '4', '2017-11-08 10:38:24', '2017-11-08 10:38:24'),
(16, 'Clement Bat', 'Area Leader', 1, '', 'Mckeon Temple', 'La Area', '2017-11-08 10:39:34', '2017-11-08 10:39:34'),
(17, 'Brown Sugar', 'Leader Name', 1, '', 'Mckeon Temple', 'La Area', '2017-11-08 11:08:12', '2017-11-08 11:08:12'),
(18, 'Brown Sugar', 'Treasurer', 1, '', '1', '1', '2017-11-08 11:13:34', '2017-11-08 11:13:34'),
(19, '3', 'Treasurer', 1, '', '1', '1', '2017-11-08 11:13:34', '2017-11-08 11:13:34'),
(20, 'Brown Sugar', 'Treasurer', 1, '', '1', '1', '2017-11-08 11:14:39', '2017-11-08 11:14:39'),
(21, '3', 'Assistant Leader', 1, '', '1', '1', '2017-11-08 11:14:39', '2017-11-08 11:14:39'),
(22, 'Brown Sugar', 'Assistant Leader', 1, '', '1', '1', '2017-11-08 11:16:17', '2017-11-08 11:16:17'),
(23, '3', 'Assistant Leader', 1, '', '1', '1', '2017-11-08 11:16:17', '2017-11-08 11:16:17'),
(24, 'leader xyz', 'Area Leader', 1, '', '', '1', '2017-11-08 11:20:21', '2017-11-08 11:20:21'),
(25, 'leader xyz', 'Area Leader', 1, '', '76', '1', '2017-11-08 11:52:12', '2017-11-08 11:52:12'),
(26, 'Brown Sugar', 'Assistant Leader', 1, '2001', '1', '1', '2017-11-08 11:52:31', '2017-11-08 11:52:31'),
(27, 'Brown Sugar', 'Assistant Leader', 1, '2001', '1', '1', '2017-11-08 11:55:10', '2017-11-08 11:55:10'),
(28, 'leader xyz', 'Area Leader', 1, '2002', '76', '1', '2017-11-08 11:55:18', '2017-11-08 11:55:18'),
(29, '8', 'Zone Leader', 1, '', '1', '1', '2017-11-08 13:04:38', '2017-11-08 13:04:38'),
(30, 'Clement Bat', 'Assistant Leader', 1, '2002', '1', '1', '2017-11-08 13:06:35', '2017-11-08 13:06:35'),
(31, 'Clement Bat', 'Cell Leader', 1, '2001', '1', '1', '2017-11-08 13:24:22', '2017-11-08 13:24:22'),
(32, 'GHana', 'Leader Name', 1, '2003', '1', '1', '2017-11-15 14:25:56', '2017-11-15 14:25:56'),
(33, '15', 'Cell Leader', 20, '', '102', '6', '2017-11-15 15:34:34', '2017-11-15 15:34:34'),
(34, 'h', 'Cell Leader', 20, '', '', '6', '2017-11-15 15:43:09', '2017-11-15 15:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `entry_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id`, `title`, `entry_user`, `created_at`, `updated_at`) VALUES
(1, 'Leader Name', 1, '2017-09-26 00:00:00', '2017-09-26 11:52:56'),
(3, 'Treasurer', 1, '2017-09-26 11:51:19', '2017-09-26 11:51:19'),
(4, 'Assistant Leader', 1, '2017-09-28 10:24:23', '2017-09-28 10:24:37'),
(6, 'Area Leader', 1, '2017-09-28 12:22:32', '2017-09-28 12:22:32'),
(7, 'Zone Leader', 1, '2017-09-28 12:22:47', '2017-09-28 12:22:47'),
(8, 'Cell Leader', 1, '2017-09-28 12:22:55', '2017-09-28 12:22:55'),
(9, 'My title', 1, '2017-09-29 11:03:02', '2017-09-29 11:03:02'),
(10, 'My title22', 1, '2017-09-29 14:50:38', '2017-09-29 14:50:38'),
(11, 'Treasurers', 1, '2017-09-29 15:55:56', '2017-09-29 15:55:56'),
(12, 'Leader Namess', 1, '2017-09-29 16:00:11', '2017-09-29 16:00:11'),
(13, 'Leader Namesss', 1, '2017-09-29 16:00:12', '2017-09-29 16:00:12'),
(14, 'Leader Namesssss', 1, '2017-09-29 16:00:12', '2017-09-29 16:00:12'),
(15, 'Twinkle', 1, '2017-10-04 14:07:19', '2017-10-04 14:07:19'),
(16, 'Twinkless', 1, '2017-10-04 14:07:19', '2017-10-04 14:07:19'),
(17, 'Police', 1, '2017-10-04 14:09:56', '2017-10-04 14:09:56'),
(18, 'Leader Name', 1, '2017-09-26 00:00:00', '2017-09-26 11:52:56'),
(19, 'Treasurer', 1, '2017-09-26 11:51:19', '2017-09-26 11:51:19'),
(20, 'Assistant Leader', 1, '2017-09-28 10:24:23', '2017-09-28 10:24:37'),
(21, 'Area Leader', 1, '2017-09-28 12:22:32', '2017-09-28 12:22:32'),
(22, 'Zone Leader', 1, '2017-09-28 12:22:47', '2017-09-28 12:22:47'),
(23, 'Cell Leader', 1, '2017-09-28 12:22:55', '2017-09-28 12:22:55'),
(24, 'My title', 1, '2017-09-29 11:03:02', '2017-09-29 11:03:02'),
(25, 'My title22', 1, '2017-09-29 14:50:38', '2017-09-29 14:50:38'),
(26, 'Treasurers', 1, '2017-09-29 15:55:56', '2017-09-29 15:55:56'),
(27, 'Leader Namess', 1, '2017-09-29 16:00:11', '2017-09-29 16:00:11'),
(28, 'Leader Namesss', 1, '2017-09-29 16:00:12', '2017-09-29 16:00:12'),
(29, 'Leader Namesssss', 1, '2017-09-29 16:00:12', '2017-09-29 16:00:12'),
(30, 'Twinkle', 1, '2017-10-04 14:07:19', '2017-10-04 14:07:19'),
(31, 'Twinkless', 1, '2017-10-04 14:07:19', '2017-10-04 14:07:19'),
(32, 'Police', 1, '2017-10-04 14:09:56', '2017-10-04 14:09:56'),
(33, 'Leader Name', 1, '2017-09-26 00:00:00', '2017-09-26 11:52:56'),
(34, 'Treasurer', 1, '2017-09-26 11:51:19', '2017-09-26 11:51:19'),
(35, 'Assistant Leader', 1, '2017-09-28 10:24:23', '2017-09-28 10:24:37'),
(36, 'Area Leader', 1, '2017-09-28 12:22:32', '2017-09-28 12:22:32'),
(37, 'Zone Leader', 1, '2017-09-28 12:22:47', '2017-09-28 12:22:47'),
(38, 'Cell Leader', 1, '2017-09-28 12:22:55', '2017-09-28 12:22:55'),
(39, 'My title', 1, '2017-09-29 11:03:02', '2017-09-29 11:03:02'),
(40, 'My title22', 1, '2017-09-29 14:50:38', '2017-09-29 14:50:38'),
(41, 'Treasurers', 1, '2017-09-29 15:55:56', '2017-09-29 15:55:56'),
(42, 'Leader Namess', 1, '2017-09-29 16:00:11', '2017-09-29 16:00:11'),
(43, 'Leader Namesss', 1, '2017-09-29 16:00:12', '2017-09-29 16:00:12'),
(44, 'Leader Namesssss', 1, '2017-09-29 16:00:12', '2017-09-29 16:00:12'),
(45, 'Twinkle', 1, '2017-10-04 14:07:19', '2017-10-04 14:07:19'),
(46, 'Twinkless', 1, '2017-10-04 14:07:19', '2017-10-04 14:07:19'),
(47, 'Police', 1, '2017-10-04 14:09:56', '2017-10-04 14:09:56'),
(48, 'Leader Name', 1, '2017-09-26 00:00:00', '2017-09-26 11:52:56'),
(49, 'Treasurer', 1, '2017-09-26 11:51:19', '2017-09-26 11:51:19'),
(50, 'Assistant Leader', 1, '2017-09-28 10:24:23', '2017-09-28 10:24:37'),
(51, 'Area Leader', 1, '2017-09-28 12:22:32', '2017-09-28 12:22:32'),
(52, 'Zone Leader', 1, '2017-09-28 12:22:47', '2017-09-28 12:22:47'),
(53, 'Cell Leader', 1, '2017-09-28 12:22:55', '2017-09-28 12:22:55'),
(54, 'My title', 1, '2017-09-29 11:03:02', '2017-09-29 11:03:02'),
(55, 'My title22', 1, '2017-09-29 14:50:38', '2017-09-29 14:50:38'),
(56, 'Treasurers', 1, '2017-09-29 15:55:56', '2017-09-29 15:55:56'),
(57, 'Leader Namess', 1, '2017-09-29 16:00:11', '2017-09-29 16:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `AssemblyID` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `facilitator` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `AssemblyID`, `topic`, `facilitator`, `comments`, `date`, `created_at`, `updated_at`) VALUES
(1, '2001', 'Revelations Of the End time', '', 'Joyce Said These', '2017-09-14', '2017-09-14 00:00:00', '2017-11-03 11:01:55'),
(2, '2003', 'Revelations', '', 'Abuja Said This', '2017-09-14', '2017-09-14 00:00:00', '2017-09-14 00:00:00'),
(3, '2001', 'My Topic', '', 'aaaa', '2017-09-12', '2017-10-19 11:21:55', '2017-10-19 11:21:55'),
(4, '2001', 'Fatherly', '', 'Well', '2017-09-12', '2017-10-19 11:25:49', '2017-10-19 11:25:49'),
(5, '2001', 'hjsgdhgashjg', '', ' jdghasgchasghcdgashgc jdghasgchasghcdgashgc jdghasgchasghcdgashgc', '2017-10-19', '2017-10-19 15:23:02', '2017-10-19 15:23:02'),
(6, '2001', 'Book', '', 'koobjsjhj', '2017-10-14', '2017-10-19 15:25:11', '2017-10-19 15:25:11'),
(7, '2001', 'hjsgdhgashjg', '', ' jdghasgchasghcdgashgc jdghasgchasghcdgashgc jdghasgchasghcdgashgc', '2017-10-19', '2017-10-19 15:29:43', '2017-10-19 15:29:43'),
(8, '2001', 'wow', '', 'asd', '2017-10-20', '2017-10-20 14:55:56', '2017-10-20 14:55:56'),
(9, '5025', 'Check one ', '', 'zero', '2017-11-21', '2017-11-21 11:41:46', '2017-11-21 11:41:46'),
(10, '2001', 'ty', 'aaa', 'sss', '2017-11-30', '2017-11-30 14:29:58', '2017-11-30 14:29:58'),
(11, '2001', 'ty', 'my facilitor', 'sss', '2017-11-30', '2017-11-30 14:29:58', '2017-11-30 14:35:33'),
(12, '2001', '323', 'fff', '', '2017-12-05', '2017-12-05 09:52:06', '2017-12-05 09:52:06'),
(13, '2001', '323pp', 'fff', '32323', '2017-12-13', '2017-12-05 09:58:33', '2017-12-05 09:58:33'),
(14, '2001', 'qwerty', 'fff', '32323', '2017-12-27', '2017-12-05 09:59:55', '2017-12-05 09:59:55'),
(15, '2001', 'whoer', 'aaaa', 'aaaaaa', '2017-12-19', '2017-12-19 11:56:00', '2017-12-19 11:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `note` longtext,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'fileupload\\1510660725.png', 'gth anan ', 1, '2017-11-14 11:58:45', '2017-11-14 11:58:45'),
(2, 'fileupload\\1510666751.pdf', 'ghghgh', 1, '2017-11-14 13:39:12', '2017-11-14 13:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `userlevels`
--

CREATE TABLE `userlevels` (
  `UserLevelID` int(11) NOT NULL,
  `UserLevel` varchar(50) NOT NULL,
  `area` int(11) NOT NULL,
  `national` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlevels`
--

INSERT INTO `userlevels` (`UserLevelID`, `UserLevel`, `area`, `national`) VALUES
(1, 'Area', 0, 1),
(2, 'Zone', 1, 1),
(3, 'Cell', 1, 1),
(4, 'National', 0, 0),
(5, '3C User', 0, 0);

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
  `NationalID` int(11) DEFAULT NULL,
  `AreaID` int(11) NOT NULL,
  `DistrictID` int(11) NOT NULL,
  `CellID` int(1) NOT NULL,
  `PhoneNo` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `UserLevelID` int(11) NOT NULL,
  `Userstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `NationalID`, `AreaID`, `DistrictID`, `CellID`, `PhoneNo`, `UserLevelID`, `Userstatus`) VALUES
(1, 'super', 'super@abc.com', '$2y$10$xkItq8qa6h1Nvct/I4gdBemcFZ06l5U7ndLyzUtp9rcCdrkqvK.KS', 'DZi6HBiolrNzQtieAVInr244bhC5LdQ4ZOShPFLBfD6X48aRkf0DrfUjFdJB', '2016-07-27 11:07:44', '2017-12-19 09:44:08', 1, 1, 1, 2001, '0245711809', 3, 1),
(2, 'samba', 'ntow_samuel@yahoo.com', '$2y$10$xkItq8qa6h1Nvct/I4gdBemcFZ06l5U7ndLyzUtp9rcCdrkqvK.KS', '', '2016-08-03 12:54:51', '2017-07-14 12:11:13', 1, 1, 1, 0, '0245711809', 4, 1),
(3, 'john Nuamah', 'superuser@abc.com', '$2y$10$dMIhsfjjfgePqYkte81VOOB17y4vYnAnDWqihoxR6wstDJRRDA0da', NULL, NULL, NULL, 1, 1, 1, 0, '0243210305', 1, 1),
(4, 'jeff', 'ascendm8600@gmail.com', '$2y$10$xkItq8qa6h1Nvct/I4gdBemcFZ06l5U7ndLyzUtp9rcCdrkqvK.KS', 'uVtj9BFpHpvYrFHN9hAq2VQQIhxDZW1Gi1QwoHAElTpCN3uNdiB8cR6w8Zvc', '2017-06-19 12:19:41', '2017-08-04 13:07:49', 1, 1, 1, 2001, '0246272001', 1, 1),
(8, 'cell', 'cell@abc.com', '$2y$10$i7HxCtc6hLQ4nC4pnk5K6OfVXvkLXKSwwygwBeH05Yn3SU2wz3PZG', 'dtl3KEzWyH6ZKPOHT8oNH5Relv7ObS0YUu2H0uTepoqW3EaE3kCEZYQhgJYg', '2017-07-31 12:06:57', '2017-09-26 10:28:54', 1, 1, 1, 2001, '00000000', 3, 1),
(9, 'qwerty', 'qwerty@abc.com', '$2y$10$GaTDijGtK4KsOudjJ2wf/u.Sfc/flyGi2islwG9T.sNDGmVs1t952', 'l5dKsL1OMaTNUQg940PAvOt8GvcLyjZ83PupuWoU7mBwbzuFex6Myw7Tsa8z', '2017-07-31 17:28:51', '2017-11-14 14:17:34', 1, 4, 1, 0, '789456123', 3, 1),
(10, 'pp', 'p@abc.com', '$2y$10$2bbGv/.866/805Omyt/T5uujyYD6cfLFXRsvL6bQpbWfx62UtwgE2', NULL, '2017-07-31 17:30:17', '2017-07-31 17:30:17', 1, 1, 1, 2001, '7777777', 3, 1),
(11, 'abc1', 'abc1@abc.com', '$2y$10$lxR3nMCtYC3EbpJ/hNBF5O4G8GEiIkvX5d0I45dzIqiWUpEtxw8gW', 'z6v57X7OB5mmKQ3bGT0bsBeM5jWcEPjg4iUy1zbwVmQf4h3CWfeBpyAKHjuy', '2017-11-14 14:09:49', '2017-11-14 14:19:44', 2, 1, 84, 5054, '12345678', 1, 1),
(12, 'abc2', 'abc2@abc.com', '$2y$10$lxR3nMCtYC3EbpJ/hNBF5O4G8GEiIkvX5d0I45dzIqiWUpEtxw8gW', 'YyGrOzOJBAGa5zzzCRVo5y19s0UV5YYnoDET9jKv9ZuvPjyG1NCTAtTwm9Gp', '2017-11-14 14:10:44', '2017-11-14 14:26:01', 2, 4, 80, 2003, '123456789', 1, 1),
(13, 'asd', 'asd@abc.com', '$2y$10$L0O80zvnsrLjsDgtrtfrV.I4wxzHBN5UKaeURJ3iNIcfkz6wJpVm.', NULL, '2017-11-14 14:25:53', '2017-11-14 14:25:53', 2, 1, 84, 5054, '12345678', 1, 1),
(14, 'awes', 'qwertyq@cc.com', '$2y$10$z2K1YUFQdMIZyNVMAQVHn.D0ykzzvhNGubXbioSf.9kz5sOhZAcZO', NULL, '2017-11-15 10:48:48', '2017-11-15 10:48:48', 2, 1, 1, 2003, '12345678', 3, 1),
(15, 'Jefferey Ashiety', 'admin@abc.coma', '$2y$10$ZuDXuHj7etpAyjztzt4TC.9Lzotxtcs0SwTK8RGFofphnSwmM/MDa', NULL, '2017-11-15 10:52:03', '2017-11-15 10:52:03', 1, 1, 1, 2001, '12345676', 2, 1),
(16, 'Jefferey3 Ashiety3', 'ascendm8600@gmail.coma', '$2y$10$M0bf2Goa1uKxl5tevTwjlelVkq161PIiTJuKjdEPszzOmc13gRglC', NULL, '2017-11-15 10:59:05', '2017-11-15 10:59:05', 1, 1, 1, 2001, '212121212', 1, 1),
(17, 'abc1', 'ntow_samuel@yahoo.coms', '$2y$10$ovzwATVJ.zHLF21UO37BF.hvGfj6a9hMmQ1l8RGHTJeRqroEHklRy', NULL, '2017-11-15 11:12:53', '2017-11-15 11:12:53', NULL, 1, 1, 0, '0244946325', 2, 1),
(18, 'Jefferey Ashiety', 'admin@abc.coma', '$2y$10$fwym1tN9DRGovWBZ8t5S.uJA4kYii/R2/jYusiHHtBN9yWc.rlGua', NULL, '2017-11-15 11:14:34', '2017-11-15 11:14:34', NULL, 1, 1, 2001, 'aasas', 2, 1),
(19, 'Jefferey Ashiety', 'ascendm8600@gmail.com12', '$2y$10$qev.BHv5LfzXxDNQJnKuleM4S8oeHfbjxrlZztLg4gGbxUWo8ObW2', NULL, '2017-11-15 11:17:04', '2017-11-15 11:18:35', 1, 1, 1, 5007, '0123654789', 2, 1),
(20, 'area a', 'areaa@abc.com', '$2y$10$PqDP.z3Tv5UqJZKVmHEye.Fr7QS.kHIPOmlc45Lp751.Zacq8rwv2', '3bYtgJZbxaynvAD1z8z1f5rZe84UeanvLXqF0UtkMuNNYXz8m8AHVYwEZfj1', '2017-11-15 15:16:12', '2017-11-20 16:06:22', 1, 6, 84, 5042, '12345678', 1, 1),
(21, 'Celluser 1', 'cell1@abc.com', '$2y$10$nNinKaP4xta4Da2ITjD1yeN2xi4N0bepRD9.B7F0mPbWYqJTAceUW', NULL, '2017-12-13 14:41:05', '2017-12-13 14:41:50', 2, 1, 1, 2003, '024', 3, 1);

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
-- Indexes for table `accountheadings`
--
ALTER TABLE `accountheadings`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `cell`
--
ALTER TABLE `cell`
  ADD PRIMARY KEY (`CellID`);

--
-- Indexes for table `cellattendances`
--
ALTER TABLE `cellattendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cellmeetingattendances`
--
ALTER TABLE `cellmeetingattendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chartofaccounts`
--
ALTER TABLE `chartofaccounts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `incomeexps`
--
ALTER TABLE `incomeexps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indicators`
--
ALTER TABLE `indicators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaders`
--
ALTER TABLE `leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mainfinance`
--
ALTER TABLE `mainfinance`
  ADD PRIMARY KEY (`MainFinanceID`);

--
-- Indexes for table `markattendances`
--
ALTER TABLE `markattendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetingtypes`
--
ALTER TABLE `meetingtypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membertypes`
--
ALTER TABLE `membertypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationals`
--
ALTER TABLE `nationals`
  ADD PRIMARY KEY (`NationalID`);

--
-- Indexes for table `pentecoastdivision`
--
ALTER TABLE `pentecoastdivision`
  ADD PRIMARY KEY (`DivisionID`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions_log`
--
ALTER TABLE `positions_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `accountheadings`
--
ALTER TABLE `accountheadings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `AreaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `assembly`
--
ALTER TABLE `assembly`
  MODIFY `AssemblyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `cell`
--
ALTER TABLE `cell`
  MODIFY `CellID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `cellattendances`
--
ALTER TABLE `cellattendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cellmeetingattendances`
--
ALTER TABLE `cellmeetingattendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `DistrictID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `FinanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT for table `incomeexps`
--
ALTER TABLE `incomeexps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `indicators`
--
ALTER TABLE `indicators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `leaders`
--
ALTER TABLE `leaders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `mainfinance`
--
ALTER TABLE `mainfinance`
  MODIFY `MainFinanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `markattendances`
--
ALTER TABLE `markattendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `meetingtypes`
--
ALTER TABLE `meetingtypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `membertypes`
--
ALTER TABLE `membertypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `nationals`
--
ALTER TABLE `nationals`
  MODIFY `NationalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pentecoastdivision`
--
ALTER TABLE `pentecoastdivision`
  MODIFY `DivisionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `positions_log`
--
ALTER TABLE `positions_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `userlevels`
--
ALTER TABLE `userlevels`
  MODIFY `UserLevelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user_state`
--
ALTER TABLE `user_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
