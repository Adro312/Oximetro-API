CREATE DATABASE oximetro;
USE oximetro;

CREATE TABLE records (
  id INT PRIMARY KEY AUTO_INCREMENT,
  oxygen FLOAT NOT NULL,
  heart_rate FLOAT NOT NULL,
  temperature FLOAT NOT NULL,
  registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE lastest_records (
  id INT PRIMARY KEY AUTO_INCREMENT,
  lastest_record INT UNSIGNED NOT NULL,
  penultimate_record INT UNSIGNED NOT NULL,
  antepenultimate_record INT UNSIGNED NOT NULL
);

CREATE TABLE oximetro_status (
  id INT PRIMARY KEY AUTO_INCREMENT,
  oximetro_connection INT DEFAULT 0,
  scan_status INT DEFAULT 0
);

-- Prubeas
INSERT INTO oximetro_status (oximetro_connection, scan_status) VALUES (0, 0);
UPDATE oximetro_status SET scan_status = 1 WHERE id = 1;