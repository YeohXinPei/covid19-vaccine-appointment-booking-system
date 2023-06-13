-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2023 at 11:07 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`email`, `password`) VALUES
('admin123@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `booster_reg`
--

CREATE TABLE `booster_reg` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(100) NOT NULL,
  `c_date` date NOT NULL,
  `c_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booster_reg`
--

INSERT INTO `booster_reg` (`id`, `date`, `time`, `venue`, `c_date`, `c_time`) VALUES
(1, '2023-02-02', '14:37:00', 'Pantai Hospital Batu Pahat', '2023-02-19', '02:02:52'),
(2, '2023-04-03', '15:45:00', 'Pantai Hospital Sungai Petani', '2023-02-19', '02:15:43'),
(3, '2023-05-14', '17:23:00', 'Metro Hospital Sungai Petani', '2023-02-20', '03:37:51'),
(4, '2023-02-03', '12:45:07', 'Pantai Hospital Batu Pahat', '2023-02-20', '05:16:40'),
(5, '2023-04-03', '13:23:17', 'Metro Hospital Sungai Petani', '2023-02-20', '06:45:45'),
(6, '2023-06-15', '19:23:45', 'Pantai Hospital Sungai Petani', '2023-02-19', '03:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `flag` int(11) DEFAULT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `ic` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postalcode` varchar(15) NOT NULL,
  `contactno` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `flag`, `firstname`, `lastname`, `ic`, `email`, `address`, `city`, `state`, `postalcode`, `contactno`, `date`, `gender`, `password`, `code`) VALUES
(1, 1, 'ivy tan', 'jia xuan', '030609-02-0894', 'ivytan@gmail.com', '135 lorong 3, taman melati jaya', 'sungai petani', 'kedah', '08000', '013-7651389', '2003-06-09', 'female', 'gffh67876gvdgv6dfggf6cdfhh9hfdgh43', ''),
(2, 1, 'XIN PEI', 'YEOH', '030822-02-0244', 'yeohxinpei123@gmail.com', '26 jalan keranji 1/3 taman bertam', 'Sungai petani kedah', 'Kedah', '08000', '018-4661801', '2003-08-22', 'female', 'a77603887301c0088552e99db10790d3', ''),
(3, 1, 'leong', 'sea hooi', '800707-02-5654', 'seahooi07@gmail.com', 'c19 taman bersatu', 'sungai petani', 'kedah', '08000', '012-5574475', '1980-07-07', 'female', 'ffd4bguhhfg7hfdghshg1hgdgxg9hhgg3ff', ''),
(4, 1, 'mok', 'chuan yi', '000615-02-0543', 'mok0987@gmail.com', '1765 taman mewah lorong7', 'sungai petani', 'kedah', '08000', '016-7462229', '15/06/2000', 'male', 'bdhab44hbbjz3jhhjh2344hjhjzhjxzbjv66v', ''),
(5, 1, 'lee', 'xuan teng', '900911-02-4567', 'lee45@gmail.com', 'taman ria jaya 67 lorong45', 'sungai petani', 'kedah', '08000', '019-5679322', '11/09/1990', 'male', 'xdgfx6chv8hvhvhj656gvgvgc7fgv667gfg', ''),
(6, 1, 'lim', 'david', '030708-02-1234', 'david123@gmail.com', '87 taman kuning , jalan batu', 'sungai petani', 'kedah', '08000', '012-5679438', '08/07/2003', 'male', 'dxrt5fhgvjh7gvhhjh8gfgffj887h766ggvhjb', ''),
(7, NULL, 'jacky', 'wong', '080101-02-5467', 'wong@gmail.com', '56 taman burma road', 'sungai petani', 'kedah', '08000', '014-6489977', '2008-01-01', 'male', 'jnjk7hjjhb7hhjbhj845egfghvhjgb7fvvu873', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booster_reg`
--
ALTER TABLE `booster_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
