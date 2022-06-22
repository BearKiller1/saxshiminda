Components
    1. id
    2. name
    3. type (1 = group, 2 = component)
    4. description
    5. permision


-- CREATE DATABASE IF NOT EXISTS `Lucid`;

-- Create Components table
CREATE TABLE IF NOT EXISTS `Components` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `type` int(11) NOT NULL,
    `description` text NOT NULL,
    `permision` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ========================================================================================================================202122232425