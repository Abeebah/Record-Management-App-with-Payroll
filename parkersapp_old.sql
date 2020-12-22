-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2018 at 05:25 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkersapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `pk_categories`
--

CREATE TABLE `pk_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` int(11) DEFAULT NULL,
  `date_deleted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pk_categories`
--

INSERT INTO `pk_categories` (`id`, `name`, `description`, `class`, `created_by`, `date_created`, `deleted_by`, `date_deleted`, `is_active`) VALUES
(1, 'Fees ', 'Fees for stuff', 'Debit', NULL, '2018-10-19 08:59:45', 5, '2018-10-19 08:59:45', 0),
(2, 'Fuel', 'fuel for the week ', 'Credit', NULL, '2018-10-19 09:02:20', 5, '2018-10-19 09:02:20', 1),
(5, 'ticket', 'TICK TO  SHOW', 'Credit', NULL, '2018-10-19 09:35:49', 5, '2018-10-19 09:35:49', 0),
(6, 'dante', 'fixed', 'Credit', NULL, '2018-10-19 09:44:39', 5, '2018-10-19 09:44:39', 1),
(7, 'prove', 'prove in the end', 'Credit', NULL, '2018-10-25 09:40:37', 5, '2018-10-25 09:40:37', 0),
(8, 'mean', 'mean cat', 'Debit', 5, '2018-10-29 16:08:14', NULL, '2018-10-29 16:08:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pk_company`
--

CREATE TABLE `pk_company` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `company_balance` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(15) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` int(11) DEFAULT NULL,
  `date_deleted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pk_company`
--

INSERT INTO `pk_company` (`id`, `name`, `description`, `company_balance`, `status`, `created_by`, `date_created`, `deleted_by`, `date_deleted`, `is_active`) VALUES
(1, 'Parkers inc.', 'Parkers Investment Ltd', '', NULL, NULL, '2018-10-11 16:57:29', 5, '2018-10-11 16:57:29', 0),
(3, 'Omolomo', 'Hello uhit', '1200', NULL, NULL, '2018-10-13 18:23:39', 5, '2018-10-13 18:23:39', 1),
(4, 'Dexterity', 'Company september', '0', NULL, NULL, '2018-10-18 16:24:39', 5, '2018-10-18 16:24:39', 1),
(5, 'fress', 'sdfa', '', NULL, 5, '2018-10-29 16:02:53', 5, '2018-10-29 16:02:53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pk_expenses`
--

CREATE TABLE `pk_expenses` (
  `id` int(3) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `description` varchar(225) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `expense_amount` decimal(10,0) DEFAULT NULL,
  `balance` decimal(10,0) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pk_expenses`
--

INSERT INTO `pk_expenses` (`id`, `company_id`, `description`, `category`, `expense_amount`, `balance`, `date_created`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 4, 'thi is heere', 'Fueldantemean', '1000', '0', '2018-11-04 17:08:23', 5, NULL, NULL),
(2, 4, 'test testing', '6', '1000', '0', '2018-11-04 17:09:27', 5, NULL, NULL),
(3, 3, 'testing', '2', '100', '0', '2018-11-04 17:33:38', 5, NULL, NULL),
(4, 3, 'testing', '2', '100', '0', '2018-11-04 17:35:06', 5, NULL, NULL),
(5, 3, 'testing', '2', '100', '0', '2018-11-04 17:35:59', 5, NULL, NULL),
(6, 3, 'testing', '2', '100', '0', '2018-11-04 17:36:19', 5, NULL, NULL),
(7, 4, 'testing', '2', '1000', '0', '2018-11-04 17:43:02', 5, NULL, NULL),
(8, 4, 'testing', '2', '1000', '0', '2018-11-04 17:43:42', 5, NULL, NULL),
(9, 4, 'testing', '2', '100', '0', '2018-11-04 17:44:19', 5, NULL, NULL),
(11, 3, 'expense', '2', '1000', '200', '2018-11-04 17:50:13', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pk_income`
--

CREATE TABLE `pk_income` (
  `id` int(3) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `income_amount` decimal(10,0) DEFAULT NULL,
  `balance` decimal(10,0) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pk_income`
--

INSERT INTO `pk_income` (`id`, `company_id`, `description`, `category`, `income_amount`, `balance`, `date_created`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 3, 'thi is heere', 'Fueldantemean', '1000', '0', '2018-11-04 17:07:59', 5, NULL, NULL),
(2, 4, 'test testing', '6', '1000', '0', '2018-11-04 17:09:19', 5, NULL, NULL),
(3, 3, 'trial ', '2', '1000', '0', '2018-11-04 17:31:22', 5, NULL, NULL),
(4, 3, 'testing', '2', '100', '0', '2018-11-04 17:37:59', 5, NULL, NULL),
(5, 3, 'testing', '2', '100', '0', '2018-11-04 17:38:53', 5, NULL, NULL),
(6, 3, 'testing', '2', '100', '0', '2018-11-04 17:40:06', 5, NULL, NULL),
(7, 3, 'testing', '2', '100', '0', '2018-11-04 17:40:39', 5, NULL, NULL),
(8, 3, 'testing', '2', '100', '0', '2018-11-04 17:40:47', 5, NULL, NULL),
(9, 3, 'testing', '2', '1000', '0', '2018-11-04 17:40:55', 5, NULL, NULL),
(10, 4, 'testing', '2', '1000', '0', '2018-11-04 17:41:07', 5, NULL, NULL),
(11, 3, 'expense', '2', '1000', '1200', '2018-11-04 17:51:03', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pk_locals`
--

CREATE TABLE `pk_locals` (
  `local_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `local_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pk_locals`
--

INSERT INTO `pk_locals` (`local_id`, `state_id`, `local_name`) VALUES
(1, 1, 'Aba South'),
(2, 1, 'Arochukwu'),
(3, 1, 'Bende'),
(4, 1, 'Ikwuano'),
(5, 1, 'Isiala Ngwa North'),
(6, 1, 'Isiala Ngwa South'),
(7, 1, 'Isuikwuato'),
(8, 1, 'Obi Ngwa'),
(9, 1, 'Ohafia'),
(10, 1, 'Osisioma'),
(11, 1, 'Ugwunagbo'),
(12, 1, 'Ukwa East'),
(13, 1, 'Ukwa West'),
(14, 1, 'Umuahia North'),
(15, 1, 'Umuahia South'),
(16, 1, 'Umu Nneochi'),
(17, 2, 'Fufure'),
(18, 2, 'Ganye'),
(19, 2, 'Gayuk'),
(20, 2, 'Gombi'),
(21, 2, 'Grie'),
(22, 2, 'Hong'),
(23, 2, 'Jada'),
(24, 2, 'Lamurde'),
(25, 2, 'Madagali'),
(26, 2, 'Maiha'),
(27, 2, 'Mayo Belwa'),
(28, 2, 'Michika'),
(29, 2, 'Mubi North'),
(30, 2, 'Mubi South'),
(31, 2, 'Numan'),
(32, 2, 'Shelleng'),
(33, 2, 'Song'),
(34, 2, 'Toungo'),
(35, 2, 'Yola North'),
(36, 2, 'Yola South'),
(37, 3, 'Eastern Obolo'),
(38, 3, 'Eket'),
(39, 3, 'Esit Eket'),
(40, 3, 'Essien Udim'),
(41, 3, 'Etim Ekpo'),
(42, 3, 'Etinan'),
(43, 3, 'Ibeno'),
(44, 3, 'Ibesikpo Asutan'),
(45, 3, 'Ibiono-Ibom'),
(46, 3, 'Ika'),
(47, 3, 'Ikono'),
(48, 3, 'Ikot Abasi'),
(49, 3, 'Ikot Ekpene'),
(50, 3, 'Ini'),
(51, 3, 'Itu'),
(52, 3, 'Mbo'),
(53, 3, 'Mkpat-Enin'),
(54, 3, 'Nsit-Atai'),
(55, 3, 'Nsit-Ibom'),
(56, 3, 'Nsit-Ubium'),
(57, 3, 'Obot Akara'),
(58, 3, 'Okobo'),
(59, 3, 'Onna'),
(60, 3, 'Oron'),
(61, 3, 'Oruk Anam'),
(62, 3, 'Udung-Uko'),
(63, 3, 'Ukanafun'),
(64, 3, 'Uruan'),
(65, 3, 'Urue-Offong/Oruko'),
(66, 3, 'Uyo'),
(67, 4, 'Anambra East'),
(68, 4, 'Anambra West'),
(69, 4, 'Anaocha'),
(70, 4, 'Awka North'),
(71, 4, 'Awka South'),
(72, 4, 'Ayamelum'),
(73, 4, 'Dunukofia'),
(74, 4, 'Ekwusigo'),
(75, 4, 'Idemili North'),
(76, 4, 'Idemili South'),
(77, 4, 'Ihiala'),
(78, 4, 'Njikoka'),
(79, 4, 'Nnewi North'),
(80, 4, 'Nnewi South'),
(81, 4, 'Ogbaru'),
(82, 4, 'Onitsha North'),
(83, 4, 'Onitsha South'),
(84, 4, 'Orumba North'),
(85, 4, 'Orumba South'),
(86, 4, 'Oyi'),
(87, 5, 'Bauchi'),
(88, 5, 'Bogoro'),
(89, 5, 'Damban'),
(90, 5, 'Darazo'),
(91, 5, 'Dass'),
(92, 5, 'Gamawa'),
(93, 5, 'Ganjuwa'),
(94, 5, 'Giade'),
(95, 5, 'Itas/Gadau'),
(96, 5, 'Jama\'are'),
(97, 5, 'Katagum'),
(98, 5, 'Kirfi'),
(99, 5, 'Misau'),
(100, 5, 'Ningi'),
(101, 5, 'Shira'),
(102, 5, 'Tafawa Balewa'),
(103, 5, 'Toro'),
(104, 5, 'Warji'),
(105, 5, 'Zaki'),
(106, 6, 'Ekeremor'),
(107, 6, 'Kolokuma/Opokuma'),
(108, 6, 'Nembe'),
(109, 6, 'Ogbia'),
(110, 6, 'Sagbama'),
(111, 6, 'Southern Ijaw'),
(112, 6, 'Yenagoa'),
(113, 7, 'Apa'),
(114, 7, 'Ado'),
(115, 7, 'Buruku'),
(116, 7, 'Gboko'),
(117, 7, 'Guma'),
(118, 7, 'Gwer East'),
(119, 7, 'Gwer West'),
(120, 7, 'Katsina-Ala'),
(121, 7, 'Konshisha'),
(122, 7, 'Kwande'),
(123, 7, 'Logo'),
(124, 7, 'Makurdi'),
(125, 7, 'Obi'),
(126, 7, 'Ogbadibo'),
(127, 7, 'Ohimini'),
(128, 7, 'Oju'),
(129, 7, 'Okpokwu'),
(130, 7, 'Oturkpo'),
(131, 7, 'Tarka'),
(132, 7, 'Ukum'),
(133, 7, 'Ushongo'),
(134, 7, 'Vandeikya'),
(135, 8, 'Askira/Uba'),
(136, 8, 'Bama'),
(137, 8, 'Bayo'),
(138, 8, 'Biu'),
(139, 8, 'Chibok'),
(140, 8, 'Damboa'),
(141, 8, 'Dikwa'),
(142, 8, 'Gubio'),
(143, 8, 'Guzamala'),
(144, 8, 'Gwoza'),
(145, 8, 'Hawul'),
(146, 8, 'Jere'),
(147, 8, 'Kaga'),
(148, 8, 'Kala/Balge'),
(149, 8, 'Konduga'),
(150, 8, 'Kukawa'),
(151, 8, 'Kwaya Kusar'),
(152, 8, 'Mafa'),
(153, 8, 'Magumeri'),
(154, 8, 'Maiduguri'),
(155, 8, 'Marte'),
(156, 8, 'Mobbar'),
(157, 8, 'Monguno'),
(158, 8, 'Ngala'),
(159, 8, 'Nganzai'),
(160, 8, 'Shani'),
(161, 9, 'Akamkpa'),
(162, 9, 'Akpabuyo'),
(163, 9, 'Bakassi'),
(164, 9, 'Bekwarra'),
(165, 9, 'Biase'),
(166, 9, 'Boki'),
(167, 9, 'Calabar Municipal'),
(168, 9, 'Calabar South'),
(169, 9, 'Etung'),
(170, 9, 'Ikom'),
(171, 9, 'Obanliku'),
(172, 9, 'Obubra'),
(173, 9, 'Obudu'),
(174, 9, 'Odukpani'),
(175, 9, 'Ogoja'),
(176, 9, 'Yakuur'),
(177, 9, 'Yala'),
(178, 10, 'Aniocha South'),
(179, 10, 'Bomadi'),
(180, 10, 'Burutu'),
(181, 10, 'Ethiope East'),
(182, 10, 'Ethiope West'),
(183, 10, 'Ika North East'),
(184, 10, 'Ika South'),
(185, 10, 'Isoko North'),
(186, 10, 'Isoko South'),
(187, 10, 'Ndokwa East'),
(188, 10, 'Ndokwa West'),
(189, 10, 'Okpe'),
(190, 10, 'Oshimili North'),
(191, 10, 'Oshimili South'),
(192, 10, 'Patani'),
(193, 10, 'Sapele'),
(194, 10, 'Udu'),
(195, 10, 'Ughelli North'),
(196, 10, 'Ughelli South'),
(197, 10, 'Ukwuani'),
(198, 10, 'Uvwie'),
(199, 10, 'Warri North'),
(200, 10, 'Warri South'),
(201, 10, 'Warri South West'),
(202, 11, 'Afikpo North'),
(203, 11, 'Afikpo South'),
(204, 11, 'Ebonyi'),
(205, 11, 'Ezza North'),
(206, 11, 'Ezza South'),
(207, 11, 'Ikwo'),
(208, 11, 'Ishielu'),
(209, 11, 'Ivo'),
(210, 11, 'Izzi'),
(211, 11, 'Ohaozara'),
(212, 11, 'Ohaukwu'),
(213, 11, 'Onicha'),
(214, 12, 'Egor'),
(215, 12, 'Esan Central'),
(216, 12, 'Esan North-East'),
(217, 12, 'Esan South-East'),
(218, 12, 'Esan West'),
(219, 12, 'Etsako Central'),
(220, 12, 'Etsako East'),
(221, 12, 'Etsako West'),
(222, 12, 'Igueben'),
(223, 12, 'Ikpoba Okha'),
(224, 12, 'Orhionmwon'),
(225, 12, 'Oredo'),
(226, 12, 'Ovia North-East'),
(227, 12, 'Ovia South-West'),
(228, 12, 'Owan East'),
(229, 12, 'Owan West'),
(230, 12, 'Uhunmwonde'),
(231, 13, 'Efon'),
(232, 13, 'Ekiti East'),
(233, 13, 'Ekiti South-West'),
(234, 13, 'Ekiti West'),
(235, 13, 'Emure'),
(236, 13, 'Gbonyin'),
(237, 13, 'Ido Osi'),
(238, 13, 'Ijero'),
(239, 13, 'Ikere'),
(240, 13, 'Ikole'),
(241, 13, 'Ilejemeje'),
(242, 13, 'Irepodun/Ifelodun'),
(243, 13, 'Ise/Orun'),
(244, 13, 'Moba'),
(245, 13, 'Oye'),
(246, 14, 'Awgu'),
(247, 14, 'Enugu East'),
(248, 14, 'Enugu North'),
(249, 14, 'Enugu South'),
(250, 14, 'Ezeagu'),
(251, 14, 'Igbo Etiti'),
(252, 14, 'Igbo Eze North'),
(253, 14, 'Igbo Eze South'),
(254, 14, 'Isi Uzo'),
(255, 14, 'Nkanu East'),
(256, 14, 'Nkanu West'),
(257, 14, 'Nsukka'),
(258, 14, 'Oji River'),
(259, 14, 'Udenu'),
(260, 14, 'Udi'),
(261, 14, 'Uzo Uwani'),
(262, 15, 'Bwari'),
(263, 15, 'Gwagwalada'),
(264, 15, 'Kuje'),
(265, 15, 'Kwali'),
(266, 15, 'Municipal Area Council'),
(267, 16, 'Balanga'),
(268, 16, 'Billiri'),
(269, 16, 'Dukku'),
(270, 16, 'Funakaye'),
(271, 16, 'Gombe'),
(272, 16, 'Kaltungo'),
(273, 16, 'Kwami'),
(274, 16, 'Nafada'),
(275, 16, 'Shongom'),
(276, 16, 'Yamaltu/Deba'),
(277, 17, 'Ahiazu Mbaise'),
(278, 17, 'Ehime Mbano'),
(279, 17, 'Ezinihitte'),
(280, 17, 'Ideato North'),
(281, 17, 'Ideato South'),
(282, 17, 'Ihitte/Uboma'),
(283, 17, 'Ikeduru'),
(284, 17, 'Isiala Mbano'),
(285, 17, 'Isu'),
(286, 17, 'Mbaitoli'),
(287, 17, 'Ngor Okpala'),
(288, 17, 'Njaba'),
(289, 17, 'Nkwerre'),
(290, 17, 'Nwangele'),
(291, 17, 'Obowo'),
(292, 17, 'Oguta'),
(293, 17, 'Ohaji/Egbema'),
(294, 17, 'Okigwe'),
(295, 17, 'Orlu'),
(296, 17, 'Orsu'),
(297, 17, 'Oru East'),
(298, 17, 'Oru West'),
(299, 17, 'Owerri Municipal'),
(300, 17, 'Owerri North'),
(301, 17, 'Owerri West'),
(302, 17, 'Unuimo'),
(303, 18, 'Babura'),
(304, 18, 'Biriniwa'),
(305, 18, 'Birnin Kudu'),
(306, 18, 'Buji'),
(307, 18, 'Dutse'),
(308, 18, 'Gagarawa'),
(309, 18, 'Garki'),
(310, 18, 'Gumel'),
(311, 18, 'Guri'),
(312, 18, 'Gwaram'),
(313, 18, 'Gwiwa'),
(314, 18, 'Hadejia'),
(315, 18, 'Jahun'),
(316, 18, 'Kafin Hausa'),
(317, 18, 'Kazaure'),
(318, 18, 'Kiri Kasama'),
(319, 18, 'Kiyawa'),
(320, 18, 'Kaugama'),
(321, 18, 'Maigatari'),
(322, 18, 'Malam Madori'),
(323, 18, 'Miga'),
(324, 18, 'Ringim'),
(325, 18, 'Roni'),
(326, 18, 'Sule Tankarkar'),
(327, 18, 'Taura'),
(328, 18, 'Yankwashi'),
(329, 19, 'Chikun'),
(330, 19, 'Giwa'),
(331, 19, 'Igabi'),
(332, 19, 'Ikara'),
(333, 19, 'Jaba'),
(334, 19, 'Jema\'a'),
(335, 19, 'Kachia'),
(336, 19, 'Kaduna North'),
(337, 19, 'Kaduna South'),
(338, 19, 'Kagarko'),
(339, 19, 'Kajuru'),
(340, 19, 'Kaura'),
(341, 19, 'Kauru'),
(342, 19, 'Kubau'),
(343, 19, 'Kudan'),
(344, 19, 'Lere'),
(345, 19, 'Makarfi'),
(346, 19, 'Sabon Gari'),
(347, 19, 'Sanga'),
(348, 19, 'Soba'),
(349, 19, 'Zangon Kataf'),
(350, 19, 'Zaria'),
(351, 20, 'Albasu'),
(352, 20, 'Bagwai'),
(353, 20, 'Bebeji'),
(354, 20, 'Bichi'),
(355, 20, 'Bunkure'),
(356, 20, 'Dala'),
(357, 20, 'Dambatta'),
(358, 20, 'Dawakin Kudu'),
(359, 20, 'Dawakin Tofa'),
(360, 20, 'Doguwa'),
(361, 20, 'Fagge'),
(362, 20, 'Gabasawa'),
(363, 20, 'Garko'),
(364, 20, 'Garun Mallam'),
(365, 20, 'Gaya'),
(366, 20, 'Gezawa'),
(367, 20, 'Gwale'),
(368, 20, 'Gwarzo'),
(369, 20, 'Kabo'),
(370, 20, 'Kano Municipal'),
(371, 20, 'Karaye'),
(372, 20, 'Kibiya'),
(373, 20, 'Kiru'),
(374, 20, 'Kumbotso'),
(375, 20, 'Kunchi'),
(376, 20, 'Kura'),
(377, 20, 'Madobi'),
(378, 20, 'Makoda'),
(379, 20, 'Minjibir'),
(380, 20, 'Nasarawa'),
(381, 20, 'Rano'),
(382, 20, 'Rimin Gado'),
(383, 20, 'Rogo'),
(384, 20, 'Shanono'),
(385, 20, 'Sumaila'),
(386, 20, 'Takai'),
(387, 20, 'Tarauni'),
(388, 20, 'Tofa'),
(389, 20, 'Tsanyawa'),
(390, 20, 'Tudun Wada'),
(391, 20, 'Ungogo'),
(392, 20, 'Warawa'),
(393, 20, 'Wudil'),
(394, 21, 'Batagarawa'),
(395, 21, 'Batsari'),
(396, 21, 'Baure'),
(397, 21, 'Bindawa'),
(398, 21, 'Charanchi'),
(399, 21, 'Dandume'),
(400, 21, 'Danja'),
(401, 21, 'Dan Musa'),
(402, 21, 'Daura'),
(403, 21, 'Dutsi'),
(404, 21, 'Dutsin Ma'),
(405, 21, 'Faskari'),
(406, 21, 'Funtua'),
(407, 21, 'Ingawa'),
(408, 21, 'Jibia'),
(409, 21, 'Kafur'),
(410, 21, 'Kaita'),
(411, 21, 'Kankara'),
(412, 21, 'Kankia'),
(413, 21, 'Katsina'),
(414, 21, 'Kurfi'),
(415, 21, 'Kusada'),
(416, 21, 'Mai\'Adua'),
(417, 21, 'Malumfashi'),
(418, 21, 'Mani'),
(419, 21, 'Mashi'),
(420, 21, 'Matazu'),
(421, 21, 'Musawa'),
(422, 21, 'Rimi'),
(423, 21, 'Sabuwa'),
(424, 21, 'Safana'),
(425, 21, 'Sandamu'),
(426, 21, 'Zango'),
(427, 22, 'Arewa Dandi'),
(428, 22, 'Argungu'),
(429, 22, 'Augie'),
(430, 22, 'Bagudo'),
(431, 22, 'Birnin Kebbi'),
(432, 22, 'Bunza'),
(433, 22, 'Dandi'),
(434, 22, 'Fakai'),
(435, 22, 'Gwandu'),
(436, 22, 'Jega'),
(437, 22, 'Kalgo'),
(438, 22, 'Koko/Besse'),
(439, 22, 'Maiyama'),
(440, 22, 'Ngaski'),
(441, 22, 'Sakaba'),
(442, 22, 'Shanga'),
(443, 22, 'Suru'),
(444, 22, 'Wasagu/Danko'),
(445, 22, 'Yauri'),
(446, 22, 'Zuru'),
(447, 23, 'Ajaokuta'),
(448, 23, 'Ankpa'),
(449, 23, 'Bassa'),
(450, 23, 'Dekina'),
(451, 23, 'Ibaji'),
(452, 23, 'Idah'),
(453, 23, 'Igalamela Odolu'),
(454, 23, 'Ijumu'),
(455, 23, 'Kabba/Bunu'),
(456, 23, 'Kogi'),
(457, 23, 'Lokoja'),
(458, 23, 'Mopa Muro'),
(459, 23, 'Ofu'),
(460, 23, 'Ogori/Magongo'),
(461, 23, 'Okehi'),
(462, 23, 'Okene'),
(463, 23, 'Olamaboro'),
(464, 23, 'Omala'),
(465, 23, 'Yagba East'),
(466, 23, 'Yagba West'),
(467, 24, 'Baruten'),
(468, 24, 'Edu'),
(469, 24, 'Ekiti'),
(470, 24, 'Ifelodun'),
(471, 24, 'Ilorin East'),
(472, 24, 'Ilorin South'),
(473, 24, 'Ilorin West'),
(474, 24, 'Irepodun'),
(475, 24, 'Isin'),
(476, 24, 'Kaiama'),
(477, 24, 'Moro'),
(478, 24, 'Offa'),
(479, 24, 'Oke Ero'),
(480, 24, 'Oyun'),
(481, 24, 'Pategi'),
(482, 25, 'Ajeromi-Ifelodun'),
(483, 25, 'Alimosho'),
(484, 25, 'Amuwo-Odofin'),
(485, 25, 'Apapa'),
(486, 25, 'Badagry'),
(487, 25, 'Epe'),
(488, 25, 'Eti Osa'),
(489, 25, 'Ibeju-Lekki'),
(490, 25, 'Ifako-Ijaiye'),
(491, 25, 'Ikeja'),
(492, 25, 'Ikorodu'),
(493, 25, 'Kosofe'),
(494, 25, 'Lagos Island'),
(495, 25, 'Lagos Mainland'),
(496, 25, 'Mushin'),
(497, 25, 'Ojo'),
(498, 25, 'Oshodi-Isolo'),
(499, 25, 'Shomolu'),
(500, 25, 'Surulere'),
(501, 26, 'Awe'),
(502, 26, 'Doma'),
(503, 26, 'Karu'),
(504, 26, 'Keana'),
(505, 26, 'Keffi'),
(506, 26, 'Kokona'),
(507, 26, 'Lafia'),
(508, 26, 'Nasarawa'),
(509, 26, 'Nasarawa Egon'),
(510, 26, 'Obi'),
(511, 26, 'Toto'),
(512, 26, 'Wamba'),
(513, 27, 'Agwara'),
(514, 27, 'Bida'),
(515, 27, 'Borgu'),
(516, 27, 'Bosso'),
(517, 27, 'Chanchaga'),
(518, 27, 'Edati'),
(519, 27, 'Gbako'),
(520, 27, 'Gurara'),
(521, 27, 'Katcha'),
(522, 27, 'Kontagora'),
(523, 27, 'Lapai'),
(524, 27, 'Lavun'),
(525, 27, 'Magama'),
(526, 27, 'Mariga'),
(527, 27, 'Mashegu'),
(528, 27, 'Mokwa'),
(529, 27, 'Moya'),
(530, 27, 'Paikoro'),
(531, 27, 'Rafi'),
(532, 27, 'Rijau'),
(533, 27, 'Shiroro'),
(534, 27, 'Suleja'),
(535, 27, 'Tafa'),
(536, 27, 'Wushishi'),
(537, 28, 'Abeokuta South'),
(538, 28, 'Ado-Odo/Ota'),
(539, 28, 'Egbado North'),
(540, 28, 'Egbado South'),
(541, 28, 'Ewekoro'),
(542, 28, 'Ifo'),
(543, 28, 'Ijebu East'),
(544, 28, 'Ijebu North'),
(545, 28, 'Ijebu North East'),
(546, 28, 'Ijebu Ode'),
(547, 28, 'Ikenne'),
(548, 28, 'Imeko Afon'),
(549, 28, 'Ipokia'),
(550, 28, 'Obafemi Owode'),
(551, 28, 'Odeda'),
(552, 28, 'Odogbolu'),
(553, 28, 'Ogun Waterside'),
(554, 28, 'Remo North'),
(555, 28, 'Shagamu'),
(556, 29, 'Akoko North-West'),
(557, 29, 'Akoko South-West'),
(558, 29, 'Akoko South-East'),
(559, 29, 'Akure North'),
(560, 29, 'Akure South'),
(561, 29, 'Ese Odo'),
(562, 29, 'Idanre'),
(563, 29, 'Ifedore'),
(564, 29, 'Ilaje'),
(565, 29, 'Ile Oluji/Okeigbo'),
(566, 29, 'Irele'),
(567, 29, 'Odigbo'),
(568, 29, 'Okitipupa'),
(569, 29, 'Ondo East'),
(570, 29, 'Ondo West'),
(571, 29, 'Ose'),
(572, 29, 'Owo'),
(573, 30, 'Atakunmosa West'),
(574, 30, 'Aiyedaade'),
(575, 30, 'Aiyedire'),
(576, 30, 'Boluwaduro'),
(577, 30, 'Boripe'),
(578, 30, 'Ede North'),
(579, 30, 'Ede South'),
(580, 30, 'Ife Central'),
(581, 30, 'Ife East'),
(582, 30, 'Ife North'),
(583, 30, 'Ife South'),
(584, 30, 'Egbedore'),
(585, 30, 'Ejigbo'),
(586, 30, 'Ifedayo'),
(587, 30, 'Ifelodun'),
(588, 30, 'Ila'),
(589, 30, 'Ilesa East'),
(590, 30, 'Ilesa West'),
(591, 30, 'Irepodun'),
(592, 30, 'Irewole'),
(593, 30, 'Isokan'),
(594, 30, 'Iwo'),
(595, 30, 'Obokun'),
(596, 30, 'Odo Otin'),
(597, 30, 'Ola Oluwa'),
(598, 30, 'Olorunda'),
(599, 30, 'Oriade'),
(600, 30, 'Orolu'),
(601, 30, 'Osogbo'),
(602, 31, 'Akinyele'),
(603, 31, 'Atiba'),
(604, 31, 'Atisbo'),
(605, 31, 'Egbeda'),
(606, 31, 'Ibadan North'),
(607, 31, 'Ibadan North-East'),
(608, 31, 'Ibadan North-West'),
(609, 31, 'Ibadan South-East'),
(610, 31, 'Ibadan South-West'),
(611, 31, 'Ibarapa Central'),
(612, 31, 'Ibarapa East'),
(613, 31, 'Ibarapa North'),
(614, 31, 'Ido'),
(615, 31, 'Irepo'),
(616, 31, 'Iseyin'),
(617, 31, 'Itesiwaju'),
(618, 31, 'Iwajowa'),
(619, 31, 'Kajola'),
(620, 31, 'Lagelu'),
(621, 31, 'Ogbomosho North'),
(622, 31, 'Ogbomosho South'),
(623, 31, 'Ogo Oluwa'),
(624, 31, 'Olorunsogo'),
(625, 31, 'Oluyole'),
(626, 31, 'Ona Ara'),
(627, 31, 'Orelope'),
(628, 31, 'Ori Ire'),
(629, 31, 'Oyo'),
(630, 31, 'Oyo East'),
(631, 31, 'Saki East'),
(632, 31, 'Saki West'),
(633, 31, 'Surulere'),
(634, 32, 'Barkin Ladi'),
(635, 32, 'Bassa'),
(636, 32, 'Jos East'),
(637, 32, 'Jos North'),
(638, 32, 'Jos South'),
(639, 32, 'Kanam'),
(640, 32, 'Kanke'),
(641, 32, 'Langtang South'),
(642, 32, 'Langtang North'),
(643, 32, 'Mangu'),
(644, 32, 'Mikang'),
(645, 32, 'Pankshin'),
(646, 32, 'Qua\'an Pan'),
(647, 32, 'Riyom'),
(648, 32, 'Shendam'),
(649, 32, 'Wase'),
(650, 33, 'Ahoada East'),
(651, 33, 'Ahoada West'),
(652, 33, 'Akuku-Toru'),
(653, 33, 'Andoni'),
(654, 33, 'Asari-Toru'),
(655, 33, 'Bonny'),
(656, 33, 'Degema'),
(657, 33, 'Eleme'),
(658, 33, 'Emuoha'),
(659, 33, 'Etche'),
(660, 33, 'Gokana'),
(661, 33, 'Ikwerre'),
(662, 33, 'Khana'),
(663, 33, 'Obio/Akpor'),
(664, 33, 'Ogba/Egbema/Ndoni'),
(665, 33, 'Ogu/Bolo'),
(666, 33, 'Okrika'),
(667, 33, 'Omuma'),
(668, 33, 'Opobo/Nkoro'),
(669, 33, 'Oyigbo'),
(670, 33, 'Port Harcourt'),
(671, 33, 'Tai'),
(672, 34, 'Bodinga'),
(673, 34, 'Dange Shuni'),
(674, 34, 'Gada'),
(675, 34, 'Goronyo'),
(676, 34, 'Gudu'),
(677, 34, 'Gwadabawa'),
(678, 34, 'Illela'),
(679, 34, 'Isa'),
(680, 34, 'Kebbe'),
(681, 34, 'Kware'),
(682, 34, 'Rabah'),
(683, 34, 'Sabon Birni'),
(684, 34, 'Shagari'),
(685, 34, 'Silame'),
(686, 34, 'Sokoto North'),
(687, 34, 'Sokoto South'),
(688, 34, 'Tambuwal'),
(689, 34, 'Tangaza'),
(690, 34, 'Tureta'),
(691, 34, 'Wamako'),
(692, 34, 'Wurno'),
(693, 34, 'Yabo'),
(694, 35, 'Bali'),
(695, 35, 'Donga'),
(696, 35, 'Gashaka'),
(697, 35, 'Gassol'),
(698, 35, 'Ibi'),
(699, 35, 'Jalingo'),
(700, 35, 'Karim Lamido'),
(701, 35, 'Kumi'),
(702, 35, 'Lau'),
(703, 35, 'Sardauna'),
(704, 35, 'Takum'),
(705, 35, 'Ussa'),
(706, 35, 'Wukari'),
(707, 35, 'Yorro'),
(708, 35, 'Zing'),
(709, 36, 'Bursari'),
(710, 36, 'Damaturu'),
(711, 36, 'Fika'),
(712, 36, 'Fune'),
(713, 36, 'Geidam'),
(714, 36, 'Gujba'),
(715, 36, 'Gulani'),
(716, 36, 'Jakusko'),
(717, 36, 'Karasuwa'),
(718, 36, 'Machina'),
(719, 36, 'Nangere'),
(720, 36, 'Nguru'),
(721, 36, 'Potiskum'),
(722, 36, 'Tarmuwa'),
(723, 36, 'Yunusari'),
(724, 36, 'Yusufari'),
(725, 37, 'Bakura'),
(726, 37, 'Birnin Magaji/Kiyaw'),
(727, 37, 'Bukkuyum'),
(728, 37, 'Bungudu'),
(729, 37, 'Gummi'),
(730, 37, 'Gusau'),
(731, 37, 'Kaura Namoda'),
(732, 37, 'Maradun'),
(733, 37, 'Maru'),
(734, 37, 'Shinkafi'),
(735, 37, 'Talata Mafara'),
(736, 37, 'Chafe'),
(737, 37, 'Zurmi');

-- --------------------------------------------------------

--
-- Table structure for table `pk_payroll`
--

CREATE TABLE `pk_payroll` (
  `id` int(11) NOT NULL,
  `staff_id` int(5) NOT NULL,
  `basic` varchar(255) NOT NULL,
  `deduction` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `month` int(4) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_by` int(5) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pk_payroll`
--

INSERT INTO `pk_payroll` (`id`, `staff_id`, `basic`, `deduction`, `tax`, `month`, `note`, `created_by`, `date_created`) VALUES
(1, 0, '10000', '100', '1000', 0, 'thata', 0, '2018-11-02 10:43:23'),
(2, 7, '10000', '1000', '1000', 7, 'atsdgfs', 5, '2018-11-02 10:48:24'),
(3, 7, '10000', '200', '1000', 4, '', 5, '2018-11-02 14:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `pk_roles`
--

CREATE TABLE `pk_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pk_roles`
--

INSERT INTO `pk_roles` (`id`, `name`, `deleted_at`) VALUES
(1, 'Admin', NULL),
(2, 'User', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pk_states`
--

CREATE TABLE `pk_states` (
  `state_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pk_states`
--

INSERT INTO `pk_states` (`state_id`, `name`, `date_created`, `is_active`) VALUES
(1, 'Abia State', '2018-10-11 13:11:04', 1),
(2, 'Adamawa State', '2018-10-11 13:11:04', 1),
(3, 'Akwa Ibom State', '2018-10-11 13:11:04', 1),
(4, 'Anambra State', '2018-10-11 13:11:04', 1),
(5, 'Bauchi State', '2018-10-11 13:11:04', 1),
(6, 'Bayelsa State', '2018-10-11 13:11:04', 1),
(7, 'Benue State', '2018-10-11 13:11:04', 1),
(8, 'Borno State', '2018-10-11 13:11:04', 1),
(9, 'Cross River State', '2018-10-11 13:11:04', 1),
(10, 'Delta State', '2018-10-11 13:11:04', 1),
(11, 'Ebonyi State', '2018-10-11 13:11:04', 1),
(12, 'Edo State', '2018-10-11 13:11:04', 1),
(13, 'Ekiti State', '2018-10-11 13:11:04', 1),
(14, 'Enugu State', '2018-10-11 13:11:04', 1),
(15, 'FCT', '2018-10-11 13:11:04', 1),
(16, 'Gombe State', '2018-10-11 13:11:04', 1),
(17, 'Imo State', '2018-10-11 13:11:04', 1),
(18, 'Jigawa State', '2018-10-11 13:11:04', 1),
(19, 'Kaduna State', '2018-10-11 13:11:04', 1),
(20, 'Kano State', '2018-10-11 13:11:04', 1),
(21, 'Katsina State', '2018-10-11 13:11:04', 1),
(22, 'Kebbi State', '2018-10-11 13:11:04', 1),
(23, 'Kogi State', '2018-10-11 13:11:04', 1),
(24, 'Kwara State', '2018-10-11 13:11:04', 1),
(25, 'Lagos State', '2018-10-11 13:11:04', 1),
(26, 'Nasarawa State', '2018-10-11 13:11:04', 1),
(27, 'Niger State', '2018-10-11 13:11:04', 1),
(28, 'Ogun State', '2018-10-11 13:11:04', 1),
(29, 'Ondo State', '2018-10-11 13:11:04', 1),
(30, 'Osun State', '2018-10-11 13:11:04', 1),
(31, 'Oyo State', '2018-10-11 13:11:04', 1),
(32, 'Plateau State', '2018-10-11 13:11:04', 1),
(33, 'Rivers State', '2018-10-11 13:11:04', 1),
(34, 'Sokoto State', '2018-10-11 13:11:04', 1),
(35, 'Taraba State', '2018-10-11 13:11:04', 1),
(36, 'Yobe State', '2018-10-11 13:11:04', 1),
(37, 'Zamfara State', '2018-10-11 13:11:04', 1),
(38, '', '2018-10-11 16:17:33', 0),
(39, 'Allen', '2018-10-11 16:17:59', 0),
(40, 'jlsdghu7', '2018-10-11 16:18:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pk_users`
--

CREATE TABLE `pk_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `salary` decimal(10,0) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `avatar` varchar(55) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `last_ip_address` varbinary(45) DEFAULT NULL,
  `ip_address` varbinary(45) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pk_users`
--

INSERT INTO `pk_users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `position`, `activation_code`, `forgotten_password_code`, `remember_code`, `company_id`, `phone`, `address`, `salary`, `gender`, `role`, `avatar`, `created_at`, `updated_at`, `last_login`, `last_ip_address`, `ip_address`, `is_active`) VALUES
(5, 'ayobami', 'omotosho', 'ayobamimoses1@gmail.com', 'ayobamimoses1@gmail.com', '$2y$10$G2RVV5bwaMCWbd9S5LwW5uRvV7h/JL15r7xw.Y5A79NIwEGxDDYXS', '', NULL, NULL, NULL, 3, '08137230787', '6, eze anthony crescent akesan Lago', '83000', '1', 2, 'omotosho.png', '2018-10-23 13:17:36', '2018-10-30 08:54:42', NULL, NULL, '', 1),
(6, 'ayobami', 'omotosho', 'ayobamimoses71@gmail.com', '1', '$2y$10$XOJpfAxggHLVkWk2TxhiM.n5e8py4SNoh//e/XqiH3L', '', NULL, NULL, NULL, 1, '08137230787', '08137230787', '2000', '1', 1, 'omotosho1.png', '2018-10-25 09:47:32', '2018-10-25 11:01:24', NULL, NULL, '', 0),
(7, 'ayobami', 'omotosho', 'ayobamimoses21@gmail.com', '3', '$2y$10$yRFO0ljiDbKc7zAGXDbLD.gW9rsz9nzm4gKCx1bO5WeTcNdoaVx.W', '', NULL, NULL, NULL, 3, '08127230787', '08137230787', '10000', '1', 1, 'omotosho2.png', '2018-10-25 09:54:48', '2018-10-26 13:54:22', NULL, NULL, '', 1),
(8, 'Abibat', 'Oyeniyi', 'habibatoyeniyi@gmail.com', '4', '$2y$10$aCkNMxG8T0JbZ2ItcRUFZeepnBA0R3FYnXCTIpa0QUjPR8WZqoZGW', '', NULL, NULL, NULL, 4, '08085999915', '31 Adeshile', '3000', '2', 1, 'Oyeniyi.png', '2018-11-06 16:03:21', '2018-11-06 16:03:38', NULL, NULL, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pk_categories`
--
ALTER TABLE `pk_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `pk_company`
--
ALTER TABLE `pk_company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `pk_expenses`
--
ALTER TABLE `pk_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `fk1` (`created_by`),
  ADD KEY `fk2` (`updated_by`),
  ADD KEY `fk3` (`deleted_by`);

--
-- Indexes for table `pk_income`
--
ALTER TABLE `pk_income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `pk_locals`
--
ALTER TABLE `pk_locals`
  ADD PRIMARY KEY (`local_id`);

--
-- Indexes for table `pk_payroll`
--
ALTER TABLE `pk_payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pk_states`
--
ALTER TABLE `pk_states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `pk_users`
--
ALTER TABLE `pk_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pk_categories`
--
ALTER TABLE `pk_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pk_company`
--
ALTER TABLE `pk_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pk_expenses`
--
ALTER TABLE `pk_expenses`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pk_income`
--
ALTER TABLE `pk_income`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pk_locals`
--
ALTER TABLE `pk_locals`
  MODIFY `local_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=738;

--
-- AUTO_INCREMENT for table `pk_payroll`
--
ALTER TABLE `pk_payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pk_states`
--
ALTER TABLE `pk_states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pk_users`
--
ALTER TABLE `pk_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pk_categories`
--
ALTER TABLE `pk_categories`
  ADD CONSTRAINT `pk_categories_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `pk_categories_ibfk_2` FOREIGN KEY (`deleted_by`) REFERENCES `pk_users` (`id`);

--
-- Constraints for table `pk_company`
--
ALTER TABLE `pk_company`
  ADD CONSTRAINT `pk_company_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `pk_company_ibfk_2` FOREIGN KEY (`deleted_by`) REFERENCES `pk_users` (`id`);

--
-- Constraints for table `pk_expenses`
--
ALTER TABLE `pk_expenses`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`created_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`updated_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`deleted_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `pk_expenses_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `pk_company` (`id`);

--
-- Constraints for table `pk_income`
--
ALTER TABLE `pk_income`
  ADD CONSTRAINT `pk_income_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `pk_company` (`id`),
  ADD CONSTRAINT `pk_income_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `pk_income_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `pk_income_ibfk_4` FOREIGN KEY (`deleted_by`) REFERENCES `pk_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
