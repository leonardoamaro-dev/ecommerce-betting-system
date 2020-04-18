-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 04-Mar-2020 às 03:27
-- Versão do servidor: 10.4.10-MariaDB
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
-- Banco de dados: `clickspeed`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `preco` float NOT NULL,
  `estado` int(10) NOT NULL,
  `descrição` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `categoria` int(10) NOT NULL,
  `vendas` int(255) NOT NULL,
  `membro_id` int(255) NOT NULL,
  `tempo` int(255) NOT NULL,
  `restante` int(100) NOT NULL,
  `avaliacao` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `estado`, `descrição`, `tags`, `categoria`, `vendas`, `membro_id`, `tempo`, `restante`, `avaliacao`) VALUES
(1, 'Sony Smart TV - 2015', 1.25, 1, 'Semi usado, em perfeito estado, Campo Limpo SP, ', 'TELEVISÃO; BARATO; SEMI USADO; PERFEITO ESTADO', 1, 0, 1, 1583285538, 1583293219, 1),
(2, 'Iphone 6', 1, 1, 'Semi usado, em perfeito estado, Campo Limpo SP, ', 'TELEVISÃO; BARATO; SEMI USADO; PERFEITO ESTADO', 1, 0, 1, 1583285538, 1583289619, 5),
(3, 'Iphone 7', 1, 1, 'Semi usado, em perfeito estado, Campo Limpo SP, ', 'TELEVISÃO; BARATO; SEMI USADO; PERFEITO ESTADO', 1, 0, 1, 1583285584, 1583289619, 3),
(4, 'Iphone 8', 1, 1, 'Semi usado, em perfeito estado, Campo Limpo SP, ', 'TELEVISÃO; BARATO; SEMI USADO; PERFEITO ESTADO', 1, 0, 1, 1583285584, 1583289619, 4),
(5, 'Iphone 9', 1, 1, 'Semi usado, em perfeito estado, Campo Limpo SP, ', 'TELEVISÃO; BARATO; SEMI USADO; PERFEITO ESTADO', 1, 0, 1, 1583285596, 1583289619, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
