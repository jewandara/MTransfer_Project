-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2016 at 07:03 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mtransfer`
--

-- --------------------------------------------------------

--
-- Table structure for table `mt_account`
--

CREATE TABLE IF NOT EXISTS `mt_account` (
  `profile_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_account`
--

INSERT INTO `mt_account` (`profile_id`, `user_id`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mt_configuration`
--

CREATE TABLE IF NOT EXISTS `mt_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mt_configuration`
--

INSERT INTO `mt_configuration` (`id`, `name`, `value`) VALUES
(1, 'website_name', 'UserCake'),
(2, 'website_url', 'localhost/'),
(3, 'email', 'noreply@ILoveUserCake.com'),
(4, 'activation', 'false'),
(5, 'resend_activation_threshold', '0'),
(6, 'language', 'models/languages/en.php'),
(7, 'template', 'models/site-templates/default.css');

-- --------------------------------------------------------

--
-- Table structure for table `mt_district`
--

CREATE TABLE IF NOT EXISTS `mt_district` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `district` varchar(500) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `body` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `mt_district`
--

INSERT INTO `mt_district` (`id`, `district`, `description`, `body`) VALUES
(1, 'Gampaha', 'https://en.wikipedia.org/wiki/Gampaha', 'Gampaha is a major city in Gampaha District, Western Province, Sri Lanka. It is situated to the north-east of the capital Colombo. It is the sixth largest urban area in Western Province, after Colombo, Negombo, Kalutara, Panadura and Avissawella. Gampaha is also the second largest city in the Gampaha district, after Negombo city. According to the facts of central index prepared by urban development authority (UDA), Gampaha city develops around 95% although the population is less than in Negombo.[2] Gampaha city has land area of 25.8 hectares and is home to the offices of 75 government institutions.'),
(2, 'Vavuniya', 'https://en.wikipedia.org/wiki/Vavuniya', 'Vavuniy is a large town in the Northern Province, Sri Lanka, governed by an Urban Council. It is also the main town in the Vavuniya District.'),
(3, 'Trincomalee', 'https://en.wikipedia.org/wiki/Trincomalee', 'Trincomalee is the administrative headquarters of the Trincomalee District and major resort port city of Eastern Province, Sri Lanka. Located on the east coast of the island overlooking the Trincomalee Harbour, 113 miles south of Jaffna and 69 miles north of Batticaloa, Trincomalee has been one of the main centres of Tamil language speaking culture on the island for over two millennia.'),
(4, 'Ampara', 'https://en.wikipedia.org/wiki/Ampara_District', 'Ampara District''s population was 648,057 in 2012. The district is one of the most diverse in Sri Lanka, both ethnically and religiously.\r\n\r\nThe population of the district, like the rest of the east and north, was affected by the civil war. The war killed an estimated 100,000 people.Several hundred thousand Sri Lankan Tamils, possibly as much as one million, emigrated to the West during the war. Many Sri Lankan Tamils also moved to the relative safety of the capital Colombo. The war also caused many people from all ethnic and religious groups who lived in the district to flee to other parts of Sri Lanka, though most of them have returned to the district since the end of the civil war.'),
(5, 'Anuradhapura', 'https://en.wikipedia.org/wiki/Anuradhapura', 'Anuradhapura is a major city in Sri Lanka. It is the capital city of North Central Province, Sri Lanka and the capital of Anuradhapura District. Anuradhapura is one of the ancient capitals of Sri Lanka, famous for its well-preserved ruins of ancient Sri Lankan civilization. It was the third capital of the Kingdom of Rajarata, following the kingdoms of Tambapanni and Upatissa Nuwara.'),
(6, 'Badulla', 'https://en.wikipedia.org/wiki/Badulla', 'Badulla is a major city in Sri Lanka. It is the capital city of Uva Province and the Badulla District. Badulla is located 60 km southeast of Kandy, almost encircled by the Badulu Oya (River), about 680 metres (2200 ft) above sea level and is surrounded by picturesque hills and mountains, most of which have tea plantations.'),
(7, 'Batticaloa', 'https://en.wikipedia.org/wiki/Batticaloa', 'Batticaloa is a major city in the Eastern Province, Sri Lanka, and its former capital. It is the administrative capital of the Batticaloa District. The city is the seat of the Eastern University of Sri Lanka and is a major commercial city. It is on the east coast, 69 miles (111 km) south by south east of Trincomalee, and is situated on an island. Pasikudah is popular tourist destinations, with beaches and flat year-round warm-water shallow-lagoons.'),
(8, 'Colombo', 'https://en.wikipedia.org/wiki/Colombo', 'Colombo is the commercial capital[3] and largest city of Sri Lanka. According to the Brookings Institution, Colombo has a population of 5.6 million metropolitan area,[4][5][6][7][8] and 752,993[2] in the City proper. It is the financial centre of the island and a popular tourist destination. It is located on the west coast of the island and adjacent to Sri Jayawardenepura Kotte, the legislative capital of Sri Lanka. Colombo is often referred to as the capital since Sri Jayawardenepura Kotte is within the urban area of, and a satellite city of, Colombo. It is also the administrative capital of Western Province, Sri Lanka and the district capital of Colombo District. Colombo is a busy and vibrant place with a mixture of modern life and colonial buildings and ruins.[9] It was the legislative capital of Sri Lanka until 1982.'),
(9, 'Galle', 'https://en.wikipedia.org/wiki/Galle', 'Galle is a major city in Sri Lanka, situated on the southwestern tip, 119 km from Colombo. Galle is the administrative capital of Southern Province, Sri Lanka and is the district capital of Galle District. Galle is the fifth largest city in Sri Lanka after the capital Colombo, Kandy, Jaffna and Negombo.'),
(10, 'Hambantota', 'https://en.wikipedia.org/wiki/Hambantota', 'Hambantota is the main town in Hambantota District, Southern Province, Sri Lanka. This underdeveloped area was hit hard by the 2004 Indian Ocean tsunami and is undergoing a number of major development projects including the construction of a new sea port and international airport. These projects and others such as Hambantota Cricket Stadium are said to form part of the government''s plan to transform Hambantota into the second major urban hub of Sri Lanka, away from Colombo.'),
(11, 'Jaffna', 'https://en.wikipedia.org/wiki/Jaffna', 'Jaffna is the capital city of the Northern Province of Sri Lanka. It is the administrative headquarters of the Jaffna district located on a peninsula of the same name. With a population of 88,138, Jaffna is Sri Lanka''s 12th largest city.[1] Jaffna is approximately six miles away from Kandarodai which served as a famous emporium in the Jaffna peninsula from classical antiquity. Jaffna''s suburb, Nallur served as the capital of the four centuries-long medieval Jaffna kingdom. Prior to the Sri Lankan civil war, it was Sri Lanka''s second most populated city after the commercial capital Colombo. The 1980s insurgent uprising led to extensive damage, expulsion of part of the population, and military occupation. Since the end of civil war in 2009, refugees and internally displaced people have started to return to their homes and government and private sector reconstruction has begun.'),
(12, 'Kalutara', 'https://en.wikipedia.org/wiki/Kalutara', 'Kalutara or Kalutota is a large town in Kalutara District, Western Province, Sri Lanka. It is also the administrative capital of Kalutara District. It is located approximately 40 km (25 mi) south of the capital Colombo.'),
(13, 'Kandy', 'https://en.wikipedia.org/wiki/Kandy', 'Kandy is a major city in Sri Lanka, located in the Central Province, Sri Lanka. It is the second largest city in the country after Colombo. It was the last capital of the ancient kings'' era of Sri Lanka.[1] The city lies in the midst of hills in the Kandy plateau, which crosses an area of tropical plantations, mainly tea. Kandy is both an administrative and religious city and is also the capital of the Central Province. Kandy is the home of The Temple of the Tooth Relic (Sri Dalada Maligawa), one of the most sacred places of worship in the Buddhist world. It was declared a world heritage site by UNESCO in 1988.'),
(14, 'Kegalle', 'https://en.wikipedia.org/wiki/Kegalle', 'Kegalle is a large town in Sabaragamuwa Province of Sri Lanka. It is located on the Colombo–Kandy road, approximately 78 km (48 mi) from Colombo and 40 km (25 mi) from Kandy. It is the main town in the Kegalle District, which is one of two districts which comprise Sabaragamuwa Province. The town is governed by an Urban Council.'),
(15, 'Kilinochchi', 'https://en.wikipedia.org/wiki/Kilinochchi', 'Kilinochchi is the main town of Kilinochchi District, Northern Province of Sri Lanka. Kilinochchi is situated at the A9 road some 100 km (62 mi) south-east of Jaffna. It was the administrative center and de facto capital of the LTTE (Tamil Tigers)[1] until 2 January 2009, when troops of the Sri Lankan Army recaptured the city.'),
(16, 'Kurunegala', 'https://en.wikipedia.org/wiki/Kurunegala', 'Kurunegala is a major city in Sri Lanka. It is the capital city of the North Western Province and the Kurunegala District. Kurunegala was an ancient royal capital for 50 years, from the end of the 13th century to the start of the 14th century. It is at the junction of several main roads linking to other important parts of the country. It is about 94 km from Colombo and 42 km from Kandy.'),
(17, 'Mannar', 'https://en.wikipedia.org/wiki/Mannar,_Sri_Lanka', 'Mannar formerly spelled Manar, is a large town and the main town of Mannar District, Northern Province, Sri Lanka. It is governed by an Urban Council. The town is located on Mannar Island overlooking the Gulf of Mannar and is home to the historic Ketheeswaram temple.'),
(18, 'Matale', 'https://en.wikipedia.org/wiki/Matale', 'Matale often written as Mathale (pronounced Maathalé), is the largest town of the Matale District of the Central Province, of Sri Lanka. It is 142 kilometres (88 mi) from Colombo and near Kandy. Surrounding the town are the Knuckles Mountain Range, the foothills were called Wiltshire by the British. It is a mainly agricultural area, where tea, rubber, vegetable and spice cultivation dominate.'),
(19, 'Matara', 'https://en.wikipedia.org/wiki/Matara,_Sri_Lanka', 'Matara is a major city in Sri Lanka, on the southern coast of Southern Province, 160 km from Colombo. It is a major commercial hub, and it is the administrative capital of Matara District.[1] It was gravely affected by the Asian tsunami in December 2004.'),
(20, 'Monaragala', 'https://en.wikipedia.org/wiki/Monaragala', 'Monaragala is a small town of Monaragala District and the largest town in Monaragala District. Monaragala is located 57.3 km northwest of Badulla the capital city of Uva Province, about 151 metres (495 ft) above the sea level and Monaragala is situated on the Colombo-Batticaloa main road.'),
(21, 'Mullaitivu', 'https://en.wikipedia.org/wiki/Mullaitivu', 'Mullaitivu is the main town of Mullaitivu District, situated on the north-eastern coast of Northern Province, Sri Lanka. A largely fishing settlement, the town in the early 20th century grew as an anchoring harbour of the small sailing vessels transporting goods between Colombo and Jaffna. The town has a District Secretary''s office, many other government institutions and schools located in and around the area.'),
(22, 'Nuwara Eliya', 'https://en.wikipedia.org/wiki/Nuwara_Eliya', 'Nuwara Eliya is a city in the hill country of the Central Province, Sri Lanka. Its name means "city on the plain (table land)" or "city of light". The city is the administrative capital of Nuwara Eliya District, with a picturesque landscape and temperate climate. It is at an altitude of 1,868 m (6,128 ft) and is considered to be the most important location for tea production in Sri Lanka. The city is overlooked by Pidurutalagala, the tallest mountain in Sri Lanka. Nuwara Eliya is known for its temperate, cool climate — the coolest area in Sri Lanka.'),
(23, 'Polonnaruwa', 'https://en.wikipedia.org/wiki/Polonnaruwa', 'Polonnaruwa is the main town of Polonnaruwa District in North Central Province, Sri Lanka. Kaduruwela area is the Polonnaruwa New Town and the other part of Polonnaruwa remains as the royal ancient city of the Kingdom of Polonnaruwa.'),
(24, 'Puttalam', 'https://en.wikipedia.org/wiki/Puttalam', 'Puttalam is a large town in Puttalam District, North Western Province, Sri Lanka. Puttalam is the administrative capital of the Puttalam District and governed by an Urban Council. Situated 130 kilometres (81 mi) north of Colombo, the capital of Sri Lanka and 95 kilometres (59 mi) north of Negombo. Puttalam is known for energy production, salt, coconut production and fishing. It has one of the largest lagoons in the country. Puttalam is popularly know for kind and hospitality people. It has many virgin tourist destination such as Wilpattu National Park, Kalpitiya, and virgin beaches, natural resources, Dolphin watch, carol watch and sand dunes etc. Puttalam town is near to Anamaduwa which is biggest city in Puttalam.'),
(25, 'Ratnapura', 'https://en.wikipedia.org/wiki/Ratnapura', 'Ratnapura is a major city in Sri Lanka. It is the capital city of Sabaragamuwa Province, Sri Lanka and the Ratnapura District. The name ''Ratnapura'' is a direct Sanskrit word meaning City (from the Sanskrit word ''Pura'') of Gems (from the Sanskrit word ''Ratna'') over 2000 years ago when the first Buddhist monks arrived here from the north eastern provinces of India namely Bodh-Gaya, Varanasi and Pataliputra they not only did bring with them the Buddhist religion but since their teachings were mainly in Sanskrit and Pali they also influenced the local language, the palm candy produced traditionally in this region, but the more common explanation in Sri Lanka is that it comes from the Sinhala "ratna" meaning gems and "pura" meaning city.[1] Ratnapura is also spelled as Rathnapura. Located some 101 km south east of capital Colombo.');

-- --------------------------------------------------------

--
-- Table structure for table `mt_hospital`
--

CREATE TABLE IF NOT EXISTS `mt_hospital` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `district_id` int(10) NOT NULL,
  `hospital` varchar(500) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `number` int(5) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL,
  `body` text,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `mt_hospital`
--

INSERT INTO `mt_hospital` (`id`, `district_id`, `hospital`, `type`, `number`, `code`, `link`, `body`, `date`) VALUES
(1, 9, 'Gamapa', 'Divisional Hospital Type B', 345, 'cc', NULL, NULL, '2016-06-19 20:12:46'),
(7, 3, 'errtrtr', 'Divisional Hospital Type A', 4, 'zz', NULL, NULL, '2016-06-19 20:12:46'),
(11, 13, 'dhdfhdfhdfh', 'Divisional Hospital Type A', 43534, 'zz', NULL, NULL, '2016-06-19 20:12:46'),
(12, 4, 'dfsdfsdfsdfsd', 'Base Hospital Type B', 5645, 'zz', NULL, NULL, '2016-06-19 20:12:46'),
(15, 1, 'Kuliyapitiyarrrrrr', 'Teaching Hospital', 4, '', '', '', '2016-06-19 20:12:46'),
(16, 17, 'fhfghdfdf', 'Base Hospital Type B', 2147483647, 'zz', NULL, NULL, '2016-06-19 20:12:46'),
(17, 15, 'eryeryhdfhfdh', 'National  Hospital', 2147483647, 'zz', NULL, NULL, '2016-06-19 20:12:46'),
(18, 10, 'Kuliyapitiya', 'District General  Hospital', 555555555, 'zz', NULL, NULL, '2016-06-19 20:12:46'),
(19, 14, 'ergdfgdfgtrtrt', 'National  Hospital', 2147483647, 'zz', NULL, NULL, '2016-06-19 20:12:46'),
(20, 1, 'Kuliyapitiyadddd', 'Provincial General Hospital', 6532, 'zz', NULL, NULL, '2016-06-19 20:12:46'),
(21, 1, 'Gampahaaaaaaaa', 'Provincial General Hospital', 8623212, 'zz', NULL, NULL, '2016-06-19 20:12:46'),
(22, 1, 'gamaaaaaa', 'Provincial General Hospital', 7, 'zz', NULL, NULL, '2016-06-19 20:13:08'),
(23, 1, 'vvvvvvv', 'Provincial General Hospital', 4382, 'zz', NULL, 'TARGET = "_blank" - HTML Code Tutorial\r\nwww.htmlcodetutorial.com/linking/_A_TARGET_95y98y108y97y110y107y.html\r\nThis value does not require the use of any frames. "_blank" is popular in web pages which are devoted to links to "other resources on the net". By opening a new ...\r\nTA', '2016-06-19 20:14:22'),
(24, 1, 'sdgsdgsd', 'District General  Hospital', 311, 'zz', NULL, NULL, '2016-06-19 20:18:04'),
(25, 1, 'sssssssssss', 'Provincial General Hospital', 209, 'zz', ' ', ' ', '2016-06-19 20:22:14'),
(26, 1, 'ccccccccccccccc', 'Provincial General Hospital', 67342, 'zz', 'https://www.facebook.com/suhada.maru/friends?ft_ref=mni', 'stackoverflow.com/questions/4964130/target-blank-vs-target-new\r\nFeb 10, 2011 - ... at least one character that does not start with a U+005F LOW LINE character. ... Using target="_blank" will instruct the browser to create a new ... All browsers sup', '2016-06-19 20:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `mt_pages`
--

CREATE TABLE IF NOT EXISTS `mt_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(150) NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `mt_pages`
--

INSERT INTO `mt_pages` (`id`, `page`, `private`) VALUES
(1, 'account.php', 1),
(2, 'activate-account.php', 0),
(3, 'admin_configuration.php', 1),
(4, 'admin_page.php', 1),
(5, 'admin_pages.php', 1),
(6, 'admin_permission.php', 1),
(7, 'admin_permissions.php', 1),
(8, 'admin_user.php', 1),
(9, 'admin_users.php', 1),
(10, 'forgot-password.php', 0),
(11, 'index.php', 0),
(12, 'left-nav.php', 0),
(13, 'login.php', 0),
(14, 'logout.php', 1),
(15, 'register.php', 0),
(16, 'resend-activation.php', 0),
(17, 'user_settings.php', 1),
(18, 'admin.php', 0),
(19, 'admin_hospital.php', 1),
(20, 'admin_hospitals.php', 1),
(21, 'register_Nurse.php', 0),
(22, 'register_Teacher.php', 0),
(23, 'admin_hospital_new.php', 1),
(24, 'hospitals.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mt_permissions`
--

CREATE TABLE IF NOT EXISTS `mt_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mt_permissions`
--

INSERT INTO `mt_permissions` (`id`, `name`) VALUES
(1, 'Teacher'),
(2, 'Administrator'),
(3, 'Nurse');

-- --------------------------------------------------------

--
-- Table structure for table `mt_permission_page_matches`
--

CREATE TABLE IF NOT EXISTS `mt_permission_page_matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `mt_permission_page_matches`
--

INSERT INTO `mt_permission_page_matches` (`id`, `permission_id`, `page_id`) VALUES
(1, 1, 1),
(2, 1, 14),
(3, 1, 17),
(4, 2, 1),
(5, 2, 3),
(6, 2, 4),
(7, 2, 5),
(8, 2, 6),
(9, 2, 7),
(10, 2, 8),
(11, 2, 9),
(12, 2, 14),
(13, 2, 17),
(23, 3, 1),
(24, 3, 14),
(25, 3, 17),
(26, 2, 20),
(27, 2, 19),
(28, 2, 23);

-- --------------------------------------------------------

--
-- Table structure for table `mt_profile`
--

CREATE TABLE IF NOT EXISTS `mt_profile` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `SurName` varchar(70) DEFAULT NULL,
  `MarriedStatus` varchar(5) DEFAULT NULL,
  `BirthDay` int(3) DEFAULT NULL,
  `BirthMonth` int(3) DEFAULT NULL,
  `BirthYear` int(5) DEFAULT NULL,
  `Gender` varchar(5) DEFAULT NULL,
  `View` int(2) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `InsertDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mt_profile`
--

INSERT INTO `mt_profile` (`id`, `FirstName`, `LastName`, `SurName`, `MarriedStatus`, `BirthDay`, `BirthMonth`, `BirthYear`, `Gender`, `View`, `UpdateDate`, `InsertDate`) VALUES
(1, 'Rachitha', 'Madusanka', 'Jeewandara', 'M', 10, 4, 1990, 'M', 1, '2016-06-20 09:17:55', '2016-06-20 09:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `mt_profile_contact`
--

CREATE TABLE IF NOT EXISTS `mt_profile_contact` (
  `profile_id` int(20) NOT NULL,
  `district_id` int(10) NOT NULL,
  `HomeAddress` varchar(300) DEFAULT NULL,
  `OfficeAddress` varchar(300) DEFAULT NULL,
  `ContactMobile` int(15) DEFAULT NULL,
  `HandPhone` int(15) DEFAULT NULL,
  `LandPhone` int(15) DEFAULT NULL,
  `FaxNumber` int(15) DEFAULT NULL,
  `OfficeEmail` varchar(70) DEFAULT NULL,
  `View` int(2) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_profile_contact`
--

INSERT INTO `mt_profile_contact` (`profile_id`, `district_id`, `HomeAddress`, `OfficeAddress`, `ContactMobile`, `HandPhone`, `LandPhone`, `FaxNumber`, `OfficeEmail`, `View`, `UpdateDate`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-06-20 09:37:11'),
(2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-06-20 10:06:45'),
(3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-06-20 10:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `mt_profile_experience`
--

CREATE TABLE IF NOT EXISTS `mt_profile_experience` (
  `profile_id` int(20) NOT NULL,
  `profileDataBase` varchar(5) NOT NULL,
  `working_database_id` int(10) DEFAULT NULL,
  `working_database_year` int(5) DEFAULT NULL,
  `database_one_id` int(10) DEFAULT NULL,
  `database_one_start_year` int(5) DEFAULT NULL,
  `database_one_start_month` int(2) DEFAULT NULL,
  `database_one_end_year` int(5) DEFAULT NULL,
  `database_one_end_month` int(2) DEFAULT NULL,
  `database_two_id` int(10) DEFAULT NULL,
  `database_two_start_year` int(5) DEFAULT NULL,
  `database_two_start_month` int(2) DEFAULT NULL,
  `database_two_end_year` int(5) DEFAULT NULL,
  `database_two_end_month` int(2) DEFAULT NULL,
  `Diploma` varchar(1000) DEFAULT NULL,
  `Degree` varchar(1000) DEFAULT NULL,
  `Institution` int(2) DEFAULT NULL,
  `Institution_district_id` int(10) DEFAULT NULL,
  `OtherExperence` text,
  `View` int(2) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_profile_experience`
--

INSERT INTO `mt_profile_experience` (`profile_id`, `profileDataBase`, `working_database_id`, `working_database_year`, `database_one_id`, `database_one_start_year`, `database_one_start_month`, `database_one_end_year`, `database_one_end_month`, `database_two_id`, `database_two_start_year`, `database_two_start_month`, `database_two_end_year`, `database_two_end_month`, `Diploma`, `Degree`, `Institution`, `Institution_district_id`, `OtherExperence`, `View`, `UpdateDate`) VALUES
(1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-06-20 10:06:02'),
(2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-06-20 10:06:10'),
(3, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-06-20 10:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `mt_request`
--

CREATE TABLE IF NOT EXISTS `mt_request` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `district_id` int(10) NOT NULL,
  `batabaseType` varchar(5) NOT NULL,
  `batabase_id` int(10) DEFAULT NULL,
  `request_start_year` int(5) DEFAULT NULL,
  `request_start_month` int(2) DEFAULT NULL,
  `request_end_year` int(5) DEFAULT NULL,
  `request_end_month` int(2) DEFAULT NULL,
  `InsertDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `UpdateDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mt_request`
--

INSERT INTO `mt_request` (`id`, `user_id`, `district_id`, `batabaseType`, `batabase_id`, `request_start_year`, `request_start_month`, `request_end_year`, `request_end_month`, `InsertDate`, `UpdateDate`) VALUES
(1, 3, 1, 'H', NULL, NULL, NULL, NULL, NULL, '2016-06-20 10:30:53', '2016-06-20 10:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `mt_users`
--

CREATE TABLE IF NOT EXISTS `mt_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(150) NOT NULL,
  `activation_token` varchar(225) NOT NULL,
  `last_activation_request` int(11) NOT NULL,
  `lost_password_request` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `title` varchar(150) NOT NULL,
  `sign_up_stamp` int(11) NOT NULL,
  `last_sign_in_stamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mt_users`
--

INSERT INTO `mt_users` (`id`, `user_name`, `display_name`, `password`, `email`, `activation_token`, `last_activation_request`, `lost_password_request`, `active`, `title`, `sign_up_stamp`, `last_sign_in_stamp`) VALUES
(1, 'jewandara@gmail.com', 'jewandara', '5b7a85538fb858c0debc1af0a2c9a9a058955409ef575ae55aa390518c3394955', 'jewandara@gmail.com', 'c2b324ffc4b24cfd2e79f9b7e5d883e9', 1466238427, 0, 1, 'Teacher', 1466238427, 1466351647),
(2, 'jewandara1@gmail.com', 'jewandara1', '88c71a1790a41c2cbc9dac6114f6037fab3950d2fd673453deb77f39c7883fea3', 'jewandara1@gmail.com', 'c05662cd5e18c54feae646773a2575b8', 1466238689, 0, 1, 'Teacher', 1466238689, 1466351335),
(3, 'jewandara2@gmail.com', 'jewandara2', 'e40e7f3fc2a29dc4f8ea73ac62b854787cefa660ff706d94da9011fa34aea0a9c', 'jewandara2@gmail.com', 'b1fa5c27ca411fa134c3d55c75651e4e', 1466238718, 0, 1, 'Nurse', 1466238718, 1466390972);

-- --------------------------------------------------------

--
-- Table structure for table `mt_user_permission_matches`
--

CREATE TABLE IF NOT EXISTS `mt_user_permission_matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mt_user_permission_matches`
--

INSERT INTO `mt_user_permission_matches` (`id`, `user_id`, `permission_id`) VALUES
(1, 1, 2),
(2, 1, 2),
(3, 2, 1),
(4, 3, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
