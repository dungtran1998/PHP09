-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2020 at 03:41 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zendvn_sql_ex`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `ordering` int(11) NOT NULL DEFAULT 1,
  `group_acp` tinyint(1) NOT NULL DEFAULT 0,
  `permission_id` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `status`, `ordering`, `group_acp`, `permission_id`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'Admin', 1, 1, 1, '1,2,3,4,5', '2020-04-15 14:01:20', NULL, NULL, NULL),
(2, 'Mangaer', 1, 2, 1, NULL, '2020-05-19 14:04:33', 'admin', '2020-07-19 14:05:09', NULL),
(3, 'Member', 1, 3, 0, NULL, '2020-06-19 14:06:13', 'admin', NULL, 'admin'),
(4, 'Register', 1, 4, 0, NULL, '2020-07-01 14:06:51', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `module` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`, `module`, `controller`, `action`) VALUES
(1, 'Hiển thị danh sách các quyển sách', 'admin', 'book', 'index'),
(2, 'Thay đổi status một quyển sách', 'admin', 'book', 'status'),
(3, 'Thay đổi status nhiều quyển sách', 'admin', 'book', 'multi-status'),
(4, 'Cập nhật (add, edit) thông tin một quyển sách', 'admin', 'book', 'form'),
(5, 'Xóa một quyển sách', 'admin', 'book', 'delete'),
(6, 'Admin control panel', 'admin', 'index', 'index');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `avatar` text DEFAULT NULL,
  `sign` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `register_time` datetime DEFAULT NULL,
  `register_ip` varchar(255) DEFAULT NULL,
  `active_code` text DEFAULT NULL,
  `active_time` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `ordering` int(11) NOT NULL DEFAULT 11,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `firstname`, `lastname`, `password`, `avatar`, `sign`, `created`, `created_by`, `modified`, `modified_by`, `register_time`, `register_ip`, `active_code`, `active_time`, `status`, `ordering`, `group_id`) VALUES
(1, 'linhnguyen', 'linhnguyen@gmail.com', 'Linh', '', 'e10adc3949ba59abbe56e057f20f883e', 'user_abc.jpg', 'lorem lorem lorem', '2020-07-04 14:25:08', 'admin', '2020-07-19 14:25:08', NULL, NULL, 'admin', '1', NULL, 1, 2, 4),
(2, 'tuannguyen', 'tuannguyen@gmail.com', 'Tuan', NULL, '25d55ad283aa400af464c76d713c07ad', 'user_admin123.jpg', 'aksdjksadjsaldksad', '2020-07-08 14:27:34', NULL, '2020-07-23 14:27:34', NULL, NULL, NULL, NULL, NULL, 1, 2, 1),
(3, 'nvan', 'nva@gmail.com', 'An', 'Nguyễn', '9bf681667f9846315035f0b6553ad65c', 'jaksjdkldjsa.jpg', NULL, '2020-07-12 14:32:47', NULL, '2020-07-19 14:32:47', 'hailan', '2020-07-26 14:32:47', '127.0.0.1', '1', '2020-07-19 14:32:47', 1, 10, 2),
(4, 'hailan', 'lthlan54@gmail.com', 'Hai Lan', NULL, '6c3b31e17d52838cbcc89460a63368cb', NULL, NULL, '2020-07-16 14:34:18', NULL, '2020-07-30 14:22:33', NULL, '2020-07-19 14:34:18', '127.0.0.1', 'abc123xyz', NULL, 0, 10, 2);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
