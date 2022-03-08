DROP DATABASE IF EXISTS kaddra_promotion;
CREATE DATABASE IF NOT EXISTS kaddra_promotion CHARACTER SET utf8 COLLATE utf8_general_ci;
USE kaddra_promotion;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `kaddra_promotion`
--

-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `PK_User_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(255) DEFAULT NULL,
  `vorname` varchar(255) DEFAULT NULL,
  `nachname` varchar(255) DEFAULT NULL,
  `passwortHASH` varchar(255) DEFAULT NULL,
  `member_seit_Datum` date DEFAULT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `verify_number` numeric(4,0) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `background_picture` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `ist_verifyed_user` tinyint(1) DEFAULT NULL,
  `ist_admin_BOOLEAN` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `album`
--

CREATE TABLE `album` (
  `PK_album_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Titel` varchar(255) DEFAULT NULL,
  `Dauer` varchar(255) DEFAULT NULL,
  `Erscheinungsdatum` date DEFAULT NULL,
  `Song_Anzahl` varchar(255) DEFAULT NULL,
  `PK_Künstler_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bewertung`
--

CREATE TABLE `song_bewertung` (
  `PK_Bewertung_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `wert` int(11) NOT NULL,
  `FK_PK_user_ID` int(11) DEFAULT NULL,
  `FK_PK_Song_ID` int(11) DEFAULT NULL,
  FOREIGN KEY (FK_PK_user_ID) REFERENCES user(PK_User_ID),
  FOREIGN KEY (FK_PK_Song_ID) REFERENCES song(PK_song_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `feature`
--

CREATE TABLE `feature` (
  `PK_feature_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `PK_Künstler_ID` int(11) DEFAULT NULL,
  `FK_PK_Song_ID` int(11) DEFAULT NULL,
  `FK_PK_Album_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tabellenstruktur für Tabelle `song`
--

CREATE TABLE `song` (
  `PK_song_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Titel` varchar(255) DEFAULT NULL,
  `Dauer` TIME DEFAULT NULL,
  `wiedergaben` INT DEFAULT NULL,
  `Erscheinungsdatum` date DEFAULT NULL,
  `Excplicit` tinyint(1) DEFAULT NULL,
  `FK_PK_Künstler_ID` int(11) DEFAULT NULL,
  `FK_PK_Album_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `kommentare`
--

CREATE TABLE `kommentare`(
  `PK_Kommentare_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `datum` datetime DEFAULT NULL,
  `inhalt` varchar(255) NOT NULL,
  `FK_PK_Kommentar_ID` int(11) DEFAULT NULL,
  `FK_PK_Song_ID` int(11) NULL,
  `FK_PK_User_ID` int(11) NOT NULL,
  FOREIGN KEY (FK_PK_User_ID) REFERENCES user(PK_User_ID),
  FOREIGN KEY (FK_PK_Song_ID) REFERENCES song(PK_song_ID),
  FOREIGN KEY (FK_PK_Kommentar_ID) REFERENCES kommentare(PK_Kommentare_ID) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kommentar_bewertung`
--

CREATE TABLE `kommentar_bewertung` (
  `PK_Bewertung_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `wert` int(11) NOT NULL,
  `FK_PK_user_ID` int(11) DEFAULT NULL,
  `FK_PK_Kommentare_ID` int(11) DEFAULT NULL,
  FOREIGN KEY (FK_PK_user_ID) REFERENCES user(PK_User_ID),
  FOREIGN KEY (FK_PK_Kommentare_ID) REFERENCES kommentare(PK_Kommentare_ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `künstler`
--

CREATE TABLE `künstler` (
  `PK_Künstler_ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) DEFAULT NULL,
  `monatliche_hörer_innen` varchar(255) DEFAULT NULL,
  `lieder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Indizes der exportierten Tabellen
--

-- --
-- -- Indizes für die Tabelle `album`
-- --
-- ALTER TABLE `album`
--   ADD PRIMARY KEY (`PK_album_ID`);

-- --
-- -- Indizes für die Tabelle `bewertung`
-- --
-- ALTER TABLE `bewertung`
--   ADD PRIMARY KEY (`PK_Bewertung_ID`);

-- --
-- -- Indizes für die Tabelle `feature`
-- --
-- ALTER TABLE `feature`
--   ADD PRIMARY KEY (`PK_feature_ID`);

-- --
-- -- Indizes für die Tabelle `kommentare`
-- --
-- ALTER TABLE `kommentare`
--   ADD PRIMARY KEY (`PK_Kommentare_ID`);

-- --
-- -- Indizes für die Tabelle `künstler`
-- --
-- ALTER TABLE `künstler`
--   ADD PRIMARY KEY (`PK_Künstler_ID`);

-- --
-- -- Indizes für die Tabelle `song`
-- --
-- ALTER TABLE `song`
--   ADD PRIMARY KEY (`PK_song_ID`);

-- --
-- -- Indizes für die Tabelle `user`
-- --
-- ALTER TABLE `user`
--   ADD PRIMARY KEY (`PK_User_ID`);

-- --
-- -- AUTO_INCREMENT für exportierte Tabellen
-- --

-- --
-- -- AUTO_INCREMENT für Tabelle `album`
-- --
-- ALTER TABLE `album`
--   MODIFY `PK_album_ID` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT für Tabelle `bewertung`
-- --
-- ALTER TABLE `bewertung`
--   MODIFY `PK_Bewertung_ID` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT für Tabelle `feature`
-- --
-- ALTER TABLE `feature`
--   MODIFY `PK_feature_ID` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT für Tabelle `kommentare`
-- --
-- ALTER TABLE `kommentare`
--   MODIFY `PK_Kommentare_ID` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT für Tabelle `künstler`
-- --
-- ALTER TABLE `künstler`
--   MODIFY `PK_Künstler_ID` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT für Tabelle `song`
-- --
-- ALTER TABLE `song`
--   MODIFY `PK_song_ID` int(11) NOT NULL AUTO_INCREMENT;

-- --
-- -- AUTO_INCREMENT für Tabelle `user`
-- --
-- ALTER TABLE `user`
--   MODIFY `PK_User_ID` int(11) NOT NULL AUTO_INCREMENT;
-- COMMIT;

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
