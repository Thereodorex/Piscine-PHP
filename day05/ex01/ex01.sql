CREATE TABLE ft_table(
    `id` int AUTO_INCREMENT NOT NULL,
    `login` varchar(8) DEFAULT 'toto' NOT NULL,
    `group` ENUM('staff', 'student', 'other') NOT NULL,
    `creation_date` date NOT NULL,
    PRIMARY KEY (`id`)
);