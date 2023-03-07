-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:3306
-- 產生時間： 2023 年 03 月 07 日 06:32
-- 伺服器版本： 8.0.32-0ubuntu0.20.04.2
-- PHP 版本： 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `slim_project`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `account` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `admins`
--

INSERT INTO `admins` (`id`, `name`, `account`, `password`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- 資料表結構 `client`
--

CREATE TABLE `client` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `phone` int NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telephone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `seller_id` int DEFAULT NULL,
  `amount` int NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`id`, `name`, `telephone`, `phone`, `seller_id`, `amount`, `order_time`, `note`) VALUES
(2, 'test', '', '09', 11, 1, '2022-12-05 14:02:55', NULL),
(4, 'test', '', '0912321', 8, 0, '2022-12-05 14:02:55', NULL),
(5, 'yu-an shen', '', '0952239458', 8, 1, '2022-12-05 14:02:55', NULL),
(6, 'yu-an shen', '', '0952239458', 0, 1, '2022-12-05 14:02:55', NULL),
(8, 'yu-an shen', '', '0952239458', 11, 2, '2022-12-05 14:02:55', NULL),
(9, 'yu-an shen', '', '0952239458', 11, 1, '2022-12-05 14:02:55', NULL),
(11, 'yu-an shen', '', '0952239458', 8, 2, '2022-12-05 14:02:55', NULL),
(12, 'dsadasdas', 'dasasda', 'asdasdasd', 8, 213123, '2023-03-04 13:21:55', 'asdadsa'),
(13, 'qweqewq', '', '7878', 8, 2, '2023-03-04 21:26:01', ''),
(14, 'resersrertest', '', '12121212', 0, 1, '2023-03-04 22:06:00', ''),
(15, 'admin', '', '0952239458', 11, 4, '2023-03-04 22:06:16', 'qweqweqeqweqw'),
(16, 'test', '', '12312312', 11, 213123, '2023-03-05 07:14:49', ''),
(17, 'test', '', '0952239458', 8, 2, '2023-03-05 07:15:17', ''),
(18, 'tret', '', '92323946', 8, 213123, '2023-03-05 07:17:30', ''),
(19, 'test', '', '0952239458', 8, 2, '2023-03-05 09:13:59', ''),
(20, '沈育安', '', '0952239458', 8, 2, '2023-03-05 09:14:29', ''),
(21, 'test', '', '0952239458', 8, 2, '2023-03-06 04:14:22', ''),
(22, '沈育安', '', '0952239458', 8, 2, '2023-03-06 04:24:03', ''),
(23, '沈育安', '', '0952239458', 8, 2, '2023-03-06 04:24:09', ''),
(24, '沈育安', '', '0952239458', 8, 2, '2023-03-06 04:24:11', ''),
(25, '沈育安', '', '0952239458', 8, 2, '2023-03-06 04:24:14', ''),
(26, '沈育安', '', '0952239458', 8, 2, '2023-03-06 04:24:25', ''),
(27, '沈育安', '', '0952239458', 8, 213123, '2023-03-06 04:28:50', 'asdfasfds');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `size` text NOT NULL,
  `price` int NOT NULL,
  `amount` int DEFAULT NULL,
  `order_index` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `size`, `price`, `amount`, `order_index`) VALUES
(3, 'PP700', 100, NULL, 1),
(5, 'PP660', 50, NULL, 2),
(6, 'PP550', 25, NULL, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `seller`
--

CREATE TABLE `seller` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `phone` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `seller`
--

INSERT INTO `seller` (`id`, `name`, `phone`) VALUES
(8, 'edit_seller9', 912312),
(11, 'test', 192);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `client`
--
ALTER TABLE `client`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
