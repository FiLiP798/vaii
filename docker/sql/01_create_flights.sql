CREATE TABLE IF NOT EXISTS `airports` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `iata_code` CHAR(3) NOT NULL,
    `icao_code` CHAR(4) NULL,
    `name` VARCHAR(120) NOT NULL,
    `city` VARCHAR(100) NOT NULL,
    `country` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_airports_iata_code` (`iata_code`),
    UNIQUE KEY `uq_airports_icao_code` (`icao_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `airlines` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `iata_code` CHAR(2) NULL,
    `icao_code` CHAR(3) NULL,
    `name` VARCHAR(120) NOT NULL,
    `country` VARCHAR(100) NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_airlines_iata_code` (`iata_code`),
    UNIQUE KEY `uq_airlines_icao_code` (`icao_code`),
    UNIQUE KEY `uq_airlines_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `flights` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `flight_number` VARCHAR(20) NOT NULL,
    `departure_airport_id` INT UNSIGNED NOT NULL,
    `arrival_airport_id` INT UNSIGNED NOT NULL,
    `airline_id` INT UNSIGNED NOT NULL,
    `flight_date` DATE NOT NULL,
    `distance_km` INT UNSIGNED NULL,
    `ticket_price` DECIMAL(10, 2) NULL,
    `payment_method` VARCHAR(20) NULL,
    `notes` TEXT NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_flights_flight_date` (`flight_date`),
    INDEX `idx_flights_departure_airport` (`departure_airport_id`),
    INDEX `idx_flights_arrival_airport` (`arrival_airport_id`),
    INDEX `idx_flights_airline` (`airline_id`),
    CONSTRAINT `fk_flights_departure_airport` FOREIGN KEY (`departure_airport_id`) REFERENCES `airports` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT `fk_flights_arrival_airport` FOREIGN KEY (`arrival_airport_id`) REFERENCES `airports` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT `fk_flights_airline` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
