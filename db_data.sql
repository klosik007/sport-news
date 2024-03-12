CREATE SCHEMA sportNews;
CREATE SCHEMA sportNews_test;

-- generated automatically by Doctrine migrations
CREATE TABLE `sportNews`.`author` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
CREATE TABLE `sportNews`.`news` (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
CREATE TABLE `sportNews`.`news_author` (news_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_31061BBCB5A459A0 (news_id), INDEX IDX_31061BBCF675F31B (author_id), PRIMARY KEY(news_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
ALTER TABLE `sportNews`.`news_author` ADD CONSTRAINT FK_31061BBCB5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE;
ALTER TABLE `sportNews`.`news_author` ADD CONSTRAINT FK_31061BBCF675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE;

INSERT INTO `sportNews`.`author`
(`id`,
`name`)
VALUES
(1, 'Przemek'),
(2, 'Maniek'),
(3, 'Cycu');

INSERT INTO `sportNews`.`news`
(`id`,
`title`,
`text`,
`created_at`)
VALUES
(1,
'Bramka Lewadowskiego w meczu Barcy',
'Lorem ipsum est docet alert',
'2024-03-09 21:48:15'),
(2,
'Remis Rakowa z Puszczą',
'Lorem ipsum est docet alert!!!!!',
'2024-03-09 20:23:01'),
(3,
'Wygrana Arsenalu',
'Arsenal uporał się z Brentford 2:1 w meczu 28 kolejki angielskiej Premier League',
'2024-03-09 20:30:45');

INSERT INTO `sportNews`.`news_author`
(`news_id`,
`author_id`)
VALUES
(1, 1), (1, 3), (2, 2), (3, 2), (3, 3);

-- to run PHP tests
CREATE TABLE `sportNews_test`.`author` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
CREATE TABLE `sportNews_test`.`news` (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
CREATE TABLE `sportNews_test`.`news_author` (news_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_31061BBCB5A459A0 (news_id), INDEX IDX_31061BBCF675F31B (author_id), PRIMARY KEY(news_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
ALTER TABLE `sportNews_test`.`news_author` ADD CONSTRAINT FK_31061BBCB5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE;
ALTER TABLE `sportNews_test`.`news_author` ADD CONSTRAINT FK_31061BBCF675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE;

INSERT INTO `sportNews_test`.`author`
(`id`,
`name`)
VALUES
(1, 'Przemek'),
(2, 'Maniek'),
(3, 'Cycu');

INSERT INTO `sportNews_test`.`news`
(`id`,
`title`,
`text`,
`created_at`)
VALUES
(1,
'Bramka Lewadowskiego w meczu Barcy',
'Lorem ipsum est docet alert',
'2024-03-09 21:48:15'),
(2,
'Remis Rakowa z Puszczą',
'Lorem ipsum est docet alert!!!!!',
'2024-03-09 20:23:01'),
(3,
'Wygrana Arsenalu',
'Arsenal uporał się z Brentford 2:1 w meczu 28 kolejki angielskiej Premier League',
'2024-03-09 20:30:45');

INSERT INTO `sportNews_test`.`news_author`
(`news_id`,
`author_id`)
VALUES
(1, 1), (1, 3), (2, 2), (3, 2), (3, 3);
