CREATE DATABASE oximetro;
USE oximetro;

CREATE TABLE registros (
  id INT NOT NULL AUTO_INCREMENT,
  dht11_temperatura FLOAT,
  dht11_humedad FLOAT,
  fecha_hora_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fecha_hora_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE status_oximetro (
  id INT NOT NULL AUTO_INCREMENT,
  status_oximetro INT,
  fecha_hora_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fecha_hora_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

INSERT INTO status_oximetro (status_oximetro) VALUES (0);
UPDATE status_oximetro SET status_oximetro = 1 WHERE id = 1;