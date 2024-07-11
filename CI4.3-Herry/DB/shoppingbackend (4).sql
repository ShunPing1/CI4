-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024-07-11 17:33:12
-- 伺服器版本： 8.0.36
-- PHP 版本： 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shoppingbackend`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admindata`
--

CREATE TABLE `admindata` (
  `a_ID` tinyint UNSIGNED NOT NULL,
  `a_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_level` enum('admin','vice admin','ordinary') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ordinary',
  `a_jointime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `admindata`
--

INSERT INTO `admindata` (`a_ID`, `a_name`, `a_username`, `a_password`, `a_email`, `a_level`, `a_jointime`) VALUES
(1, 'Admin123', 'admin', '$2y$10$Pi7pP6rHdFzN.hWa23YZlOkF09Y.dHKtd3uzWT3tPApyzWClEqzBy', 'aassx1004@gmail.com', 'admin', '2024-06-03 16:51:31'),
(8, 'test1', 'test1', '$2y$10$QYh.lBWazZiDdhsQbWUXxe1Z5ISCwvBChP/mlLHPO/w64JqyiDy.S', 'test1@gmail.com', 'ordinary', '2024-06-04 11:31:54'),
(9, 'test2', 'test2', '$2y$10$a6obZcZvkS0kAXP8S07BTeGNxInQ/A72Q9vbrx1fMIX1XY1Tgw4PG', 'test2@gmail.com', 'ordinary', '2024-06-04 11:32:24'),
(10, 'test3', 'test3', 'test3', 'test3@gmail.com', 'ordinary', '2024-06-04 11:32:53'),
(11, 'test4', 'test4', 'test4', 'test4@gmail.com', 'ordinary', '2024-06-04 11:32:53'),
(14, 'test5', 'test5', '$2y$10$nqpamd9fvI4zDP/nUJcIyu2EcFMKesoTcPJfBb/B6JhrjzY7bw8sG', 'test5@gmail.com', 'ordinary', '2024-06-27 14:39:43'),
(15, 'test6', 'test6', '$2y$10$Pm3gIXEbKSW2FTypB52NjuasNFh7mtP2eq6xfVsH.3vpLC6aBRSqW', 'test6@gmail.com', 'ordinary', '2024-06-27 14:40:15'),
(16, 'test7', 'test7', '$2y$10$Izie9rk5kmhb.vZvcHuJ1.b9a1DqEqmiDhUFspvNtlRqHzyNK1bA2', 'test7@gmail.com', 'ordinary', '2024-06-27 14:40:45'),
(17, 'test8', 'test8', '$2y$10$iUeYdPn1gUczio2AappHoeJJsW9EZLoMLNIVAtVnjc7Nkfv80YuF.', 'test8@gmail.com', 'ordinary', '2024-06-27 14:40:58'),
(18, 'test9', 'test9', '$2y$10$GBgXIfu2gZ7cQ6JOnvIRmeD1c5TlGbJXgCwhKoyQtE/wACuBaj96e', 'test9@gmail.com', 'ordinary', '2024-06-27 14:42:03'),
(19, 'test10', 'test10', '$2y$10$Fdc.5INyNGlwYSjhizpbqejAlpy0JBzyyzUhI/W/Y1lN4MK092PgW', 'test10@gmail.com', 'ordinary', '2024-06-27 16:02:11'),
(20, 'test11', 'test11', '$2y$10$dyknfr8ucH4s1jfJEaU.JuXP3EL/3dvXD/8PL3nU1Vio9xVBx2zEm', 'test11@gmail.com', 'ordinary', '2024-07-05 10:41:51'),
(21, 'test12', 'test12', '$2y$10$cK.Fgc/uUfnCFTTNtntR2eCX.Hi4pszfiiBRv/tQh.iaPhqZwYlyW', 'test12@gmail.com', 'ordinary', '2024-07-05 10:43:31');

-- --------------------------------------------------------

--
-- 資料表結構 `category`
--

CREATE TABLE `category` (
  `categoryID` int UNSIGNED NOT NULL,
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorySort` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `categorySort`) VALUES
(60, '衣', 1),
(64, '褲', 2),
(65, '長褲', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `favourite`
--

CREATE TABLE `favourite` (
  `f_ID` tinyint UNSIGNED NOT NULL,
  `m_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `favourite`
--

INSERT INTO `favourite` (`f_ID`, `m_username`, `sID`) VALUES
(223, 'member6', 173),
(230, 'member3', 180),
(231, 'member3', 172),
(232, 'member3', 174),
(233, 'member3', 153),
(234, 'member3', 154),
(235, 'member3', 175),
(236, 'member3', 173),
(237, 'member3', 178),
(238, 'member3', 177);

-- --------------------------------------------------------

--
-- 資料表結構 `memberdata`
--

CREATE TABLE `memberdata` (
  `m_ID` int NOT NULL,
  `m_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `m_sex` enum('男','女') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '男',
  `m_birthday` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_login` int NOT NULL DEFAULT '0',
  `m_jointime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `memberdata`
--

INSERT INTO `memberdata` (`m_ID`, `m_name`, `m_username`, `m_password`, `m_sex`, `m_birthday`, `m_email`, `m_phone`, `m_address`, `m_login`, `m_jointime`) VALUES
(2, 'Alice', 'Alice123', '$2y$10$V3TFU/apRve0vpnpocgyFO.kBcbxKsKXfYIYobEVZdKsPdjbX5r4G', '女', '2001-07-05', 'alice123@gmail.com', '0968458456', 'XO市OX區XO路00號', 28, '2024-05-30 12:11:19'),
(3, 'Chris', 'Chris123', '$2y$10$FXEYf0GTtgp3ctf1WKL8q.kcB5Pcw8qVXKGo9ShqCqggS4Bh1yxbC', '男', '1965-04-23', 'chris@gmail.com', '0957635624', '', 1, '2024-05-30 16:53:53'),
(11, 'member2', 'member2', '$2y$10$hvHygrIwK/RWX/BHQRODUeIOsBX7QwjMzC1xHI9CmU.tb8VxsoUyq', '男', '', 'member2@gmail.com', '', '', 0, '2024-06-03 08:50:41'),
(12, 'member3', 'member3', '$2y$10$k9vVveJMFr0wRwpwUhUQp.Vcxn1sbtCZY1FDYr60g6IOu41NwIOnK', '男', '1998/10/04', 'aassx1004@gmail.com', '0956485412', 'OOOOOOOOOOOOOO', 5, '2024-06-03 08:50:55'),
(20, 'member6', 'member6', '$2y$10$Fxme.Bb4sdlhRo.NAETMSe4621Zvu9lp5MieyYhMfRvXqoV8i0y.y', '女', '', 'member6@gmail.com', '', '', 0, '2024-07-04 16:58:56'),
(21, 'member4', 'member4', '$2y$10$9NT6IjdMHQSl8BMpv7Zt8.nt1Kax5zHlET8Drjg9/xHsdVr5evrk.', '男', '', 'member4@gmail.com', '', '', 0, '2024-07-04 17:01:07');

-- --------------------------------------------------------

--
-- 資料表結構 `order_detail`
--

CREATE TABLE `order_detail` (
  `od_id` int NOT NULL,
  `sID` int UNSIGNED NOT NULL,
  `od_price` int UNSIGNED NOT NULL,
  `od_quantity` int UNSIGNED NOT NULL,
  `od_format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `order_info`
--

CREATE TABLE `order_info` (
  `oi_ID` tinyint UNSIGNED NOT NULL,
  `m_ID` int UNSIGNED NOT NULL,
  `total_price` int UNSIGNED NOT NULL,
  `order_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buy_time` datetime NOT NULL,
  `send_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_postal` int UNSIGNED NOT NULL,
  `buyer_addr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `order_state`
--

CREATE TABLE `order_state` (
  `os_ID` tinyint UNSIGNED NOT NULL,
  `os_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `os_sort` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `order_state`
--

INSERT INTO `order_state` (`os_ID`, `os_name`, `os_sort`) VALUES
(1, '待付款', 1),
(2, '待出貨', 2),
(3, '待收貨', 3),
(4, '已完成', 4),
(5, '退貨/款', 5),
(7, '失敗', 6);

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `sID` tinyint UNSIGNED NOT NULL,
  `categoryID` int UNSIGNED NOT NULL DEFAULT '1',
  `subcategoryID` int UNSIGNED NOT NULL,
  `sSort` int DEFAULT NULL,
  `sIMG` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sOri_Price` int UNSIGNED NOT NULL,
  `sDiscount` int UNSIGNED NOT NULL,
  `sNarrate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sContent1` text COLLATE utf8mb4_unicode_ci,
  `sContent2` text COLLATE utf8mb4_unicode_ci,
  `sContent3` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`sID`, `categoryID`, `subcategoryID`, `sSort`, `sIMG`, `sName`, `sOri_Price`, `sDiscount`, `sNarrate`, `sContent1`, `sContent2`, `sContent3`) VALUES
(153, 60, 4, 5, '_CR836_color_3.jpeg', '護理衣(二)', 111, 111, '111', '', '', ''),
(154, 60, 7, 1, '_CR836_color_3.jpeg', '護理衣(一)', 111, 111, '111', '', '', ''),
(155, 60, 4, 12, '_CR836_color_4.jpeg', '護理衣(三)', 111, 111, '111', '', '', ''),
(160, 64, 5, 16, 'TOP.png', '褲子', 111, 111, '111', '', '', ''),
(172, 64, 5, -6, '_CR852_viewer_1.jpeg', '123', 340, 150, '11321321321', '13213131', '3321313213', '13213131'),
(173, 64, 3, -2, '_CR852_viewer_1.jpeg', '褲2', 180, 300, '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate non quam, unde consectetur incidunt quisquam sed, ea quaerat tenetur facilis obcaecati eveniet hic eligendi! Cum at exercitationem eius officiis magnam.\r\n', '', '', ''),
(174, 60, 7, 1, '_CR836_color_4.jpeg', '衣1', 150, 300, '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate non quam, unde consectetur incidunt quisquam sed, ea quaerat tenetur facilis obcaecati eveniet hic eligendi! Cum at exercitationem eius officiis magnam.\r\n', '', '', ''),
(175, 60, 4, 0, '_CR836_color_4.jpeg', '護理衣', 300, 120, '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate non quam, unde consectetur incidunt quisquam sed, ea quaerat tenetur facilis obcaecati eveniet hic eligendi! Cum at exercitationem eius officiis magnam.\r\n', '', '', ''),
(176, 65, 6, 1, '_CR816_viewer_1.jpeg', '長褲', 300, 550, '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate non quam, unde consectetur incidunt quisquam sed, ea quaerat tenetur facilis obcaecati eveniet hic eligendi! Cum at exercitationem eius officiis magnam.\r\n', '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate non quam, unde consectetur incidunt quisquam sed, ea quaerat tenetur facilis obcaecati eveniet hic eligendi! Cum at exercitationem eius officiis magnam.\r\n', '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate non quam, unde consectetur incidunt quisquam sed, ea quaerat tenetur facilis obcaecati eveniet hic eligendi! Cum at exercitationem eius officiis magnam.\r\n', '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate non quam, unde consectetur incidunt quisquam sed, ea quaerat tenetur facilis obcaecati eveniet hic eligendi! Cum at exercitationem eius officiis magnam.\r\n'),
(177, 64, 5, -3, '_CR852_viewer_1.jpeg', '長褲-3', 280, 450, '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate non quam, unde consectetur incidunt quisquam sed, ea quaerat tenetur facilis obcaecati eveniet hic eligendi! Cum at exercitationem eius officiis magnam.\r\n', '', '', ''),
(178, 65, 6, 0, '_CR816_viewer_1.jpeg', 'test長褲', 300, 500, '13131132', '', '', ''),
(180, 64, 3, -4, '136473511_m_normal_none.jpg', '褲子', 380, 120, '褲子', '', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `sc_ID` tinyint UNSIGNED NOT NULL,
  `sc_IMG` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sc_format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sc_discount` int UNSIGNED NOT NULL,
  `sc_amount` int UNSIGNED NOT NULL,
  `m_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `shopping_cart`
--

INSERT INTO `shopping_cart` (`sc_ID`, `sc_IMG`, `sc_name`, `sc_format`, `sc_discount`, `sc_amount`, `m_username`, `sID`) VALUES
(61, '_CR836_color_3.jpeg', '111', '規格D-2', 111, 2, 'Alice123', 153),
(108, '_CR836_color_2.jpeg', '123', '規格A-1', 1312313, 3, 'Alice123', 172);

-- --------------------------------------------------------

--
-- 資料表結構 `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategoryID` tinyint UNSIGNED NOT NULL,
  `subcategoryName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategorySort` int UNSIGNED NOT NULL,
  `categoryID` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `subcategory`
--

INSERT INTO `subcategory` (`subcategoryID`, `subcategoryName`, `subcategorySort`, `categoryID`) VALUES
(1, '衣-111', 1, 60),
(3, '褲-1', 3, 64),
(4, '護理衣', 4, 60),
(5, '護理褲', 5, 64),
(6, '長褲-1', 6, 65),
(7, '長袖衣服', 8, 60);

-- --------------------------------------------------------

--
-- 資料表結構 `test`
--

CREATE TABLE `test` (
  `t_ID` tinyint NOT NULL,
  `t_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `test`
--

INSERT INTO `test` (`t_ID`, `t_name`) VALUES
(1, 'choice02'),
(2, 'choice03'),
(3, 'choice03'),
(4, '0');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admindata`
--
ALTER TABLE `admindata`
  ADD PRIMARY KEY (`a_ID`);

--
-- 資料表索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- 資料表索引 `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`f_ID`);

--
-- 資料表索引 `memberdata`
--
ALTER TABLE `memberdata`
  ADD PRIMARY KEY (`m_ID`);

--
-- 資料表索引 `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`od_id`);

--
-- 資料表索引 `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`oi_ID`);

--
-- 資料表索引 `order_state`
--
ALTER TABLE `order_state`
  ADD PRIMARY KEY (`os_ID`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`sID`);

--
-- 資料表索引 `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`sc_ID`);

--
-- 資料表索引 `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategoryID`);

--
-- 資料表索引 `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`t_ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admindata`
--
ALTER TABLE `admindata`
  MODIFY `a_ID` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `favourite`
--
ALTER TABLE `favourite`
  MODIFY `f_ID` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `memberdata`
--
ALTER TABLE `memberdata`
  MODIFY `m_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `od_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_info`
--
ALTER TABLE `order_info`
  MODIFY `oi_ID` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_state`
--
ALTER TABLE `order_state`
  MODIFY `os_ID` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `sID` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `sc_ID` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategoryID` tinyint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `test`
--
ALTER TABLE `test`
  MODIFY `t_ID` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
