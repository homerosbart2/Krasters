CREATE DATABASE TIENDA;

/*
DROP TABLE DetalleCompras;
DROP TABLE Carrito;
DROP TABLE Compras;
DROP TABLE Usuarios;
DROP TABLE Existencias;
DROP TABLE Productos;
DROP TABLE Emisores;
DROP TABLE Couriers;
DROP TABLE Marcas;
DROP TABLE Colores;
DROP TABLE Lugares;
*/

CREATE TABLE Marcas(
    marca_nombre varchar(20),
    dir_logo varchar(100),
    PRIMARY KEY(marca_nombre)
);

CREATE TABLE Colores(
    color_nombre varchar(10),
    color_codigo varchar(8),
    PRIMARY KEY(color_nombre)
);

CREATE TABLE Productos(
    producto_id SERIAL,
    producto_nombre varchar(20),
    descripcion varchar(30),
    precio decimal,
    marca_nombre varchar(20),
    PRIMARY KEY(producto_id,marca_nombre),
    FOREIGN KEY(marca_nombre) REFERENCES Marcas(marca_nombre),
    UNIQUE(producto_nombre,marca_nombre)
);

CREATE TABLE Existencias(
    producto_id integer,
    color_nombre varchar(10),
    talla varchar(10),
    existencia integer,    
    FOREIGN KEY(producto_id) REFERENCES Productos(producto_id),
    FOREIGN KEY(color_nombre) REFERENCES Colores(color_nombre),
    UNIQUE(producto_id,color_nombre,talla)
);

CREATE TABLE Usuarios(
    usuario varchar(15),
    nombre varchar(25),
    password_usuario varchar(15),
    role integer,
    PRIMARY KEY(usuario)
);

CREATE TABLE Emisores(
	emisor_id SERIAL,
	nombre varchar(30),
    direccion_ip varchar(25),
    autorizacion_path varchar(20),
    formato varchar(10),
    PRIMARY KEY(emisor_id),
    UNIQUE (direccion_ip)
);

CREATE TABLE Couriers(
	courier_id SERIAL,
	nombre varchar(30),
    direccion_ip varchar(25),
    consulta_path varchar(20),
    envio_path varchar(20),
    estado_path varchar(20),
    formato varchar(10),
    PRIMARY KEY(courier_id),
    UNIQUE (direccion_ip)
);

CREATE TABLE Lugares(
    lugar_id varchar(10),
    nombre varchar(25),
    PRIMARY KEY(lugar_id),  
    UNIQUE(nombre) 
);

CREATE TABLE Compras(
    compra_id SERIAL,
    emisor_id integer,
    courier_id integer,
    lugar_id varchar(10),
    usuario varchar(15),
    tarjeta_ccv varchar(25),
    tarjeta_nombre varchar(25),
    tarjeta_tipo varchar(10),
    tarjeta_fecha_vencimiento date,
    fecha timestamp,
    PRIMARY KEY(compra_id),
    FOREIGN KEY(lugar_id) REFERENCES Lugares(lugar_id),
    FOREIGN KEY(usuario) REFERENCES Usuarios(usuario),
    FOREIGN KEY(emisor_id) REFERENCES Emisores(emisor_id),
    FOREIGN KEY(courier_id)   REFERENCES Couriers(courier_id)
);

CREATE TABLE DetalleCompras(
    compra_id integer,
    producto_id integer,
    color_nombre varchar(10),
    talla varchar(10), 
    cantidad decimal,
    FOREIGN KEY(color_nombre) REFERENCES Colores(color_nombre),   
    FOREIGN KEY(producto_id) REFERENCES Productos(producto_id),
    FOREIGN KEY(compra_id) REFERENCES Compras(compra_id)
);

CREATE TABLE Carrito(
    carrito_id SERIAL,
    usuario varchar(15),
    producto_id integer,
    color_nombre varchar(10),
    talla varchar(10), 
    cantidad decimal,
    FOREIGN KEY(usuario) REFERENCES Usuarios(usuario),
    FOREIGN KEY(color_nombre) REFERENCES Colores(color_nombre),   
    FOREIGN KEY(producto_id) REFERENCES Productos(producto_id),
    CHECK (cantidad >= 0)
);

CREATE TABLE Lugares(
    codigo varchar(5),
    nombre varchar(30),
    PRIMARY KEY(codigo),
    UNIQUE(nombre)
);

CREATE USER tienda;
ALTER USER tienda WITH ENCRYPTED PASSWORD '%TiendaAdmin18%';
GRANT ALL PRIVILEGES ON DATABASE "TIENDA" TO tienda;
GRANT ALL PRIVILEGES ON TABLE Marcas,Colores,Productos,Existencias,Usuarios,Emisores,Couriers,Lugares,Compras,DetalleCompras,Carrito TO tienda;
GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public to tienda;

INSERT INTO Colores(color_nombre,color_codigo) VALUES('Blue','0000FF');
INSERT INTO Colores(color_nombre,color_codigo) VALUES('Amarillo','FFFF00');
INSERT INTO Colores(color_nombre,color_codigo) VALUES('Fuchsia','FF00FF');
INSERT INTO Colores(color_nombre,color_codigo) VALUES('Rojo','FF0000');
INSERT INTO Colores(color_nombre,color_codigo) VALUES('Verde','008000');

INSERT INTO Marcas(marca_nombre) VALUES('Adidas');
INSERT INTO Marcas(marca_nombre) VALUES('Nike');
INSERT INTO Marcas(marca_nombre) VALUES('Puma');
INSERT INTO Marcas(marca_nombre) VALUES('Everlast');

INSERT INTO Usuarios(usuario,nombre,password_usuario,role) VALUES ('diego','Diego Alejandro','1234',0)