CREATE TABLE Categorias(
	id int NOT NULL AUTO_INCREMENT,
	nombre varchar(32) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE Articulos (
	id int NOT NULL AUTO_INCREMENT,
	nombre varchar(32),
	categoria int,
	cantidad int,
	FOREIGN KEY (categoria) REFERENCES Categorias(id),
	PRIMARY KEY (id)
);
