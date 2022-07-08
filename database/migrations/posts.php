<?php

return [
    "
    -- phpMyAdmin SQL Dump
    -- version 5.1.3
    -- https://www.phpmyadmin.net/
    --
    -- Host: 127.0.0.1
    -- Generation Time: Jun 16, 2022 at 07:28 AM
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
    -- Table structure for table `posts`
    --

    CREATE TABLE `posts` (
    `id` tinyint(4) NOT NULL,
    `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    `subtitle` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `author_id` tinyint(4) NOT NULL,
    `category_id` tinyint(4) NOT NULL,
    `is_published` tinyint(1) NOT NULL DEFAULT 0,
    `created_at` datetime NOT NULL,
    `updated_at` datetime DEFAULT NULL,
    `deleted_at` datetime DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

    --
    -- Indexes for dumped tables
    --

    --
    -- Indexes for table `posts`
    --
    ALTER TABLE `posts`
    ADD PRIMARY KEY (`id`),
    ADD KEY `idx_posts_published` (`is_published`),
    ADD KEY `idx_posts_slug` (`slug`),
    ADD KEY `fk_posts_author_id` (`author_id`),
    ADD KEY `fk_posts_category_id` (`category_id`);

    --
    -- AUTO_INCREMENT for dumped tables
    --

    --
    -- AUTO_INCREMENT for table `posts`
    --
    ALTER TABLE `posts`
    MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

    --
    -- Constraints for dumped tables
    --

    --
    -- Constraints for table `posts`
    --
    ALTER TABLE `posts`
    ADD CONSTRAINT `fk_posts_author_id` FOREIGN KEY (`author_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_posts_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
    COMMIT;

    /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
    /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
    /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
    "
];
