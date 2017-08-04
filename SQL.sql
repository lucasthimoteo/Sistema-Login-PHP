
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE login_lucas_thimoteo;
USE login_lucas_thimoteo;

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin'; 
FLUSH PRIVILEGES;
GRANT
  ALTER,
  ALTER ROUTINE,
  CREATE,
  CREATE ROUTINE,
  CREATE TEMPORARY TABLES,
  CREATE VIEW,
  DELETE,
  DROP,
  EVENT,
  EXECUTE,
  INDEX,
  INSERT,
  LOCK TABLES,
  REFERENCES,
  SELECT,
  SHOW VIEW,
  TRIGGER,
  UPDATE 
ON
  `login_lucas_thimoteo`.* 
TO
  'admin' @'localhost';

CREATE TABLE `login` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `pass` char(40) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `tel1` varchar(13) DEFAULT NULL,
  `tel2` varchar(13) DEFAULT NULL,
  `permission_level` char(1) DEFAULT 'n',
  `signup_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '0',
  `valid_code` varchar(40) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



INSERT INTO `login` (`id`, `username`, `email`, `pass`, `full_name`, `address`, `tel1`, `tel2`, `permission_level`, `signup_date`, `active`, `valid_code`, `image`) VALUES
(22, 'admin', 'luca.lic@hotmail.it', '$1$tK2.yr1.$G2B1xX43nu3gQZhaT947M0', 'lucas thimoteo', 'rua pedro gomes', '21997336525', '', 'A', '2017-08-04 05:00:32', 1, 'admin21997336525', 'uploads / 15018228325983ff7083589.jpg');


ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_identification` (`username`,`email`);

ALTER TABLE `login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

