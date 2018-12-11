-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2016 at 01:11 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ppdu`
--

-- --------------------------------------------------------

--
-- Table structure for table `AgendaAttachments`
--

DROP TABLE IF EXISTS `AgendaAttachments`;
CREATE TABLE IF NOT EXISTS `AgendaAttachments` (
  `AgendaAttachmentID` int(11) NOT NULL AUTO_INCREMENT,
  `AgendaID` int(11) NOT NULL,
  `AttachmentDescription` varchar(255) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`AgendaAttachmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `AgendaItems`
--

DROP TABLE IF EXISTS `AgendaItems`;
CREATE TABLE IF NOT EXISTS `AgendaItems` (
  `AgendaItemId` int(11) NOT NULL AUTO_INCREMENT,
  `MeetingID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `RaisedBy` varchar(50) NOT NULL,
  PRIMARY KEY (`AgendaItemId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Agendas`
--

DROP TABLE IF EXISTS `Agendas`;
CREATE TABLE IF NOT EXISTS `Agendas` (
  `AgendaID` int(11) NOT NULL AUTO_INCREMENT,
  `ProposedMeetingDate` date NOT NULL,
  `MeetingID` int(11) NOT NULL,
  `MinistryID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`AgendaID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Agendas`
--

INSERT INTO `Agendas` (`AgendaID`, `ProposedMeetingDate`, `MeetingID`, `MinistryID`, `DocumentID`) VALUES
(1, '2016-01-12', 1, 2, 2),
(2, '2016-01-06', 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `AllowedUsers`
--

DROP TABLE IF EXISTS `AllowedUsers`;
CREATE TABLE IF NOT EXISTS `AllowedUsers` (
  `WorkflowStateID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ApprovalDecisionLetters`
--

DROP TABLE IF EXISTS `ApprovalDecisionLetters`;
CREATE TABLE IF NOT EXISTS `ApprovalDecisionLetters` (
  `ApprovalDecisionLetterID` int(11) NOT NULL AUTO_INCREMENT,
  `MemoID` int(11) NOT NULL,
  `MinistryID` int(11) NOT NULL,
  `DecisionStatusID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`ApprovalDecisionLetterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ApprovalDecisionLetters`
--

INSERT INTO `ApprovalDecisionLetters` (`ApprovalDecisionLetterID`, `MemoID`, `MinistryID`, `DecisionStatusID`, `DocumentID`) VALUES
(1, 1, 2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ApprovalMemos`
--

DROP TABLE IF EXISTS `ApprovalMemos`;
CREATE TABLE IF NOT EXISTS `ApprovalMemos` (
  `ApprovalMemoID` int(11) NOT NULL AUTO_INCREMENT,
  `MeetingID` int(11) NOT NULL,
  `MinistryID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`ApprovalMemoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ApprovalMemos`
--

INSERT INTO `ApprovalMemos` (`ApprovalMemoID`, `MeetingID`, `MinistryID`, `DocumentID`) VALUES
(1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `CommitteeReports`
--

DROP TABLE IF EXISTS `CommitteeReports`;
CREATE TABLE IF NOT EXISTS `CommitteeReports` (
  `CommitteeReportID` int(11) NOT NULL AUTO_INCREMENT,
  `MemoID` int(11) NOT NULL,
  `MeetingID` int(11) NOT NULL,
  `MinistryID` int(11) NOT NULL,
  `RecommendationStatusID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`CommitteeReportID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `CommitteeReports`
--

INSERT INTO `CommitteeReports` (`CommitteeReportID`, `MemoID`, `MeetingID`, `MinistryID`, `RecommendationStatusID`, `DocumentID`) VALUES
(1, 2, 1, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Contractors`
--

DROP TABLE IF EXISTS `Contractors`;
CREATE TABLE IF NOT EXISTS `Contractors` (
  `ContractorID` int(11) NOT NULL AUTO_INCREMENT,
  `Contractor` varchar(30) NOT NULL,
  PRIMARY KEY (`ContractorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `DecisionLetters`
--

DROP TABLE IF EXISTS `DecisionLetters`;
CREATE TABLE IF NOT EXISTS `DecisionLetters` (
  `DecisionLetterID` int(11) NOT NULL AUTO_INCREMENT,
  `MemoID` int(11) NOT NULL,
  `MeetingID` int(11) NOT NULL,
  `MinistryID` int(11) NOT NULL,
  `DecisionStatusID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`DecisionLetterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `DecisionLetters`
--

INSERT INTO `DecisionLetters` (`DecisionLetterID`, `MemoID`, `MeetingID`, `MinistryID`, `DecisionStatusID`, `DocumentID`) VALUES
(1, 2, 1, 2, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `DecisionStatus`
--

DROP TABLE IF EXISTS `DecisionStatus`;
CREATE TABLE IF NOT EXISTS `DecisionStatus` (
  `DecisionStatusID` int(11) NOT NULL AUTO_INCREMENT,
  `DecisionStatus` varchar(30) NOT NULL,
  PRIMARY KEY (`DecisionStatusID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `DecisionStatus`
--

INSERT INTO `DecisionStatus` (`DecisionStatusID`, `DecisionStatus`) VALUES
(1, 'Approved'),
(2, 'Stood Down'),
(3, 'Referred to Committee');

-- --------------------------------------------------------

--
-- Table structure for table `Districts`
--

DROP TABLE IF EXISTS `Districts`;
CREATE TABLE IF NOT EXISTS `Districts` (
  `DistrictID` int(11) NOT NULL AUTO_INCREMENT,
  `District` varchar(30) NOT NULL,
  PRIMARY KEY (`DistrictID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Documents`
--

DROP TABLE IF EXISTS `Documents`;
CREATE TABLE IF NOT EXISTS `Documents` (
  `DocumentID` int(11) NOT NULL AUTO_INCREMENT,
  `DocumentTitle` varchar(255) NOT NULL,
  `ReferenceNo` varchar(255) NOT NULL,
  `DocumentDate` date NOT NULL,
  `Keywords` varchar(400) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `DocumentTypeID` int(11) NOT NULL,
  `UploadDate` date NOT NULL,
  PRIMARY KEY (`DocumentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `Documents`
--

INSERT INTO `Documents` (`DocumentID`, `DocumentTitle`, `ReferenceNo`, `DocumentDate`, `Keywords`, `FilePath`, `DocumentTypeID`, `UploadDate`) VALUES
(1, 'Memo: The status of the electrical power distribution network', 'MEn/123/ME/16/01/1', '2016-01-02', 'power, distribution network, electricity', 'theFileName.pdf', 1, '2016-01-04'),
(2, 'Meeting Minutes', 'ref1105', '2016-12-01', '', '/Applications/XAMPP/xamppfiles/temp/phpypiWvx', 0, '0000-00-00'),
(3, 'Meeting Minutes', 'ref1157', '1212-12-12', '', '/Applications/XAMPP/xamppfiles/temp/phpOn6f4K', 0, '0000-00-00'),
(4, 'Meeting Minutes', '44', '2012-11-20', '', '/Applications/XAMPP/xamppfiles/temp/phpiL6qxy', 0, '0000-00-00'),
(5, 'Meeting Minutes', '44', '2012-09-03', '', '/Applications/XAMPP/xamppfiles/temp/phpuwLevo', 0, '0000-00-00'),
(6, 'Meeting Minutes', '44', '2012-09-07', '', '/Applications/XAMPP/xamppfiles/temp/phpbQptHP', 0, '0000-00-00'),
(7, 'Meeting Minutes', '44', '2012-09-08', '', '/Applications/XAMPP/xamppfiles/temp/phpdO0mHl', 0, '0000-00-00'),
(8, 'Meeting Minutes', '44', '2012-09-08', '', '/Applications/XAMPP/xamppfiles/temp/php0gfJWC', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `DocumentStateHistory`
--

DROP TABLE IF EXISTS `DocumentStateHistory`;
CREATE TABLE IF NOT EXISTS `DocumentStateHistory` (
  `DocumentStateHistoryID` int(11) NOT NULL AUTO_INCREMENT,
  `DocumentID` int(11) NOT NULL,
  `WorkflowStateID` int(11) NOT NULL,
  `CreatedDate` date NOT NULL,
  `SenderID` int(11) NOT NULL,
  `RecipientID` int(11) NOT NULL,
  `Comments` varchar(500) NOT NULL,
  PRIMARY KEY (`DocumentStateHistoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `DocumentTypes`
--

DROP TABLE IF EXISTS `DocumentTypes`;
CREATE TABLE IF NOT EXISTS `DocumentTypes` (
  `DocumentTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `DocumentType` varchar(30) NOT NULL,
  `TableName` varchar(30) NOT NULL,
  PRIMARY KEY (`DocumentTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `DocumentTypes`
--

INSERT INTO `DocumentTypes` (`DocumentTypeID`, `DocumentType`, `TableName`) VALUES
(1, 'Memo', 'memos'),
(2, 'Forwarding Letter', 'forwardingletters');

-- --------------------------------------------------------

--
-- Table structure for table `ForwardingLetters`
--

DROP TABLE IF EXISTS `ForwardingLetters`;
CREATE TABLE IF NOT EXISTS `ForwardingLetters` (
  `ForwardingLetterID` int(11) NOT NULL AUTO_INCREMENT,
  `MemoID` int(11) NOT NULL,
  `MinistryID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`ForwardingLetterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ForwardingLetters`
--

INSERT INTO `ForwardingLetters` (`ForwardingLetterID`, `MemoID`, `MinistryID`, `DocumentID`) VALUES
(1, 1, 2, 4),
(2, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `FundingSources`
--

DROP TABLE IF EXISTS `FundingSources`;
CREATE TABLE IF NOT EXISTS `FundingSources` (
  `FundingSourceID` int(11) NOT NULL AUTO_INCREMENT,
  `FundingSource` varchar(30) NOT NULL,
  PRIMARY KEY (`FundingSourceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MeetingParticipants`
--

DROP TABLE IF EXISTS `MeetingParticipants`;
CREATE TABLE IF NOT EXISTS `MeetingParticipants` (
  `MeetingParticipantsID` int(11) NOT NULL AUTO_INCREMENT,
  `MeetingID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`MeetingParticipantsID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Meetings`
--

DROP TABLE IF EXISTS `Meetings`;
CREATE TABLE IF NOT EXISTS `Meetings` (
  `MeetingID` int(11) NOT NULL AUTO_INCREMENT,
  `MeetingNumber` varchar(50) NOT NULL,
  `ProposedMeetingDate` date NOT NULL,
  `WasPostponed` tinyint(4) NOT NULL DEFAULT '0',
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`MeetingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Meetings`
--

INSERT INTO `Meetings` (`MeetingID`, `MeetingNumber`, `ProposedMeetingDate`, `WasPostponed`, `DocumentID`) VALUES
(1, 'mtgNo123', '2016-01-01', 0, 1),
(2, 'meeting No 4', '2016-01-12', 0, 4),
(3, 'meeting No 5', '2016-01-12', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `MeetingTypes`
--

DROP TABLE IF EXISTS `MeetingTypes`;
CREATE TABLE IF NOT EXISTS `MeetingTypes` (
  `MeetingTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `MeetingType` varchar(30) NOT NULL,
  PRIMARY KEY (`MeetingTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `MeetingTypes`
--

INSERT INTO `MeetingTypes` (`MeetingTypeID`, `MeetingType`) VALUES
(1, 'Special'),
(2, 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `Memos`
--

DROP TABLE IF EXISTS `Memos`;
CREATE TABLE IF NOT EXISTS `Memos` (
  `MemoID` int(11) NOT NULL AUTO_INCREMENT,
  `MinistryID` int(11) NOT NULL,
  `IsSigned` tinyint(4) NOT NULL,
  `HasTitle` tinyint(11) NOT NULL,
  `HasSummary` tinyint(11) NOT NULL,
  `PriorityID` int(11) NOT NULL,
  `SourceID` int(11) NOT NULL,
  `MemoContent` varchar(2000) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`MemoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Memos`
--

INSERT INTO `Memos` (`MemoID`, `MinistryID`, `IsSigned`, `HasTitle`, `HasSummary`, `PriorityID`, `SourceID`, `MemoContent`, `DocumentID`) VALUES
(1, 1, 1, 1, 1, 1, 1, 'memo conente', 1),
(2, 2, 1, 1, 1, 1, 1, 'some memo content', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Ministries`
--

DROP TABLE IF EXISTS `Ministries`;
CREATE TABLE IF NOT EXISTS `Ministries` (
  `MinistryID` int(11) NOT NULL AUTO_INCREMENT,
  `Ministry` varchar(30) NOT NULL,
  PRIMARY KEY (`MinistryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Ministries`
--

INSERT INTO `Ministries` (`MinistryID`, `Ministry`) VALUES
(1, 'Mines and Energy'),
(2, 'Ministry of Health');

-- --------------------------------------------------------

--
-- Table structure for table `Minutes`
--

DROP TABLE IF EXISTS `Minutes`;
CREATE TABLE IF NOT EXISTS `Minutes` (
  `MinutesID` int(11) NOT NULL AUTO_INCREMENT,
  `MeetingID` int(11) NOT NULL,
  `ActualMeetingDate` date NOT NULL,
  `MeetingTypeID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`MinutesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Minutes`
--

INSERT INTO `Minutes` (`MinutesID`, `MeetingID`, `ActualMeetingDate`, `MeetingTypeID`, `DocumentID`) VALUES
(1, 1, '2016-01-12', 1, 1),
(2, 1, '1212-12-11', 1, 0),
(3, 1, '1212-12-11', 1, 0),
(4, 1, '2020-11-12', 1, 2),
(6, 1, '1212-11-30', 1, 2),
(7, 1, '1212-11-30', 1, 2),
(8, 1, '0000-00-00', 1, 2),
(9, 1, '2016-12-01', 1, 2),
(10, 1, '1212-12-12', 1, 2),
(11, 1, '2012-09-08', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Priorities`
--

DROP TABLE IF EXISTS `Priorities`;
CREATE TABLE IF NOT EXISTS `Priorities` (
  `PriorityID` int(11) NOT NULL AUTO_INCREMENT,
  `PriorityName` varchar(50) NOT NULL,
  PRIMARY KEY (`PriorityID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ProjectReports`
--

DROP TABLE IF EXISTS `ProjectReports`;
CREATE TABLE IF NOT EXISTS `ProjectReports` (
  `ProjectReportID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`ProjectReportID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Projects`
--

DROP TABLE IF EXISTS `Projects`;
CREATE TABLE IF NOT EXISTS `Projects` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectName` varchar(255) NOT NULL,
  `RegionID` int(11) NOT NULL,
  `DistrictID` int(11) NOT NULL,
  `Locality` varchar(100) NOT NULL,
  `ContractorID` int(11) NOT NULL,
  `ContractAmount` decimal(14,2) NOT NULL,
  `PercentageDone` int(11) NOT NULL,
  `ExpectedPercentage` int(11) NOT NULL,
  `FundingSourceID` int(11) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `MDAID` int(11) NOT NULL,
  `ProjectCreationDate` date NOT NULL,
  `SourceID` int(11) NOT NULL,
  `PriorityID` int(11) NOT NULL,
  `DecisionMemoDate` int(11) NOT NULL,
  `MinistryContact` int(11) NOT NULL,
  `ProjectTypeID` int(11) NOT NULL,
  `Verification` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL COMMENT 'Perhaps memo approving project',
  PRIMARY KEY (`ProjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ProjectStatus`
--

DROP TABLE IF EXISTS `ProjectStatus`;
CREATE TABLE IF NOT EXISTS `ProjectStatus` (
  `ProjectStatusID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectStatus` varchar(30) NOT NULL,
  PRIMARY KEY (`ProjectStatusID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ProjectTypes`
--

DROP TABLE IF EXISTS `ProjectTypes`;
CREATE TABLE IF NOT EXISTS `ProjectTypes` (
  `ProjectTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectType` varchar(30) NOT NULL,
  PRIMARY KEY (`ProjectTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `RecommendationStatus`
--

DROP TABLE IF EXISTS `RecommendationStatus`;
CREATE TABLE IF NOT EXISTS `RecommendationStatus` (
  `RecommendationStatusID` int(11) NOT NULL AUTO_INCREMENT,
  `RecommendationStatus` varchar(30) NOT NULL,
  PRIMARY KEY (`RecommendationStatusID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Regions`
--

DROP TABLE IF EXISTS `Regions`;
CREATE TABLE IF NOT EXISTS `Regions` (
  `RegionID` int(11) NOT NULL AUTO_INCREMENT,
  `Region` varchar(30) NOT NULL,
  PRIMARY KEY (`RegionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Sources`
--

DROP TABLE IF EXISTS `Sources`;
CREATE TABLE IF NOT EXISTS `Sources` (
  `SourceID` int(11) NOT NULL AUTO_INCREMENT,
  `Source` varchar(30) NOT NULL,
  PRIMARY KEY (`SourceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Sources`
--

INSERT INTO `Sources` (`SourceID`, `Source`) VALUES
(1, 'SONA'),
(2, 'Dev'),
(3, 'PDU'),
(4, 'ToC');

-- --------------------------------------------------------

--
-- Table structure for table `UserLevels`
--

DROP TABLE IF EXISTS `UserLevels`;
CREATE TABLE IF NOT EXISTS `UserLevels` (
  `UserLevelID` int(11) NOT NULL AUTO_INCREMENT,
  `UserLevel` varchar(30) NOT NULL,
  PRIMARY KEY (`UserLevelID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE IF NOT EXISTS `Users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(120) NOT NULL,
  `UserLevelID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNo` varchar(14) NOT NULL,
  `CreatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `WorkflowNavigation`
--

DROP TABLE IF EXISTS `WorkflowNavigation`;
CREATE TABLE IF NOT EXISTS `WorkflowNavigation` (
  `WorkflowNavigationID` int(11) NOT NULL AUTO_INCREMENT,
  `WorkflowStateID` int(11) NOT NULL,
  `NextWorkflowStateID` int(11) NOT NULL,
  PRIMARY KEY (`WorkflowNavigationID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Workflows`
--

DROP TABLE IF EXISTS `Workflows`;
CREATE TABLE IF NOT EXISTS `Workflows` (
  `WorkflowID` int(11) NOT NULL AUTO_INCREMENT,
  `WorkflowName` varchar(50) NOT NULL,
  PRIMARY KEY (`WorkflowID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `WorkflowStates`
--

DROP TABLE IF EXISTS `WorkflowStates`;
CREATE TABLE IF NOT EXISTS `WorkflowStates` (
  `WorkflowStateID` int(11) NOT NULL AUTO_INCREMENT,
  `StateName` varchar(50) NOT NULL,
  `WorkflowID` int(11) NOT NULL,
  `IsActive` tinyint(4) NOT NULL,
  PRIMARY KEY (`WorkflowStateID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xDecisions`
--

DROP TABLE IF EXISTS `xDecisions`;
CREATE TABLE IF NOT EXISTS `xDecisions` (
  `DecisionID` int(11) NOT NULL AUTO_INCREMENT,
  `DecisionDate` date NOT NULL,
  `MeetingID` int(11) NOT NULL,
  `MeetingNumber` varchar(50) NOT NULL,
  `MeetingDate` date NOT NULL,
  `Content` varchar(2000) NOT NULL,
  `MinistryID` int(11) NOT NULL,
  `DecisionStatusID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`DecisionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xExecutiveApprovalMemo`
--

DROP TABLE IF EXISTS `xExecutiveApprovalMemo`;
CREATE TABLE IF NOT EXISTS `xExecutiveApprovalMemo` (
  `ExecutiveApprovalMemoID` int(11) NOT NULL AUTO_INCREMENT,
  `MinistryID` int(11) NOT NULL,
  `DocumentID` int(11) NOT NULL,
  PRIMARY KEY (`ExecutiveApprovalMemoID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
