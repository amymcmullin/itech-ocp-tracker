-- iTech Differentiated OCP Tracker
-- Schema only. Load this first, then seed-demo.sql.

-- Tables are emitted in dump order, so FK checks are relaxed for the load.
SET FOREIGN_KEY_CHECKS=0;


CREATE TABLE IF NOT EXISTS `assignments` (
  `assignmentID` char(11) NOT NULL DEFAULT '0',
  `assignmentName` varchar(150) NOT NULL DEFAULT '',
  `standardID` char(8) NOT NULL DEFAULT '',
  `levelID` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`assignmentID`),
  KEY `FK_assignments_levels` (`levelID`),
  KEY `FK_assignments_Standards` (`standardID`),
  CONSTRAINT `FK_assignments_Standards` FOREIGN KEY (`standardID`) REFERENCES `Standards` (`standardID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_assignments_levels` FOREIGN KEY (`levelID`) REFERENCES `levels` (`levelID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `earnedOCP` (
  `EarnID` varchar(50) NOT NULL DEFAULT 'AUTO_INCREMENT',
  `date` date NOT NULL,
  `stuID` char(6) NOT NULL DEFAULT '',
  `assignmentID` varchar(11) NOT NULL DEFAULT '0',
  `Observation` longtext DEFAULT NULL,
  PRIMARY KEY (`EarnID`),
  KEY `FK_earnedOCP_students` (`stuID`),
  KEY `FK_earnedOCP_assignments` (`assignmentID`),
  CONSTRAINT `FK_earnedOCP_assignments` FOREIGN KEY (`assignmentID`) REFERENCES `assignments` (`assignmentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_earnedOCP_students` FOREIGN KEY (`stuID`) REFERENCES `students` (`stuID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `enrollment` (
  `enrollID` int(11) NOT NULL AUTO_INCREMENT,
  `termID` varchar(8) NOT NULL DEFAULT '',
  `stuID` varchar(6) NOT NULL DEFAULT '',
  `courseID` char(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`enrollID`),
  UNIQUE KEY `stuID` (`stuID`),
  KEY `enrollID` (`enrollID`),
  KEY `FK_enrollment_terms` (`termID`),
  KEY `FK_enrollment_programs` (`courseID`),
  CONSTRAINT `FK_enrollment_programs` FOREIGN KEY (`courseID`) REFERENCES `programs` (`courseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_enrollment_students` FOREIGN KEY (`stuID`) REFERENCES `students` (`stuID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_enrollment_terms` FOREIGN KEY (`termID`) REFERENCES `terms` (`termID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `levels` (
  `levelID` char(1) NOT NULL DEFAULT '',
  `levelName` text NOT NULL,
  `levelDescription` text NOT NULL,
  PRIMARY KEY (`levelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Observations` (
  `observeID` timestamp NULL DEFAULT NULL,
  `stuID` char(6) DEFAULT NULL,
  `standardID` char(8) DEFAULT NULL,
  `levelID` char(1) DEFAULT NULL,
  `observationNotes` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `OCPs` (
  `ocpID` char(50) NOT NULL DEFAULT '',
  `ocpName` text DEFAULT NULL,
  `ocpDescription` text DEFAULT NULL,
  `courseID` char(7) NOT NULL,
  PRIMARY KEY (`ocpID`(7)),
  KEY `FK_OCPs_programs` (`courseID`),
  CONSTRAINT `FK_OCPs_programs` FOREIGN KEY (`courseID`) REFERENCES `programs` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `programs` (
  `courseID` char(7) NOT NULL,
  `courseName` varchar(50) DEFAULT NULL,
  `courseHours` int(11) DEFAULT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `skills` (
  `skillID` text NOT NULL,
  `standardID` text NOT NULL,
  `skillDesc` text NOT NULL,
  PRIMARY KEY (`skillID`(8))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `Standards` (
  `standardID` char(8) NOT NULL DEFAULT '',
  `ocpID` char(50) NOT NULL DEFAULT '',
  `standardDesc` mediumtext NOT NULL DEFAULT '',
  PRIMARY KEY (`standardID`),
  KEY `ocpID` (`ocpID`),
  KEY `standardID` (`standardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `students` (
  `stuID` char(6) NOT NULL DEFAULT '',
  `stuNameFirst` text NOT NULL,
  `stuNameLast` text NOT NULL,
  `stuEmail` text NOT NULL,
  `PSAV` tinyint(1) NOT NULL,
  PRIMARY KEY (`stuID`) USING BTREE,
  UNIQUE KEY `stuID` (`stuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `terms` (
  `termID` varchar(8) NOT NULL DEFAULT '',
  `termName` text NOT NULL,
  PRIMARY KEY (`termID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS=1;
