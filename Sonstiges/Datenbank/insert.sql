--
-- Datenbank: `tobsi`
--

USE tobsi;

--
-- Daten für Tabelle `tabdatum`
--

INSERT INTO `tabdatum` (`d_ID`, `datum`) VALUES
(1, '10.3.2016'),
(2, '11.3.2016');

--
-- Daten für Tabelle `tabessen`
--

INSERT INTO `tabessen` (`essen`) VALUES
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

--
-- Daten für Tabelle `tabname`
--

INSERT INTO `tabname` (`n_ID`, `name`) VALUES
(1, 'Dominik'),
(2, 'Quentin'),
(3, 'Tilo'),
(4, 'Tobias');

--
-- Daten für Tabelle `tabbez`
--

INSERT INTO `tabbez` (`n_ID`, `d_ID`, `essen`) VALUES
(4, 1, 'McDonalds'),
(4, 2, 'Food Lounge');


