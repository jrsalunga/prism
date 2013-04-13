-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 16, 2013 at 06:57 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prism`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GETGUID`() RETURNS char(32) CHARSET utf8
BEGIN
      RETURN UPPER( REPLACE( UUID(), "-", "" ) );
   END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `apledger`
--

CREATE TABLE IF NOT EXISTS `apledger` (
  `supplierid` char(32) NOT NULL,
  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `txndate` date NOT NULL,
  `txncode` char(3) DEFAULT '',
  `txnrefno` char(10) DEFAULT '',
  `amount` decimal(15,2) DEFAULT '0.00',
  `prevbal` decimal(15,2) DEFAULT '0.00',
  `currbal` decimal(15,2) DEFAULT '0.00',
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `SUPPLIERID` (`supplierid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `apvdtl`
--

CREATE TABLE IF NOT EXISTS `apvdtl` (
  `apvhdrid` char(32) NOT NULL,
  `itemid` char(32) NOT NULL,
  `qty` decimal(9,0) DEFAULT '0',
  `unitcost` decimal(12,2) DEFAULT '0.00',
  `amount` decimal(15,2) DEFAULT '0.00',
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `APVHDRID` (`apvhdrid`),
  KEY `ITEMID` (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `apvhdr`
--

CREATE TABLE IF NOT EXISTS `apvhdr` (
  `refno` char(10) NOT NULL,
  `date` date NOT NULL,
  `locationid` char(32) NOT NULL,
  `supplierid` char(32) NOT NULL,
  `supprefno` char(15) DEFAULT '',
  `porefno` char(15) DEFAULT '',
  `terms` tinyint(4) DEFAULT '0',
  `notes` text,
  `totqty` decimal(9,0) DEFAULT '0',
  `totamount` decimal(15,2) DEFAULT '0.00',
  `totdebit` decimal(15,2) DEFAULT '0.00',
  `totcredit` decimal(15,2) DEFAULT '0.00',
  `balance` decimal(15,2) DEFAULT '0.00',
  `id` char(32) NOT NULL,
  `posted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `REFNO` (`refno`),
  KEY `LOCATIONID` (`locationid`),
  KEY `SUPPLIERID` (`supplierid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apvhdr`
--

INSERT INTO `apvhdr` (`refno`, `date`, `locationid`, `supplierid`, `supprefno`, `porefno`, `terms`, `notes`, `totqty`, `totamount`, `totdebit`, `totcredit`, `balance`, `id`, `posted`) VALUES
('001', '2013-01-13', 'ed0ceccc28b011e2b4065404a67007de', 'bd48b56927e011e2b4065404a67007de', '101', '100', 1, 'wla', 100, 100.00, 100.00, 110.00, 10.00, '0bf8a00f288011e2b4065404a67007de', 0),
('0001', '2013-01-14', 'e40c5ae628b011e2b4065404a67007de', '0bf8a00f288011e2b4065404a67007de', '12233', '13336', 1, NULL, 0, 0.00, 0.00, 0.00, 0.00, '45e576b25dfe11e2ab4e5404a67007de', 0),
('RT', '2013-01-16', 'cfaf50a55deb11e2ab4e5404a67007de', '0bf8a00f288011e2b4065404a67007de', '', '', 0, NULL, 0, 0.00, 0.00, 0.00, 0.00, '95d4428b5f8c11e2ab4e5404a67007de', 0),
('0002', '2012-11-15', 'db6d515d28b011e2b4065404a67007de', '0bf8a00f288011e2b4065404a67007de', '2323', '5656565', 2, NULL, 0, 0.00, 0.00, 0.00, 0.00, 'b6810f385e0811e2ab4e5404a67007de', 0),
('0003', '2012-11-15', 'cfaf50a55deb11e2ab4e5404a67007de', '0bf8a00f288011e2b4065404a67007de', '2323', '223', 2, NULL, 0, 0.00, 0.00, 0.00, 0.00, 'cb9482cd5e0811e2ab4e5404a67007de', 0);

-- --------------------------------------------------------

--
-- Table structure for table `arledger`
--

CREATE TABLE IF NOT EXISTS `arledger` (
  `customerid` char(32) NOT NULL,
  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `txndate` date NOT NULL,
  `txncode` char(3) DEFAULT '',
  `txnrefno` char(10) DEFAULT '',
  `amount` decimal(15,2) DEFAULT '0.00',
  `prevbal` decimal(15,2) DEFAULT '0.00',
  `currbal` decimal(15,2) DEFAULT '0.00',
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CUSTOMERID` (`customerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `code` char(20) DEFAULT '',
  `descriptor` char(50) DEFAULT '',
  `type` tinyint(4) DEFAULT '0',
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CODE` (`code`),
  KEY `DESCRIPTOR` (`descriptor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`code`, `descriptor`, `type`, `id`) VALUES
('x1', '', 1, '02471a4b1c0b11e293185404a67007de'),
('smb', 'san mig - light', 1, '02f5f18b173d11e2b55d5404a67007de'),
('ffhggg', '', 1, '049a50f81a9411e2ad9f5404a67007de'),
('smb-pp', 'san mig light - pale pilsen', 1, '04fa3a5a173d11e2b55d5404a67007de'),
('x9', '', 1, '0888d23e1c0f11e293185404a67007de'),
('fda9', 'fgsdg', 2, '0b627e09173d11e2b55d5404a67007de'),
('hgfd', '', 1, '15f3ea9c1d6d11e293185404a67007de'),
('sfsdf', '', 1, '1be1e0351c0711e293185404a67007de'),
('fda16', 'bvcbxcbxc', 1, '1c1b59b0173d11e2b55d5404a67007de'),
('x10', '', 1, '2213a5e01c0f11e293185404a67007de'),
('sa', 'dfas', 0, '247dc5fa272911e2b1685404a67007de'),
('x11', '', 1, '248579ca1c0f11e293185404a67007de'),
('x12', '', 1, '264033d51c0f11e293185404a67007de'),
('hgh', 'hgfhdf', 1, '2876035c1bfc11e293185404a67007de'),
('x13', '', 1, '288b9c851c0f11e293185404a67007de'),
('fgsdtre treww', '', 1, '28cc347e1c0911e293185404a67007de'),
('x14', '', 1, '2aeccb961c0f11e293185404a67007de'),
('fgsdtre trewwdsd', '', 1, '2b3008801c0911e293185404a67007de'),
('fdasfafsdfasf', 'gsdgfsd', 1, '2b81ed4a180911e2ad9f5404a67007de'),
('x23', 'fgdgsdgsd', 2, '2c025d5e1c1011e293185404a67007de'),
('fgsdtre trewwdsdDSAD', '', 1, '2ce5d53f1c0911e293185404a67007de'),
('yitriri', '', 1, '2daadfff18d811e2ad9f5404a67007de'),
('fdasdsfad5', '', 1, '2de774cb175411e2b55d5404a67007de'),
('iuyituyi', '', 1, '2e143f1918d911e2ad9f5404a67007de'),
('tttttt', 't', 1, '34a54909272c11e2b1685404a67007de'),
('fd', '', 1, '399d103a180911e2ad9f5404a67007de'),
('fdsa', 'fas', 1, '3b19923d174111e2b55d5404a67007de'),
('x15', '', 1, '3c062d221c0f11e293185404a67007de'),
('x17', '', 1, '3d325eda1c0f11e293185404a67007de'),
('x18', '', 1, '3e39d9f51c0f11e293185404a67007de'),
('marc', 'acebuche', 1, '41e7730b1a9011e2ad9f5404a67007de'),
('x19', '', 1, '430709581c0f11e293185404a67007de'),
('fdsadfs', '', 1, '4695b399174111e2b55d5404a67007de'),
('oop3', '', 1, '4d088ddc18dc11e2ad9f5404a67007de'),
('oop4', '', 1, '4f4e0c2d18dc11e2ad9f5404a67007de'),
('oop5', '', 1, '5104e8f218dc11e2ad9f5404a67007de'),
('oop6', '', 1, '5317aea018dc11e2ad9f5404a67007de'),
('fdsadffd', '', 1, '54009d10174111e2b55d5404a67007de'),
('x2', '', 1, '5592c65d1c0b11e293185404a67007de'),
('oop7', '', 1, '55e5479718dc11e2ad9f5404a67007de'),
('x3', '', 1, '56f65be91c0b11e293185404a67007de'),
('x4', '', 1, '57cc19c61c0b11e293185404a67007de'),
('fdsadff5', '', 1, '5e6334dd174111e2b55d5404a67007de'),
('hannah', 'montana', 1, '5e9bfccb1c0011e293185404a67007de'),
('fdsadff7', '', 1, '6011a3ee174111e2b55d5404a67007de'),
('x20', '', 1, '6378d4ed1c0f11e293185404a67007de'),
('x21', '', 1, '64ee9ad71c0f11e293185404a67007de'),
('iuyityr', 'ityuity', 1, '680a3dcc18d911e2ad9f5404a67007de'),
('fdsafsdafas', '', 1, '68b70639175411e2b55d5404a67007de'),
('ynj', '', 1, '6a0258a2182b11e2ad9f5404a67007de'),
('ynjjf', '', 1, '6be550be182b11e2ad9f5404a67007de'),
('ghghgh oo', '', 1, '6cd21dff1a8d11e2ad9f5404a67007de'),
('ynjj7', '', 1, '6d56c896182b11e2ad9f5404a67007de'),
('ynjj8', '', 1, '6dfe09a9182b11e2ad9f5404a67007de'),
('ynjj10', '', 1, '6fd62f84182b11e2ad9f5404a67007de'),
('fdasfasfasfas', 'fsda', 1, '70026b3717f211e2ad9f5404a67007de'),
('ynjj11', '', 1, '7080dd4a182b11e2ad9f5404a67007de'),
('ynjj12', '', 1, '70f547f4182b11e2ad9f5404a67007de'),
('kunnka', 'fdfasdfa;', 1, '71e5abb41bfc11e293185404a67007de'),
('ynjj13', '', 1, '7248fb30182b11e2ad9f5404a67007de'),
('leslie', 'sy', 2, '728fca9b1a9011e2ad9f5404a67007de'),
('ynjj14', '', 1, '72d1537a182b11e2ad9f5404a67007de'),
('ynjj15', '', 1, '73494398182b11e2ad9f5404a67007de'),
('nmvbmnvb', '', 2, '7394eae118d911e2ad9f5404a67007de'),
('ynjj16', '', 1, '7411d799182b11e2ad9f5404a67007de'),
('yrty', 'ytr', 1, '742983b61a9511e2ad9f5404a67007de'),
('ynjj1', '', 1, '74e7066a182b11e2ad9f5404a67007de'),
('kunnkaf', '', 1, '759caf861bfc11e293185404a67007de'),
('opopo', 'popo', 1, '75ab252119b311e2ad9f5404a67007de'),
('ynjj18', '', 1, '76a3c116182b11e2ad9f5404a67007de'),
('smb1', '', 1, '78d8c9af18dc11e2ad9f5404a67007de'),
('ynjj20', '', 1, '78f1b79c182b11e2ad9f5404a67007de'),
('ppp', '', 1, '7976657318de11e2ad9f5404a67007de'),
('hannah2', 'dsfjajf', 1, '7d48b2fa1c0011e293185404a67007de'),
('opopo3', '', 1, '7e9e4fc619b311e2ad9f5404a67007de'),
('ynjj21', '', 1, '7f3274d6182b11e2ad9f5404a67007de'),
('hannah3', 'dsfasfa', 1, '7f70eb211c0011e293185404a67007de'),
('ynjj22', '', 1, '7fa6f9f5182b11e2ad9f5404a67007de'),
('ynjj23', '', 1, '800fe87a182b11e2ad9f5404a67007de'),
('ynjj24', '', 1, '806fa19e182b11e2ad9f5404a67007de'),
('ynjj25', '', 1, '80ce4416182b11e2ad9f5404a67007de'),
('ynjj26', '', 1, '812e7f8b182b11e2ad9f5404a67007de'),
('ynjj27', '', 1, '8198daa7182b11e2ad9f5404a67007de'),
('ynjj28', '', 1, '81fb8334182b11e2ad9f5404a67007de'),
('ynjj29', '', 1, '826e9a6f182b11e2ad9f5404a67007de'),
('hannah4', 'fsfasjfj', 1, '8271a0791c0011e293185404a67007de'),
('fdsafas fdsafa', '', 1, '83197adb17f611e2ad9f5404a67007de'),
('jefferson', 'salunga', 1, '8372efd61a8e11e2ad9f5404a67007de'),
('mama', 'sara', 2, '83c1fe1b1a9011e2ad9f5404a67007de'),
('ynjj30', '', 1, '846200db182b11e2ad9f5404a67007de'),
('hannah5', 'dhfdshafha', 1, '854443b91c0011e293185404a67007de'),
('hggfhdf', 'hfgh', 1, '860334b81bfc11e293185404a67007de'),
('dddddd', 'fffff', 1, '865842fe27b511e2b1685404a67007de'),
('fdasfa', 'jgd', 1, '865fbbcf17f211e2ad9f5404a67007de'),
('ynjj31', '', 1, '88138d3f182b11e2ad9f5404a67007de'),
('ynjj32', '', 1, '88be1195182b11e2ad9f5404a67007de'),
('ynjj33', 'ghfgh', 1, '89578c12182b11e2ad9f5404a67007de'),
('ynjj34', 'hjgjgfj', 1, '8adf1bb5182b11e2ad9f5404a67007de'),
('urrt', '', 1, '8b5017ee17f311e2ad9f5404a67007de'),
('ynjj35', '', 1, '8b7bb34c182b11e2ad9f5404a67007de'),
('hannah6', 'dfgjhdfash', 2, '8b9f806c1c0011e293185404a67007de'),
('ynjj36', '', 1, '8be3c063182b11e2ad9f5404a67007de'),
('ynjj37', '', 1, '8c4f139b182b11e2ad9f5404a67007de'),
('ynjj38', '', 1, '8cba03ff182b11e2ad9f5404a67007de'),
('gfdgsd', '', 1, '8cbab965175211e2b55d5404a67007de'),
('ynjj39', '', 2, '8d2e1be1182b11e2ad9f5404a67007de'),
('ynjj40', '', 2, '8f097069182b11e2ad9f5404a67007de'),
('ynjj41', '', 2, '9097d449182b11e2ad9f5404a67007de'),
('ynjj42', '', 1, '9117b957182b11e2ad9f5404a67007de'),
('hannah7', 'dhgasfhg', 2, '913986271c0011e293185404a67007de'),
('ynjj43', '', 1, '91b70e8b182b11e2ad9f5404a67007de'),
('ynjj44', '', 1, '920c612f182b11e2ad9f5404a67007de'),
('ynjj45', '', 1, '9268e5da182b11e2ad9f5404a67007de'),
('arnol', 'roy', 1, '92aa0f281bfe11e293185404a67007de'),
('ynjj46', '', 1, '92c2628f182b11e2ad9f5404a67007de'),
('ynjj47', '', 1, '931dd714182b11e2ad9f5404a67007de'),
('ynjj48', '', 1, '937da3c1182b11e2ad9f5404a67007de'),
('ynjj49', '', 1, '93eb8955182b11e2ad9f5404a67007de'),
('ynjj50', '', 1, '95beaef1182b11e2ad9f5404a67007de'),
('ynjj51', '', 1, '97b9b802182b11e2ad9f5404a67007de'),
('fgd', 'gfdgds', 1, '97f821751bfc11e293185404a67007de'),
('ynjj52', '', 1, '9820ab95182b11e2ad9f5404a67007de'),
('ynjj53', '', 1, '987d39aa182b11e2ad9f5404a67007de'),
('ynjj54', '', 1, '98cf147e182b11e2ad9f5404a67007de'),
('ynjj55', '', 1, '9adff190182b11e2ad9f5404a67007de'),
('ynjj5', '', 1, '9bd6bee4182b11e2ad9f5404a67007de'),
('fgsdfgsd', '', 1, '9c972cf81c0a11e293185404a67007de'),
('ynjj', '', 1, '9c9fae12182b11e2ad9f5404a67007de'),
('ynj9', '', 1, '9d5ce183182b11e2ad9f5404a67007de'),
('arnold', 'papa', 2, '9dc085c41bfe11e293185404a67007de'),
('xxxx', 'ssdda', 1, '9dc6101227b011e2b1685404a67007de'),
('gwe', '', 1, '9e90a06e175211e2b55d5404a67007de'),
('fdsfas', 'fasdf', 1, 'a1f4b12117fd11e2ad9f5404a67007de'),
('iuy', '', 1, 'a466c1b818d911e2ad9f5404a67007de'),
('ytr', '', 1, 'a490c6d818dd11e2ad9f5404a67007de'),
('pp1', '', 1, 'a5581fbe18de11e2ad9f5404a67007de'),
('gsdgfgsd', 'gsd', 1, 'a823f0731a9311e2ad9f5404a67007de'),
('x7', '', 1, 'ac296c8d1c0e11e293185404a67007de'),
('low', 'low', 1, 'b21357c21bfb11e293185404a67007de'),
('gh999', 'hdfh', 1, 'b24b9e8f18ee11e2ad9f5404a67007de'),
('ytryrttttttuuu', 'g', 1, 'b281605c1bff11e293185404a67007de'),
('steve', 'dimanalata', 1, 'b3e365141a8f11e2ad9f5404a67007de'),
('gfdgfgsd', '', 1, 'b5964d4918dd11e2ad9f5404a67007de'),
('xxx', '', 1, 'bcf3fe991c0a11e293185404a67007de'),
('fdasfas', '', 1, 'bf4d8bf917fc11e2ad9f5404a67007de'),
('xxx1', '', 1, 'bfb85ca427b011e2b1685404a67007de'),
('ytertyer', 'yt', 1, 'c565ced8272c11e2b1685404a67007de'),
('oop', '', 1, 'ca744faa18db11e2ad9f5404a67007de'),
('dfas', 'fdas', 1, 'caddc2435eda11e2ab4e5404a67007de'),
('jhf', '', 1, 'd3d8e13b17fd11e2ad9f5404a67007de'),
('hhhhhh', '', 1, 'd5d9c7e1272e11e2b1685404a67007de'),
('fdddd', '', 1, 'd8f8e87a27af11e2b1685404a67007de'),
('x8', '', 1, 'ddb3cace1c0e11e293185404a67007de'),
('x5', '', 1, 'e0390d1c1c0b11e293185404a67007de'),
('iuyit', '', 1, 'e0e4a72418dd11e2ad9f5404a67007de'),
('das', 'dfsa', 1, 'e1db91d15ea911e2ab4e5404a67007de'),
('fdas', 'fas', 1, 'e2475f8b173c11e2b55d5404a67007de'),
('jgfj', '', 1, 'e2debf5217fd11e2ad9f5404a67007de'),
('gfsdgsd', 'gfsdg', 1, 'e51e9d471bff11e293185404a67007de'),
('x6', '', 1, 'e595cede1c0b11e293185404a67007de'),
('fdsadfas', '', 1, 'e647c1dd175311e2b55d5404a67007de'),
('x', '', 1, 'ea19b2fb1c0b11e293185404a67007de'),
('iiuyi', '', 1, 'f5ed6c4b18dd11e2ad9f5404a67007de'),
('hanah', 'dfasfsa', 1, 'f72b1bc81bfe11e293185404a67007de'),
('oop2', 'gfdgfgsdgds', 1, 'fb14f48618db11e2ad9f5404a67007de'),
('fdsadfabxc', '', 1, 'fb8c69d0175311e2b55d5404a67007de');

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE IF NOT EXISTS `category_type` (
  `code` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descriptor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category_type`
--

INSERT INTO `category_type` (`code`, `descriptor`) VALUES
(1, 'Product/Service'),
(2, 'Expense');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `code` char(20) DEFAULT '',
  `descriptor` char(50) DEFAULT '',
  `cperson` char(50) DEFAULT '',
  `ctitle` char(50) DEFAULT '',
  `salesmanid` char(32) NOT NULL,
  `terms` decimal(3,0) DEFAULT '0',
  `balance` decimal(15,2) DEFAULT '0.00',
  `address` char(120) DEFAULT '',
  `phone` char(20) DEFAULT '',
  `fax` char(20) DEFAULT '',
  `mobile` char(20) DEFAULT '',
  `email` char(120) DEFAULT '',
  `notes` text,
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CODE` (`code`),
  KEY `DESCRIPTOR` (`descriptor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`code`, `descriptor`, `cperson`, `ctitle`, `salesmanid`, `terms`, `balance`, `address`, `phone`, `fax`, `mobile`, `email`, `notes`, `id`) VALUES
('xxx', 'hfj', 'fadsf', '', 'f80cd814272b11e2b1685404a67007de', 0, 0.00, 'fasd', 'fas', 'fasd', '', '', NULL, '88fd9ba6289f11e2b4065404a67007de'),
('fdsaf', 'fdsafa', '', '', '3c9640d327c011e2b4065404a67007de', 0, 0.00, '', '', '', '', '', NULL, '9b2b9cef289c11e2b4065404a67007de'),
('dd', 'dd', '', '', 'f80cd814272b11e2b1685404a67007de', 0, 0.00, '', '', '', '', '', NULL, 'a37caa8928a411e2b4065404a67007de'),
('ddd', 'dd', '', '', 'f80cd814272b11e2b1685404a67007de', 0, 0.00, '', '', '', '', '', NULL, 'b22fda2e28a411e2b4065404a67007de');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `code` char(20) DEFAULT '',
  `descriptor` char(50) DEFAULT '',
  `type` tinyint(4) DEFAULT '0',
  `categoryid` char(32) NOT NULL,
  `umeasure` char(10) DEFAULT '',
  `longdesc` text,
  `picfile` char(120) DEFAULT '',
  `onhand` decimal(9,0) DEFAULT '0',
  `unitprice` decimal(12,2) DEFAULT '0.00',
  `floorprice` decimal(12,2) DEFAULT '0.00',
  `unitcost` decimal(12,2) DEFAULT '0.00',
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CODE` (`code`),
  KEY `DESCRIPTOR` (`descriptor`),
  KEY `CATEGORYID` (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`code`, `descriptor`, `type`, `categoryid`, `umeasure`, `longdesc`, `picfile`, `onhand`, `unitprice`, `floorprice`, `unitcost`, `id`) VALUES
('jeff5', '', 0, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 0.00, 0.00, 0.00, '01b880d41fcc11e293185404a67007de'),
('gfsdg', 'San Mig Light', 1, '02471a4b1c0b11e293185404a67007de', 'pcs', 'San Miguel Beer - Lights', 'smbl.jpg', 100, 1.00, 1.00, 1.00, '04fa3a5a173d11e2b55d5404a67007de'),
('jeff3', '', 0, '', '', NULL, '', 0, 0.00, 0.00, 0.00, '0d5d5f3f1da911e293185404a67007de'),
('gdfggfgd', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '178d0f4d1da011e293185404a67007de'),
('gfsdgdwsd', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '1b2aaada1d8c11e293185404a67007de'),
('trwe', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '2951adfe1d8311e293185404a67007de'),
('trwetert', '', 2, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '311360561d8311e293185404a67007de'),
('x', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '36ab10531d8c11e293185404a67007de'),
('tere', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '39156920270611e2b1685404a67007de'),
('fdsfafdas', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '3b67dba91d8211e293185404a67007de'),
('twer', '', 4, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '474235ed1d8311e293185404a67007de'),
('hdf', '', 1, '02f5f18b173d11e2b55d5404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '478fd62e1d8b11e293185404a67007de'),
('trew', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '4ea61e571d8311e293185404a67007de'),
('trewr', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '51a0bec51d8311e293185404a67007de'),
('trewrtret', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '5449b0f11d8311e293185404a67007de'),
('trewrtretfdsa', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '5abfe81a1d8311e293185404a67007de'),
('gfsdgsd', '', 1, '02f5f18b173d11e2b55d5404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '5b61bc371d8b11e293185404a67007de'),
('fds', 'fs', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 0.00, '6b39e3b15dfb11e2ab4e5404a67007de'),
('cvx', '', 5, '02471a4b1c0b11e293185404a67007de', '', NULL, 'nerd_herd_logo___chuck_by_freakzman-d31jtko.png', 0, 1.00, 1.00, 1.00, '6bc6c9aa222a11e2b8455404a67007de'),
('dfs', '', 3, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, '82dea6a01d9411e293185404a67007de'),
('jeff', '', 0, '', '', NULL, '', 0, 0.00, 0.00, 0.00, '8bdbf4641da811e293185404a67007de'),
('jeff2', '', 0, '', '', NULL, '', 0, 0.00, 0.00, 0.00, 'afa31c221da811e293185404a67007de'),
('fdasfa', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, 'bb1789a71d8211e293185404a67007de'),
('jeff4', '', 0, '', '', NULL, '', 0, 0.00, 0.00, 0.00, 'ca7f5c521daf11e293185404a67007de'),
('beer', 'fds afas', 1, '02f5f18b173d11e2b55d5404a67007de', 'can', NULL, 'Nike_1990.png', 0, 1.00, 1.00, 100.00, 'cb50b0211ffd11e293185404a67007de'),
('hgdf', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, 'd7458a871d9911e293185404a67007de'),
('gdfg', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, 'dfe60d2a1d8b11e293185404a67007de'),
('hgd', '', 2, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, 'e0f702921d8511e293185404a67007de'),
('gfdsg', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, 'e1e763861da611e293185404a67007de'),
('beer2', 'fas dfas', 1, '02f5f18b173d11e2b55d5404a67007de', 'bottle', NULL, 'Nike_1990.png', 0, 1.00, 1.00, 1.00, 'e483be441ffd11e293185404a67007de'),
('fdsaf', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, 'e53bba241d9811e293185404a67007de'),
('r', '', 1, '02471a4b1c0b11e293185404a67007de', '', NULL, '', 0, 1.00, 1.00, 1.00, 'f67b452b1d9811e293185404a67007de'),
('fdsfa', 'fdf', 1, '04fa3a5a173d11e2b55d5404a67007de', 'box', NULL, '199514_10151271192844665_2024735616_n.jpg', 0, 1.00, 1.00, 1.00, 'f70a707f1d8111e293185404a67007de');

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE IF NOT EXISTS `item_type` (
  `code` int(10) unsigned DEFAULT NULL,
  `descriptor` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`code`, `descriptor`) VALUES
(1, 'Product'),
(2, 'Service'),
(3, 'Opex'),
(4, 'Capex'),
(5, 'Accruals');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `code` char(20) DEFAULT '',
  `descriptor` char(50) DEFAULT '',
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CODE` (`code`),
  KEY `DESCRIPTOR` (`descriptor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`code`, `descriptor`, `id`) VALUES
('pag', 'Pangasinan', 'cfaf50a55deb11e2ab4e5404a67007de'),
('mla', 'Manila', 'db6d515d28b011e2b4065404a67007de'),
('cbu', 'Cebu', 'e40c5ae628b011e2b4065404a67007de'),
('tlc', 'Tarlac', 'ed0ceccc28b011e2b4065404a67007de');

-- --------------------------------------------------------

--
-- Table structure for table `locationinvty`
--

CREATE TABLE IF NOT EXISTS `locationinvty` (
  `itemid` char(32) NOT NULL,
  `locationid` char(32) NOT NULL,
  `onhand` decimal(9,0) DEFAULT '0',
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ITEMID` (`itemid`),
  KEY `LOCATIONID` (`locationid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE IF NOT EXISTS `salesman` (
  `code` char(20) DEFAULT '',
  `descriptor` char(50) DEFAULT '',
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CODE` (`code`),
  KEY `DESCRIPTOR` (`descriptor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`code`, `descriptor`, `id`) VALUES
('achua', 'Adrian Chua', '3c9640d327c011e2b4065404a67007de'),
('jrsalunga', 'Jefferson Salunga', 'f80cd814272b11e2b1685404a67007de');

-- --------------------------------------------------------

--
-- Table structure for table `stockcard`
--

CREATE TABLE IF NOT EXISTS `stockcard` (
  `itemid` char(32) NOT NULL,
  `locationid` char(32) NOT NULL,
  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `txndate` date NOT NULL,
  `txncode` char(3) DEFAULT '',
  `txnrefno` char(10) DEFAULT '',
  `qty` decimal(7,0) DEFAULT '0',
  `prevbal` decimal(9,0) DEFAULT '0',
  `currbal` decimal(9,0) DEFAULT '0',
  `prevbalx` decimal(9,0) DEFAULT '0',
  `currbalx` decimal(9,0) DEFAULT '0',
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ITEMID` (`itemid`),
  KEY `LOCATIONID` (`locationid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `code` char(20) DEFAULT '',
  `descriptor` char(50) DEFAULT '',
  `payee` char(50) DEFAULT '',
  `cperson` char(50) DEFAULT '',
  `ctitle` char(50) DEFAULT '',
  `terms` decimal(3,0) DEFAULT '0',
  `balance` decimal(15,2) DEFAULT '0.00',
  `address` char(120) DEFAULT '',
  `phone` char(20) DEFAULT '',
  `fax` char(20) DEFAULT '',
  `mobile` char(20) DEFAULT '',
  `email` char(120) DEFAULT '',
  `notes` text,
  `id` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CODE` (`code`),
  KEY `DESCRIPTOR` (`descriptor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`code`, `descriptor`, `payee`, `cperson`, `ctitle`, `terms`, `balance`, `address`, `phone`, `fax`, `mobile`, `email`, `notes`, `id`) VALUES
('asa', 'San Mig Trading', 'Carlos Tan', 'Edwin Lacierda', 'Manager', 2, 100.00, 'Mangga St., Brgy 621, Sta Mesa, Manila 1006', '523-3658', '569-6354', '63955569965', 'smt@yahoo.com', 'di pwede umutang', '0bf8a00f288011e2b4065404a67007de'),
('xxx', 'Bakal Supplier', 'Juan Tamd', 'Boss Sado', 'Manager', 2, 100.00, 'Sampaloc, Manila', '522-6324', '532-6364', '09273693375', 'juantama@yahoo.com', NULL, 'bd48b56927e011e2b4065404a67007de');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vapvhdr`
--
CREATE TABLE IF NOT EXISTS `vapvhdr` (
`refno` char(10)
,`date` date
,`location` char(50)
,`supplier` char(50)
,`supprefno` char(15)
,`porefno` char(15)
,`terms` tinyint(4)
,`totqty` decimal(9,0)
,`totamount` decimal(15,2)
,`totdebit` decimal(15,2)
,`totcredit` decimal(15,2)
,`balance` decimal(15,2)
,`id` char(32)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vcategory`
--
CREATE TABLE IF NOT EXISTS `vcategory` (
`code` char(20)
,`descriptor` char(50)
,`type` varchar(45)
,`id` char(32)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vcustomer`
--
CREATE TABLE IF NOT EXISTS `vcustomer` (
`id` char(32)
,`code` char(20)
,`descriptor` char(50)
,`cperson` char(50)
,`ctitle` char(50)
,`salesman` char(50)
,`terms` decimal(3,0)
,`balance` decimal(15,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `vitem`
--
CREATE TABLE IF NOT EXISTS `vitem` (
`code` char(20)
,`descriptor` char(50)
,`type` varchar(45)
,`category` char(50)
,`onhand` decimal(9,0)
,`unitprice` decimal(12,2)
,`floorprice` decimal(12,2)
,`unitcost` decimal(12,2)
,`umeasure` char(10)
,`id` char(32)
);
-- --------------------------------------------------------

--
-- Structure for view `vapvhdr`
--
DROP TABLE IF EXISTS `vapvhdr`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vapvhdr` AS select `a`.`refno` AS `refno`,`a`.`date` AS `date`,`b`.`descriptor` AS `location`,`c`.`descriptor` AS `supplier`,`a`.`supprefno` AS `supprefno`,`a`.`porefno` AS `porefno`,`a`.`terms` AS `terms`,`a`.`totqty` AS `totqty`,`a`.`totamount` AS `totamount`,`a`.`totdebit` AS `totdebit`,`a`.`totcredit` AS `totcredit`,`a`.`balance` AS `balance`,`a`.`id` AS `id` from ((`apvhdr` `a` join `location` `b`) join `supplier` `c`) where ((`a`.`locationid` = `b`.`id`) and (`a`.`supplierid` = `c`.`id`)) order by `a`.`date` desc;

-- --------------------------------------------------------

--
-- Structure for view `vcategory`
--
DROP TABLE IF EXISTS `vcategory`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vcategory` AS select `a`.`code` AS `code`,`a`.`descriptor` AS `descriptor`,`b`.`descriptor` AS `type`,`a`.`id` AS `id` from (`category` `a` join `category_type` `b`) where (`a`.`type` = `b`.`code`) order by `a`.`type`;

-- --------------------------------------------------------

--
-- Structure for view `vcustomer`
--
DROP TABLE IF EXISTS `vcustomer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vcustomer` AS select `a`.`id` AS `id`,`a`.`code` AS `code`,`a`.`descriptor` AS `descriptor`,`a`.`cperson` AS `cperson`,`a`.`ctitle` AS `ctitle`,`b`.`descriptor` AS `salesman`,`a`.`terms` AS `terms`,`a`.`balance` AS `balance` from (`customer` `a` join `salesman` `b`) where (`a`.`salesmanid` = `b`.`id`);

-- --------------------------------------------------------

--
-- Structure for view `vitem`
--
DROP TABLE IF EXISTS `vitem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vitem` AS select `a`.`code` AS `code`,`a`.`descriptor` AS `descriptor`,`c`.`descriptor` AS `type`,`b`.`descriptor` AS `category`,`a`.`onhand` AS `onhand`,`a`.`unitprice` AS `unitprice`,`a`.`floorprice` AS `floorprice`,`a`.`unitcost` AS `unitcost`,`a`.`umeasure` AS `umeasure`,`a`.`id` AS `id` from ((`item` `a` join `category` `b`) join `item_type` `c`) where ((`a`.`categoryid` = `b`.`id`) and (`a`.`type` = `c`.`code`));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
