CREATE DATABASE oximetro;
USE oximetro;

CREATE TABLE records (
  id INT PRIMARY KEY AUTO_INCREMENT,
  oxygen FLOAT NOT NULL,
  heart_rate FLOAT NOT NULL,
  temperature FLOAT NOT NULL,
  registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO records VALUES (null, 94, 80, 36.5, null), (null, 92, 60, 36.3, null), (null, 90, 89, 36.9, null);

CREATE TABLE oximetro_status (
  id INT PRIMARY KEY AUTO_INCREMENT,
  oximetro_connection INT DEFAULT 0,
  scan_status INT DEFAULT 0
);

INSERT INTO oximetro_status (oximetro_connection, scan_status) VALUES (0, 0);
UPDATE oximetro_status SET scan_status = 1 WHERE id = 1;

SELECT id, oxygen, heart_rate, temperature, DATE(registration_date) AS 'Date', TIME(registration_date) AS 'Hour' FROM records;