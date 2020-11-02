CREATE TABLE `users` (
  `username` varchar(255) NOT NULL PRIMARY KEY,
  `algorithm` varchar(255) NOT NULL,
  `passwordhash` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `userdata` LONGTEXT
);
