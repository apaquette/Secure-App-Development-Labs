// create a database called acc


CREATE TABLE `balance` (
  `AccountNumber` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `balance` (`AccountNumber`, `value`) VALUES
(1, 400),
(2, 400),
(3, 1600),
(4, 1000),
(5, 1000);
COMMIT;


