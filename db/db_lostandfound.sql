-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2018 at 04:19 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lostandfound`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `userCount` (OUT `counts` INT)  NO SQL
select count(*) into counts from user$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `adress`
--

CREATE TABLE `adress` (
  `aid` int(3) NOT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `catagoery`
--

CREATE TABLE `catagoery` (
  `cid` int(3) NOT NULL,
  `cname` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fimages`
--

CREATE TABLE `fimages` (
  `id` int(5) NOT NULL,
  `url` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fthings`
--

CREATE TABLE `fthings` (
  `id` int(5) NOT NULL,
  `discription` varchar(100) DEFAULT NULL,
  `adressid` int(3) DEFAULT NULL,
  `pincode` int(10) NOT NULL,
  `uemail` varchar(35) DEFAULT NULL,
  `imgid` int(5) DEFAULT NULL,
  `postdate` date NOT NULL,
  `cat_ref` int(3) NOT NULL,
  `draft` int(11) NOT NULL DEFAULT '0',
  `ddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `fthings`
--
DELIMITER $$
CREATE TRIGGER `fcount` AFTER INSERT ON `fthings` FOR EACH ROW UPDATE `user` SET `posts`=`posts`+1 WHERE `email`=new.`uemail`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `foundpostdel` AFTER DELETE ON `fthings` FOR EACH ROW BEGIN
     UPDATE `user` SET `posts`=`posts`-1 WHERE `email`=old.`uemail`;

               DELETE FROM `fimages` WHERE `id`=old.`imgid`;

               DELETE FROM `adress` WHERE `aid`=old.`adressid`;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `limages`
--

CREATE TABLE `limages` (
  `id` int(5) NOT NULL,
  `url` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lthings`
--

CREATE TABLE `lthings` (
  `id` int(5) NOT NULL,
  `cat_ref` int(3) NOT NULL,
  `discription` varchar(100) DEFAULT NULL,
  `adressid` int(3) DEFAULT NULL,
  `pincode` int(10) DEFAULT NULL,
  `uemail` varchar(35) DEFAULT NULL,
  `imgid` int(5) DEFAULT NULL,
  `postdate` date NOT NULL,
  `draft` int(1) NOT NULL DEFAULT '0',
  `ddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `lthings`
--
DELIMITER $$
CREATE TRIGGER `lcount` AFTER INSERT ON `lthings` FOR EACH ROW UPDATE `user` SET `posts`=`posts`+1 WHERE `email`=new.`uemail`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `lostpostdel` AFTER DELETE ON `lthings` FOR EACH ROW BEGIN
UPDATE `user` SET `posts`=`posts`-1 WHERE `email`=old.`uemail`;

          DELETE FROM `limages` WHERE `id`=old.`imgid`;

          DELETE FROM `adress` WHERE `aid`=old.`adressid`;
          
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(35) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `isadmin` tinyint(1) DEFAULT '0',
  `posts` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `userdel` AFTER DELETE ON `user` FOR EACH ROW BEGIN

	DELETE FROM `fthings` WHERE `uemail`=old.`email`;
    DELETE FROM `lthings` WHERE `uemail`=old.`email`;

END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adress`
--
ALTER TABLE `adress`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `catagoery`
--
ALTER TABLE `catagoery`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `fimages`
--
ALTER TABLE `fimages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fthings`
--
ALTER TABLE `fthings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adressid` (`adressid`),
  ADD KEY `imgid` (`imgid`),
  ADD KEY `cat_ref` (`cat_ref`),
  ADD KEY `uemail` (`uemail`);

--
-- Indexes for table `limages`
--
ALTER TABLE `limages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lthings`
--
ALTER TABLE `lthings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_ref` (`cat_ref`),
  ADD KEY `adressid` (`adressid`),
  ADD KEY `uemail` (`uemail`),
  ADD KEY `imgid` (`imgid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adress`
--
ALTER TABLE `adress`
  MODIFY `aid` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `catagoery`
--
ALTER TABLE `catagoery`
  MODIFY `cid` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fimages`
--
ALTER TABLE `fimages`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fthings`
--
ALTER TABLE `fthings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `limages`
--
ALTER TABLE `limages`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lthings`
--
ALTER TABLE `lthings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `fthings`
--
ALTER TABLE `fthings`
  ADD CONSTRAINT `fthings_ibfk_1` FOREIGN KEY (`adressid`) REFERENCES `adress` (`aid`) ON DELETE CASCADE,
  ADD CONSTRAINT `fthings_ibfk_2` FOREIGN KEY (`imgid`) REFERENCES `fimages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fthings_ibfk_4` FOREIGN KEY (`cat_ref`) REFERENCES `catagoery` (`cid`),
  ADD CONSTRAINT `fthings_ibfk_5` FOREIGN KEY (`uemail`) REFERENCES `user` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `lthings`
--
ALTER TABLE `lthings`
  ADD CONSTRAINT `la` FOREIGN KEY (`adressid`) REFERENCES `adress` (`aid`) ON DELETE CASCADE,
  ADD CONSTRAINT `lc` FOREIGN KEY (`cat_ref`) REFERENCES `catagoery` (`cid`) ON DELETE NO ACTION,
  ADD CONSTRAINT `ulimg` FOREIGN KEY (`imgid`) REFERENCES `limages` (`id`),
  ADD CONSTRAINT `ulmail` FOREIGN KEY (`uemail`) REFERENCES `user` (`email`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
