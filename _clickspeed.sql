-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 20-Abr-2020 às 00:59
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id12308239_clickspeed`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE `compras` (
  `id` int(50) NOT NULL,
  `member_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `time` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` float NOT NULL,
  `estado` int(10) NOT NULL,
  `descrição` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `categoria` int(10) NOT NULL,
  `vendas` int(255) NOT NULL,
  `membro_id` int(255) NOT NULL,
  `cronometo_status` int(10) NOT NULL,
  `tempo` int(255) NOT NULL,
  `restante` int(100) NOT NULL,
  `avaliacao` int(1) NOT NULL,
  `ganhador` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `estado`, `descrição`, `tags`, `categoria`, `vendas`, `membro_id`, `cronometo_status`, `tempo`, `restante`, `avaliacao`, `ganhador`) VALUES
(1, 'Sony Smart TV - 2015', 1.25, 1, 'Semi usado, em perfeito estado, Campo Limpo SP, ', 'TELEVISÃO; BARATO; SEMI USADO; PERFEITO ESTADO', 1, 0, 1, 0, 1585966135, 1585971853, 1, 0),
(2, 'Iphone 6', 1, 1, 'Semi usado, em perfeito estado, Campo Limpo SP, ', 'TELEVISÃO; BARATO; SEMI USADO; PERFEITO ESTADO', 1, 0, 1, 0, 1583285538, 1583289619, 5, 0),
(3, 'Iphone 7', 1, 1, 'Semi usado, em perfeito estado, Campo Limpo SP, ', 'TELEVISÃO; BARATO; SEMI USADO; PERFEITO ESTADO', 1, 0, 1, 0, 1583285584, 1583289619, 3, 0),
(4, 'Iphone 8', 1, 1, 'Semi usado, em perfeito estado, Campo Limpo SP, ', 'TELEVISÃO; BARATO; SEMI USADO; PERFEITO ESTADO', 1, 0, 1, 0, 1583285584, 1585971853, 4, 3),
(5, 'Iphone 9', 1, 1, 'Semi usado, em perfeito estado, Campo Limpo SP, ', 'TELEVISÃO; BARATO; SEMI USADO; PERFEITO ESTADO', 1, 0, 1, 0, 1585964935, 1585971853, 2, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `celular` varchar(255) NOT NULL,
  `end` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cid` varchar(255) CHARACTER SET utf8 NOT NULL,
  `est` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `verificada` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `email`, `senha`, `nome`, `sobrenome`, `celular`, `end`, `cid`, `est`, `cep`, `verificada`, `code`, `time`) VALUES
(3, 'la95112@gmail.com', '$2y$10$nQVsxbuzJ9Ek.au8asPxweGtzHteLUplU2KLBcHaYJKZJ0B.0NJBe', 'Leonardo', 'Amaro', '11452840461', 'rua floriano peixoto', 'cabreÃºva', 'SP', '13318-000', 1, '$2y$10$jF7Ngb/FJLitTZcc30JEi.0S3.vsN/D7B45bwidgvWp6EaEPEs3RG', 1585971688);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
