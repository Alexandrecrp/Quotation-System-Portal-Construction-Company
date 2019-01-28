-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Jul-2018 às 04:51
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logsystem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) DEFAULT NULL,
  `idprincipal` int(11) DEFAULT NULL,
  `cliente_campo1` varchar(100) DEFAULT NULL,
  `cliente_campo2` varchar(100) DEFAULT NULL,
  `cliente_campo3` varchar(50) DEFAULT NULL,
  `cliente_campo4` varchar(50) DEFAULT NULL,
  `cliente_campo5` varchar(50) DEFAULT NULL,
  `cliente_campo6` varchar(50) DEFAULT NULL,
  `cliente_campo7` varchar(50) DEFAULT NULL,
  `cliente_campo8` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) DEFAULT NULL,
  `idprincipal` int(11) NOT NULL,
  `fornecedor_campo1` varchar(100) DEFAULT NULL,
  `fornecedor_campo2` varchar(100) DEFAULT NULL,
  `fornecedor_campo3` varchar(50) DEFAULT NULL,
  `fornecedor_campo4` varchar(50) DEFAULT NULL,
  `fornecedor_campo5` varchar(50) DEFAULT NULL,
  `fornecedor_campo6` varchar(50) DEFAULT NULL,
  `fornecedor_campo7` varchar(50) DEFAULT NULL,
  `fornecedor_campo8` varchar(50) DEFAULT NULL,
  `fornecedor_campo9` varchar(50) DEFAULT NULL,
  `fornecedor_campo10` varchar(50) DEFAULT NULL,
  `fornecedor_campo11` varchar(50) DEFAULT NULL,
  `fornecedor_campo12` varchar(50) DEFAULT NULL,
  `fornecedor_campo13` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) DEFAULT NULL,
  `idprincipal` int(11) NOT NULL,
  `produto_campo1` varchar(100) NOT NULL,
  `produto_campo2` varchar(100) NOT NULL,
  `produto_campo3` varchar(50) DEFAULT NULL,
  `produto_campo4` varchar(50) DEFAULT NULL,
  `produto_campo5` varchar(50) DEFAULT NULL,
  `produto_campo6` varchar(50) DEFAULT NULL,
  `produto_campo7` varchar(50) DEFAULT NULL,
  `produto_campo8` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `senha`
--

CREATE TABLE `senha` (
  `us_cod` int(11) NOT NULL,
  `us_senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `senha`
--

INSERT INTO `senha` (`us_cod`, `us_senha`) VALUES
(1, '2982c3d0adde4c20d6c9a116abee2d68');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `us_cod` int(11) NOT NULL,
  `us_nome` varchar(100) NOT NULL,
  `us_email` varchar(100) NOT NULL,
  `us_sexo` varchar(1) NOT NULL,
  `us_data` date NOT NULL,
  `us_hora` time NOT NULL,
  `us_ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`us_cod`, `us_nome`, `us_email`, `us_sexo`, `us_data`, `us_hora`, `us_ip`) VALUES
(1, 'Alexandre', 'alexandrecrp202@gmail.com', 'm', '2018-04-23', '01:55:50', '::1'),
(2, 'meikan', 'meikan@lixao.com.br', 'm', '2018-04-27', '03:50:50', '::1'),
(3, 'Alexandre Rodrigues', 'alexandrecrpfeedback@gmail.com', 'm', '2018-05-02', '10:37:25', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senha`
--
ALTER TABLE `senha`
  ADD PRIMARY KEY (`us_cod`),
  ADD KEY `fk_senha_usuario_idx` (`us_cod`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`us_cod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `us_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `senha`
--
ALTER TABLE `senha`
  ADD CONSTRAINT `fk_senha_usuario` FOREIGN KEY (`us_cod`) REFERENCES `usuario` (`us_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
