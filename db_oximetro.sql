CREATE DATABASE oximetro;
USE oximetro;

CREATE TABLE records (
  id INT PRIMARY KEY AUTO_INCREMENT,
  oxygen FLOAT NOT NULL,
  heart_rate FLOAT NOT NULL,
  temperature FLOAT NOT NULL,
  registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO records VALUES 
  (null, 94, 80, 36.5, null),
  (null, 94, 80, 36.5, '2022-01-12 12:53:19'),
  (null, 96, 60, 36.2, '2022-09-15 13:25:10'),
  (null, 92, 65, 36.1, '2022-08-03 15:03:11'),
  (null, 92, 70, 36.6, '2022-07-17 16:14:28'),
  (null, 93, 75, 36.5, '2022-06-28 13:50:30'),
  (null, 94, 80, 36.8, '2022-05-10 11:18:44'),
  (null, 95, 80, 36.9, '2022-04-29 14:17:55'),
  (null, 96, 85, 37.1, '2022-03-01 19:05:13'),
  (null, 96, 85, 37.1, '2022-03-01 14:25:53'),
  (null, 96, 85, 37.1, '2022-03-01 10:50:33'),
  (null, 91, 90, 36.2, '2022-02-14 21:00:12');

CREATE TABLE oximetro_status (
  id INT PRIMARY KEY AUTO_INCREMENT,
  oximetro_connection INT DEFAULT 0,
  scan_status INT DEFAULT 0
);

INSERT INTO oximetro_status (oximetro_connection, scan_status) VALUES (0, 0);

--------------------------------------
-------------- TESTS -----------------
--------------------------------------

UPDATE oximetro_status SET scan_status = 0, oximetro_connection = 0 WHERE id = 1;

UPDATE oximetro_status SET scan_status = 1 WHERE id = 1;
UPDATE oximetro_status SET scan_status = 0 WHERE id = 1;

SELECT id, oxygen, heart_rate, temperature, DATE(registration_date) AS 'Date', TIME(registration_date) AS 'Hour' FROM records;

SELECT id, oxygen, heart_rate, temperature, DATE(registration_date) AS 'Date', TIME(registration_date) AS 'Hour' FROM records ORDER BY id DESC LIMIT 2;

SELECT id, oxygen, heart_rate, temperature, DATE(registration_date) AS 'Date', TIME(registration_date) AS 'Hour' FROM records WHERE DATE(registration_date) = '2022-03-01';