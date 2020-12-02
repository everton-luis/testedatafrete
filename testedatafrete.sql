-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Dez-2020 às 23:51
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `testedatafrete`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ceps`
--

CREATE TABLE `ceps` (
  `id` int(10) UNSIGNED NOT NULL,
  `altitude` double NOT NULL,
  `cep` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `bairro` varchar(150) NOT NULL,
  `cidade` varchar(150) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ceps`
--

INSERT INTO `ceps` (`id`, `altitude`, `cep`, `latitude`, `longitude`, `logradouro`, `bairro`, `cidade`, `estado`) VALUES
(5, 934, 80010060, -25.428, -49.2730996607, 'Travessa Jesuíno Marcondes', 'Centro', 'Curitiba', 'PR'),
(6, 934, 80020010, -25.4277299951, -49.2732989671, 'Praça General Osório', 'Centro', 'Curitiba', 'PR'),
(7, 10, 88340227, -27.0254884, -48.654703, 'Rua Goiania', 'Centro', 'Camboriú', 'SC'),
(8, 21, 89010020, -26.9190900076, -49.0661009453, 'Rua Ângelo Dias', 'Centro', 'Blumenau', 'SC'),
(9, 21, 89010000, -26.9189099917, -49.066, 'Rua 15 de Novembro', 'Centro', 'Blumenau', 'SC'),
(10, 21, 89010040, -26.9189099993, -49.0661009376, 'Rua Caetano Deeke', 'Centro', 'Blumenau', 'SC'),
(11, 21, 89010060, -26.9188199929, -49.0657981185, 'Rua Rodolfo Freygang', 'Centro', 'Blumenau', 'SC'),
(16, 61, 88816227, -28.7098624115, -49.3376350406, 'Rua Tico-Tico', 'Cristo Redentor', 'Criciúma', 'SC'),
(17, 934, 80010070, -25.4279099915, -49.2730996633, 'Rua Senador Alencar Guimarães', 'Centro', 'Curitiba', 'PR'),
(18, 3, 89216210, -26.3161500102, -48.846, 'Rua Silva Jardim', 'Glória', 'Joinville', 'SC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `viagens`
--

CREATE TABLE `viagens` (
  `id` int(10) UNSIGNED NOT NULL,
  `ceporigem_id` int(10) UNSIGNED DEFAULT NULL,
  `cepdestino_id` int(10) UNSIGNED DEFAULT NULL,
  `distancia` double NOT NULL,
  `hora_cadastro` datetime NOT NULL,
  `hora_alteracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ceps`
--
ALTER TABLE `ceps`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `viagens`
--
ALTER TABLE `viagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ceps_origem` (`ceporigem_id`),
  ADD KEY `fk_ceps_destino` (`cepdestino_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ceps`
--
ALTER TABLE `ceps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `viagens`
--
ALTER TABLE `viagens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `viagens`
--
ALTER TABLE `viagens`
  ADD CONSTRAINT `fk_ceps_destino` FOREIGN KEY (`cepdestino_id`) REFERENCES `ceps` (`id`),
  ADD CONSTRAINT `fk_ceps_origem` FOREIGN KEY (`ceporigem_id`) REFERENCES `ceps` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
