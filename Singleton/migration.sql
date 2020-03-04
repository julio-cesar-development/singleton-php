CREATE SCHEMA IF NOT EXISTS Singleton;

USE Singleton;

CREATE TABLE IF NOT EXISTS `Event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCity` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `temperature` varchar(20) DEFAULT NULL,
  `wind_direction` varchar(20) DEFAULT NULL,
  `wind_velocity` varchar(20) DEFAULT NULL,
  `humidity` varchar(20) DEFAULT NULL,
  `condition` varchar(20) DEFAULT NULL,
  `pressure` varchar(20) DEFAULT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `sensation` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCity` (`idCity`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
