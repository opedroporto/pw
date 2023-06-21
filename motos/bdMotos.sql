USE wda_crud;

CREATE TABLE motos (
  id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  codigo int(11) NOT NULL,
  nome varchar(50) NOT NULL,
  fabricante varchar(50) NOT NULL,
  ano int(11) NOT NULL,
  preco int(11) NOT NULL,
  cores varchar(50) NOT NULL,
  imagem varchar(30) NOT NULL,
  fabricacao date NOT NULL,
  modificado datetime NOT NULL
);