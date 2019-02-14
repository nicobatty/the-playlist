<?php

require __DIR__ . '/../autoload.php';

$compositionRoot = new \NicoBatty\ThePlaylist\CompositionRoot();

$pdo = $compositionRoot->getDbConnection();

$videoSqlTable = <<<SQL
CREATE TABLE `video` (
  `id` INT(32) AUTO_INCREMENT,
  `title` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB;
SQL;

echo 'Create table video:' . "\n";
echo $videoSqlTable . "\n\n";

$pdo->exec($videoSqlTable);

$playlistSqlTable = <<<SQL
CREATE TABLE `playlist` (
  `id` INT(32) AUTO_INCREMENT,
  `title` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB;
SQL;

echo 'Create table playlist:' . "\n";
echo $playlistSqlTable . "\n\n";

$pdo->exec($playlistSqlTable);

$playlistVideoSqlTable = <<<SQL
CREATE TABLE `playlist_video` (
  `playlist_id` INT(32),
  `video_id` INT(32),
  `position` INT(32) DEFAULT 0,
  PRIMARY KEY (`playlist_id`, `video_id`),
  FOREIGN KEY (`playlist_id`) REFERENCES `playlist`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`video_id`) REFERENCES `video`(`id`) ON DELETE CASCADE
) ENGINE=INNODB;
SQL;

echo 'Create table playlist_video:' . "\n";
echo $playlistVideoSqlTable . "\n\n";

$pdo->exec($playlistVideoSqlTable);