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

INSERT INTO `tabessen` (`name`) VALUES
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

INSERT INTO `tabperson` (`p_ID`, `name`) VALUES
(1, 'Dominik'),
(2, 'Quentin'),
(3, 'Tilo'),
(4, 'Tobias');

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `passwort`, `vorname`, `nachname`, `created_at`, `updated_at`) VALUES
(1, 'tobi@stein.bruck', '$2y$10$HACmKF8VuYsRGXNv7K6tj.o.uLEozvjJafiMNLmGt5QN78qdOoUCG', '', '', '2016-03-22 08:39:49', NULL),
(2, 'quentin.popp@t-online.de', '$2y$10$wxbVk1PeZvxXs/vLC8qfk.Pp0UFBfPUe1.V0w5qcfc.o61kN7zsDC', '', '', '2016-03-22 09:04:06', NULL);


--
-- Daten für Tabelle `users`
--
INSERT INTO `users` (`id`, `email`, `passwort`, `vorname`, `nachname`, `created_at`, `updated_at`) VALUES
(6, 'tobi@stein.bruck', '$2y$10$HACmKF8VuYsRGXNv7K6tj.o.uLEozvjJafiMNLmGt5QN78qdOoUCG', '', '', '2016-03-22 08:39:49', NULL),
(7, 'quentin.popp@t-online.de', '$2y$10$wxbVk1PeZvxXs/vLC8qfk.Pp0UFBfPUe1.V0w5qcfc.o61kN7zsDC', '', '', '2016-03-22 09:04:06', NULL);
