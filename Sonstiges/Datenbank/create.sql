--
-- Datenbank: `tobsi`
--
DROP SCHEMA IF EXISTS tobsi ;
CREATE SCHEMA IF NOT EXISTS tobsi DEFAULT CHARACTER SET UTF8;
USE tobsi;
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
  `p_ID` int(11),
  PRIMARY KEY (`e_ID`),
  UNIQUE KEY (`name`),
  CONSTRAINT `constraint_person` FOREIGN KEY (`p_ID`) REFERENCES `tabperson` (`p_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------


--
-- Tabellenstruktur für Tabelle `tabbez`
--

CREATE TABLE IF NOT EXISTS `tabbez` (
  `p_ID` int(11) NOT NULL,
  `d_ID` int(11) NOT NULL,
  `e_ID1` int(11) NOT NULL,
  `e_ID2` int(11),
  PRIMARY KEY (`p_ID`,`d_ID`),
  CONSTRAINT `constraint_datum` FOREIGN KEY (`d_ID`) REFERENCES `tabdatum` (`d_ID`) ON UPDATE CASCADE,
  CONSTRAINT `constraint_name` FOREIGN KEY (`p_ID`) REFERENCES `tabperson` (`p_ID`) ON UPDATE CASCADE,
  CONSTRAINT `constraint_essen1` FOREIGN KEY (`e_ID1`) REFERENCES `tabessen` (`e_ID`) ON UPDATE CASCADE,
  CONSTRAINT `constraint_essen2` FOREIGN KEY (`e_ID2`) REFERENCES `tabessen` (`e_ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tabbez`
--

CREATE TABLE IF NOT EXISTS `tabchat` (
	`c_ID` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(30) NOT NULL,
	`nachricht` text NOT NULL,
	`ts` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`c_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tabellenstruktur für Tabelle `tablocation`
--

CREATE TABLE IF NOT EXISTS `tablocation` (
	`l_ID` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(30) NOT NULL,
	`link` varchar(100) NOT NULL,
    `p_ID` int(11) NOT NULL,
	  PRIMARY KEY (`l_ID`),
      CONSTRAINT `constraint_benutzer` FOREIGN KEY (`p_ID`) REFERENCES `tabperson` (`p_ID`) ON UPDATE CASCADE
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
