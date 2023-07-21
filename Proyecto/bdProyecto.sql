DROP DATABASE IF EXISTS Premium;
CREATE DATABASE Premium;
USE Premium;

CREATE TABLE Tipo_de_Prenda (
  id_Prenda INT PRIMARY KEY AUTO_INCREMENT,
  nombreTipoPrenda VARCHAR(60) NOT NULL
);

INSERT INTO Tipo_de_Prenda (nombreTipoPrenda) VALUES
  ('camisa'),
  ('pantalone'),
  ('falda'),
  ('calzado'),
  ('alfombras'),
  ('sombreros');

CREATE TABLE Cliente (
  id_Cliente INT PRIMARY KEY AUTO_INCREMENT,
  nombreClie VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  telefono INT NOT NULL,
  direccion VARCHAR(50) NOT NULL
);

INSERT INTO Cliente (nombreClie, apellido, telefono, direccion) VALUES
  ('Juan', 'Pérez', 123456789, 'Calle 123'),
  ('María', 'Gómez', 987654321, 'Avenida 456');

CREATE TABLE Tipo_de_Servicio (
  id_TipoServicio INT PRIMARY KEY AUTO_INCREMENT,
  nombreServicio VARCHAR(60) NOT NULL,
  id_Prenda INT,
  FOREIGN KEY (id_Prenda) REFERENCES Tipo_de_Prenda (id_Prenda)
);

INSERT INTO Tipo_de_Servicio (nombreServicio, id_Prenda) VALUES
  ('planchado', 1),
  ('secado', 2),
  ('lavado', 3),
  ('tinturado', 4),
  ('desmanchado', 5);

CREATE TABLE Servicio (
  id_Servicio INT PRIMARY KEY AUTO_INCREMENT,
  fecha_recogida DATE NOT NULL,
  cantidad INT NOT NULL,
  estado VARCHAR(60) NOT NULL,
  id_TipoServicio INT,
  id_Prenda INT,
  id_Cliente INT,
  FOREIGN KEY (id_TipoServicio) REFERENCES Tipo_de_Servicio (id_TipoServicio),
  FOREIGN KEY (id_Prenda) REFERENCES Tipo_de_Prenda (id_Prenda),
  FOREIGN KEY (id_Cliente) REFERENCES Cliente (id_Cliente)
);

select *from Servicio;