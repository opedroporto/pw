-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Mar-2023 às 04:11
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crud`
--
USE crud;
-- --------------------------------------------------------

--
-- Estrutura da tabela `brinquedos`
--

CREATE TABLE `brinquedos` (
  `id` int(11) NOT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `marca` varchar(40) DEFAULT NULL,
  `faixa_etaria` int(11) DEFAULT NULL,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `brinquedos`
--

INSERT INTO `brinquedos` (`id`, `modelo`, `marca`, `faixa_etaria`, `data_cad`, `foto`) VALUES
(1, 'carrinho', 'Hot Wheels', 2, '2023-05-08 19:30:00', 'hotwheels.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `title`, `created`) VALUES
(1, 'John Doe', 'johndoe@example.com', '2026550143', 'Lawyer', '2019-05-08 17:32:00'),
(2, 'David Deacon', 'daviddeacon@example.com', '2025550121', 'Employee', '2019-05-08 17:28:44'),
(3, 'Sam White', 'samwhite@example.com', '2004550121', 'Employee', '2019-05-08 17:29:27'),
(4, 'Colin Chaplin', 'colinchaplin@example.com', '2022550178', 'Supervisor', '2019-05-08 17:29:27'),
(5, 'Ricky Waltz', 'rickywaltz@example.com', '7862342390', '', '2019-05-09 19:16:00'),
(6, 'Arnold Hall', 'arnoldhall@example.com', '5089573579', 'Manager', '2019-05-09 19:17:00'),
(7, 'Toni Adams', 'alvah1981@example.com', '2603668738', '', '2019-05-09 19:19:00'),
(8, 'Donald Perry', 'donald1983@example.com', '7019007916', 'Employee', '2019-05-09 19:20:00'),
(9, 'Joe McKinney', 'nadia.doole0@example.com', '6153353674', 'Employee', '2019-05-09 19:20:00'),
(10, 'Angela Horst', 'angela1977@example.com', '3094234980', 'Assistant', '2019-05-09 19:21:00'),
(11, 'James Jameson', 'james1965@example.com', '4002349823', 'Assistant', '2019-05-09 19:32:00'),
(12, 'Daniel Deacon', 'danieldeacon@example.com', '5003423549', 'Manager', '2019-05-09 19:33:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(15) NOT NULL,
  `birthdate` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `ie` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `customers`
--

INSERT INTO `customers` (`id`, `name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
(26, 'Ciclano de Tal', '12345678900', '1989-01-01 00:00:00', 'Rua da Web, 123', 'Internet', '1234568', 'Teste', 'Te', '55555555555', '55555555555', '123456', '2016-05-24 00:00:00', '2023-03-25 19:07:05'),
(29, 'Nicolas', '21312893129', '2006-01-15 00:00:00', 'Rua Thomas Maelo', 'Santo Amadre Paulinha', '18058200', 'Sorocaba', 'RJ', '1598465615', '15998465615', '12345678900000', '2022-09-22 15:00:11', '2022-10-02 13:30:58'),
(30, 'Joãozin', '12345678901234', '2022-10-13 00:00:00', 'Rua das Pedras', 'Bairro da Lagoa', '12345678', 'Sorocaba', 'SP', '15995477632', '1595477632', '12345678901234', '2022-10-02 13:27:06', '2022-10-02 13:27:06'),
(31, 'Pedro', '12345678910', '2006-10-20 00:00:00', 'Rua Joaquim', 'Santa Helena', '18059300', 'Sorocaba', 'SP', '1596424576', '15996424576', '12345678901234', '2022-10-02 13:32:29', '2022-10-02 13:32:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `motos`
--

CREATE TABLE `motos` (
  `id` int(11) NOT NULL,
  `codigo` bigint(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `fabricante` varchar(50) NOT NULL,
  `ano` int(11) NOT NULL,
  `preco` int(11) NOT NULL,
  `cores` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `fabricacao` date NOT NULL,
  `modificado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `motos`
--

INSERT INTO `motos` (`id`, `codigo`, `nome`, `fabricante`, `ano`, `preco`, `cores`, `imagem`, `fabricacao`, `modificado`) VALUES
(8, 12345678901, 'GS', 'BMW', 2013, 180000, 'preto e azul', 'gs.jpg', '2012-04-02', '2023-03-25 19:05:18'),
(9, 21434243244, 'Biz', 'Honda', 2023, 13110, 'Prata fosco', 'biz.png', '2022-09-13', '2022-09-28 00:09:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `user`, `password`, `foto`) VALUES
(1, 'admin', 'admin', '$2a$08$Cf1f11ePArKlBJomM0F6a.KIBpTt.7gUCjwtRFml4pSQHfIV0USPW', 'php.png'),
(2, 'Mary Zica', 'mazi', '786098767869', 'semImagem.png'),
(4, 'Fugiru Nakombi', 'fugina', '623485634753234', 'semImagem.png'),
(20, 'daffy duck', 'patolino', '$2a$08$Cf1f11ePArKlBJomM0F6a.6yCTSaj7wsFoeMW/FggCw8kpn9iwKcS', 'patolino.png'),
(23, 'user', 'user', '$2a$08$Cf1f11ePArKlBJomM0F6a.M7/9f0rCdTfJPirJSaBtCUKZp.dFnBO', 'semImagem.png'),
(24, 'usuario', 'usuario', '$2a$08$Cf1f11ePArKlBJomM0F6a.0lDe27qIeA2.2klznliNan//t9D4OT2', 'hamburguer.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `brinquedos`
--
ALTER TABLE `brinquedos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `motos`
--
ALTER TABLE `motos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `brinquedos`
--
ALTER TABLE `brinquedos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `motos`
--
ALTER TABLE `motos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
