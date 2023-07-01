-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2018 at 06:16 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kandidat`
--

CREATE TABLE IF NOT EXISTS `tbl_kandidat` (
`id_kandidat` int(11) NOT NULL,
  `ketua` varchar(50) NOT NULL,
  `jenkel` int(11) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `foto` varchar(400) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kandidat`
--

INSERT INTO `tbl_kandidat` (`id_kandidat`, `ketua`, `jenkel`, `visi`, `misi`, `foto`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE IF NOT EXISTS `tbl_login` (
`id_login` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `username`, `nama`, `password`, `jurusan`, `prodi`, `level`) VALUES
(1, 'admin', 'Administrator', '7af9f01dacba9538b7bef577ee745d8e', '', '', 1),


-- --------------------------------------------------------

--
-- Table structure for table `tbl_voting`
--

CREATE TABLE IF NOT EXISTS `tbl_voting` (
`id_voting` int(11) NOT NULL,
  `id_kandidat` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `poin` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_voting`
--

INSERT INTO `tbl_voting` (`id_voting`, `id_kandidat`, `id_login`, `waktu`, `poin`) VALUES
(1, 15, 1, '2018-08-17 08:54:23', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kandidat`
--
ALTER TABLE `tbl_kandidat`
 ADD PRIMARY KEY (`id_kandidat`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
 ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `tbl_voting`
--
ALTER TABLE `tbl_voting`
 ADD PRIMARY KEY (`id_voting`), ADD KEY `id_kandidat` (`id_kandidat`,`id_login`), ADD KEY `id_login` (`id_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kandidat`
--
ALTER TABLE `tbl_kandidat`
MODIFY `id_kandidat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `tbl_voting`
--
ALTER TABLE `tbl_voting`
MODIFY `id_voting` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_voting`
--
ALTER TABLE `tbl_voting`
ADD CONSTRAINT `tbl_voting_ibfk_1` FOREIGN KEY (`id_kandidat`) REFERENCES `tbl_kandidat` (`id_kandidat`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tbl_voting_ibfk_2` FOREIGN KEY (`id_login`) REFERENCES `tbl_login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
