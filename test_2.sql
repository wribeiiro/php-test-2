-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 14/12/2020 às 23:37
-- Versão do servidor: 8.0.22-0ubuntu0.20.04.3
-- Versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `test_2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `product_type_id` int NOT NULL,
  `price` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `description`, `product_type_id`, `price`, `created_at`, `updated_at`) VALUES
(4, 'New product', 1, '234.0000', '2020-12-14 16:34:09', NULL),
(5, 'test OK', 1, '45.0000', '2020-12-14 16:38:11', '2020-12-14 16:57:47'),
(21, 'test', 5, '34.0000', '2020-12-14 20:39:43', NULL),
(22, 'Test', 5, '50.0000', '2020-12-14 22:08:27', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `products_type`
--

CREATE TABLE `products_type` (
  `id` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `tax_percentage` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `products_type`
--

INSERT INTO `products_type` (`id`, `description`, `tax_percentage`, `created_at`, `updated_at`) VALUES
(1, 'Product Type Default', '15.0000', '2020-12-14 09:31:37', '2020-12-14 17:29:23'),
(3, 'Default 2', '45.0000', '2020-12-14 17:27:46', NULL),
(5, 'tetst', '5.0000', '2020-12-14 20:36:52', '2020-12-14 22:57:01'),
(6, 'asdfads', '43.0000', '2020-12-14 20:39:06', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sales`
--

CREATE TABLE `sales` (
  `id` int NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `total_price` decimal(11,4) DEFAULT '0.0000',
  `total_tax` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `sales`
--

INSERT INTO `sales` (`id`, `client_name`, `total_price`, `total_tax`, `created_at`, `updated_at`) VALUES
(1, 'CLIENT TEST', '5.0000', '5.0000', '2020-12-14 09:32:27', '2020-12-14 22:57:27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sales_item`
--

CREATE TABLE `sales_item` (
  `id` int NOT NULL,
  `sale_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` decimal(11,4) DEFAULT '0.0000',
  `price` decimal(11,4) DEFAULT '0.0000',
  `tax` decimal(11,4) DEFAULT '0.0000',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `sales_item`
--

INSERT INTO `sales_item` (`id`, `sale_id`, `product_id`, `quantity`, `price`, `tax`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '1.0000', '5.0000', '5.0000', '2020-12-14 10:07:27', '2020-12-14 23:04:49');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Índices de tabela `products_type`
--
ALTER TABLE `products_type`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sales_item`
--
ALTER TABLE `sales_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `products_type`
--
ALTER TABLE `products_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `sales_item`
--
ALTER TABLE `sales_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_type_id`) REFERENCES `products_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `sales_item`
--
ALTER TABLE `sales_item`
  ADD CONSTRAINT `sales_item_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
