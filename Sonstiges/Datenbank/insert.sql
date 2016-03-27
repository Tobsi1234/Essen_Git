--
-- Datenbank: `tobsi`
--

USE tobsi;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `email`, `passwort`, `vorname`, `nachname`, `created_at`, `updated_at`) VALUES
(1, 'tobi@stein.bruck', '$2y$10$HACmKF8VuYsRGXNv7K6tj.o.uLEozvjJafiMNLmGt5QN78qdOoUCG', '', '', '2016-03-22 08:39:49', NULL),
(2, 'quentin.popp@t-online.de', '$2y$10$wxbVk1PeZvxXs/vLC8qfk.Pp0UFBfPUe1.V0w5qcfc.o61kN7zsDC', '', '', '2016-03-22 09:04:06', NULL);

--
-- Daten für Tabelle `tabdatum`
--

INSERT INTO `tabdatum` (`d_ID`, `datum`) VALUES
(1, '10.3.2016'),
(2, '11.3.2016');


--
-- Daten für Tabelle `tabessen`
--

INSERT INTO `tabessen` (`name`, `u_ID`) VALUES
('GebÃ¤ck', 2),
('Kochen', 2),
('DÃ¶ner', 2),
('Hearthstone', 2),
('Indisch', 2),
('Italienisch', 2),
('Burger', 2),
('Pizza', 2),
('Chicken', 2),
('Wir essen Dominik auf', 2);


--
-- Daten für Tabelle `tabname`
--

INSERT INTO `tabperson` (`name`) VALUES
('Dominik'),
('Quentin'),
('Tilo'),
('Tobias');



