-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Fev-2019 às 01:06
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.0.31
DROP DATABASE IF EXISTS reunioa;
DROP DATABASE IF EXISTS reuniao;
CREATE DATABASE IF NOT EXISTS reuniao;
USE  reuniao;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gerenciador_reunioes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `inicio` datetime NOT NULL,
  `fim` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `horario`
--



-- --------------------------------------------------------

--
-- Estrutura da tabela `presidente`
--

CREATE TABLE `presidente` (
  `id_presidente` int(11) NOT NULL,
  `nome_presidente` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `presidente`
--

INSERT INTO `presidente` (`id_presidente`, `nome_presidente`) VALUES
(1, 'LANDRY PERREIRA DA SILVA'),
(2, 'ANDERSON WALBER DE JESUS BARBOSA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reunioes`
--

CREATE TABLE `reunioes` (
  `id_reuniao` int(11) NOT NULL,
  `data_reuniao` int(11) NOT NULL,
  `tipo_reuniao` int(11) NOT NULL,
  `status_reuniao` int(11) NOT NULL,
  `presidente_reuniao` int(11) NOT NULL,
  `participantes_reuniao` int(11) NOT NULL,
  `pauta` longtext NOT NULL,
  `deliberacoes` longtext NOT NULL,
  `observacoes` longtext NOT NULL,
  `participantes` longtext NOT NULL,
  `consolidado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `reunioes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL,
  `nome_tipo` varchar(55) NOT NULL,
  `cor` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nome_status` varchar(55) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `status` (`id_status`, `nome_status`) VALUES
(1, 'Aberta'),
(2, 'Consolidada');
--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `nome_tipo`,`cor`) VALUES
(1, 'Colegiado','#26A69A'),
(2, 'professores','Cyan');

--
-- Indexes for dumped tables
--
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(80) NOT NULL,
  `registro_usuario` varchar(11) NOT NULL,
  `email_usuario` varchar(80) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `lotacao` varchar(80) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `participantes` (
  `id_participacao` int(11) NOT NULL,
  `lista_participantes` varchar(120) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `presidente`
--
ALTER TABLE `presidente`
  ADD PRIMARY KEY (`id_presidente`);

--
-- Indexes for table `reunioes`
--
ALTER TABLE `reunioes`
  ADD PRIMARY KEY (`id_reuniao`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `presidente`
--
ALTER TABLE `presidente`
  MODIFY `id_presidente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reunioes`
--
ALTER TABLE `reunioes`
  MODIFY `id_reuniao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
