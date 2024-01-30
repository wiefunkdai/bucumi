-- phpMyAdmin SQL Dump
-- version 5.2.1-2.fc39
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2024 at 06:42 PM
-- Server version: 10.5.23-MariaDB
-- PHP Version: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwd_bucumi`
--

-- --------------------------------------------------------

--
-- Table structure for table `sd_books`
--

CREATE TABLE `sd_books` (
  `bookid` int(11) NOT NULL,
  `bookkeyword` text NOT NULL,
  `booktitle` varchar(128) NOT NULL,
  `booksummary` text NOT NULL,
  `bookdescription` longtext DEFAULT NULL,
  `bookauthor` varchar(128) NOT NULL,
  `bookpublisher` varchar(128) DEFAULT NULL,
  `booktotalpages` int(11) NOT NULL,
  `bookcover` varchar(200) NOT NULL,
  `bookfilepath` varchar(200) NOT NULL,
  `bookpublishdate` datetime DEFAULT NULL,
  `bookrentprice` float NOT NULL DEFAULT 0,
  `bookstatus` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sd_books`
--

INSERT INTO `sd_books` (`bookid`, `bookkeyword`, `booktitle`, `booksummary`, `bookdescription`, `bookauthor`, `bookpublisher`, `booktotalpages`, `bookcover`, `bookfilepath`, `bookpublishdate`, `bookrentprice`, `bookstatus`) VALUES
(1706123089, 'PHP Books, Web Programming', 'Web Development Using Php', 'PHP is a simple yet powerful language designed for creating HTML content.PHP is a server scripting language, and a powerful tool for making dynamic and interactive Web pages.PHP is a widely used, free, and efficient alternative to competitors such as Microsoft\'s ASP.It is an open- source, interpreted, and object-oriented scripting language that can be executed at the server-side.', NULL, 'Dr. Tarandeep Kaur', NULL, 269, '1706123089.png', '1706123089.pdf', NULL, 2000, 1),
(1706130499, 'AI Tech, Machine Learning, Artificial Intelligence', 'Explorations in Artificial Intelligence and Machine Learning', 'Artificial Intelligence (AI) seems the defining technology of our time.Google has just re-branded its Google Research division to Google AI as the company pursues developments in the field of artificial intelligence.', NULL, 'Taylor & Frech Group', 'CRC Press', 178, '710613782.png', '710613782.pdf', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sd_rents`
--

CREATE TABLE `sd_rents` (
  `rentid` int(11) NOT NULL,
  `rentdatetime` datetime NOT NULL DEFAULT current_timestamp(),
  `rentuserid` int(11) NOT NULL,
  `rentbookid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sd_topups`
--

CREATE TABLE `sd_topups` (
  `topupid` int(11) NOT NULL,
  `topupbucumibank` enum('bni','bca','mandiri','bri') NOT NULL,
  `topuptransferdate` date NOT NULL,
  `topupbalance` float NOT NULL DEFAULT 0,
  `topupbankfrom` varchar(128) NOT NULL,
  `topupnumberbanksender` char(30) NOT NULL,
  `topupnamesender` varchar(128) NOT NULL,
  `topupevidencetransfer` varchar(200) DEFAULT NULL,
  `topupuserid` int(11) NOT NULL,
  `topupstatus` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sd_topups`
--

INSERT INTO `sd_topups` (`topupid`, `topupbucumibank`, `topuptransferdate`, `topupbalance`, `topupbankfrom`, `topupnumberbanksender`, `topupnamesender`, `topupevidencetransfer`, `topupuserid`, `topupstatus`) VALUES
(1, 'bni', '2024-01-30', 50000, 'Internet Banking BCA', '999999', 'Stephanus Bagus Saputra', '187875-1706588306.jpg', 187875, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sd_users`
--

CREATE TABLE `sd_users` (
  `userid` int(11) NOT NULL,
  `username` char(32) NOT NULL,
  `useremail` varchar(64) NOT NULL,
  `userpassword` varchar(128) NOT NULL COMMENT '\r\n',
  `usernationid` bigint(20) NOT NULL,
  `userfullname` varchar(180) NOT NULL,
  `userdescription` text DEFAULT NULL,
  `useraddress` text DEFAULT NULL,
  `userbirthday` date DEFAULT NULL,
  `userphone` bigint(20) DEFAULT NULL,
  `userbalance` float NOT NULL DEFAULT 25000,
  `userrole` enum('admin','member') NOT NULL DEFAULT 'member',
  `usergender` enum('pria','wanita') DEFAULT NULL,
  `userphoto` varchar(200) DEFAULT NULL,
  `userstatus` tinyint(1) NOT NULL DEFAULT 1,
  `usercreatedate` datetime NOT NULL DEFAULT current_timestamp(),
  `usergoogleid` char(30) DEFAULT NULL,
  `userfacebookid` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sd_users`
--

INSERT INTO `sd_users` (`userid`, `username`, `useremail`, `userpassword`, `usernationid`, `userfullname`, `userdescription`, `useraddress`, `userbirthday`, `userphone`, `userbalance`, `userrole`, `usergender`, `userphoto`, `userstatus`, `usercreatedate`, `usergoogleid`, `userfacebookid`) VALUES
(187863, 'wiefunkdai', 'stephanusdai@icloud.com', '33fa44b690e43956d0d6d37abf43f6a55660b300', 21220047, 'Stephanus Bagus Saputra', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer non condimentum urna. Vestibulum auctor vehicula neque, quis suscipit quam porttitor ut. Cras eu tristique sapien. Ut at arcu id neque tincidunt imperdiet. Integer dapibus, mauris sed blandit vestibulum, augue urna lobortis ligula, facilisis fringilla lacus mauris eget erat. Mauris est dolor, pulvinar at mi non, aliquet euismod nunc. Curabitur vel finibus tortor. Suspendisse sit amet justo est. Phasellus rutrum mattis nisl id facilisis. Nullam pretium nisi lacus, eget varius nisi rutrum sed. Maecenas semper gravida hendrerit. Nullam egestas leo id nisi sagittis placerat. Quisque fermentum quis lectus bibendum tincidunt. Sed egestas at ante id vulputate.\r\n\r\nInteger sem nibh, luctus id rutrum sit amet, semper id ligula. Etiam placerat dui ut magna eleifend posuere. Quisque maximus blandit erat, convallis feugiat lorem. Suspendisse laoreet eget lacus in gravida. Nam ac nulla diam. Vestibulum ut iaculis ipsum, id semper nisi. Phasellus nec ornare quam. Donec ultricies tellus volutpat ex rutrum viverra. In accumsan dui quis condimentum fringilla. Vestibulum nulla risus, porta eget dapibus laoreet, consequat ac enim. Cras vel lacus quis velit posuere viverra. Curabitur a erat in urna rutrum facilisis. Ut ullamcorper velit libero, vel eleifend est tristique eu. Vivamus sagittis vitae odio at fermentum.', NULL, NULL, NULL, 0, 'admin', 'pria', 'wiefunkdai-1706209940.jpg', 1, '2024-01-24 22:01:20', NULL, NULL),
(187865, 'demo', 'demouser@localhost.com', 'cbdbe4936ce8be63184d9f2e13fc249234371b9a', 10001, 'Demo User', '', NULL, NULL, NULL, 0, 'member', 'pria', 'demo.jpg', 1, '2024-01-24 22:22:14', NULL, NULL),
(187866, 'Ilhambrosnan', 'Ilhambrosnan@gmail.com', '5452336c87e7cc8f19892534741223639bd1d06e', 11190055, 'M. Ilham Brosnansyah', NULL, NULL, NULL, NULL, 0, 'admin', 'pria', NULL, 1, '2024-01-26 16:20:10', NULL, NULL),
(187867, 'firdausmhmd11', 'firdausmhmd11@gmail.com', '57b3b9580e8f8c2417c2f987d3c59093ab66e139', 11180147, 'Muhamad Firdaus', NULL, NULL, NULL, NULL, 0, 'admin', 'pria', NULL, 1, '2024-01-26 16:21:04', NULL, NULL),
(187868, 'ihsanadrian087', 'ihsanadrian087@gmail.com', 'd3ff5f067daa7543635ca00dd6315165c6a2dae7', 21220022, 'M Ihsan Adrian', NULL, NULL, NULL, NULL, 0, 'admin', 'pria', NULL, 1, '2024-01-26 16:21:58', NULL, NULL),
(187869, 'chaidarramadhan', 'chaidarramadhan@gmail.com', '0df3f76a203030fddfaec19599abad998c61db37', 1000001, 'M. Chaidar Ramadhan', NULL, NULL, NULL, NULL, 0, 'admin', 'pria', NULL, 1, '2024-01-26 16:22:41', NULL, NULL),
(187870, 'megamee', 'megamee@gmail.om', 'c41b7cc6b12ff24a6743afeb6f437c9c9423d79a', 1000002, 'Mega', NULL, NULL, NULL, NULL, 0, 'admin', 'pria', NULL, 1, '2024-01-26 16:23:22', NULL, NULL),
(187875, 'stephanusbagus', 'bagusputraraza@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 666666, 'Stephanus Bagus Saputra', NULL, NULL, NULL, NULL, 25000, 'member', 'pria', 'stephanusbagus-1706307506.png', 1, '2024-01-27 05:18:26', '115757015894327873326', '1053872505846052'),
(187876, 'ilhambrosnansyah', 'ilhambrosnansyah@gmail.com', '62bfa509ce96331879f59410730049890fab2b6e', 11190055, 'Poem Poetry', NULL, NULL, NULL, NULL, 25000, 'member', NULL, 'ilhambrosnansyah-1706601572.jpg', 1, '2024-01-30 14:59:32', '115593184598578349922', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sd_books`
--
ALTER TABLE `sd_books`
  ADD PRIMARY KEY (`bookid`),
  ADD UNIQUE KEY `booktitle` (`booktitle`);

--
-- Indexes for table `sd_rents`
--
ALTER TABLE `sd_rents`
  ADD PRIMARY KEY (`rentid`);

--
-- Indexes for table `sd_topups`
--
ALTER TABLE `sd_topups`
  ADD PRIMARY KEY (`topupid`);

--
-- Indexes for table `sd_users`
--
ALTER TABLE `sd_users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `useremail` (`useremail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sd_books`
--
ALTER TABLE `sd_books`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1706130500;

--
-- AUTO_INCREMENT for table `sd_rents`
--
ALTER TABLE `sd_rents`
  MODIFY `rentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sd_topups`
--
ALTER TABLE `sd_topups`
  MODIFY `topupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sd_users`
--
ALTER TABLE `sd_users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187877;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
