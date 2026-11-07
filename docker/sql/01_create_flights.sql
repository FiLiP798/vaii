CREATE TABLE IF NOT EXISTS `flights` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `flight_number` VARCHAR(20) NOT NULL,
    `departure_airport` VARCHAR(100) NOT NULL,
    `arrival_airport` VARCHAR(100) NOT NULL,
    `airline` VARCHAR(120) NOT NULL,
    `flight_date` DATE NOT NULL,
    `distance_km` INT UNSIGNED NULL,
    `ticket_price` DECIMAL(10, 2) NULL,
    `payment_method` VARCHAR(20) NULL,
    `notes` TEXT NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_flights_flight_date` (`flight_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
