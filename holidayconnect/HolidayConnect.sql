-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2024 at 12:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HolidayConnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PostId` int(11) NOT NULL,
  `CommentBody` varchar(50) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentId`, `UserId`, `PostId`, `CommentBody`, `Timestamp`) VALUES
(1, 2, 5, 'Wow nccc !', '2024-05-11 08:13:10'),
(2, 2, 5, 'woo', '2024-05-11 08:15:36'),
(3, 3, 10, 'image', '2024-05-11 14:01:35'),
(4, 2, 11, 'wow', '2024-05-11 14:39:35'),
(5, 2, 10, 'ncc', '2024-05-11 14:39:56'),
(6, 7, 11, 'ncc', '2024-05-11 21:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `FollowId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `IsFollowing` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`FollowId`, `UserId`, `IsFollowing`, `Timestamp`) VALUES
(8, 2, 1, '2024-05-11 08:11:34'),
(13, 1, 2, '2024-05-11 11:18:48'),
(15, 1, 3, '2024-05-11 11:32:49'),
(16, 1, 1, '2024-05-11 15:26:33'),
(17, 4, 2, '2024-05-11 15:27:33'),
(18, 4, 1, '2024-05-11 15:28:56'),
(20, 3, 1, '2024-05-11 20:48:33'),
(21, 3, 3, '2024-05-11 20:49:00'),
(22, 6, 2, '2024-05-11 21:07:28'),
(24, 7, 1, '2024-05-11 21:35:11'),
(25, 7, 2, '2024-05-11 21:35:27'),
(27, 6, 1, '2024-05-11 21:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `LikeId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PostId` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`LikeId`, `UserId`, `PostId`, `Timestamp`) VALUES
(2, 2, 5, '2024-05-11 08:11:38'),
(3, 2, 6, '2024-05-11 08:12:26'),
(6, 1, 6, '2024-05-11 08:22:12'),
(8, 1, 7, '2024-05-11 09:36:28'),
(9, 1, 11, '2024-05-11 10:04:59'),
(10, 1, 10, '2024-05-11 10:05:00'),
(11, 1, 9, '2024-05-11 10:05:01'),
(12, 1, 8, '2024-05-11 10:05:04'),
(13, 1, 5, '2024-05-11 10:05:06'),
(15, 3, 10, '2024-05-11 11:32:14'),
(16, 3, 9, '2024-05-11 11:32:15'),
(17, 3, 8, '2024-05-11 11:32:17'),
(18, 3, 7, '2024-05-11 11:32:18'),
(19, 3, 5, '2024-05-11 11:32:19'),
(20, 1, 12, '2024-05-11 11:32:58'),
(21, 3, 11, '2024-05-11 14:01:40'),
(23, 2, 11, '2024-05-11 14:38:36'),
(24, 2, 10, '2024-05-11 14:38:37'),
(25, 2, 9, '2024-05-11 14:38:38'),
(26, 2, 14, '2024-05-11 14:39:20'),
(27, 1, 14, '2024-05-11 14:50:31'),
(28, 1, 15, '2024-05-11 18:24:26'),
(29, 4, 14, '2024-05-11 19:44:47'),
(30, 4, 11, '2024-05-11 19:44:48'),
(31, 4, 10, '2024-05-11 19:44:49'),
(32, 4, 9, '2024-05-11 19:44:56'),
(33, 4, 8, '2024-05-11 19:44:57'),
(34, 4, 7, '2024-05-11 19:44:58'),
(35, 4, 16, '2024-05-11 19:49:49'),
(36, 3, 14, '2024-05-11 20:33:45'),
(37, 3, 6, '2024-05-11 20:33:52'),
(38, 3, 15, '2024-05-11 20:48:49'),
(39, 3, 13, '2024-05-11 20:49:04'),
(40, 3, 12, '2024-05-11 20:49:05'),
(41, 6, 14, '2024-05-11 21:07:43'),
(42, 6, 11, '2024-05-11 21:07:44'),
(43, 6, 10, '2024-05-11 21:07:47'),
(44, 6, 18, '2024-05-11 21:08:52'),
(45, 7, 19, '2024-05-11 21:35:05'),
(46, 7, 11, '2024-05-11 21:35:16'),
(47, 7, 14, '2024-05-11 21:36:11'),
(48, 7, 10, '2024-05-11 21:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LocationId` int(11) NOT NULL,
  `LocationName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationId`, `LocationName`) VALUES
(1, ''),
(2, 'Afghanistan'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua and Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bermuda'),
(26, 'Bhutan'),
(27, 'Bosnia and Herzegovina'),
(28, 'Botswana'),
(29, 'Bouvet Island'),
(30, 'Brazil'),
(31, 'British Indian Ocean Territory'),
(32, 'Brunei Darussalam'),
(33, 'Bulgaria'),
(34, 'Burkina Faso'),
(35, 'Burundi'),
(36, 'Cambodia'),
(37, 'Cameroon'),
(38, 'Canada'),
(39, 'Cape Verde'),
(40, 'Cayman Islands'),
(41, 'Central African Republic'),
(42, 'Chad'),
(43, 'Chile'),
(44, 'China'),
(45, 'Christmas Island'),
(46, 'Cocos (Keeling) Islands'),
(47, 'Colombia'),
(48, 'Comoros'),
(49, 'Congo'),
(50, 'Cook Islands'),
(51, 'Costa Rica'),
(52, 'Croatia'),
(53, 'Cuba'),
(54, 'Cyprus'),
(55, 'Czech Republic'),
(56, 'Denmark'),
(57, 'Djibouti'),
(58, 'Dominica'),
(59, 'Dominican Republic'),
(60, 'Ecuador'),
(61, 'Egypt'),
(62, 'El Salvador'),
(63, 'Equatorial Guinea'),
(64, 'Eritrea'),
(65, 'Estonia'),
(66, 'Ethiopia'),
(67, 'Falkland Islands (Malvinas)'),
(68, 'Faroe Islands'),
(69, 'Fiji'),
(70, 'Finland'),
(71, 'France'),
(72, 'French Guiana'),
(73, 'French Polynesia'),
(74, 'French Southern Territories'),
(75, 'Gabon'),
(76, 'Gambia'),
(77, 'Georgia'),
(78, 'Germany'),
(79, 'Ghana'),
(80, 'Gibraltar'),
(81, 'Greece'),
(82, 'Greenland'),
(83, 'Grenada'),
(84, 'Guadeloupe'),
(85, 'Guam'),
(86, 'Guatemala'),
(87, 'Guernsey'),
(88, 'Guinea'),
(89, 'Guinea-Bissau'),
(90, 'Guyana'),
(91, 'Haiti'),
(92, 'Heard Island and McDonald Islands'),
(93, 'Holy See (Vatican City State)'),
(94, 'Honduras'),
(95, 'Hong Kong'),
(96, 'Hungary'),
(97, 'Iceland'),
(98, 'India'),
(99, 'Indonesia'),
(100, 'Iraq'),
(101, 'Ireland'),
(102, 'Isle of Man'),
(103, 'Israel'),
(104, 'Italy'),
(105, 'Jamaica'),
(106, 'Japan'),
(107, 'Jersey'),
(108, 'Jordan'),
(109, 'Kazakhstan'),
(110, 'Kenya'),
(111, 'Kiribati'),
(112, 'Kuwait'),
(113, 'Kyrgyzstan'),
(114, 'Lao Peoples Democratic Republic'),
(115, 'Latvia'),
(116, 'Lebanon'),
(117, 'Lesotho'),
(118, 'Liberia'),
(119, 'Libya'),
(120, 'Liechtenstein'),
(121, 'Lithuania'),
(122, 'Luxembourg'),
(123, 'Macao'),
(124, 'Madagascar'),
(125, 'Malawi'),
(126, 'Malaysia'),
(127, 'Maldives'),
(128, 'Mali'),
(129, 'Malta'),
(130, 'Marshall Islands'),
(131, 'Martinique'),
(132, 'Mauritania'),
(133, 'Mauritius'),
(134, 'Mayotte'),
(135, 'Mexico'),
(136, 'Monaco'),
(137, 'Mongolia'),
(138, 'Montenegro'),
(139, 'Montserrat'),
(140, 'Morocco'),
(141, 'Mozambique'),
(142, 'Myanmar'),
(143, 'Namibia'),
(144, 'Nauru'),
(145, 'Nepal'),
(146, 'Netherlands'),
(147, 'New Caledonia'),
(148, 'New Zealand'),
(149, 'Nicaragua'),
(150, 'Niger'),
(151, 'Nigeria'),
(152, 'Niue'),
(153, 'Norfolk Island'),
(154, 'Northern Mariana Islands'),
(155, 'Norway'),
(156, 'Oman'),
(157, 'Pakistan'),
(158, 'Palau'),
(159, 'Panama'),
(160, 'Papua New Guinea'),
(161, 'Paraguay'),
(162, 'Peru'),
(163, 'Philippines'),
(164, 'Pitcairn'),
(165, 'Poland'),
(166, 'Portugal'),
(167, 'Puerto Rico'),
(168, 'Qatar'),
(169, 'Romania'),
(170, 'Russian Federation'),
(171, 'Rwanda'),
(172, 'Saint Kitts and Nevis'),
(173, 'Saint Lucia'),
(174, 'Saint Martin (French part)'),
(175, 'Saint Pierre and Miquelon'),
(176, 'Saint Vincent and the Grenadines'),
(177, 'Samoa'),
(178, 'San Marino'),
(179, 'Sao Tome and Principe'),
(180, 'Saudi Arabia'),
(181, 'Senegal'),
(182, 'Serbia'),
(183, 'Seychelles'),
(184, 'Sierra Leone'),
(185, 'Singapore'),
(186, 'Sint Maarten (Dutch part)'),
(187, 'Slovakia'),
(188, 'Slovenia'),
(189, 'Solomon Islands'),
(190, 'Somalia'),
(191, 'South Africa'),
(192, 'South Georgia and the South Sandwich Islands'),
(193, 'South Sudan'),
(194, 'Spain'),
(195, 'Sri Lanka'),
(196, 'Sudan'),
(197, 'SuriLocationName'),
(198, 'Svalbard and Jan Mayen'),
(199, 'Swaziland'),
(200, 'Sweden'),
(201, 'Switzerland'),
(202, 'Syrian Arab Republic'),
(203, 'Tajikistan'),
(204, 'Thailand'),
(205, 'Timor-Leste'),
(206, 'Togo'),
(207, 'Tokelau'),
(208, 'Tonga'),
(209, 'Trinidad and Tobago'),
(210, 'Tunisia'),
(211, 'Turkey'),
(212, 'Turkmenistan'),
(213, 'Turks and Caicos Islands'),
(214, 'Tuvalu'),
(215, 'Uganda'),
(216, 'Ukraine'),
(217, 'United Arab Emirates'),
(218, 'United Kingdom'),
(219, 'United States'),
(220, 'United States Minor Outlying Islands'),
(221, 'Uruguay'),
(222, 'Uzbekistan'),
(223, 'Vanuatu'),
(224, 'Viet Nam'),
(225, 'Wallis and Futuna'),
(226, 'Western Sahara'),
(227, 'Yemen'),
(228, 'Zambia'),
(229, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `NotifId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `FromUser` int(11) NOT NULL,
  `PostId` int(11) DEFAULT NULL,
  `CommentBody` varchar(50) DEFAULT NULL,
  `Notification` varchar(100) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`NotifId`, `UserId`, `FromUser`, `PostId`, `CommentBody`, `Notification`, `Timestamp`) VALUES
(9, 1, 2, NULL, NULL, 'Followed you!', '2024-05-11 08:11:34'),
(10, 1, 2, 5, NULL, 'Liked your post!', '2024-05-11 08:11:38'),
(11, 2, 2, 6, NULL, 'Liked your post!', '2024-05-11 08:12:26'),
(12, 1, 2, 5, 'Wow nccc !', 'Commented on your post!', '2024-05-11 08:13:10'),
(13, 1, 2, 5, 'woo', 'Commented on your post!', '2024-05-11 08:15:36'),
(17, 2, 1, 6, NULL, 'Liked your post!', '2024-05-11 08:22:12'),
(20, 1, 1, 7, NULL, 'Liked your post!', '2024-05-11 09:36:28'),
(23, 1, 1, 11, NULL, 'Liked your post!', '2024-05-11 10:04:59'),
(24, 1, 1, 10, NULL, 'Liked your post!', '2024-05-11 10:05:00'),
(25, 1, 1, 9, NULL, 'Liked your post!', '2024-05-11 10:05:01'),
(26, 1, 1, 8, NULL, 'Liked your post!', '2024-05-11 10:05:04'),
(27, 1, 1, 5, NULL, 'Liked your post!', '2024-05-11 10:05:06'),
(28, 2, 1, NULL, NULL, 'Followed you!', '2024-05-11 11:18:48'),
(31, 1, 3, 10, NULL, 'Liked your post!', '2024-05-11 11:32:14'),
(32, 1, 3, 9, NULL, 'Liked your post!', '2024-05-11 11:32:15'),
(33, 1, 3, 8, NULL, 'Liked your post!', '2024-05-11 11:32:17'),
(34, 1, 3, 7, NULL, 'Liked your post!', '2024-05-11 11:32:18'),
(35, 1, 3, 5, NULL, 'Liked your post!', '2024-05-11 11:32:19'),
(36, 3, 1, NULL, NULL, 'Followed you!', '2024-05-11 11:32:49'),
(37, 3, 1, 12, NULL, 'Liked your post!', '2024-05-11 11:32:58'),
(38, 1, 3, 10, 'image', 'Commented on your post!', '2024-05-11 14:01:35'),
(39, 1, 3, 11, NULL, 'Liked your post!', '2024-05-11 14:01:40'),
(41, 1, 2, 11, NULL, 'Liked your post!', '2024-05-11 14:38:36'),
(42, 1, 2, 10, NULL, 'Liked your post!', '2024-05-11 14:38:37'),
(43, 1, 2, 9, NULL, 'Liked your post!', '2024-05-11 14:38:38'),
(44, 2, 2, 14, NULL, 'Liked your post!', '2024-05-11 14:39:20'),
(45, 1, 2, 11, 'wow', 'Commented on your post!', '2024-05-11 14:39:35'),
(46, 1, 2, 10, 'ncc', 'Commented on your post!', '2024-05-11 14:39:56'),
(47, 2, 1, 14, NULL, 'Liked your post!', '2024-05-11 14:50:31'),
(48, 1, 1, NULL, NULL, 'Followed you!', '2024-05-11 15:26:33'),
(49, 2, 4, NULL, NULL, 'Followed you!', '2024-05-11 15:27:33'),
(50, 1, 4, NULL, NULL, 'Followed you!', '2024-05-11 15:28:56'),
(51, 3, 1, 15, NULL, 'Liked your post!', '2024-05-11 18:24:26'),
(52, 2, 4, 14, NULL, 'Liked your post!', '2024-05-11 19:44:47'),
(53, 1, 4, 11, NULL, 'Liked your post!', '2024-05-11 19:44:48'),
(54, 1, 4, 10, NULL, 'Liked your post!', '2024-05-11 19:44:49'),
(55, 1, 4, 9, NULL, 'Liked your post!', '2024-05-11 19:44:56'),
(56, 1, 4, 8, NULL, 'Liked your post!', '2024-05-11 19:44:57'),
(57, 1, 4, 7, NULL, 'Liked your post!', '2024-05-11 19:44:58'),
(58, 4, 4, 16, NULL, 'Liked your post!', '2024-05-11 19:49:49'),
(60, 2, 3, 14, NULL, 'Liked your post!', '2024-05-11 20:33:45'),
(61, 2, 3, 6, NULL, 'Liked your post!', '2024-05-11 20:33:52'),
(62, 1, 3, NULL, NULL, 'Followed you!', '2024-05-11 20:48:33'),
(63, 3, 3, 15, NULL, 'Liked your post!', '2024-05-11 20:48:49'),
(64, 3, 3, NULL, NULL, 'Followed you!', '2024-05-11 20:49:00'),
(65, 3, 3, 13, NULL, 'Liked your post!', '2024-05-11 20:49:04'),
(66, 3, 3, 12, NULL, 'Liked your post!', '2024-05-11 20:49:05'),
(67, 2, 6, NULL, NULL, 'Followed you!', '2024-05-11 21:07:28'),
(69, 2, 6, 14, NULL, 'Liked your post!', '2024-05-11 21:07:43'),
(70, 1, 6, 11, NULL, 'Liked your post!', '2024-05-11 21:07:44'),
(71, 1, 6, 10, NULL, 'Liked your post!', '2024-05-11 21:07:47'),
(72, 6, 6, 18, NULL, 'Liked your post!', '2024-05-11 21:08:52'),
(73, 7, 7, 19, NULL, 'Liked your post!', '2024-05-11 21:35:05'),
(74, 1, 7, NULL, NULL, 'Followed you!', '2024-05-11 21:35:11'),
(75, 1, 7, 11, NULL, 'Liked your post!', '2024-05-11 21:35:16'),
(76, 1, 7, 11, 'ncc', 'Commented on your post!', '2024-05-11 21:35:22'),
(77, 2, 7, NULL, NULL, 'Followed you!', '2024-05-11 21:35:27'),
(78, 2, 7, 14, NULL, 'Liked your post!', '2024-05-11 21:36:11'),
(79, 1, 7, 10, NULL, 'Liked your post!', '2024-05-11 21:36:12'),
(81, 1, 6, NULL, NULL, 'Followed you!', '2024-05-11 21:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `PostId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `LocationId` int(11) NOT NULL DEFAULT 1,
  `PostImage` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `Caption` varchar(100) DEFAULT '',
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`PostId`, `UserId`, `LocationId`, `PostImage`, `Caption`, `Timestamp`) VALUES
(5, 1, 195, '9901b9cf-8e58-4c3a-8fea-e2ed5c0f3f954.JPG', 'Gaming Logo', '2024-05-11 08:10:48'),
(6, 2, 195, 'download_(5).png', 'I have started my university life at IIT.', '2024-05-11 08:12:21'),
(7, 1, 1, '68D561B5B7CA417181FDABBA65D0E10F.jpg', '', '2024-05-11 09:36:22'),
(8, 1, 1, 'jonatan-pie-EvKBHBGgaUo-unsplash.jpg', '', '2024-05-11 09:40:30'),
(9, 1, 219, 'MV5BMjMxNjY2MDU1OV5BMl5BanBnXkFtZTgwNzY1MTUwNTM@__V1_FMjpg_UX1000_.jpg', 'Avengers', '2024-05-11 09:55:15'),
(10, 1, 1, 'WallpaperDog-5487207.jpg', '', '2024-05-11 09:58:32'),
(11, 1, 2, 'IMG_1879.jpg', 'Selfie', '2024-05-11 10:02:50'),
(12, 3, 1, 'Black_White_Minimalist_Business_Logo.png', '', '2024-05-11 11:31:53'),
(13, 3, 1, 'Untitled_Project.jpg', '', '2024-05-11 14:00:46'),
(14, 2, 219, 'download_(4).png', 'github', '2024-05-11 14:39:11'),
(15, 3, 1, 'Black_White_Minimalist_Business_Logo1.png', '', '2024-05-11 16:18:42'),
(16, 4, 2, 'Black_White_Minimalist_Business_Logo2.png', 'holiday team', '2024-05-11 19:47:27'),
(17, 3, 195, 'Untitled_Project_(1).jpg', '', '2024-05-11 20:49:59'),
(18, 6, 195, 'Untitled_Project1.jpg', 'gaming', '2024-05-11 21:08:48'),
(19, 7, 5, '9901b9cf-8e58-4c3a-8fea-e2ed5c0f3f955.JPG', 'Comment', '2024-05-11 21:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserBio` varchar(120) DEFAULT '',
  `UserImage` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Username`, `Name`, `Email`, `Password`, `UserBio`, `UserImage`) VALUES
(1, '@chirath', 'Chirath Thusaraka Sirimanna', 'chirath.20191168@iit.ac.lk', '$2y$10$TORos4I0gsfPox1qOkPNxe9g15eMKBKqhCmlD2t1mAXhE9w8i/sWC', 'From Sri Lanka.\n23 Y  Gamer.', 'IMG_2766_(1).jpg'),
(2, '@chirath1', 'Chirath Thusaraka Sirimanna', 'chirath.20191168@iit.ac.lk', '$2y$10$fyjqwQT6wCS8rcOTUGPye.jE2fJNlCWpT5UIVuwrRgpiFgk1CsYlK', 'Hi im chirath', 'IMG_1879-removebg-preview.png'),
(3, '@chirath2', 'Chirath Thusaraka Sirimanna', 'chirath.20191168@iit.ac.lk', '$2y$10$Yyt5YSLsyp4PTr2PuMizuOBVo3UsqDEixwVWk2a14RTGRqEbsBGRW', '', 'default.jpg'),
(4, '@chirath4', 'Chirath Thusaraka Sirimanna', 'chirath.20191168@iit.ac.lk', '$2y$10$1e4wV4wKMODEVnU7qNJLT.Kl6RK.pm/aKyo6c4cmlZbpP6PuNV1HW', '', 'default.jpg'),
(6, '@chirath3', 'Chirath Thusaraka Sirimanna', 'chirath.20191168@iit.ac.lk', '$2y$10$PKk5Y1U/U9KBXDj8ti.7AeBof36God.2W1HoI6k3uV1UuMnR.V5wW', 'Hi 19Y.', 'default.jpg'),
(7, '@chirath6', 'Chirath Sirimanna', 'chirath.20191168@iit.ac.lk', '$2y$10$5qOGMBctGB7c9h5xFKmWfOU15XIGYGCr95Pia7NGr5waM1GlP2.fO', '', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentId`),
  ADD KEY `FK_CommentUser` (`UserId`),
  ADD KEY `FK_CommentPost` (`PostId`);

--
-- Indexes for table `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`FollowId`),
  ADD KEY `FK_FollowUser` (`UserId`),
  ADD KEY `FK_FollowIsFollowing` (`IsFollowing`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`LikeId`),
  ADD KEY `FK_LikeUser` (`UserId`),
  ADD KEY `FK_LikePost` (`PostId`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LocationId`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`NotifId`),
  ADD KEY `FK_NotifUser` (`UserId`),
  ADD KEY `FK_NotifFromUser` (`FromUser`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`PostId`),
  ADD KEY `FK_PostUser` (`UserId`),
  ADD KEY `FK_PostLocation` (`LocationId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `following`
--
ALTER TABLE `following`
  MODIFY `FollowId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `LikeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `NotifId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `PostId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_CommentPost` FOREIGN KEY (`PostId`) REFERENCES `posts` (`PostId`),
  ADD CONSTRAINT `FK_CommentUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `FK_FollowIsFollowing` FOREIGN KEY (`IsFollowing`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `FK_FollowUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FK_LikePost` FOREIGN KEY (`PostId`) REFERENCES `posts` (`PostId`),
  ADD CONSTRAINT `FK_LikeUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_NotifFromUser` FOREIGN KEY (`FromUser`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `FK_NotifUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_PostLocation` FOREIGN KEY (`LocationId`) REFERENCES `location` (`LocationId`),
  ADD CONSTRAINT `FK_PostUser` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
