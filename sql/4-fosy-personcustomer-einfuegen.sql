-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Jun 2013 um 21:18
-- Server Version: 5.5.27
-- PHP-Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `fosy`
--

--
-- Daten für Tabelle `person`
--

INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Bernd', 'Maur', NULL, NULL, NULL, 'Libellengasse', 12, 2, 4, 'Saraberg', 9863, 'Austria', '0650 659 61 34', NULL, 'BerndMaur@gmail.de', '1954-12-05', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Mike', 'Dreher', NULL, NULL, NULL, 'Schlösslstrasse ', 13, 2, 1, 'NETZBERG', 4420, 'Austria', '0664 654 54 70', NULL, 'mike.dreher@gmail.de', '1984-12-08', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Sven', 'Papst', NULL, NULL, NULL, 'Kimpling ', 22, 2, 1, 'ZWETTL AN DER RODL', 1120, 'Austria', '0680 659 34 34', NULL, 'sven.papst@gmail.de', '1970-12-05', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Paul', 'Nussbaum', NULL, NULL, NULL, 'Salzburger Strasse', 43, 2, 1, 'LITZLDORF', 5512, 'Austria', '0650 659 61 34', NULL, 'paul.nussbaum@gmail.de', '1954-10-15', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Jens', 'Schmidt', NULL, NULL, NULL, 'Bonygasse', 11, 2, 1, ' EBEN IM PONGAU', 1780, 'Austria', '0650 342 34 34', NULL, 'BerndMaur@gmail.de', '1954-12-05', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Matthias', 'Hofmann', NULL, NULL, NULL, 'Herrenstrasse ', 43, 2, 1, 'HAIMACH', 8800, 'Austria', '0650 342 61 49', NULL, 'jensschmidt@gmail.de', '1970-12-05', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Jan', 'Sanger', NULL, NULL, NULL, 'Ditscheinergasse', 6, 2, 1, 'SCHENKENBRUNN', 2654, 'Austria', '0650 34 34 3', NULL, 'matthiashofman@gmail.de', '1959-12-05', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Klaus', 'Trommler', NULL, NULL, NULL, 'Schlösslstrasse ', 36, 2, 1, 'PICHLING', 1256, 'Austria', '0650 659 34 49', NULL, 'jan@gmail.de', '1997-12-05', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Lucas', 'Aachen', NULL, NULL, NULL, 'Bahnhofstrasse', 23, 2, 1, 'SIMETSHAM', 2240, 'Austria', '0650 659 34 49', NULL, 'klaust@gmail.de', '1952-12-05', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Marko', 'Metzger', NULL, NULL, NULL, 'Zeppelinstrasse', 25, 2, 1, 'OBERRIETHAL', 3665, 'Austria', '0650 34 61 49', NULL, 'markometzger@gmail.de', '1954-12-05', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Ralph', 'Seiler', NULL, NULL, NULL, 'Horner Strasse', 11, 2, 5, 'BIRKFELD', 6582, 'Austria', '0650 34 34 34', NULL, 'ralphseiler@gmail.de', '1954-12-09', NULL, NULL, NULL, NULL, 1, NULL);
INSERT INTO `person` (`fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(NULL, 'Leon', 'Mayer', NULL, NULL, NULL, 'Traungasse ', 75, 2, 8, 'LUEGGRABEN', 2568, 'Austria', '0650 34 61 34', NULL, 'leonmayer@gmail.de', '1067-12-05', NULL, NULL, NULL, NULL, 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
