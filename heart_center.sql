-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 10:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heart_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_userid`, `item_id`) VALUES
(1, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `con_id` int(11) NOT NULL,
  `emp_phone` varchar(11) DEFAULT NULL,
  `emp_email` varchar(255) DEFAULT NULL,
  `emp_address` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`con_id`, `emp_phone`, `emp_email`, `emp_address`) VALUES
(1, '01012345678', 'ahmed_elkholy@gmail.com', 'Tanta'),
(2, '01112345678', 'marwan_attia@gmail.com', 'Tanta'),
(3, '01212345678', 'soha_samy@gmail.com', 'Tanta');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(200) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `dept_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `user_userid`, `dept_active`) VALUES
(1, 'Finance', 1, 1),
(2, 'Doctors', 1, 1),
(3, 'Nursing', 1, 1),
(4, 'Adminstration', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(200) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `emp_age` int(11) DEFAULT NULL,
  `emp_gender` enum('male','female') DEFAULT NULL,
  `national_id` varchar(14) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `emp_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `job_id`, `dept_id`, `salary`, `hire_date`, `emp_age`, `emp_gender`, `national_id`, `user_userid`, `emp_active`) VALUES
(1, 'Ahmed hamdy Elkholy', 1, 1, 8900, '2017-05-23', 34, 'male', '12345678912345', 1, 1),
(2, 'Marwan Attia Rashdan', 2, 2, 12000, '2020-03-12', 30, 'male', '12345678912347', 1, 1),
(3, 'Soha Samy Soliman', 2, 2, 12500, '2020-03-14', 28, 'female', '12345678912346', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `exam_id` int(11) NOT NULL,
  `exam_name` varchar(200) DEFAULT NULL,
  `exam_price` float DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `exam_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `examinations`
--

INSERT INTO `examinations` (`exam_id`, `exam_name`, `exam_price`, `user_userid`, `exam_active`) VALUES
(1, 'ECHO', 300, 1, 1),
(2, 'Stress', 450, 1, 1),
(3, 'PSG', 100, 1, 1),
(4, 'ECHO FOR kids', 400, 1, 1),
(5, 'Holter', 500, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `heart_users`
--

CREATE TABLE `heart_users` (
  `user_userid` int(11) NOT NULL,
  `user_fullname` varchar(200) DEFAULT NULL,
  `user_username` varchar(150) DEFAULT NULL,
  `user_password` varchar(200) DEFAULT NULL,
  `user_usertype` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `heart_users`
--

INSERT INTO `heart_users` (`user_userid`, `user_fullname`, `user_username`, `user_password`, `user_usertype`) VALUES
(1, 'Mohammed Mohmmed Abd Elmeged', 'mohammed_mohammed', '123456', 1),
(2, 'Mostafa Mostafa Hassan', 'mostafa_hassan', '456789', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `pat_id` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `invoice_time` time DEFAULT NULL,
  `invoice_total` float DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `invoice_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `pat_id`, `invoice_date`, `invoice_time`, `invoice_total`, `emp_id`, `user_userid`, `invoice_active`) VALUES
(1, 1, '2023-10-29', '10:49:21', 375, 2, 1, 1),
(2, 2, '2023-10-29', '10:56:44', 905, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `detail_id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`detail_id`, `invoice_id`, `exam_id`, `price`, `discount`) VALUES
(1, 1, 1, 300, 25),
(2, 1, 3, 100, 0),
(3, 2, 2, 450, 25),
(4, 2, 5, 500, 20);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(150) DEFAULT NULL,
  `item_price` float DEFAULT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `item_amount` float GENERATED ALWAYS AS (`item_quantity` * `item_price`) VIRTUAL,
  `item_photo` varchar(200) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_price`, `item_quantity`, `item_photo`, `user_userid`) VALUES
(1, 'نسكافيه  - 2*1', 8, 300, '../upload_files/1700Wx1700H_115318_main.jpg', 1),
(2, 'حاج عوف - قهوة عربي', 50, 35, '../upload_files/1700Wx1700H_613889_main.jpg', 1),
(3, 'قهوة ابو عوف', 35, 100, '../upload_files/1700Wx1700H_613771_main.jpg', 1),
(4, 'بن العروبة', 45, 100, '../upload_files/1700Wx1700H_585006_main.jpg', 1),
(5, 'نسكافيه جولد بالفانليا', 8, 130, '../upload_files/1700Wx1700H_478055_main.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(200) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `job_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_title`, `user_userid`, `job_active`) VALUES
(1, 'Accountant', 1, 1),
(2, 'Doctor', 1, 1),
(3, 'Nurse', 1, 1),
(4, 'Office Boy', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `pat_id` int(11) NOT NULL,
  `pat_name` varchar(200) DEFAULT NULL,
  `pat_phone` varchar(11) DEFAULT NULL,
  `pat_age` int(11) DEFAULT NULL,
  `pat_gender` enum('male','female') DEFAULT NULL,
  `treat_id` int(11) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `pat_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`pat_id`, `pat_name`, `pat_phone`, `pat_age`, `pat_gender`, `treat_id`, `user_userid`, `pat_active`) VALUES
(1, 'Ahmed Said Saad', '01012345678', 52, 'male', 1, 1, 1),
(2, 'Seham Samy Samir', '01112345678', 44, 'female', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(200) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `section_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `section_name`, `user_userid`, `section_active`) VALUES
(1, 'Cardiology', 1, 1),
(2, 'Gastroenterology', 2, 1),
(3, 'Hematology', 1, 1),
(4, 'Hepatology', 1, 1),
(5, 'General surgery', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slide_id` int(11) NOT NULL,
  `slide_name` varchar(200) DEFAULT NULL,
  `slide_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slide_id`, `slide_name`, `slide_path`) VALUES
(1, 'Slider 1', '../upload_files/slider/1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `treat_doctors`
--

CREATE TABLE `treat_doctors` (
  `treat_id` int(11) NOT NULL,
  `treat_name` varchar(200) DEFAULT NULL,
  `treat_phone` varchar(11) DEFAULT NULL,
  `treat_gender` enum('male','female') DEFAULT NULL,
  `treat_address` varchar(255) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `user_userid` int(11) DEFAULT NULL,
  `treat_active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `treat_doctors`
--

INSERT INTO `treat_doctors` (`treat_id`, `treat_name`, `treat_phone`, `treat_gender`, `treat_address`, `section_id`, `user_userid`, `treat_active`) VALUES
(1, 'Adel Ramdan Abo Elala', '01012345678', 'male', 'Tanta', 1, 1, 1),
(2, 'Hemat Hamed Hemdan', '01112345678', 'female', 'Tanta', 2, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_user` (`user_userid`),
  ADD KEY `cart_item` (`item_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`con_id`),
  ADD UNIQUE KEY `emp_phone` (`emp_phone`),
  ADD UNIQUE KEY `emp_email` (`emp_email`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`),
  ADD KEY `dept_user` (`user_userid`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `national_id` (`national_id`),
  ADD KEY `emp_job` (`job_id`),
  ADD KEY `emp_dept` (`dept_id`),
  ADD KEY `emp_user` (`user_userid`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `exam_user` (`user_userid`);

--
-- Indexes for table `heart_users`
--
ALTER TABLE `heart_users`
  ADD PRIMARY KEY (`user_userid`),
  ADD UNIQUE KEY `user_username` (`user_username`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invoice_pat` (`pat_id`),
  ADD KEY `invoice_emp` (`emp_id`),
  ADD KEY `invoice_user` (`user_userid`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `det_inv` (`invoice_id`),
  ADD KEY `det_exam` (`exam_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_user` (`user_userid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `job_user` (`user_userid`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`pat_id`),
  ADD UNIQUE KEY `pat_phone` (`pat_phone`),
  ADD KEY `tpat_treat` (`treat_id`),
  ADD KEY `pat_user` (`user_userid`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `section_user` (`user_userid`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `treat_doctors`
--
ALTER TABLE `treat_doctors`
  ADD PRIMARY KEY (`treat_id`),
  ADD UNIQUE KEY `treat_phone` (`treat_phone`),
  ADD KEY `treat_section` (`section_id`),
  ADD KEY `treat_user` (`user_userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `heart_users`
--
ALTER TABLE `heart_users`
  MODIFY `user_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `treat_doctors`
--
ALTER TABLE `treat_doctors`
  MODIFY `treat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_user` FOREIGN KEY (`user_userid`) REFERENCES `heart_users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `dept_user` FOREIGN KEY (`user_userid`) REFERENCES `heart_users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `emp_dept` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_job` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_user` FOREIGN KEY (`user_userid`) REFERENCES `heart_users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `examinations`
--
ALTER TABLE `examinations`
  ADD CONSTRAINT `exam_user` FOREIGN KEY (`user_userid`) REFERENCES `heart_users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_emp` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_pat` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`pat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_user` FOREIGN KEY (`user_userid`) REFERENCES `heart_users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `det_exam` FOREIGN KEY (`exam_id`) REFERENCES `examinations` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `det_inv` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `item_user` FOREIGN KEY (`user_userid`) REFERENCES `heart_users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `job_user` FOREIGN KEY (`user_userid`) REFERENCES `heart_users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `pat_user` FOREIGN KEY (`user_userid`) REFERENCES `heart_users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tpat_treat` FOREIGN KEY (`treat_id`) REFERENCES `treat_doctors` (`treat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `section_user` FOREIGN KEY (`user_userid`) REFERENCES `heart_users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `treat_doctors`
--
ALTER TABLE `treat_doctors`
  ADD CONSTRAINT `treat_section` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `treat_user` FOREIGN KEY (`user_userid`) REFERENCES `heart_users` (`user_userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
