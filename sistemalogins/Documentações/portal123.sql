-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 179.188.16.22
-- Generation Time: 28-Jan-2019 às 14:51
-- Versão do servidor: 5.6.35-81.0-log
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal123`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `idprincipal` int(11) DEFAULT NULL,
  `cliente_campo1` varchar(200) DEFAULT NULL,
  `cliente_campo2` varchar(200) DEFAULT NULL,
  `cliente_campo3` varchar(200) DEFAULT NULL,
  `cliente_campo4` varchar(200) DEFAULT NULL,
  `cliente_campo5` varchar(200) DEFAULT NULL,
  `cliente_campo6` varchar(200) DEFAULT NULL,
  `cliente_campo7` varchar(200) DEFAULT NULL,
  `cliente_campo8` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `formadepagamento`
--

CREATE TABLE `formadepagamento` (
  `id` int(11) NOT NULL,
  `idprincipal` int(11) NOT NULL,
  `idfornecedor` int(11) NOT NULL,
  `qtdparcela` varchar(50) NOT NULL,
  `datavencparcela` varchar(50) NOT NULL,
  `contatovendedor` varchar(50) NOT NULL,
  `prazoentrega` varchar(50) NOT NULL,
  `precoavista` varchar(50) NOT NULL,
  `precoaprazo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `idprincipal` int(11) NOT NULL,
  `fornecedor_campo1` varchar(200) DEFAULT NULL,
  `fornecedor_campo2` varchar(200) NOT NULL,
  `fornecedor_campo3` varchar(200) DEFAULT NULL,
  `fornecedor_campo4` varchar(200) DEFAULT NULL,
  `fornecedor_campo5` varchar(200) DEFAULT NULL,
  `fornecedor_campo6` varchar(200) DEFAULT NULL,
  `fornecedor_campo7` varchar(200) DEFAULT NULL,
  `fornecedor_campo8` varchar(200) DEFAULT NULL,
  `fornecedor_campo9` varchar(200) DEFAULT NULL,
  `fornecedor_campo10` varchar(200) DEFAULT NULL,
  `fornecedor_campo11` varchar(200) DEFAULT NULL,
  `fornecedor_campo12` varchar(200) DEFAULT NULL,
  `fornecedor_campo13` varchar(200) DEFAULT NULL,
  `fornecedor_campo14` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `idprincipal` int(11) NOT NULL,
  `produto_campo1` varchar(200) DEFAULT NULL,
  `produto_campo2` varchar(200) DEFAULT NULL,
  `produto_campo3` varchar(200) DEFAULT NULL,
  `produto_campo4` varchar(200) DEFAULT NULL,
  `produto_campo5` varchar(200) DEFAULT NULL,
  `produto_campo6` varchar(200) DEFAULT NULL,
  `produto_campo7` varchar(200) DEFAULT NULL,
  `produto_campo8` varchar(200) DEFAULT NULL,
  `produto_campo9` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtofornecedor`
--

CREATE TABLE `produtofornecedor` (
  `id` int(11) NOT NULL,
  `idprincipal` int(11) NOT NULL,
  `idfornecedor` int(11) NOT NULL,
  `produtofornecedor_campo1` varchar(200) DEFAULT NULL,
  `produtofornecedor_campo2` varchar(200) DEFAULT NULL,
  `produtofornecedor_campo3` varchar(200) DEFAULT NULL,
  `produtofornecedor_campo4` varchar(200) DEFAULT NULL,
  `produtofornecedor_campo5` varchar(200) DEFAULT NULL,
  `produtofornecedor_campo6` varchar(200) DEFAULT NULL,
  `produtofornecedor_campo7` varchar(200) DEFAULT NULL,
  `produtofornecedor_campo8` varchar(200) DEFAULT NULL,
  `produtofornecedor_campo9` varchar(50) DEFAULT NULL,
  `produtofornecedor_campo10` varchar(50) DEFAULT NULL,
  `produtofornecedor_campo11` varchar(300) DEFAULT NULL,
  `produtofornecedor_campo12` datetime DEFAULT NULL
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
(1, '7ee9c4f86007ba41bc79bbfab1cd8a68'),
(5, '6f70270c4850b5a1f32bb534160128cd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `travafornecedor`
--

CREATE TABLE `travafornecedor` (
  `id` int(11) NOT NULL,
  `idprincipal` varchar(100) NOT NULL,
  `idfornecedor` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `us_cod` int(11) NOT NULL,
  `us_nome` varchar(100) NOT NULL,
  `us_email` varchar(100) NOT NULL,
  `us_tipo` varchar(1) DEFAULT NULL,
  `us_data` date NOT NULL,
  `us_hora` time NOT NULL,
  `us_ip` varchar(50) NOT NULL,
  `us_idfornecedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`us_cod`, `us_nome`, `us_email`, `us_tipo`, `us_data`, `us_hora`, `us_ip`, `us_idfornecedor`) VALUES
(1, 'Portal', 'compras1@portalconstrutora.com.br', 'M', '2018-04-23', '01:55:50', '::1', 0),
(5, 'Alexandrecrp', 'alexandrecrpfeedback@gmail.com', 'M', '2018-08-18', '06:21:09', '::1', 804);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formadepagamento`
--
ALTER TABLE `formadepagamento`
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
-- Indexes for table `produtofornecedor`
--
ALTER TABLE `produtofornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senha`
--
ALTER TABLE `senha`
  ADD PRIMARY KEY (`us_cod`),
  ADD KEY `fk_senha_usuario_idx` (`us_cod`);

--
-- Indexes for table `travafornecedor`
--
ALTER TABLE `travafornecedor`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `formadepagamento`
--
ALTER TABLE `formadepagamento`
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
-- AUTO_INCREMENT for table `produtofornecedor`
--
ALTER TABLE `produtofornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travafornecedor`
--
ALTER TABLE `travafornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `us_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
