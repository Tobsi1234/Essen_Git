--
-- Datenbank: `tobsi`
--
DROP SCHEMA IF EXISTS tobsi ;
CREATE SCHEMA IF NOT EXISTS tobsi DEFAULT CHARACTER SET UTF8;
USE tobsi;
-- --------------------------------------------------------
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_ID` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`u_ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------


--
-- Tabellenstruktur für Tabelle `tabperson`
--

CREATE TABLE IF NOT EXISTS `tabperson` (
  `p_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`p_ID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- --------------------------------------------------------


--
-- Tabellenstruktur für Tabelle `tabdatum`
--

CREATE TABLE IF NOT EXISTS `tabdatum` (
  `d_ID` int(11) NOT NULL AUTO_INCREMENT,
  `datum` varchar(30) NOT NULL,
  PRIMARY KEY (`d_ID`),
  UNIQUE KEY `datum` (`datum`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tabessen`
--

CREATE TABLE IF NOT EXISTS `tabessen` (
  `e_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `u_ID` int(10) NOT NULL,
  PRIMARY KEY (`e_ID`),
  UNIQUE KEY (`name`),
  CONSTRAINT `constraint_person` FOREIGN KEY (`u_ID`) REFERENCES `users` (`u_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------


--
-- Tabellenstruktur für Tabelle `tabbez`
--

CREATE TABLE IF NOT EXISTS `tabbez` (
  `u_ID` int(11) NOT NULL,
  `d_ID` int(11) NOT NULL,
  `e_ID1` int(11) NOT NULL,
  `e_ID2` int(11),
  PRIMARY KEY (`u_ID`,`d_ID`),
  CONSTRAINT `constraint_datum` FOREIGN KEY (`d_ID`) REFERENCES `tabdatum` (`d_ID`) ON UPDATE CASCADE,
  CONSTRAINT `constraint_name` FOREIGN KEY (`u_ID`) REFERENCES `users` (`u_ID`) ON UPDATE CASCADE,
  CONSTRAINT `constraint_essen1` FOREIGN KEY (`e_ID1`) REFERENCES `tabessen` (`e_ID`) ON UPDATE CASCADE,
  CONSTRAINT `constraint_essen2` FOREIGN KEY (`e_ID2`) REFERENCES `tabessen` (`e_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tabchat`
--

CREATE TABLE IF NOT EXISTS `tabchat` (
	`c_ID` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(30) NOT NULL,
	`nachricht` text NOT NULL,
	`ts` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`c_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tablocation`
--

CREATE TABLE IF NOT EXISTS `tablocation` (
	`l_ID` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(30) NOT NULL,
	`link` varchar(100) NOT NULL,
    `u_ID` int(10) NOT NULL,
	  PRIMARY KEY (`l_ID`),
      CONSTRAINT `constraint_benutzer` FOREIGN KEY (`u_ID`) REFERENCES `users` (`u_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- Tabellenstruktur für Tabelle `tablocessen`
--

CREATE TABLE IF NOT EXISTS `tablocessen` (
  `l_ID` int(11) NOT NULL,
  `e_ID` int(11) NOT NULL,
  PRIMARY KEY (`l_ID`,`e_ID`),
  CONSTRAINT `constraint_location` FOREIGN KEY (`l_ID`) REFERENCES `tablocation` (`l_ID`) ON UPDATE CASCADE,
  CONSTRAINT `constraint_essen` FOREIGN KEY (`e_ID`) REFERENCES `tabessen` (`e_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

