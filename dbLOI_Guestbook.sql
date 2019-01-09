SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `Guestbook` (
  `ID` int(11) UNSIGNED NOT NULL,
  `Naam` char(50) NOT NULL,
  `Boodschap` text NOT NULL,
  `Datum` datetime DEFAULT NULL,
  `Sport` char(30) DEFAULT '',
  `Beoefenaar` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `Guestbook`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `Guestbook`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;