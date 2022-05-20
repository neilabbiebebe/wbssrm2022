-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 12:28 PM
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
(6, 'BADMINTONqweqwe'),
(7, 'LAWN TENNIS'),
(8, 'SEPAK TAKRAW'),
(9, 'FOOTSAL'),
(10, 'FOOTBALL');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `team_acro` varchar(10) NOT NULL,
  `team_coach` varchar(50) NOT NULL,
  `coach_contact` varchar(50) NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `team_acro`, `team_coach`, `coach_contact`, `logo`) VALUES
(1, 'JAVA', 'JAVA', 'JERRY ALE', '09234378910', 'java1.png'),
(2, 'JAVASCRIPT', 'JAVASCRIPT', 'BENJAMIN OMAMALIN', '09567493820', 'js1.png'),
(3, 'PHP', 'PHP', 'SHELLA OLAGUIR', '09343386659', 'php1.png'),
(4, 'PYTHON', 'PYTHON', 'GABRENE DIAZ', '09546586058', 'python1.png'),
(5, 'RUBY', 'RUBY', 'IVY JANE ASILO', '09435565778', 'ruby1.png'),
(6, 'SWIFT', 'SWIFT', 'EVANGELINE LUMANTAS', '09339844691', 'swift1.png'),
(8, 'KOTLIN', 'KOTLIN', 'JHONMAR AVERGONZADO', '09667759670', 'kotlin.jpeg');

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
(5, 11, 1, 'John Prats', '213213'),
(6, 11, 4, 'John John', '093213215'),
(7, 1, 4, 'GARAONwe', '09516422411');

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
(5, 'INTRAMURAL GAMES 2022', '2022-05-13', '2022-05-16', 'LOREM IPSUM', 'BISU BALILIHAN', '04/12/2022');

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
(121, 5, 16, 2, 'winner', 3, 'losser', 1),
(122, 5, 16, 1, 'losser', 8, 'winner', 2),
(123, 5, 16, 2, '', 8, '', 3),
(124, 5, 17, 8, 'losser', 3, 'winner', 1),
(125, 5, 17, 2, '', 1, '', 2),
(126, 5, 17, 8, '', 0, '', 3),
(127, 5, 17, 3, '', 0, '', 4),
(128, 5, 17, 0, '', 0, '', 5),
(129, 5, 17, 0, '', 0, '', 6),
(130, 5, 18, 1, '', 2, '', 0),
(131, 5, 18, 1, '', 8, '', 0),
(132, 5, 18, 2, '', 1, '', 0),
(133, 5, 18, 2, '', 8, '', 0),
(134, 5, 18, 8, '', 1, '', 0),
(135, 5, 18, 8, '', 2, '', 0);

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
(1, 121, 5, 16, 1, '2022-04-21', '07:30', '08:30', '04/20/2022'),
(2, 122, 5, 16, 1, '2022-04-20', '21:08', '22:08', '04/20/2022'),
(3, 123, 5, 16, 1, '2022-04-22', '13:00', '14:00', '04/22/2022'),
(4, 124, 5, 17, 1, '2022-05-13', '18:00', '19:00', '05/13/2022'),
(5, 125, 5, 17, 1, '2022-05-13', '20:00', '21:00', '05/13/2022');

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
(16, 5, 1, 'aw', 'lao', 1, 'Single Elimination', 4, '04/20/2022'),
(17, 5, 4, 'a', 'qwe', 1, 'Double Elimination', 4, '04/22/2022'),
(18, 5, 5, 'f', 'weriwu', 3, 'Round Robin', 3, '04/22/2022');

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
(76, 5, 16, 1),
(77, 5, 16, 2),
(78, 5, 16, 8),
(79, 5, 16, 3),
(80, 5, 17, 1),
(81, 5, 17, 2),
(82, 5, 17, 8),
(83, 5, 17, 3),
(84, 5, 18, 1),
(85, 5, 18, 2),
(86, 5, 18, 8);

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
(3, 'admin321', '8ab8482bdf8da7474f312f5fc9520325', 'Papa John', 'Active', '02/11/2022');

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
(1, 'BALILIHAN COVERED COURT123', 'MAGSIJA BALILIHAN BOHOL123'),
(2, 'BALILIHAN TENNIS COURT', 'MAGSIJA BALILIHAN BOHOL'),
(3, 'BALILIHAN VOLLEYBALL COURT', 'MAGSIJA BALILIHAN BOHOL');

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
  MODIFY `sports_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `team_sports`
--
ALTER TABLE `team_sports`
  MODIFY `team_sports_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tournament_match`
--
ALTER TABLE `tournament_match`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `tournament_schedule`
--
ALTER TABLE `tournament_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tournament_sports`
--
ALTER TABLE `tournament_sports`
  MODIFY `tour_sports_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tournament_team`
--
ALTER TABLE `tournament_team`
  MODIFY `tour_team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
