<?php

return [
    "
    -- phpMyAdmin SQL Dump
    -- version 5.1.3
    -- https://www.phpmyadmin.net/
    --
    -- Host: 127.0.0.1
    -- Generation Time: Jun 16, 2022 at 07:22 AM
    -- Server version: 10.4.24-MariaDB
    -- PHP Version: 7.4.29

    SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
    START TRANSACTION;
    SET time_zone = \"+00:00\";


    /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
    /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
    /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
    /*!40101 SET NAMES utf8mb4 */;

    --
    -- Database: `my_legend`
    --

    -- --------------------------------------------------------

    --
    -- Table structure for table `members`
    --

    CREATE TABLE `members` (
    `id` tinyint(4) NOT NULL,
    `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    `family` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
    `verify_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `forget_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `forget_token_expiry` datetime DEFAULT NULL,
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL,
    `deleted_at` datetime DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    --
    -- Dumping data for table `members`
    --

    INSERT INTO `members` (`id`, `name`, `family`, `username`, `email`, `password`, `avatar`, `status`, `role`, `verify_token`, `forget_token`, `forget_token_expiry`, `created_at`, `updated_at`, `deleted_at`) VALUES
    (1, 'test', 'testimonial', 'testify', 'test@test.com', '123456789', '', 1, 'admin', NULL, NULL, NULL, '2022-06-16 07:21:03', NULL, NULL);

    --
    -- Indexes for dumped tables
    --

    --
    -- Indexes for table `members`
    --
    ALTER TABLE `members`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `unique_members_username` (`username`) USING BTREE;

    --
    -- AUTO_INCREMENT for dumped tables
    --

    --
    -- AUTO_INCREMENT for table `members`
    --
    ALTER TABLE `members`
    MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
    COMMIT;

    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
    "
];
