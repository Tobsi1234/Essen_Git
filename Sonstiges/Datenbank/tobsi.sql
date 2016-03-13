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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Daten für Tabelle `tabdatum`
--

INSERT INTO `tabdatum` (`d_ID`, `datum`) VALUES
(74, '10.3.2016'),
(81, '11.3.2016'),
(28, '12.1.2016'),
(33, '13.1.2016'),
(34, '14.1.2016'),
(14, '2.1.2016'),
(19, '3.1.2016'),
(35, '32.1.2016'),
(36, '4.2.2016'),
(21, '5.1.2016'),
(38, '5.2.2016'),
(20, '6.1.2016'),
(41, '6.3.2016'),
(22, '7.1.2016'),
(43, '7.3.2016'),
(52, '8.3.2016'),
(23, '9.1.2016'),
(69, '9.3.2016');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tabessen`
--

CREATE TABLE IF NOT EXISTS `tabessen` (
  `value` varchar(30) NOT NULL,
  PRIMARY KEY (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tabessen`
--

INSERT INTO `tabessen` (`value`) VALUES
('BÃ¤cker'),
('clown'),
('Dahoim'),
('Das Gerber'),
('DÃ¶ner'),
('Doener'),
('Etwas im Umkreis von 200 Meter'),
('FEZ'),
('Food Lounge'),
('Hearthstone'),
('Inder'),
('Inderinderinderin'),
('Italiener'),
('Kantine - The place to be'),
('McDonalds'),
('Mensa'),
('Milaneo'),
('Nur Hearthstone, kein Essen'),
('Wir essen Dominik auf');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tabname`
--

CREATE TABLE IF NOT EXISTS `tabname` (
  `n_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`n_ID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Daten für Tabelle `tabname`
--

INSERT INTO `tabname` (`n_ID`, `name`) VALUES
(32, 'Dominik'),
(40, 'Quentin'),
(87, 'Tilo'),
(28, 'Tobias');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tabbez`
--

INSERT INTO `tabbez` (`n_ID`, `d_ID`, `essen`) VALUES
(28, 14, 'McDonalds'),
(28, 19, 'Food Lounge'),
(28, 20, 'Doener'),
(28, 21, 'BÃ¤cker'),
(28, 22, 'McDonalds'),
(28, 23, 'clown'),
(28, 35, 'Milaneo'),
(28, 38, 'Kantine - The place to be'),
(28, 41, 'McDonalds'),
(28, 43, 'Milaneo'),
(28, 52, 'Wir essen Dominik auf'),
(28, 69, 'Italiener'),
(28, 74, 'Food Lounge'),
(28, 81, 'Dahoim'),
(32, 14, 'Das Gerber'),
(32, 20, 'Wir essen Dominik auf'),
(32, 21, 'Milaneo'),
(32, 28, 'Nur Hearthstone, kein Essen'),
(32, 33, 'Nur Hearthstone, kein Essen'),
(32, 34, 'Nur Hearthstone, kein Essen'),
(32, 36, 'Kantine - The place to be'),
(32, 38, 'Kantine - The place to be'),
(32, 43, 'Doener'),
(32, 69, 'Das Gerber'),
(32, 74, 'DÃ¶ner'),
(40, 28, 'FEZ'),
(40, 43, 'Das Gerber'),
(40, 52, 'BÃ¤cker'),
(40, 69, 'Inderinderinderin'),
(40, 74, 'Food Lounge'),
(87, 74, 'DÃ¶ner');

