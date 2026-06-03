-- ============================================================
-- Restaurant Management System - Database Schema
-- MySQL 8.0+ / MariaDB 10.3+
-- ============================================================

CREATE DATABASE IF NOT EXISTS `restaurant_management`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `restaurant_management`;

-- ------------------------------------------------------------
-- Table: users (g�r�e par Laravel Breeze)
-- ------------------------------------------------------------
CREATE TABLE `users` (
  `id`              BIGINT UNSIGNED   NOT NULL AUTO_INCREMENT,
  `name`            VARCHAR(255)      NOT NULL,
  `email`           VARCHAR(255)      NOT NULL,
  `email_verified_at` TIMESTAMP       NULL DEFAULT NULL,
  `password`        VARCHAR(255)      NOT NULL,
  `remember_token`  VARCHAR(100)      NULL DEFAULT NULL,
  `created_at`      TIMESTAMP         NULL DEFAULT NULL,
  `updated_at`      TIMESTAMP         NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: password_reset_tokens
-- ------------------------------------------------------------
CREATE TABLE `password_reset_tokens` (
  `email`      VARCHAR(255) NOT NULL,
  `token`      VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP    NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: sessions
-- ------------------------------------------------------------
CREATE TABLE `sessions` (
  `id`            VARCHAR(255) NOT NULL,
  `user_id`       BIGINT UNSIGNED     NULL DEFAULT NULL,
  `ip_address`    VARCHAR(45)         NULL DEFAULT NULL,
  `user_agent`    TEXT                NULL,
  `payload`       LONGTEXT            NOT NULL,
  `last_activity` INT                 NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `sessions_user_id_index` (`user_id`),
  INDEX `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: categories
-- ------------------------------------------------------------
CREATE TABLE `categories` (
  `id`          BIGINT UNSIGNED   NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(100)      NOT NULL,
  `description` TEXT              NULL DEFAULT NULL,
  `created_at`  TIMESTAMP         NULL DEFAULT NULL,
  `updated_at`  TIMESTAMP         NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: plats
-- ------------------------------------------------------------
CREATE TABLE `plats` (
  `id`            BIGINT UNSIGNED   NOT NULL AUTO_INCREMENT,
  `nom`           VARCHAR(150)      NOT NULL,
  `prix`          DECIMAL(10,2)     NOT NULL,
  `image`         VARCHAR(255)      NULL DEFAULT NULL,
  `description`   TEXT              NULL DEFAULT NULL,
  `categorie_id`  BIGINT UNSIGNED   NOT NULL,
  `created_at`    TIMESTAMP         NULL DEFAULT NULL,
  `updated_at`    TIMESTAMP         NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `plats_categorie_id_index` (`categorie_id`),
  CONSTRAINT `plats_categorie_id_foreign`
    FOREIGN KEY (`categorie_id`)
    REFERENCES `categories` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Table: commandes
-- ------------------------------------------------------------
CREATE TABLE `commandes` (
  `id`             BIGINT UNSIGNED   NOT NULL AUTO_INCREMENT,
  `client`         VARCHAR(150)      NOT NULL,
  `total`          DECIMAL(10,2)     NOT NULL,
  `date_commande`  DATE              NOT NULL,
  `created_at`     TIMESTAMP         NULL DEFAULT NULL,
  `updated_at`     TIMESTAMP         NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
