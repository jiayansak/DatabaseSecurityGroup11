-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 05:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hbwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL,
  `admin_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`, `admin_role`) VALUES
(8, 'neruhotel', '$2y$10$BU/Z3ntrGlEok4Ga7nxstusdE84inMwKhrn6rHXD6mn7j.NXDPmLS', 'master admin'),
(9, 'lok', '$2y$10$pf4kzQ.MEduo5RjaJ8UNd.AG2mNVshycgQDalON9tqXQoR9LPhTbG', 'manager admin'),
(10, 'jun', '$2y$10$JiszrFmk8Fg4E11lR.v7lek3q7IqyTgCbvUKpaToH2UEOiF9XoZDa', 'user admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `room_no` varchar(100) NOT NULL DEFAULT 'not assigned',
  `room_type` varchar(255) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `total_payment` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_name`, `user_id`, `booking_status`, `room_no`, `room_type`, `checkin_date`, `checkout_date`, `total_payment`, `payment_status`) VALUES
(29, 'jean', 22, 'pending', 'not assigned', 'Super Extra Premium', '2024-02-20', '2024-02-22', 1400.00, 'Paid'),
(31, 'Juin Wei', 24, 'pending', 'not assigned', 'Super Extra Premium', '2024-02-19', '2024-02-22', 2100.00, 'Paid'),
(32, 'Juin Wei', 24, 'cancelled', 'not assigned', 'Simple Room', '2024-02-20', '2024-02-21', 250.00, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(18, 'IMG93263.jpg'),
(28, 'IMG40753.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `pn2` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, 'JWEI HOTEL', 'https://maps.app.goo.gl/PC6J8AKD2PvqZVku8', 601121125252, 60122222222, '1211205730@student.mmu.edu.my', 'https://www.facebook.com/mmu.malaysia', 'https://www.instagram.com/mmumalaysia/', 'https://twitter.com/mmumalaysia', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7969.254603474639!2d101.642021!3d2.923038!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdb752b8264b1f:0xc1b5c80068997e0!2sMMU Entrance Persiaran Multimedia!5e0!3m2!1szh-CN!2smy!4v1703411140367!5m2!1szh-CN!2smy');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(1, 'wifi.svg', 'WIFI', 'Stay connected with free Wi-Fi! Experience uninterrupted internet access across our entire property with the added benefit of complimentary Wi-Fi services.'),
(2, 'oku.svg', 'FACILITIES FOR OKUs', 'Our facilities are designed to cater to the needs of all guests, providing special accommodations for those with physical challenges.'),
(3, 'business.svg', 'BUSINESS CENTER', 'Stay productive with our fully-equipped business center, offering the tools and amenities you need for a successful work session.'),
(4, 'nosmoking.svg', 'NON-SMOKING ROOM', 'Indulge in a breath of fresh air within our dedicated non-smoking rooms. Immerse yourself in a comfortable environment, free from the impact of smoke.'),
(5, 'parking.svg', 'PARKING FACILITIES', 'Maintain your health and wellness routine in our state-of-the-art gym, featuring modern equipment for a satisfying workout experience.'),
(6, 'gym.svg', 'GYM', 'Enjoy the convenience of on-site parking facilities, making your stay hassle-free and ensuring your vehicle\'s security during your visit.');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(1, 'bedroom'),
(2, 'kitchen'),
(3, 'balcony'),
(15, 'swimming pool'),
(16, 'dry cleaning'),
(17, 'ocean view');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(16, 'Simple Room', 500, 250, 30, 3, 2, 'The Standard/Simple Room offers comfortable and practical accommodation, making it ideal for budget-conscious travelers. Equipped with essential amenities, it&amp;amp;amp;#039;s well-suited for short stays or for those who spend most of their time exploring.', 1, 0),
(17, 'Deluxe Room', 600, 500, 90, 3, 3, 'Upgrade to the Deluxe Room for enhanced comfort with added space, stylish and well-furnished interiors, and additional amenities, making it a suitable choice for both leisure and business travelers seeking extra comfort.', 1, 0),
(18, 'Super Extra Premium', 650, 700, 8, 7, 3, 'Indulge in the ultimate luxury and sophistication of our Super Extra Premium Room, featuring spacious and elegantly designed interiors, high-end furnishings, exclusive decor, premium amenities, and personalized services. Perfect for those seeking a truly luxurious and indulgent experience.', 1, 0),
(23, 'Premium', 650, 650, 10, 4, 2, 'Good Premium', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(112, 16, 1),
(113, 16, 5),
(114, 17, 1),
(115, 17, 4),
(116, 17, 5),
(117, 17, 6),
(118, 18, 1),
(119, 18, 3),
(120, 18, 5),
(121, 18, 6),
(138, 23, 1),
(139, 23, 2);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(94, 16, 1),
(95, 16, 2),
(96, 16, 3),
(97, 16, 15),
(98, 16, 16),
(99, 16, 17),
(100, 17, 1),
(101, 17, 2),
(102, 17, 3),
(103, 18, 1),
(104, 18, 2),
(105, 18, 3),
(106, 18, 15),
(107, 18, 16),
(108, 18, 17),
(135, 23, 1),
(136, 23, 3),
(137, 23, 15),
(138, 23, 16);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(25, 18, 'IMG35320.jpg', 1),
(27, 18, 'IMG53512.jpeg', 0),
(29, 18, 'IMG95081.jpeg', 0),
(30, 18, 'IMG81211.jpeg', 0),
(31, 18, 'IMG62747.jpeg', 0),
(32, 16, 'IMG21376.jpeg', 1),
(33, 16, 'IMG18632.jpeg', 0),
(34, 16, 'IMG84912.jpeg', 0),
(36, 17, 'IMG12387.jpeg', 0),
(37, 17, 'IMG66639.jpeg', 1),
(38, 17, 'IMG41435.jpeg', 0),
(39, 17, 'IMG48651.jpeg', 0),
(52, 23, 'IMG18391.jpeg', 0),
(54, 23, 'IMG36960.jpg', 0),
(55, 23, 'IMG55678.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'NERU HOTEL', 'hi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(17, 'Lok Wun', 'IMG14689.jpg'),
(18, 'Juin Wei', 'IMG78070.jpg'),
(19, 'Eng Jean', 'IMG31136.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(2, 'Lew Eng Jean', 'lewengjean@gmail.com', 'sssssss', '0123456789', 12345, '2024-02-06', 'IMG82270.jpeg', '$2y$10$adRpD4ryeLndvqZfgzDXn.lld1pREa8l/pJ7nSnz64.U0RluOWQFu', 1, '497687ddbee778d7ca78609a55cb8005', NULL, 1, '2024-02-15 18:16:56'),
(18, 'jean', '1211205734@student.mmu.edu.my', 'eeeeeeeee', '01010101010', 22222, '2024-02-02', 'IMG45237.jpeg', '$2y$10$lcG0uebfPY.pFyqGO5SSWOraaDpnpweBE82hu5UIS/5qC/HexwSiq', 1, '72ad65ef65185c41ea930d0b59e038a5', NULL, 1, '2024-02-15 18:19:50'),
(26, 'JWEI', '1211205730@student.mmu.edu.my', 'sdfse', '0123', 22, '2024-04-03', 'IMG62539.jpeg', '123', 1, '2bbbab0c36aec97bb02736ea5e19d2c9', NULL, 1, '2024-04-03 00:12:31'),
(29, 'SEOW JUIN WEI', 'seowjuinwei@gmail.com', '123', '123', 123, '2025-05-14', 'IMG46764.jpeg', '$2y$10$MOMnyyQiueqNIbENbMLcw.4opk9jJ/WScnp/p9Fifz4Rq6IUK0Vni', 1, '5f7b62a4fc86cfee74ffb150ffb14070', NULL, 1, '2025-05-14 20:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(2, 'V. Fernandez', 'vfernandez@gmail.com', 'Loyalty Programs and Rewards', 'Do you have a loyalty program, and what are the benefits? How can I earn or redeem loyalty points during my stay?', '2024-01-27', 1),
(45, 'jwei', 'seowjuinwei@gmail.com', 'HI', 'How r u?', '2024-02-19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `facilities id` (`facilities_id`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features_id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features_id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
