--
-- Datenbank: `tobsi`
--
DROP SCHEMA IF EXISTS tobsi ;
CREATE SCHEMA IF NOT EXISTS tobsi DEFAULT CHARACTER SET UTF8;
USE tobsi;
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
  `essen` varchar(50) NOT NULL,
  PRIMARY KEY (`essen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tabname`
--

CREATE TABLE IF NOT EXISTS `tabname` (
  `n_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`n_ID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tabbez`
--

CREATE TABLE IF NOT EXISTS `tabbez` (
  `n_ID` int(11) NOT NULL,
  `d_ID` int(11) NOT NULL,
  `essen` varchar(30) NOT NULL,
  PRIMARY KEY (`n_ID`,`d_ID`),
  CONSTRAINT `constraint_datum` FOREIGN KEY (`d_ID`) REFERENCES `tabdatum` (`d_ID`) ON UPDATE CASCADE,
  CONSTRAINT `constraint_name` FOREIGN KEY (`n_ID`) REFERENCES `tabname` (`n_ID`) ON UPDATE CASCADE
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
