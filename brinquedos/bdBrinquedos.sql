SET @@global.time_zone = '+3:00';

CREATE TABLE brinquedos (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    modelo VARCHAR(50),
    marca VARCHAR (40),
    faixa_etaria INT,
    data_cad DATETIME NOT NULL DEFAULT current_timestamp(),
    foto VARCHAR(30)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO brinquedos (modelo, marca, faixa_etaria, data_cad, foto) VALUES
    ('carrinho', 'Hot Wheels', 2, '2023-05-08 19:30:00', 'hotwheels.jpg');