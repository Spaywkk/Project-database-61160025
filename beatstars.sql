-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2021 at 07:51 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beatstars`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `BuyProductBeat` (IN `iduser` INT, IN `idpost` INT, IN `pricebuy` DOUBLE, IN `timnow` DATETIME)  BEGIN

    UPDATE products SET UserProduct_id = iduser, ProductStatus = 'off' WHERE ProductID = idpost;
    UPDATE users SET Balance=Balance-pricebuy WHERE id = iduser;


    INSERT INTO `orders`(`user_id`) VALUES (iduser);
    SET @ID1 = LAST_INSERT_ID();

    INSERT INTO `order_details` (`Price`, `Order_ID`,`Product_ID`) VALUES (pricebuy,@ID1,idpost);
    SET @ID2 = LAST_INSERT_ID();

    INSERT INTO `trading_histories` (`OderdetailID`,`OderID`) VALUES (@ID2,@ID1);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BuyRank` (IN `iduser` INT, IN `namerank` VARCHAR(255))  BEGIN

    DECLARE rankPrice INT;

    IF (namerank = 'silver') THEN

        SET rankPrice = 0;

    ELSEIF (namerank = 'gold') THEN 

        SET rankPrice = 1000;

    ELSE

        SET rankPrice = 5000;
    
    END IF;

    UPDATE users SET `rank` = namerank ,Balance = Balance - rankPrice  WHERE id = iduser;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ChangeBonus` (IN `iduser` INT, IN `bonus` INT)  BEGIN

    IF (bonus = 100) THEN

        UPDATE users SET BonusStar = BonusStar-bonus, Balance = Balance + 100 WHERE id = iduser;

    ELSEIF (bonus = 150) THEN

        UPDATE users SET BonusStar = BonusStar-bonus, Balance = Balance + 150 WHERE id = iduser;

    ELSE 

        UPDATE users SET BonusStar = BonusStar-bonus,Balance = Balance + 350  WHERE id = iduser;

    END IF;

    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SoldOutProduct` (IN `idproduct` INT(7))  BEGIN

    UPDATE products SET ProductStatus = 'soldout' WHERE ProductID = idproduct;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_07_112547_add_colums_user', 2),
(9, '2021_03_07_122513_create_products_table', 3),
(10, '2021_03_07_122539_create_order_details_table', 3),
(11, '2021_03_07_122550_create_orders_table', 3),
(12, '2021_03_07_122609_create_trading_histories_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `OderDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `user_id`, `OderDate`) VALUES
(45, 1, '2021-03-25 12:26:58'),
(46, 1, '2021-03-25 12:28:23');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `InsertBonusForUser` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN 

    UPDATE users SET BonusStar = BonusStar + RAND()*(30) WHERE id = New.user_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `OderdetailID` int(11) NOT NULL,
  `Price` double NOT NULL,
  `Order_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`OderdetailID`, `Price`, `Order_ID`, `Product_ID`, `created_at`) VALUES
(44, 1200, 45, 27, '2021-03-25 12:26:58'),
(45, 1350, 46, 27, '2021-03-25 12:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(10) UNSIGNED NOT NULL,
  `UserProduct_id` int(11) NOT NULL,
  `ProductTitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ProductType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ProductDescriptions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ImageSource` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Price` double NOT NULL,
  `ProductStatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `UserProduct_id`, `ProductTitle`, `ProductType`, `ProductDescriptions`, `ImageSource`, `Price`, `ProductStatus`, `created_at`, `updated_at`) VALUES
(22, 1, 'Freestyle Rap Beat | Hard Boom Bap Type Beat | Hip Hop Instrumental - \"Behind Barz\"', 'Pop', '\"Behind Barz\"', 'https://sv1.picz.in.th/images/2021/03/25/DuPKs1.md.png', 1000, 'on', '2021-03-25 03:30:23', NULL),
(23, 2, 'Versace\" 90s OldSchool Type Freestyle Beat | Rap Instrumental Beat', 'K-pop', 'Anabolic Beatz', 'https://sv1.picz.in.th/images/2021/03/25/DuPg9D.md.png', 500, 'on', '2021-03-25 03:32:00', '2021-03-25 10:37:59'),
(24, 2, 'Lil Baby x Quavo Type Beat \'700\' Free Trap Beats 2021', 'Rap', 'Rap/Trap Instrumental', 'https://sv1.picz.in.th/images/2021/03/25/Du27Dv.md.png', 1200, 'on', '2021-03-25 03:33:03', '2021-03-25 10:38:04'),
(25, 5, 'Kodes x NLE Choppa x Larry Type Beat \'Balles\'', 'K-pop', 'Free Type Beat 2021', 'https://sv1.picz.in.th/images/2021/03/25/Du6fzZ.md.png', 300, 'on', '2021-03-25 03:35:08', '2021-03-25 10:38:09'),
(26, 1, 'Kodes x Koba laD Type Beat 2019 - \"Mortel\"', 'Rap', 'Instru Rap By DK', 'https://sv1.picz.in.th/images/2021/03/25/Dun9U9.md.png', 150, 'on', '2021-03-25 03:36:28', NULL),
(27, 1, 'BASE DE TRAP - \"FLOW ALIEN\" | Pista de Trap USO LIBRE', 'Metal', 'Rap/Trap Instrumental Freestyle Beat 2020', 'https://sv1.picz.in.th/images/2021/03/25/DunXl2.md.png', 1500, 'off', '2021-03-25 03:37:33', '2021-03-25 12:28:23');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `UpdateProduct` BEFORE UPDATE ON `products` FOR EACH ROW BEGIN 

    SET  New.updated_at = NOW();

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `trading_histories`
--

CREATE TABLE `trading_histories` (
  `TradingStoryID` int(11) NOT NULL,
  `OderdetailID` int(11) NOT NULL,
  `OderID` int(11) NOT NULL,
  `datatime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trading_histories`
--

INSERT INTO `trading_histories` (`TradingStoryID`, `OderdetailID`, `OderID`, `datatime`) VALUES
(27, 44, 45, '2021-03-25 12:26:58'),
(28, 45, 46, '2021-03-25 12:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `Birthdate` date NOT NULL,
  `phone` int(11) NOT NULL,
  `rank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `BonusStar` int(11) NOT NULL DEFAULT 0,
  `Balance` double NOT NULL DEFAULT 0,
  `status_auth` varchar(255) NOT NULL DEFAULT 'member',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `email_verified_at`, `Birthdate`, `phone`, `rank`, `BonusStar`, `Balance`, `status_auth`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'spay', '$2y$10$cZvldulxPOcZYnhrF.ZErO1PIk0ZEuInadw6TcEcH2uWWaOD4bwCm', 'spayspay', 'spay@live.com', NULL, '2021-03-09', 82222222, 'gold', 50, 77784, '\'member\'', NULL, '2021-03-07 05:13:15', '2021-03-07 05:13:15'),
(2, 'winny', '$2y$10$MGFg42nXcfTT496slU4hXe3qQhBy.o4UtnjIxd8CYAOoQFngBtKmm', 'winny@winny.com', 'winny@winny.com', NULL, '2021-03-04', 822222222, 'gold', 0, 111111100311.02, 'member', NULL, '2021-03-08 23:55:58', '2021-03-08 23:55:58'),
(5, 'spay2', '$2y$10$0ZUkcdhHoopa02LXxGt6XeEXro58QSouSFGuToJOS7w0CjiYE6pDW', 'SPAY', 'spay2@spay2.com', NULL, '2021-03-03', 8181811, 'silver', 0, 0, 'member', NULL, '2021-03-18 08:02:46', '2021-03-18 08:02:46'),
(17, 'spay3', '$2y$10$4eklLnDZIbBz.ZuVuM3L6.lvvwzcdrJbbXGlefiPlmQ7BvlOd2Sam', 'AW', 'spay3@spay.com', NULL, '2021-03-03', 812345678, 'silver', 0, 0, 'member', NULL, '2021-03-25 02:04:46', '2021-03-25 02:04:46');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `SetUpperFullNameAndRank` BEFORE INSERT ON `users` FOR EACH ROW BEGIN 
    
    DECLARE rankInsert VARCHAR(20);
    SET rankInsert = 'silver';


    IF (New.fullname IS NOT NULL) THEN

        SET  New.fullname = UPPER(New.fullname);

    END IF;


    IF (New.rank IS NULL) THEN

        SET New.rank = rankInsert;

    END IF;


END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`OderdetailID`),
  ADD KEY `Order_ID` (`Order_ID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `trading_histories`
--
ALTER TABLE `trading_histories`
  ADD PRIMARY KEY (`TradingStoryID`),
  ADD KEY `OderdetailID` (`OderdetailID`),
  ADD KEY `OderID` (`OderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `OderdetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `trading_histories`
--
ALTER TABLE `trading_histories`
  MODIFY `TradingStoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`OrderID`);

--
-- Constraints for table `trading_histories`
--
ALTER TABLE `trading_histories`
  ADD CONSTRAINT `trading_histories_ibfk_1` FOREIGN KEY (`OderdetailID`) REFERENCES `order_details` (`OderdetailID`),
  ADD CONSTRAINT `trading_histories_ibfk_2` FOREIGN KEY (`OderID`) REFERENCES `order_details` (`Order_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
