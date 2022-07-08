<?php

return [
    "
    -- phpMyAdmin SQL Dump
    -- version 5.1.3
    -- https://www.phpmyadmin.net/
    --
    -- Host: 127.0.0.1
    -- Generation Time: Jun 16, 2022 at 07:26 AM
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
    -- Table structure for table `categories`
    --

    CREATE TABLE `categories` (
    `id` tinyint(4) NOT NULL,
    `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `subtitle` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
    `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `parent_id` tinyint(4) DEFAULT NULL,
    `author_id` tinyint(4) NOT NULL,
    `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `is_published` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL,
    `deleted_at` datetime DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    --
    -- Indexes for dumped tables
    --

    --
    -- Indexes for table `categories`
    --
    ALTER TABLE `categories`
    ADD PRIMARY KEY (`id`),
    ADD KEY `idx_category_slug` (`slug`),
    ADD KEY `idx_category_published` (`is_published`),
    ADD KEY `fk_category_author_id` (`author_id`),
    ADD KEY `fk_category_parent_id` (`parent_id`);

    --
    -- AUTO_INCREMENT for dumped tables
    --

    --
    -- AUTO_INCREMENT for table `categories`
    --
    ALTER TABLE `categories`
    MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

    --
    -- Constraints for dumped tables
    --

    --
    -- Constraints for table `categories`
    --
    ALTER TABLE `categories`
    ADD CONSTRAINT `fk_category_author_id` FOREIGN KEY (`author_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_category_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
    COMMIT;

    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

    "
];
