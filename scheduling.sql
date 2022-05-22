-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 03:48 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduling`
--

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `sports_id` int(11) NOT NULL,
  `sports_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`sports_id`, `sports_name`) VALUES
(1, 'BASKETBALL'),
(4, 'BASEBALL'),
(5, 'VOLLEYBALL'),
(7, 'LAWN TENNIS'),
(8, 'SEPAK TAKRAW'),
(9, 'FOOTSAL'),
(10, 'FOOTBALL'),
(13, 'BADMINTON'),
(14, 'CHESS');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `team_acro` varchar(25) NOT NULL,
  `team_coach` varchar(50) NOT NULL,
  `coach_contact` varchar(50) NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `team_acro`, `team_coach`, `coach_contact`, `logo`) VALUES
(19, 'BISU BALILIHAN CAMPUS', 'BALILIHAN', 'Benjamin Omamalin', '09051500167', 'bisu.png'),
(20, 'BISU MAIN CAMPUS', 'MAIN', 'Tagbilaran', '09245647302', 'swift.png'),
(21, 'BISU BILAR CAMPUS', 'BILAR', 'Bilar', '09274930271', 'js.png'),
(22, 'BISU CANDIJAY CAMPUS', 'CANDIJAY', 'Candijay', '09937495036', 'python.jpeg'),
(23, 'BISU CLARIN CAMPUS', 'CLARIN', 'Clarin', '09687950656', 'ruby2.jpeg'),
(24, 'BISU CALAPE CAMPUS', 'CALAPE', 'Calape', '09247593045', 'php.jpeg'),
(25, 'HOLY NAME UNIVERSITY', 'HNU', 'Esptepa', '09284957483', '');

-- --------------------------------------------------------

--
-- Table structure for table `team_sports`
--

CREATE TABLE `team_sports` (
  `team_sports_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `sports_id` int(11) NOT NULL,
  `coach_name` varchar(30) NOT NULL,
  `contact_no` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_sports`
--

INSERT INTO `team_sports` (`team_sports_id`, `team_id`, `sports_id`, `coach_name`, `contact_no`) VALUES
(14, 16, 13, 'w', '09092867423');

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `tournament_id` int(11) NOT NULL,
  `tournament_name` varchar(50) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `organizer` varchar(50) NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`tournament_id`, `tournament_name`, `start_date`, `end_date`, `description`, `organizer`, `date_added`) VALUES
(7, 'SCUAA 2022', '2022-05-21', '2022-05-27', 'lorem ipsum', 'BISU', '05/21/2022');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_match`
--

CREATE TABLE `tournament_match` (
  `match_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `tour_sports_id` int(11) NOT NULL,
  `team_id_1` int(11) NOT NULL,
  `status_1` varchar(20) NOT NULL,
  `team_id_2` int(11) NOT NULL,
  `status_2` varchar(20) NOT NULL,
  `bracket_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tournament_match`
--

INSERT INTO `tournament_match` (`match_id`, `tournament_id`, `tour_sports_id`, `team_id_1`, `status_1`, `team_id_2`, `status_2`, `bracket_no`) VALUES
(301, 7, 48, 22, 'losser', 19, 'winner', 1),
(302, 7, 48, 23, 'winner', 24, 'losser', 2),
(303, 7, 48, 24, 'losser', 22, 'winner', 3),
(304, 7, 48, 21, 'winner', 22, 'losser', 4),
(305, 7, 48, 23, 'losser', 21, 'winner', 5),
(306, 7, 48, 19, '', 23, '', 6),
(307, 7, 48, 20, '', 21, '', 7),
(308, 7, 48, 23, '', 19, '', 8),
(309, 7, 48, 24, '', 21, '', 9),
(310, 7, 48, 19, '', 22, '', 10),
(311, 7, 48, 21, '', 23, '', 11),
(312, 7, 48, 19, '', 24, '', 12),
(313, 7, 48, 19, '', 20, '', 13),
(314, 7, 48, 22, '', 20, '', 14),
(315, 7, 48, 24, '', 19, '', 15),
(316, 7, 48, 19, '', 21, '', 16),
(317, 7, 48, 22, '', 23, '', 17),
(318, 7, 48, 20, '', 24, '', 18),
(319, 7, 48, 23, '', 20, '', 19),
(320, 7, 48, 20, '', 19, '', 20),
(321, 7, 48, 22, '', 21, '', 21),
(322, 7, 48, 20, '', 22, '', 22),
(323, 7, 48, 22, '', 24, '', 23),
(324, 7, 48, 20, '', 23, '', 24),
(325, 7, 48, 21, '', 24, '', 25),
(326, 7, 48, 21, '', 20, '', 26),
(327, 7, 48, 24, '', 23, '', 27),
(328, 7, 48, 24, '', 20, '', 28),
(329, 7, 48, 23, '', 22, '', 29),
(330, 7, 48, 21, '', 19, '', 30),
(331, 7, 49, 24, 'winner', 23, 'losser', 1),
(332, 7, 49, 19, 'winner', 20, 'losser', 2),
(333, 7, 49, 21, 'winner', 24, 'losser', 3),
(334, 7, 49, 22, 'losser', 19, 'winner', 4),
(335, 7, 49, 20, 'winner', 24, 'losser', 5),
(336, 7, 49, 23, 'winner', 22, 'losser', 6),
(337, 7, 49, 23, 'losser', 20, 'winner', 7),
(338, 7, 49, 21, 'losser', 19, 'winner', 8),
(339, 7, 49, 21, 'losser', 20, 'winner', 9),
(340, 7, 49, 19, 'winner', 20, 'losser', 10),
(341, 7, 50, 24, '', 25, '', 1),
(342, 7, 50, 19, '', 22, '', 2),
(343, 7, 50, 23, '', 21, '', 3),
(344, 7, 50, 0, '', 0, '', 4),
(345, 7, 50, 20, '', 0, '', 5),
(346, 7, 50, 0, '', 0, '', 6),
(347, 7, 50, 0, '', 0, '', 7),
(348, 7, 50, 0, '', 0, '', 8),
(349, 7, 50, 0, '', 0, '', 9),
(350, 7, 50, 0, '', 0, '', 10),
(351, 7, 50, 0, '', 0, '', 11),
(352, 7, 50, 0, '', 0, '', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tournament_schedule`
--

CREATE TABLE `tournament_schedule` (
  `schedule_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `tour_sports_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `sched_date` varchar(20) NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tournament_schedule`
--

INSERT INTO `tournament_schedule` (`schedule_id`, `match_id`, `tournament_id`, `tour_sports_id`, `venue_id`, `sched_date`, `start_time`, `end_time`, `date_added`) VALUES
(1, 301, 7, 48, 1, '2022-05-22', '08:30', '09:30', '05/22/2022'),
(2, 302, 7, 48, 1, '2022-05-22', '09:45', '10:45', '05/22/2022'),
(3, 331, 7, 49, 3, '2022-05-22', '08:15', '09:14', '05/22/2022'),
(4, 303, 7, 48, 1, '2022-05-22', '11:00', '12:00', '05/22/2022'),
(5, 304, 7, 48, 1, '2022-05-22', '13:00', '14:00', '05/22/2022'),
(6, 332, 7, 49, 3, '2022-05-22', '09:15', '10:15', '05/22/2022'),
(7, 333, 7, 49, 3, '2022-05-22', '10:20', '11:20', '05/22/2022'),
(8, 334, 7, 49, 3, '2022-05-22', '13:00', '14:00', '05/22/2022'),
(9, 335, 7, 49, 3, '2022-05-22', '14:20', '15:20', '05/22/2022'),
(10, 336, 7, 49, 3, '2022-05-22', '15:30', '16:30', '05/22/2022'),
(11, 337, 7, 49, 3, '2022-05-23', '07:30', '08:30', '05/22/2022'),
(12, 338, 7, 49, 3, '2022-05-23', '08:45', '09:45', '05/22/2022'),
(13, 339, 7, 49, 3, '2022-05-23', '10:00', '11:00', '05/22/2022'),
(14, 340, 7, 49, 3, '2022-05-23', '13:00', '14:00', '05/22/2022'),
(15, 305, 7, 48, 1, '2022-05-22', '20:07', '21:07', '05/22/2022');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_sports`
--

CREATE TABLE `tournament_sports` (
  `tour_sports_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `sports_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `manager` varchar(50) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `tournament_type` varchar(50) NOT NULL,
  `no_of_teams` int(10) NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tournament_sports`
--

INSERT INTO `tournament_sports` (`tour_sports_id`, `tournament_id`, `sports_id`, `description`, `manager`, `venue_id`, `tournament_type`, `no_of_teams`, `date_added`) VALUES
(48, 7, 1, '', 'Benigno Olaguir', 1, 'Round Robin', 6, '05/22/2022'),
(49, 7, 5, 'awds', 'johhnny', 3, 'Double Elimination', 6, '05/22/2022'),
(50, 7, 10, '', 'Avergonzado', 4, 'Double Elimination', 7, '05/22/2022');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_team`
--

CREATE TABLE `tournament_team` (
  `tour_team_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `tour_sports_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tournament_team`
--

INSERT INTO `tournament_team` (`tour_team_id`, `tournament_id`, `tour_sports_id`, `team_id`) VALUES
(197, 7, 48, 19),
(198, 7, 48, 21),
(199, 7, 48, 24),
(200, 7, 48, 22),
(201, 7, 48, 23),
(202, 7, 48, 20),
(203, 7, 49, 19),
(204, 7, 49, 21),
(205, 7, 49, 24),
(206, 7, 49, 22),
(207, 7, 49, 23),
(208, 7, 49, 20),
(209, 7, 50, 19),
(210, 7, 50, 21),
(211, 7, 50, 24),
(212, 7, 50, 22),
(213, 7, 50, 23),
(214, 7, 50, 20),
(215, 7, 50, 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`, `status`, `date_added`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Active', '02/08/2022'),
(4, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'User', 'Inactive', '05/21/2022');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venue_id` int(11) NOT NULL,
  `venue_name` varchar(50) NOT NULL,
  `venue_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `venue_name`, `venue_address`) VALUES
(1, 'BALILIHAN COVERED COURT', 'MAGSIJA BALILIHAN BOHOL'),
(2, 'BALILIHAN BADMINTON COURT', 'MAGSIJA BALILIHAN BOHOL'),
(3, 'BALILIHAN VOLLEYBALL COURT', 'MAGSIJA BALILIHAN BOHOL'),
(4, 'BALILIHAN OPEN FIELD', 'MAAGSIJA BALILIHAN BOHOL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`sports_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `team_sports`
--
ALTER TABLE `team_sports`
  ADD PRIMARY KEY (`team_sports_id`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`tournament_id`);

--
-- Indexes for table `tournament_match`
--
ALTER TABLE `tournament_match`
  ADD PRIMARY KEY (`match_id`);

--
-- Indexes for table `tournament_schedule`
--
ALTER TABLE `tournament_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `tournament_sports`
--
ALTER TABLE `tournament_sports`
  ADD PRIMARY KEY (`tour_sports_id`);

--
-- Indexes for table `tournament_team`
--
ALTER TABLE `tournament_team`
  ADD PRIMARY KEY (`tour_team_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `sports_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `team_sports`
--
ALTER TABLE `team_sports`
  MODIFY `team_sports_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tournament_match`
--
ALTER TABLE `tournament_match`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `tournament_schedule`
--
ALTER TABLE `tournament_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tournament_sports`
--
ALTER TABLE `tournament_sports`
  MODIFY `tour_sports_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tournament_team`
--
ALTER TABLE `tournament_team`
  MODIFY `tour_team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
