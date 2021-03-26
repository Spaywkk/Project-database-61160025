CREATE TABLE `beatstars`.`Orders`(
    OrderID INT NOT NULL AUTO_INCREMENT,
    OderDate INT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    PRIMARY KEY (OrderID)
)ENGINE = InnoDB;


CREATE TABLE `beatstars`.`order_details` (
    OderdetailID INT NOT NULL AUTO_INCREMENT,
    Price DOUBLE NOT NULL,
    Order_ID INT NOT NULL,
    Product_ID INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    PRIMARY KEY (OderdetailID),
    FOREIGN KEY (`Order_ID`)REFERENCES `beatstars`.`Orders` (`OrderID`)
)ENGINE = InnoDB;


CREATE TABLE `beatstars`.`trading_histories` (
    TradingStoryID INT NOT NULL AUTO_INCREMENT,
    OderdetailID INT NOT NULL,
    OderID INT NOT NULL,
    PRIMARY KEY (TradingStoryID),
    FOREIGN KEY (`OderdetailID`)REFERENCES `beatstars`.`order_details` (`OderdetailID`),
    FOREIGN KEY (`OderID`)REFERENCES `beatstars`.`order_details` (`Order_ID`)
)ENGINE = InnoDB;


CREATE TABLE `beatstars`.`ranks` (
    id_rank INT NOT NULL AUTO_INCREMENT,
    id_user INT NOT NULL,
    start_rank TIMESTAMP NULL,
    end_rank TIMESTAMP NULL,
    status_rank varchar(255) NULL,
    PRIMARY KEY (id_rank)
)ENGINE = InnoDB DEFAULT CHARSET=utf8;


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


INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `email_verified_at`, `Birthdate`, `phone`, `rank`, `BonusStar`, `Balance`, `status_auth`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'spay3', '$2y$10$7uKkFafVxyE5kO5gowOYR.3XdE0TAfPjsfTX6KzOkTRkif/7bKT7q', 'SPAY', 'spay3@spay.com', NULL, '2021-03-02', 812345678, NULL, 0, 0, 'member', NULL, '2021-03-25 01:17:17', '2021-03-25 01:17:17');
