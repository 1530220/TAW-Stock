CREATE TABLE categorias(
    id int PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(255),
    descripcion varchar(255),
    fecha_agregado date
);

CREATE TABLE productos(
  id int PRIMARY KEY AUTO_INCREMENT,
    codigo varchar(255),
    nombre varchar(255),
    fecha_agregado date,
    precio decimal(10,2),
    stock int,
    categoria int,
    ruta_img varchar(500),
    FOREIGN KEY (categoria) REFERENCES categorias(id)on delete cascade 
);

CREATE TABLE usuarios(
  id int PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(255),
    paterno varchar(255),
    materno varchar(255),
    nombre_usuario varchar(255),
  `password` varchar(255),
    correo varchar(255),
    fecha_registro date,
    ruta_img varchar(500)
);

CREATE TABLE historiales(
    id int PRIMARY key AUTO_INCREMENT,
    producto int,
    usuario int,
    fecha date,
    hora time,
    nota varchar(255),
    cantidad int,
    referencia varchar(255),
    tipo_registro varchar(255),
    FOREIGN KEY (producto) REFERENCES productos(id)on DELETE CASCADE,
    FOREIGN key (usuario) REFERENCES usuarios(id)on DELETE CASCADE
);